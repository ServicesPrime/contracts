<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Address;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $clients = Client::with('address')
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return Inertia::render('Clients/Index', [
            'clients' => $clients,
            'filters' => $request->only(['search'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Clients/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClientRequest $request)
    {
        try {
            $client = DB::transaction(function () use ($request) {

                // 1. PRIMERO crear la dirección (tabla padre)
                $address = null;
                if ($request->hasAddressData()) {
                    $addressData = $request->getAddressData();
                    $addressData['full_address'] = $request->getFullAddress();

                    $address = Address::create($addressData);
                }

                // 2. DESPUÉS crear el cliente con el address_id (tabla hija)
                $clientData = $request->getClientData();
                if ($address) {
                    $clientData['address_id'] = $address->id;
                }

                $client = Client::create($clientData);

                return $client;
            });

            return redirect()->route('client.index')
                ->with('success', 'Client created successfully!');
        } catch (\Exception $e) {
            Log::error('Error creating client: ' . $e->getMessage(), [
                'request_data' => $request->all(),
                'stack_trace' => $e->getTraceAsString()
            ]);

            return back()
                ->withErrors(['error' => 'An error occurred while creating the client. Please try again.'])
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        $client->load('address');

        return Inertia::render('Clients/Show', [
            'client' => $client
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        return Inertia::render('Clients/Create', [ // Mismo componente!
            'client' => $client->load('address')
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClientRequest $request, Client $client)
    {
        try {
            DB::transaction(function () use ($request, $client) {

                // 1. Manejar la dirección primero
                if ($request->hasAddressData()) {
                    $addressData = $request->getAddressData();
                    $addressData['full_address'] = $request->getFullAddress();

                    if ($client->address_id) {
                        // Actualizar dirección existente
                        $client->address->update($addressData);
                    } else {
                        // Crear nueva dirección
                        $address = Address::create($addressData);
                        $client->address_id = $address->id;
                    }
                } else {
                    // Si no hay datos de dirección, eliminar la relación
                    if ($client->address_id) {
                        $addressToDelete = $client->address;
                        $client->address_id = null;
                        $client->save();

                        // Verificar si otros clientes usan esta dirección
                        if ($addressToDelete && $addressToDelete->clients()->count() === 0) {
                            $addressToDelete->delete();
                        }
                    }
                }

                // 2. Actualizar el cliente
                $clientData = $request->getClientData();
                $client->update($clientData);
            });

            return redirect()->route('client.index')
                ->with('success', 'Client updated successfully!');
        } catch (\Exception $e) {
            Log::error('Error updating client: ' . $e->getMessage(), [
                'client_id' => $client->id,
                'request_data' => $request->all(),
                'stack_trace' => $e->getTraceAsString()
            ]);

            return back()
                ->withErrors(['error' => 'An error occurred while updating the client. Please try again.'])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        try {
            DB::transaction(function () use ($client) {
                $addressToCheck = $client->address;
                $clientName = $client->name;

                // Eliminar el cliente
                $client->delete();

                // Si la dirección no tiene otros clientes, eliminarla también
                if ($addressToCheck && $addressToCheck->clients()->count() === 0) {
                    $addressToCheck->delete();
                }
            });

            return redirect()->route('client.index')
                ->with('success', 'Client deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Error deleting client: ' . $e->getMessage(), [
                'client_id' => $client->id,
                'stack_trace' => $e->getTraceAsString()
            ]);

            return back()
                ->withErrors(['error' => 'An error occurred while deleting the client. Please try again.']);
        }
    }

    /**
     * Método adicional para búsqueda AJAX (opcional)
     */
    public function search(Request $request)
    {
        $search = $request->get('query', '');

        $clients = Client::with('address')
            ->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('area', 'like', "%{$search}%");
            })
            ->limit(10)
            ->get();

        return response()->json($clients);
    }
}
