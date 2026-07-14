@extends('layouts.crm')

@section('page-title', 'Modifier client')


@section('content')

<div class="space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-brand-600">Clients</p>
            <h2 class="text-3xl font-semibold text-slate-900">Modifier un client</h2>
            <p class="mt-2 text-sm text-slate-500">Mettez à jour les informations du client et enregistrez les changements.</p>
        </div>
        <a href="{{ route('customers.show', $customer) }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Retour au client</a>
    </div>

    <x-card class="p-6">
        <form action="{{ route('customers.update', $customer) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            @include('customers.form')
            <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">
                <x-secondary-button type="button" onclick="window.location='{{ route('customers.show', $customer) }}'">Annuler</x-secondary-button>
                <x-primary-button>Mettre à jour</x-primary-button>
            </div>
        </form>
    </x-card>
</div>

@endsection