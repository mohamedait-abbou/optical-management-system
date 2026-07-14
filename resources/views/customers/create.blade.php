@extends('layouts.crm')

@section('page-title', 'Nouveau client')

@section('content')

<div class="space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-brand-600">Clients</p>
            <h2 class="text-3xl font-semibold text-slate-900">Ajouter un client</h2>
            <p class="mt-2 text-sm text-slate-500">Remplissez le formulaire pour enregistrer un nouveau client dans le CRM.</p>
        </div>
        <a href="{{ route('customers.index') }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Retour à la liste</a>
    </div>

    <x-card class="p-6">
        <form action="{{ route('customers.store') }}" method="POST" class="space-y-6">
            @csrf
            @include('customers.form')
            <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">
                <x-secondary-button type="button" onclick="window.location='{{ route('customers.index') }}'">Annuler</x-secondary-button>
                <x-primary-button>Enregistrer</x-primary-button>
            </div>
        </form>
    </x-card>
</div>

@endsection