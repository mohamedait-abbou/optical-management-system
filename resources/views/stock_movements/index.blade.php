@extends('layouts.crm')

@section('page-title', 'Gestion de Stock')

@section('content')

<div class="space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-brand-600">Mouvements</p>
            <h2 class="text-3xl font-semibold text-slate-900">Gestion de stock</h2>
            <p class="mt-2 text-sm text-slate-500">Suivi des entrées et sorties de stock.</p>
        </div>
        <a href="{{ route('stock-movements.create') }}" class="inline-flex items-center justify-center rounded-2xl bg-brand-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-brand-700">Ajouter un mouvement</a>
    </div>

    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <form method="GET" action="{{ route('stock-movements.index') }}" class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center">
            <x-text-input
                name="search"
                type="search"
                class="w-full sm:max-w-xs"
                value="{{ $search }}"
                placeholder="Rechercher produit, référence ou type"
            />
            <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-brand-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-brand-700">Rechercher</button>
        </form>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-sm">
                <thead class="bg-slate-100 text-slate-600">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold">Produit</th>
                        <th class="px-4 py-3 text-left font-semibold">Type</th>
                        <th class="px-4 py-3 text-left font-semibold">Quantité</th>
                        <th class="px-4 py-3 text-left font-semibold">Référence</th>
                        <th class="px-4 py-3 text-left font-semibold">Utilisateur</th>
                        <th class="px-4 py-3 text-left font-semibold">Date</th>
                        <th class="px-4 py-3 text-right font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 bg-white">
                    @forelse($stockMovements as $movement)
                        <tr>
                            <td class="px-4 py-4">{{ optional($movement->product)->name }}</td>
                            <td class="px-4 py-4">
                                <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $movement->type_badge }}">{{ $movement->type_label }}</span>
                            </td>
                            <td class="px-4 py-4">{{ $movement->quantity }}</td>
                            <td class="px-4 py-4">{{ $movement->reference ?? '—' }}</td>
                            <td class="px-4 py-4">{{ optional($movement->user)->name }}</td>
                            <td class="px-4 py-4">{{ $movement->created_at->format('d/m/Y H:i') }}</td>
                            <td class="px-4 py-4 text-right">
                                <div class="inline-flex items-center gap-2">
                                    <a href="{{ route('stock-movements.show', $movement) }}" class="rounded-full border border-slate-200 bg-slate-50 px-3 py-1 text-xs font-semibold text-slate-700 hover:bg-slate-100">Voir</a>
                                    <a href="{{ route('stock-movements.edit', $movement) }}" class="rounded-full border border-brand-200 bg-brand-50 px-3 py-1 text-xs font-semibold text-brand-700 hover:bg-brand-100">Modifier</a>
                                    <form action="{{ route('stock-movements.destroy', $movement) }}" method="POST" onsubmit="return confirm('Supprimer ce mouvement de stock ?')" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="rounded-full border border-rose-200 bg-rose-50 px-3 py-1 text-xs font-semibold text-rose-700 hover:bg-rose-100">Supprimer</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-10 text-center text-sm text-slate-500">Aucun mouvement de stock trouvé.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $stockMovements->withQueryString()->links() }}
        </div>
    </div>
</div>

@endsection
