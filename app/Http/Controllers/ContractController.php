<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Contract;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ContractController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $contracts = Contract::when($search, function ($query, $search) {
            $query->where('name', 'like', "%$search%")
                ->orWhere('contract_number', 'like', "%$search%")
                ->orWhere('location', 'like', "%$search%")
                ->orWhere('date', 'like', "%$search%");
        })->get();

        return Inertia::render('Contracts/Index', [
            'contracts' => $contracts,
            'filters' => [
                'search' => $search,
            ],
        ]);
    }



    public function downloadPdf($id)
    {
        $contract = Contract::findOrFail($id);

        $pdf = Pdf::loadView('contracts.pdf', compact('contract'));

        return $pdf->download("contract-{$contract->contract_number}.pdf");
    }

    public function update(Request $request, Contract $contract)
    {
        $validated = $request->validate([
            'contract_number' => 'required|numeric|unique:contracts,contract_number,' . $contract->id,
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'product_description' => 'required|string',
            'product_quantity' => 'required|integer',
            'product_cost' => 'required|numeric',
            'date' => 'required|date',
        ]);

        $contract->update($validated);

        return redirect()->back();
    }
}
