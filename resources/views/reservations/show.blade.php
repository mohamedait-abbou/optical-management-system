@extends('layouts.crm')

@section('page-title', 'Réservation')

@section('content')

<div class="space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-brand-600">Réservation</p>
            <h2 class="text-3xl font-semibold text-slate-900">Détails du rendez-vous</h2>
            <p class="mt-2 text-sm text-slate-500">Vue détaillée de la réservation client.</p>
        </div>
        <div class="flex flex-col gap-3 sm:flex-row">
            <a href="{{ route('reservations.edit', $reservation) }}" class="inline-flex items-center justify-center rounded-2xl bg-brand-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-brand-700">Modifier</a>
            <a href="{{ route('reservations.index') }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Retour à la liste</a>
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-[1fr_320px]">
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="grid gap-6 sm:grid-cols-2">
                <div>
                    <p class="text-sm font-semibold text-slate-500">Client</p>
                    <p class="mt-2 text-base font-medium text-slate-900">{{ optional($reservation->customer)->first_name }} {{ optional($reservation->customer)->last_name }}</p>
                </div>

                <div>
                    <p class="text-sm font-semibold text-slate-500">Date</p>
                    <p class="mt-2 text-base font-medium text-slate-900">{{ $reservation->reservation_date->format('d/m/Y') }}</p>
                </div>

                <div>
                    <p class="text-sm font-semibold text-slate-500">Heure</p>
                    <p class="mt-2 text-base font-medium text-slate-900">{{ $reservation->reservation_time }}</p>
                </div>

                <div>
                    <p class="text-sm font-semibold text-slate-500">Statut</p>
                    <span class="mt-2 inline-flex rounded-full px-3 py-1 text-sm font-semibold {{ $reservation->status === 'pending' ? 'bg-amber-100 text-amber-700' : ($reservation->status === 'confirmed' ? 'bg-emerald-100 text-emerald-700' : ($reservation->status === 'completed' ? 'bg-sky-100 text-sky-700' : 'bg-rose-100 text-rose-700')) }}">
                        {{ $reservation->status_label }}
                    </span>
                </div>
            </div>

            <div class="mt-8 grid gap-6">
                <div>
                    <p class="text-sm font-semibold text-slate-500">Motif</p>
                    <p class="mt-2 text-sm text-slate-700">{{ $reservation->reason ?? 'Aucun motif' }}</p>
                </div>

                <div>
                    <p class="text-sm font-semibold text-slate-500">Notes</p>
                    <p class="mt-2 text-sm text-slate-700">{{ $reservation->notes ?? 'Aucune note' }}</p>
                </div>
            </div>
        </div>

        <div class="space-y-4 rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="rounded-3xl border border-slate-200 bg-slate-50 p-4 text-sm text-slate-600">
                <p class="font-semibold">Informations</p>
                <p class="mt-2">Les détails du rendez-vous sont affichés ici. Utilisez le bouton Modifier pour mettre à jour la réservation.</p>
            </div>
            <form method="POST" action="{{ route('reservations.destroy', $reservation) }}" onsubmit="return confirm('Supprimer cette réservation ?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex w-full items-center justify-center rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm font-semibold text-rose-700 transition hover:bg-rose-100">Supprimer la réservation</button>
            </form>
        </div>
    </div>
</div>

@endsection
