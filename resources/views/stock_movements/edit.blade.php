@extends('layouts.crm')

@section('page-title', 'Gestion de Stock')

@section('content')

<div class="space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-brand-600">Modifier le mouvement</p>
            <h2 class="text-3xl font-semibold text-slate-900">Modifier le mouvement de stock</h2>
            <p class="mt-2 text-sm text-slate-500">Ajustez les détails du mouvement.</p>
        </div>
        <a href="{{ route('stock-movements.index') }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Retour à la liste</a>
    </div>

    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <form method="POST" action="{{ route('stock-movements.update', $stockMovement) }}" class="space-y-6">
            @method('PUT')
            @include('stock_movements.form')

            <div class="flex justify-end gap-3">
                <a href="{{ route('stock-movements.index') }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Annuler</a>
                <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-brand-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-brand-700">Enregistrer</button>
            </div>
        </form>
    </div>
</div>

@endsection
