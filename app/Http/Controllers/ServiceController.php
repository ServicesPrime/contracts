<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Http\Controllers\Controller;
use App\Models\ServiceSpecification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;


class ServiceController extends Controller
{
    /**
     * Display a listing of services with their specifications
     */
    public function index(Request $request)
    {
        $query = Service::with('specifications');

        // Búsqueda
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('type', 'like', '%' . $search . '%')
                    ->orWhereHas('specifications', function ($spec) use ($search) {
                        $spec->where('description', 'like', '%' . $search . '%');
                    });
            });
        }

        $services = $query->orderBy('type')->get();

        return Inertia::render('Services/Index', [
            'services' => $services,
            'filters' => [
                'search' => $request->search
            ]
        ]);
    }

    /**
     * Show the form for creating a new service
     */
    public function create()
    {
        return Inertia::render('Services/Create');
    }

    /**
     * Store a newly created service in storage
     */
    public function store(Request $request)
    {
        // Primero haz el dd para ver qué datos llegan
        // dd($request->all());

        $request->validate([
            'type' => 'required|in:service,terms',           // ✅ Validar enum
            'service' => 'required|string|max:255',          // ✅ Agregado campo service
            'specifications' => 'array',
            'specifications.*.description' => 'required|string|max:255'
        ]);

        DB::transaction(function () use ($request) {
            // ✅ Crear el servicio con AMBOS campos
            $service = Service::create([
                'type' => $request->type,       // Campo type (enum)
                'service' => $request->service  // Campo service (nombre específico)
            ]);

            // Crear las especificaciones si existen
            if ($request->has('specifications')) {
                foreach ($request->specifications as $spec) {
                    if (!empty(trim($spec['description']))) {
                        $service->specifications()->create([
                            'description' => trim($spec['description'])
                        ]);
                    }
                }
            }
        });

        return redirect()->route('services.index')
            ->with('success', 'Service created successfully.');
    }
    /**
     * Display the specified service
     */
    public function show(Service $service)
    {
        $service->load('specifications');

        return Inertia::render('Services/Show', [
            'service' => $service
        ]);
    }

    /**
     * Show the form for editing the specified service
     */
    public function edit(Service $service)
    {
        $service->load('specifications');

        return Inertia::render('Services/Edit', [
            'service' => $service
        ]);
    }

    /**
     * Update the specified service in storage
     */
    public function update(Request $request, Service $service)
    {
        $request->validate([
            'type' => 'required|string|max:255',
            'specifications' => 'array',
            'specifications.*.description' => 'required|string|max:255'
        ]);

        DB::transaction(function () use ($request, $service) {
            // Actualizar el tipo de servicio
            $service->update([
                'type' => $request->type
            ]);

            // Obtener IDs de especificaciones existentes que se mantienen
            $existingSpecIds = collect($request->specifications)
                ->where('id', '!=', null)
                ->pluck('id')
                ->filter()
                ->toArray();

            // Eliminar especificaciones que ya no están en la lista
            $service->specifications()
                ->whereNotIn('id', $existingSpecIds)
                ->delete();

            // Procesar especificaciones
            foreach ($request->specifications as $specData) {
                $description = trim($specData['description']);

                if (!empty($description)) {
                    if (!empty($specData['id'])) {
                        // Actualizar especificación existente
                        ServiceSpecification::where('id', $specData['id'])
                            ->update(['description' => $description]);
                    } else {
                        // Crear nueva especificación
                        $service->specifications()->create([
                            'description' => $description
                        ]);
                    }
                }
            }
        });

        return redirect()->route('services.index')
            ->with('success', 'Service updated successfully.');
    }

    /**
     * Remove the specified service from storage
     */
    public function destroy(Service $service)
    {
        DB::transaction(function () use ($service) {
            // Las especificaciones se eliminan automáticamente por la foreign key cascade
            $service->delete();
        });

        return redirect()->route('services.index')
            ->with('success', 'Service deleted successfully.');
    }
}
