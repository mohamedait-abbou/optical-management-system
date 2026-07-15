@extends('layouts.crm')

@section('page-title', 'Commandes')

@section('content')

<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-indigo-600">Commandes</p>
            <h2 class="text-3xl font-semibold text-slate-900">Toutes les commandes</h2>
            <p class="mt-2 text-sm text-slate-500">Consultez, recherchez et gérez les commandes clients.</p>
        </div>
        <a href="{{ route('orders.create') }}" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-600/20 transition hover:bg-indigo-700 hover:scale-[1.02]">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 5v14M5 12h14"/>
            </svg>
            Nouvelle commande
        </a>
    </div>

    <!-- Search Bar -->
    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <form method="GET" action="{{ route('orders.index') }}" class="flex flex-col gap-4 sm:flex-row sm:items-center">
            <div class="relative flex-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="pointer-events-none absolute left-4 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.3-4.3"></path>
                </svg>
                <x-text-input id="search" name="search" type="search" placeholder="Rechercher par numéro, client ou statut..." value="{{ $search ?? '' }}" class="w-full rounded-2xl border-slate-200 bg-slate-50 py-3 pl-11 pr-4 text-sm text-slate-700 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200" />
            </div>
            <div class="flex gap-3 flex-wrap">
                <x-primary-button type="submit" class="rounded-2xl bg-indigo-600 hover:bg-indigo-700 shadow-md shadow-indigo-600/10">Rechercher</x-primary-button>
                @if(!empty($search))
                    <a href="{{ route('orders.index') }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Réinitialiser</a>
                @endif
            </div>
        </form>
    </div>

    <!-- Content -->
    @if($orders->isEmpty())
        <div class="rounded-3xl border border-dashed border-slate-300 bg-white p-12 text-center shadow-sm">
            <div class="mx-auto flex max-w-md flex-col items-center gap-4">
                <div class="rounded-full bg-indigo-50 p-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-indigo-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/>
                        <path d="M3 6h18"/>
                        <path d="M16 10a4 4 0 0 1-8 0"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-semibold text-slate-900">Aucune commande trouvée</h3>
                    <p class="mt-2 text-sm text-slate-500">Commencez par créer une nouvelle commande pour un client.</p>
                </div>
                <a href="{{ route('orders.create') }}" class="mt-2 inline-flex items-center justify-center gap-2 rounded-2xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-indigo-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 5v14M5 12h14"/>
                    </svg>
                    Ajouter une commande
                </a>
            </div>
        </div>
    @else
        <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full text-left text-sm text-slate-700">
                    <thead class="border-b bg-slate-50/80 text-slate-500">
                        <tr>
                            <th class="px-6 py-4 font-semibold uppercase tracking-wider text-xs"># Commande</th>
                            <th class="px-6 py-4 font-semibold uppercase tracking-wider text-xs">Client</th>
                            <th class="px-6 py-4 font-semibold uppercase tracking-wider text-xs">Date</th>
                            <th class="px-6 py-4 font-semibold uppercase tracking-wider text-xs">Statut</th>
                            <th class="px-6 py-4 font-semibold uppercase tracking-wider text-xs">Montant</th>
                            <th class="px-6 py-4 text-right font-semibold uppercase tracking-wider text-xs">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($orders as $order)
                            <tr class="group hover:bg-slate-50/80 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2 font-bold text-slate-900">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M15 6v12a3 3 0 1 0 3-3H6a3 3 0 1 0 3 3V6a3 3 0 1 0-3 3h12a3 3 0 1 0-3-3"/>
                                        </svg>
                                        {{ $order->order_number }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @if($order->customer)
                                        <div class="flex items-center gap-3">
                                            <div class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-full bg-gradient-to-br from-indigo-500 to-fuchsia-500 text-xs font-bold text-white shadow-sm">
                                                {{ strtoupper(substr($order->customer->first_name, 0, 1)) }}{{ strtoupper(substr($order->customer->last_name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <p class="font-medium text-slate-900">{{ $order->customer->first_name }} {{ $order->customer->last_name }}</p>
                                                <p class="text-xs text-slate-500">{{ $order->customer->phone ?? 'Pas de téléphone' }}</p>
                                            </div>
                                        </div>
                                    @else
                                        <span class="text-slate-400 italic">Client inconnu</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-slate-600 whitespace-nowrap">
                                    {{ optional($order->order_date)->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $statusClass = match(strtolower($order->status)) {
                                            'completed', 'terminée', 'livrée' => 'bg-emerald-50 text-emerald-700 border border-emerald-100',
                                            'pending', 'en attente', 'processing' => 'bg-amber-50 text-amber-700 border border-amber-100',
                                            'cancelled', 'annulée' => 'bg-rose-50 text-rose-700 border border-rose-100',
                                            default => 'bg-slate-100 text-slate-700 border border-slate-200',
                                        };
                                    @endphp
                                    <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold {{ $statusClass }}">
                                        {{ $order->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 font-bold text-slate-900 whitespace-nowrap">
                                    {{ number_format($order->total_amount, 2, ',', ' ') }} DH
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-end gap-2 opacity-80 group-hover:opacity-100 transition-opacity">
                                        <a href="{{ route('orders.show', $order) }}" class="p-2 rounded-xl bg-indigo-50 text-indigo-600 hover:bg-indigo-100 transition" title="Voir les détails">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/>
                                                <circle cx="12" cy="12" r="3"/>
                                            </svg>
                                        </a>
                                        <a href="{{ route('orders.edit', $order) }}" class="p-2 rounded-xl bg-amber-50 text-amber-600 hover:bg-amber-100 transition" title="Modifier">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/>
                                            </svg>
                                        </a>
                                        <form action="{{ route('orders.destroy', $order) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette commande ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 rounded-xl bg-rose-50 text-rose-600 hover:bg-rose-100 transition" title="Supprimer">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M3 6h18"/>
                                                    <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                                                    <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-6">
            {{ $orders->links() }}
        </div>
    @endif
</div>

@endsection