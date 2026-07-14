@extends('layouts.crm')

@section('page-title', 'Créer une commande')

@section('content')

<div class="space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-brand-600">Nouvelle commande</p>
            <h2 class="text-3xl font-semibold text-slate-900">Créer une commande</h2>
            <p class="mt-2 text-sm text-slate-500">Ajoutez une nouvelle commande client.</p>
        </div>
        <a href="{{ route('orders.index') }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Retour à la liste</a>
    </div>

    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <form method="POST" action="{{ route('orders.store') }}" class="space-y-6">
            @csrf

            @include('orders.form')

            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <a href="{{ route('orders.index') }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Annuler</a>
                <x-primary-button>Créer la commande</x-primary-button>
            </div>
        </form>
    </div>

    @include('customers.quick-add-customer-modal')
</div>

@endsection