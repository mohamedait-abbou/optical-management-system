<?php

namespace App\Http\Controllers;

use App\Models\PrescriptionHistory;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrescriptionHistoryController extends Controller
{
    public function index(Customer $customer)
    {
        $prescriptions = PrescriptionHistory::where('customer_id', $customer->id)
            ->with('optician')
            ->latest('examination_date')
            ->paginate(10);

        return view('prescription-history.index', compact('customer', 'prescriptions'));
    }

    public function create(Customer $customer)
    {
        return view('prescription-history.create', compact('customer'));
    }

    public function store(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'examination_date' => 'required|date',
            'od_sphere' => 'nullable|numeric|min:-20|max:20',
            'od_cylinder' => 'nullable|numeric|min:-10|max:10',
            'od_axis' => 'nullable|integer|min:0|max:180',
            'og_sphere' => 'nullable|numeric|min:-20|max:20',
            'og_cylinder' => 'nullable|numeric|min:-10|max:10',
            'og_axis' => 'nullable|integer|min:0|max:180',
            'vision_type' => 'required|in:distance,near,progressive',
            'notes' => 'nullable|string|max:1000',
        ]);

        $validated['customer_id'] = $customer->id;
        $validated['user_id'] = Auth::id();

        PrescriptionHistory::create($validated);

        return redirect()->route('prescription-history.index', $customer)
            ->with('success', 'Prescription enregistrée avec succès!');
    }

    public function edit(Customer $customer, PrescriptionHistory $prescription)
    {
        return view('prescription-history.edit', compact('customer', 'prescription'));
    }

    public function update(Request $request, Customer $customer, PrescriptionHistory $prescription)
    {
        $validated = $request->validate([
            'examination_date' => 'required|date',
            'od_sphere' => 'nullable|numeric|min:-20|max:20',
            'od_cylinder' => 'nullable|numeric|min:-10|max:10',
            'od_axis' => 'nullable|integer|min:0|max:180',
            'og_sphere' => 'nullable|numeric|min:-20|max:20',
            'og_cylinder' => 'nullable|numeric|min:-10|max:10',
            'og_axis' => 'nullable|integer|min:0|max:180',
            'vision_type' => 'required|in:distance,near,progressive',
            'notes' => 'nullable|string|max:1000',
        ]);

        $prescription->update($validated);

        return redirect()->route('prescription-history.index', $customer)
            ->with('success', 'Prescription mise à jour!');
    }

    public function destroy(Customer $customer, PrescriptionHistory $prescription)
    {
        $prescription->delete();

        return redirect()->route('prescription-history.index', $customer)
            ->with('success', 'Prescription supprimée.');
    }

    // API endpoint for charts
    public function getEvolution(Customer $customer)
    {
        $prescriptions = PrescriptionHistory::where('customer_id', $customer->id)
            ->orderBy('examination_date')
            ->get(['examination_date', 'od_sphere', 'og_sphere', 'od_cylinder', 'og_cylinder']);

        return response()->json([
            'dates' => $prescriptions->pluck('examination_date')->map(fn($d) => $d->format('d/m/Y')),
            'od_sphere' => $prescriptions->pluck('od_sphere'),
            'og_sphere' => $prescriptions->pluck('og_sphere'),
            'od_cylinder' => $prescriptions->pluck('od_cylinder'),
            'og_cylinder' => $prescriptions->pluck('og_cylinder'),
        ]);
    }
}