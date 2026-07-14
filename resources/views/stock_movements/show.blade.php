@extends('layouts.crm')

@section('page-title', 'Gestion de Stock')

@section('content')

<div class="space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-brand-600">Mouvement</p>
            <h2 class="text-3xl font-semibold text-slate-900">Détail du mouvement</h2>
            <p class="mt-2 text-sm text-slate-500">Visualisez les informations complètes du mouvement.</p>
        </div>
        <a href="{{ route('stock-movements.index') }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Retour à la liste</a>
    </div>

    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <div class="grid gap-6 sm:grid-cols-2">
            <div>
                <p class="text-sm font-semibold text-slate-500">Produit</p>
                <p class="mt-2 text-base font-medium text-slate-900">{{ optional($stockMovement->product)->name }}</p>
            </div>
            <div>
                <p class="text-sm font-semibold text-slate-500">Stock actuel</p>
                <p class="mt-2 text-base font-medium text-slate-900">{{ optional($stockMovement->product)->quantity }}</p>
            </div>
            <div>
                <p class="text-sm font-semibold text-slate-500">Type de mouvement</p>
                <p class="mt-2 inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $stockMovement->type_badge }}">{{ $stockMovement->type_label }}</p>
            </div>
            <div>
                <p class="text-sm font-semibold text-slate-500">Quantité</p>
                <p class="mt-2 text-base font-medium text-slate-900">{{ $stockMovement->quantity }}</p>
            </div>
        </div>

        <div class="mt-8 grid gap-6 sm:grid-cols-2">
            <div>
                <p class="text-sm font-semibold text-slate-500">Référence</p>
                <p class="mt-2 text-base font-medium text-slate-900">{{ $stockMovement->reference ?? '—' }}</p>
            </div>
            <div>
                <p class="text-sm font-semibold text-slate-500">Créé par</p>
                <p class="mt-2 text-base font-medium text-slate-900">{{ optional($stockMovement->user)->name }}</p>
            </div>
        </div>

        <div class="mt-8">
            <p class="text-sm font-semibold text-slate-500">Notes</p>
            <p class="mt-2 text-sm text-slate-700">{{ $stockMovement->notes ?? 'Aucune note' }}</p>
        </div>

        <div class="mt-8 grid gap-6 sm:grid-cols-2">
            <div>
                <p class="text-sm font-semibold text-slate-500">Créé le</p>
                <p class="mt-2 text-base font-medium text-slate-900">{{ $stockMovement->created_at->format('d/m/Y H:i') }}</p>
            </div>
            <div class="flex items-end justify-end gap-3">
                <a href="{{ route('stock-movements.edit', $stockMovement) }}" class="inline-flex items-center justify-center rounded-2xl bg-brand-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-brand-700">Modifier</a>
                <form action="{{ route('stock-movements.destroy', $stockMovement) }}" method="POST" onsubmit="return confirm('Supprimer ce mouvement de stock ?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center justify-center rounded-2xl border border-rose-200 bg-rose-50 px-5 py-3 text-sm font-semibold text-rose-700 transition hover:bg-rose-100">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
