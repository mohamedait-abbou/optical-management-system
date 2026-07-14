@extends('layouts.crm')

@section('page-title', 'Modifier une réservation')

@section('content')

<div class="space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-brand-600">Réservation</p>
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
                    <select id="customer_id" name="customer_id" class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3">
                        <option value="">Sélectionnez un client</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}" {{ old('customer_id', $reservation->customer_id) == $customer->id ? 'selected' : '' }}>
                                {{ $customer->first_name }} {{ $customer->last_name }}
                            </option>
                        @endforeach
                    </select>
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
                <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-brand-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-brand-700">Enregistrer les modifications</button>
            </div>
        </form>
    </div>
</div>

@endsection
