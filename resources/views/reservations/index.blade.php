@extends('layouts.crm')

@section('page-title', 'Réservations')

@section('content')

<div class="space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-brand-600">Réservations</p>
            <h2 class="text-3xl font-semibold text-slate-900">Liste des rendez-vous</h2>
            <p class="mt-2 text-sm text-slate-500">Tous les rendez-vous clients enregistrés.</p>
        </div>
<div class="flex gap-3">

    <a href="{{ route('reservations.calendar') }}"
       class="inline-flex items-center justify-center rounded-2xl border border-brand-600 px-5 py-3 text-sm font-semibold text-brand-600 hover:bg-brand-50">

        Calendrier

    </a>

    @can('reservations.create')
    <a href="{{ route('reservations.create') }}"
       class="inline-flex items-center justify-center rounded-2xl bg-brand-600 px-5 py-3 text-sm font-semibold text-white hover:bg-brand-700">

        Nouvelle réservation

    </a>
    @endcan

</div>
    </div>

    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <form method="GET" action="{{ route('reservations.index') }}" class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center">
            <x-text-input
                name="search"
                type="search"
                class="w-full sm:max-w-xs"
                value="{{ $search }}"
                placeholder="Rechercher client ou motif"
            />
            <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-brand-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-brand-700">
                Rechercher
            </button>
        </form>

        @php
            $statusClasses = [
                'pending' => 'bg-amber-100 text-amber-700',
                'confirmed' => 'bg-emerald-100 text-emerald-700',
                'completed' => 'bg-sky-100 text-sky-700',
                'cancelled' => 'bg-rose-100 text-rose-700',
            ];
        @endphp

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-sm">
                <thead class="bg-slate-100 text-slate-600">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold">Client</th>
                        <th class="px-4 py-3 text-left font-semibold">Date</th>
                        <th class="px-4 py-3 text-left font-semibold">Heure</th>
                        <th class="px-4 py-3 text-left font-semibold">Statut</th>
                        <th class="px-4 py-3 text-left font-semibold">Motif</th>
                        <th class="px-4 py-3 text-right font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 bg-white">
                    @forelse($reservations as $reservation)
                        <tr>
                            <td class="px-4 py-4">
                                {{ optional($reservation->customer)->first_name }} {{ optional($reservation->customer)->last_name }}
                            </td>
                            <td class="px-4 py-4">{{ $reservation->reservation_date->format('d/m/Y') }}</td>
                            <td class="px-4 py-4">{{ $reservation->reservation_time }}</td>
                            <td class="px-4 py-4">
                                <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $statusClasses[$reservation->status] ?? 'bg-slate-100 text-slate-700' }}">
                                    {{ $reservation->status_label }}
                                </span>
                            </td>
                            <td class="px-4 py-4">{{ $reservation->reason ?? '—' }}</td>
                            <td class="px-4 py-4 text-right">
                                <div class="inline-flex items-center gap-2">
                                    <a href="{{ route('reservations.show', $reservation) }}" class="rounded-full border border-slate-200 bg-slate-50 px-3 py-1 text-xs font-semibold text-slate-700 hover:bg-slate-100">Voir</a>
                                    <a href="{{ route('reservations.edit', $reservation) }}" class="rounded-full border border-brand-200 bg-brand-50 px-3 py-1 text-xs font-semibold text-brand-700 hover:bg-brand-100">Modifier</a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-10 text-center text-sm text-slate-500">Aucune réservation trouvée.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $reservations->links() }}
        </div>
    </div>
</div>

@endsection
