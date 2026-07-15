@extends('layouts.crm')

@section('page-title', 'Modifier une réservation')

@section('content')

<div class="space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-indigo-600">Réservation</p>
            <h2 class="text-3xl font-semibold text-slate-900">Modifier le rendez-vous</h2>
            <p class="mt-2 text-sm text-slate-500">Mettez à jour les détails du rendez-vous.</p>
        </div>
        <a href="{{ route('reservations.index') }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Retour à la liste</a>
    </div>

    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <form method="POST" action="{{ route('reservations.update', $reservation) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid gap-6 sm:grid-cols-2">
                <div>
                    <x-input-label for="customer_id" value="Client" />
                    <div class="mt-2 flex gap-2">
                        <select id="customer_id" name="customer_id" class="flex-1 rounded-xl border border-slate-300 px-4 py-3">
                            <option value="">Sélectionnez un client</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}" {{ old('customer_id', $reservation->customer_id) == $customer->id ? 'selected' : '' }}>
                                    {{ $customer->first_name }} {{ $customer->last_name }}
                                </option>
                            @endforeach
                        </select>
                        <button type="button" onclick="openNewCustomerModal()"
                            class="inline-flex items-center justify-center rounded-xl border border-indigo-200 bg-indigo-50 px-4 py-3 text-sm font-semibold text-indigo-700 transition hover:bg-indigo-100 whitespace-nowrap">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 5v14M5 12h14"/>
                            </svg>
                            Nouveau client
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('customer_id')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="reservation_date" value="Date" />
                    <x-text-input id="reservation_date" name="reservation_date" type="date" class="mt-2 w-full" value="{{ old('reservation_date', $reservation->reservation_date->toDateString()) }}" />
                    <x-input-error :messages="$errors->get('reservation_date')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="reservation_time" value="Heure" />
                    <x-text-input id="reservation_time" name="reservation_time" type="time" class="mt-2 w-full" value="{{ old('reservation_time', $reservation->reservation_time) }}" />
                    <x-input-error :messages="$errors->get('reservation_time')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="status" value="Statut" />
                    <select id="status" name="status" class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3">
                        <option value="pending" {{ old('status', $reservation->status) === 'pending' ? 'selected' : '' }}>En attente</option>
                        <option value="confirmed" {{ old('status', $reservation->status) === 'confirmed' ? 'selected' : '' }}>Confirmée</option>
                        <option value="completed" {{ old('status', $reservation->status) === 'completed' ? 'selected' : '' }}>Terminée</option>
                        <option value="cancelled" {{ old('status', $reservation->status) === 'cancelled' ? 'selected' : '' }}>Annulée</option>
                    </select>
                    <x-input-error :messages="$errors->get('status')" class="mt-2" />
                </div>
            </div>

            <div class="grid gap-6 sm:grid-cols-2">
                <div>
                    <x-input-label for="reason" value="Motif" />
                    <x-text-input id="reason" name="reason" type="text" class="mt-2 w-full" value="{{ old('reason', $reservation->reason) }}" />
                    <x-input-error :messages="$errors->get('reason')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="notes" value="Notes" />
                    <textarea id="notes" name="notes" rows="4" class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm text-slate-700">{{ old('notes', $reservation->notes) }}</textarea>
                    <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                </div>
            </div>

            <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">
                <a href="{{ route('reservations.index') }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Annuler</a>
                <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-indigo-700">Enregistrer les modifications</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Nouveau Client -->
<div id="newCustomerModal" class="hidden fixed inset-0 z-50 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-slate-900 bg-opacity-75" onclick="closeNewCustomerModal()"></div>
        
        <div class="inline-block w-full max-w-md p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white rounded-3xl shadow-xl">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-bold text-slate-900">Nouveau Client</h3>
                <button onclick="closeNewCustomerModal()" class="p-2 rounded-xl hover:bg-slate-100 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            
            <form id="newCustomerForm" action="{{ route('customers.store') }}" method="POST">
                @csrf
                <input type="hidden" name="redirect_to_reservation" value="1">
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Prénom *</label>
                        <input type="text" name="first_name" required
                            class="w-full rounded-xl border border-slate-200 px-4 py-2 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Nom *</label>
                        <input type="text" name="last_name" required
                            class="w-full rounded-xl border border-slate-200 px-4 py-2 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Téléphone</label>
                        <input type="tel" name="phone"
                            class="w-full rounded-xl border border-slate-200 px-4 py-2 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                        <input type="email" name="email"
                            class="w-full rounded-xl border border-slate-200 px-4 py-2 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200">
                    </div>
                </div>
                
                <div class="mt-6 flex gap-3">
                    <button type="button" onclick="closeNewCustomerModal()"
                        class="flex-1 px-4 py-2 rounded-xl border border-slate-200 bg-slate-50 text-slate-700 font-medium hover:bg-slate-100 transition">
                        Annuler
                    </button>
                    <button type="submit"
                        class="flex-1 px-4 py-2 rounded-xl bg-indigo-600 text-white font-medium hover:bg-indigo-700 transition">
                        Créer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openNewCustomerModal() {
    document.getElementById('newCustomerModal').classList.remove('hidden');
}

function closeNewCustomerModal() {
    document.getElementById('newCustomerModal').classList.add('hidden');
}
</script>

@endsection