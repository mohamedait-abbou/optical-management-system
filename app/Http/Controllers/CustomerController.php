<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Mail\CustomerNotificationMail;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $customers = Customer::when($search, function ($query, $search) {
            $query->where('first_name', 'like', "%{$search}%")
                ->orWhere('last_name', 'like', "%{$search}%")
                ->orWhere('cin', 'like', "%{$search}%")
                ->orWhere('phone', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
        })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('customers.index', compact('customers', 'search'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(StoreCustomerRequest $request)
    {
        $validated = $request->validated();

        $customer = Customer::create($validated);

        // Si on vient d'un formulaire de réservation (modal)
        if ($request->has('redirect_to_reservation')) {
            return redirect()->back()->with('success', 'Client créé avec succès!')->with('new_customer_id', $customer->id);
        }

        return redirect()->route('customers.index')
            ->with('success', 'Client créé avec succès!');
    }

    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer'));
    }

    public function card(Customer $customer)
    {
        $sections = view('customers.show', compact('customer'))->renderSections();

        return response()->json([
            'title' => $customer->first_name.' '.$customer->last_name,
            'html' => $sections['content'],
        ]);
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $customer->update($request->validated());

        return redirect()->route('customers.index')
            ->with('success', 'Client modifié avec succès.');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->route('customers.index')
            ->with('success', 'Client supprimé avec succès.');
    }

    public function notifyEmail(Request $request, Customer $customer)
    {
        $data = $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        Mail::to($customer->email)->send(new CustomerNotificationMail(
            $customer,
            $data['subject'],
            $data['message']
        ));

        return back()->with('success', 'Email envoyé avec succès à '.$customer->email);
    }
}
