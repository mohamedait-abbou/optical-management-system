<?php

namespace App\Http\Controllers;

use App\Models\Prescription;
use App\Models\Customer;
use App\Http\Requests\StorePrescriptionRequest;
use App\Http\Requests\UpdatePrescriptionRequest;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $prescriptions = Prescription::with('customer')
            ->when($search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('doctor_name', 'like', "%{$search}%")
                          ->orWhereHas('customer', function ($q) use ($search) {
                              $q->where('first_name', 'like', "%{$search}%")
                                ->orWhere('last_name', 'like', "%{$search}%");
                          });
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('prescriptions.index', compact('prescriptions', 'search'));
    }

    public function create(Request $request)
    {
        $customers = Customer::orderBy('first_name')->get();

        // Permet de pré-sélectionner un client si on arrive depuis sa fiche
        // (ex: lien "Ajouter une prescription" depuis customers/show.blade.php)
        $selectedCustomerId = $request->query('customer_id');

        return view('prescriptions.create', compact('customers', 'selectedCustomerId'));
    }

    public function store(StorePrescriptionRequest $request)
    {
        Prescription::create($request->validated());

        return redirect()->route('prescriptions.index')
            ->with('success', 'Prescription ajoutée avec succès.');
    }

    public function show(Prescription $prescription)
    {
        return view('prescriptions.show', compact('prescription'));
    }

    public function edit(Prescription $prescription)
    {
        $customers = Customer::orderBy('first_name')->get();

        return view('prescriptions.edit', compact('prescription', 'customers'));
    }

    public function update(UpdatePrescriptionRequest $request, Prescription $prescription)
    {
        $prescription->update($request->validated());

        return redirect()->route('prescriptions.index')
            ->with('success', 'Prescription modifiée avec succès.');
    }

    public function destroy(Prescription $prescription)
    {
        $prescription->delete();

        return redirect()->route('prescriptions.index')
            ->with('success', 'Prescription supprimée avec succès.');
    }
}