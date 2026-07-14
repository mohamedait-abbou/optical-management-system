@extends('layouts.crm')

@section('page-title', 'Clients')

@section('content')

<div class="space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-brand-600">Clients</p>
            <h2 class="text-3xl font-semibold text-slate-900">Liste des clients</h2>
            <p class="mt-2 text-sm text-slate-500">Recherchez, modifiez ou supprimez un client depuis le CRM optique.</p>
        </div>
        <a href="{{ route('customers.create') }}" class="inline-flex items-center justify-center rounded-2xl bg-brand-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-brand-700">Ajouter un client</a>
    </div>

    <div class="grid gap-4 grid-cols-1 xl:grid-cols-[1fr_300px]">
        <x-card class="p-6 min-w-0">
            <form method="GET" action="{{ route('customers.index') }}" class="flex flex-col gap-4 sm:flex-row sm:items-end">
                <label for="search" class="sr-only">Recherche</label>
                <div class="relative flex-1 min-w-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="pointer-events-none absolute left-4 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 103.908 9.338l3.587 3.586a1 1 0 001.415-1.414l-3.586-3.587A5.5 5.5 0 009 3.5zm-3.5 5.5a3.5 3.5 0 117 0 3.5 3.5 0 01-7 0z" clip-rule="evenodd" />
                    </svg>
                    <x-text-input id="search" name="search" type="search" placeholder="Recherche par nom, CIN, téléphone ou email" :value="$search" class="w-full rounded-2xl border-slate-200 bg-slate-100 py-3 pl-11 pr-4 text-sm text-slate-700" />
                </div>
                <x-primary-button type="submit" class="w-full sm:w-auto">Rechercher</x-primary-button>
            </form>
            <div class="mt-4 flex flex-wrap items-center justify-between gap-3 text-sm text-slate-500">
                <p>{{ $customers->total() }} client{{ $customers->total() > 1 ? 's' : '' }}</p>
                @if($search)
                    <a href="{{ route('customers.index') }}" class="font-medium text-brand-600 hover:text-brand-700">Effacer le filtre</a>
                @endif
            </div>
        </x-card>

        <x-card class="space-y-4 border-brand-100 bg-brand-50 p-6 text-slate-800 min-w-0">
            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-brand-700">Conseil rapide</p>
            <p class="text-sm leading-6 text-slate-700">Vous pouvez utiliser la recherche pour retrouver un client par son nom, son CIN, son adresse email ou son téléphone.</p>
            <div class="rounded-2xl bg-white p-4 text-sm text-slate-600">
                <p class="font-semibold">Astuce :</p>
                <p class="mt-2">Pour modifier un client, cliquez sur le bouton « Modifier » dans la ligne correspondante.</p>
            </div>
        </x-card>
    </div>

    <div x-data="{ deleteId: null }" class="space-y-4">
        @if($customers->isEmpty())
            <x-card class="border-dashed border-slate-300 p-10 text-center">
                <div class="mx-auto flex max-w-xl flex-col items-center gap-4 text-slate-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14 text-brand-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 3c-1.3 0-2.57.25-3.75.71" />
                        <path d="M9 4.85v1.66" />
                        <path d="M5.63 7.58A8.92 8.92 0 003 12c0 4.97 4.03 9 9 9s9-4.03 9-9a8.92 8.92 0 00-2.63-6.42" />
                        <path d="M15 9l-3 3-3-3" />
                    </svg>
                    <div>
                        <h3 class="text-xl font-semibold text-slate-900">Aucun client trouvé</h3>
                        <p class="mt-2 text-sm text-slate-500">Essayez de modifier vos critères de recherche ou ajoutez un nouveau client.</p>
                    </div>
                    <a href="{{ route('customers.create') }}" class="inline-flex items-center justify-center rounded-2xl bg-brand-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-brand-700">Ajouter un client</a>
                </div>
            </x-card>
        @else
            <div class="space-y-4 sm:hidden">
                @foreach($customers as $customer)
                    <x-card class="p-4">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-lg font-semibold text-slate-900">{{ $customer->first_name }} {{ $customer->last_name }}</p>
                                <p class="mt-1 text-sm text-slate-500">CIN : {{ $customer->cin ?? '—' }}</p>
                                <p class="mt-1 text-sm text-slate-500">{{ $customer->phone }} · {{ $customer->email ?? 'Pas d’email' }}</p>
                            </div>
                            <x-status-badge variant="info">Client</x-status-badge>
                        </div>
                        <div class="mt-4 flex flex-wrap gap-2 text-sm">
                            <a href="{{ route('customers.show', $customer) }}" class="text-brand-600 hover:text-brand-700">Voir</a>
                            <a href="{{ route('customers.edit', $customer) }}" class="text-slate-600 hover:text-slate-900">Modifier</a>
                            <button type="button" class="text-rose-600 hover:text-rose-700" @click="deleteId = {{ $customer->id }}; $dispatch('open-modal', { detail: 'delete-customer' })">Supprimer</button>
                        </div>
                    </x-card>
                @endforeach
            </div>

            <div class="hidden sm:block overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <table class="min-w-full border-separate border-spacing-0">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">Client</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">CIN</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">Téléphone</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">Email</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 text-sm text-slate-700">
                        @foreach($customers as $customer)
                            <tr class="hover:bg-slate-50">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-brand-50 text-brand-700 font-semibold">
                                            {{ strtoupper(substr($customer->first_name, 0, 1) . substr($customer->last_name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="font-semibold text-slate-900">{{ $customer->first_name }} {{ $customer->last_name }}</div>
                                            <div class="text-sm text-slate-500">{{ $customer->address ? Str::limit($customer->address, 40) : 'Adresse non renseignée' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">{{ $customer->cin ?? '—' }}</td>
                                <td class="px-6 py-4">{{ $customer->phone }}</td>
                                <td class="px-6 py-4">{{ $customer->email ?? '—' }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap gap-2">
                                        <a href="{{ route('customers.show', $customer) }}" class="rounded-full border border-slate-200 bg-slate-50 px-3 py-1 text-sm font-medium text-brand-700 transition hover:bg-brand-50">Voir</a>
                                        <a href="{{ route('customers.edit', $customer) }}" class="rounded-full border border-slate-200 bg-slate-50 px-3 py-1 text-sm font-medium text-slate-600 transition hover:bg-slate-100">Modifier</a>
                                        <button type="button" class="rounded-full border border-rose-200 bg-rose-50 px-3 py-1 text-sm font-medium text-rose-700 transition hover:bg-rose-100" @click="deleteId = {{ $customer->id }}; $dispatch('open-modal', { detail: 'delete-customer' })">Supprimer</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <p class="text-sm text-slate-500">Page {{ $customers->currentPage() }} sur {{ $customers->lastPage() }}</p>
                <div class="grow">
                    {{ $customers->links() }}
                </div>
            </div>
        @endif

        <x-modal name="delete-customer">
            <div class="p-6">
                <h2 class="text-lg font-semibold text-slate-900">Supprimer ce client</h2>
                <p class="mt-2 text-sm text-slate-600">Cette action est définitive. Le client sera supprimé de la base de données.</p>
                <form method="POST" :action="deleteId ? `/customers/${deleteId}` : '#'" class="mt-6 flex flex-col gap-3 sm:flex-row sm:justify-end">
                    @csrf
                    @method('DELETE')
                    <x-secondary-button type="button" @click="$dispatch('close-modal', { detail: 'delete-customer' })">Annuler</x-secondary-button>
                    <x-danger-button>Supprimer</x-danger-button>
                </form>
            </div>
        </x-modal>
    </div>
</div>

@endsection