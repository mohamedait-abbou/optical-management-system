@extends('layouts.crm')

@section('page-title', 'Détails client')

@section('content')

<div class="space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
    
        <div>
            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-brand-600">Client</p>
            <h2 class="text-3xl font-semibold text-slate-900">{{ $customer->first_name }} {{ $customer->last_name }}</h2>
            <p class="mt-2 text-sm text-slate-500">Informations détaillées et historique du client.</p>
        </div>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('customers.edit', $customer) }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Modifier</a>
            <button type="button" class="inline-flex items-center justify-center rounded-2xl bg-rose-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-rose-700" @click="$dispatch('open-modal', 'delete-customer')">Supprimer</button>
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-3">
        <x-card class="p-6 lg:col-span-2">
            <div class="grid gap-6 sm:grid-cols-2">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.24em] text-slate-500">Nom</p>
                    <p class="mt-3 text-lg font-semibold text-slate-900">{{ $customer->first_name }} {{ $customer->last_name }}</p>
                </div>
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.24em] text-slate-500">Téléphone</p>
                    <p class="mt-3 text-lg text-slate-900">{{ $customer->phone }}</p>
                </div>
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.24em] text-slate-500">CIN</p>
                    <p class="mt-3 text-lg text-slate-900">{{ $customer->cin ?? 'Non renseigné' }}</p>
                </div>
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.24em] text-slate-500">Email</p>
                    <p class="mt-3 text-lg text-slate-900">{{ $customer->email ?? 'Non renseigné' }}</p>
                </div>
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.24em] text-slate-500">Genre</p>
                    <p class="mt-3 text-lg text-slate-900">{{ $customer->gender ?? 'Non spécifié' }}</p>
                </div>
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.24em] text-slate-500">Date de naissance</p>
                    <p class="mt-3 text-lg text-slate-900">{{ $customer->birth_date ? 
                        
                        \Illuminate\Support\Carbon::parse($customer->birth_date)->format('d/m/Y') : 'Non renseignée' }}</p>
                </div>
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.24em] text-slate-500">Créé le</p>
                    <p class="mt-3 text-lg text-slate-900">{{ optional($customer->created_at)->format('d/m/Y') }}</p>
                </div>
            </div>

            <div class="mt-8 space-y-4">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.24em] text-slate-500">Adresse</p>
                    <p class="mt-3 rounded-3xl border border-slate-200 bg-slate-50 p-4 text-sm leading-6 text-slate-700">{{ $customer->address ?? 'Aucune adresse renseignée' }}</p>
                </div>
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.24em] text-slate-500">Notes</p>
                    <p class="mt-3 rounded-3xl border border-slate-200 bg-slate-50 p-4 text-sm leading-6 text-slate-700">{{ $customer->notes ?? 'Aucune note disponible' }}</p>
                </div>
            </div>
        </x-card>

        <x-card class="p-6">
            <p class="text-sm font-semibold uppercase tracking-[0.28em] text-brand-700">Statut</p>
            <div class="mt-5 space-y-4">
                <div class="rounded-3xl border border-slate-200 bg-slate-50 p-4">
                    <p class="text-sm text-slate-500">Dernière activité</p>
                    <p class="mt-2 text-lg font-semibold text-slate-900">{{ $customer->updated_at->diffForHumans() }}</p>
                </div>
                <div class="rounded-3xl border border-slate-200 bg-slate-50 p-4">
                    <p class="text-sm text-slate-500">Type de client</p>
                    <x-status-badge variant="info">Clients réguliers</x-status-badge>
                </div>
            </div>
        </x-card>
    </div>

    <div class="flex flex-wrap gap-3">
    <a href="{{ route('prescription-history.index', $customer) }}" 
       class="inline-flex items-center gap-2 px-5 py-2.5 rounded-2xl bg-gradient-to-r from-indigo-500 to-fuchsia-500 text-white font-semibold shadow-lg shadow-indigo-500/20 hover:shadow-indigo-500/40 transition hover:scale-105">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/>
            <circle cx="12" cy="12" r="3"/>
        </svg>
        Historique Visuel
    </a>
    <button type="button" @click="$dispatch('open-modal', 'notify-customer')"
       class="inline-flex items-center gap-2 px-5 py-2.5 rounded-2xl bg-gradient-to-r from-emerald-500 to-teal-500 text-white font-semibold shadow-lg shadow-emerald-500/20 hover:shadow-emerald-500/40 transition hover:scale-105">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="2" y="4" width="20" height="16" rx="2"/>
            <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
        </svg>
        Envoyer un email
    </button>
    </div>

    <x-modal name="notify-customer">
        <form action="{{ route('customers.notify-email', $customer) }}" method="POST" class="p-6 space-y-4">
            @csrf
            <h2 class="text-lg font-semibold text-slate-900">Envoyer un email à {{ $customer->first_name }} {{ $customer->last_name }}</h2>
            @if($customer->email)
            <div>
                <label class="text-sm font-medium text-slate-700">Destinataire</label>
                <p class="text-slate-500">{{ $customer->email }}</p>
            </div>
            @else
            <p class="text-sm text-amber-600 bg-amber-50 rounded-xl p-3">Cet client n'a pas d'adresse email renseignée.</p>
            @endif
            <div>
                <label for="subject" class="text-sm font-medium text-slate-700">Sujet</label>
                <input type="text" name="subject" id="subject" required class="mt-1 block w-full rounded-xl border-slate-200 bg-slate-50 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Ex: Rappel de rendez-vous">
            </div>
            <div>
                <label for="message" class="text-sm font-medium text-slate-700">Message</label>
                <textarea name="message" id="message" rows="5" required class="mt-1 block w-full rounded-xl border-slate-200 bg-slate-50 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Votre message..."></textarea>
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" @click="$dispatch('close-modal', 'notify-customer')" class="px-4 py-2 rounded-xl text-sm font-medium text-slate-700 bg-slate-100 hover:bg-slate-200 transition">Annuler</button>
                <button type="submit" class="px-4 py-2 rounded-xl text-sm font-semibold text-white bg-gradient-to-r from-emerald-500 to-teal-500 hover:shadow-lg transition">Envoyer</button>
            </div>
        </form>
    </x-modal>

    <x-modal name="delete-customer">
        <div class="p-6">
            <h2 class="text-lg font-semibold text-slate-900">Supprimer {{ $customer->first_name }} {{ $customer->last_name }}</h2>
            <p class="mt-2 text-sm text-slate-600">Cette suppression est irréversible. Le client et ses informations associées seront définitivement supprimés.</p>
            <form method="POST" action="{{ route('customers.destroy', $customer) }}" class="mt-6 flex flex-col gap-3 sm:flex-row sm:justify-end">
                @csrf
                @method('DELETE')
                <x-secondary-button type="button" @click="$dispatch('close-modal', 'delete-customer')">Annuler</x-secondary-button>
                <x-danger-button>Supprimer</x-danger-button>
            </form>
        </div>
    </x-modal>
</div>

@endsection