@extends('layouts.crm')

@section('page-title', 'Créer une commande')

@section('content')

<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div class="flex items-center gap-4">
            <a href="{{ route('orders.index') }}" class="p-2 rounded-xl bg-slate-100 hover:bg-slate-200 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 12H5M12 19l-7-7 7-7"/>
                </svg>
            </a>
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.3em] text-indigo-600">Nouvelle commande</p>
                <h2 class="text-3xl font-semibold text-slate-900">Créer une commande</h2>
                <p class="mt-1 text-sm text-slate-500">Ajoutez une nouvelle commande client avec les produits sélectionnés.</p>
            </div>
        </div>
        <a href="{{ route('orders.index') }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Retour à la liste</a>
    </div>

    <!-- Form Card -->
    <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
        <form method="POST" action="{{ route('orders.store') }}" class="space-y-8">
            @csrf

            @include('orders.form')

            <!-- Action Buttons -->
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between pt-6 border-t border-slate-100">
                <a href="{{ route('orders.index') }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 6 6 18M6 6l12 12"/>
                    </svg>
                    Annuler
                </a>
                <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-gradient-to-r from-indigo-600 to-fuchsia-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-600/20 transition hover:scale-[1.02]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 5v14M5 12h14"/>
                    </svg>
                    Créer la commande
                </button>
            </div>
        </form>
    </div>

    @include('customers.quick-add-customer-modal')
</div>

@endsection