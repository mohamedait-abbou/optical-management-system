@extends('layouts.crm')

@section('page-title', 'Commandes')

@section('content')

<div class="space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-brand-600">Commandes</p>
            <h2 class="text-3xl font-semibold text-slate-900">Toutes les commandes</h2>
            <p class="mt-2 text-sm text-slate-500">Consultez, recherchez et gérez les commandes clients.</p>
        </div>
        <a href="{{ route('orders.create') }}" class="inline-flex items-center justify-center rounded-2xl bg-brand-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-brand-700">Ajouter une commande</a>
    </div>

    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <form method="GET" action="{{ route('orders.index') }}" class="flex flex-col gap-4 sm:flex-row sm:items-center">
            <x-text-input id="search" name="search" type="search" placeholder="Rechercher par numéro ou client" value="{{ $search ?? '' }}" class="w-full rounded-2xl border-slate-200 bg-slate-100 py-3 pl-4 pr-4 text-sm text-slate-700" />
            <div class="flex gap-3 flex-wrap">
                <x-primary-button type="submit">Rechercher</x-primary-button>
                @if(!empty($search))
                    <a href="{{ route('orders.index') }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Réinitialiser</a>
                @endif
            </div>
        </form>
    </div>

    @if($orders->isEmpty())
        <div class="rounded-3xl border border-dashed border-slate-300 bg-white p-10 text-center shadow-sm">
            <h3 class="text-xl font-semibold text-slate-900">Aucune commande trouvée</h3>
            <p class="mt-3 text-sm text-slate-500">Créez rapidement une commande pour commencer.</p>
            <a href="{{ route('orders.create') }}" class="mt-5 inline-flex items-center justify-center rounded-2xl bg-brand-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-brand-700">Ajouter une commande</a>
        </div>
    @else
        <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
            <table class="min-w-full text-left text-sm text-slate-700">
                <thead class="border-b bg-slate-50 text-slate-500">
                    <tr>
                        <th class="px-6 py-4"># Commande</th>
                        <th class="px-6 py-4">Client</th>
                        <th class="px-6 py-4">Date</th>
                        <th class="px-6 py-4">Statut</th>
                        <th class="px-6 py-4">Montant</th>
                        <th class="px-6 py-4">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @foreach($orders as $order)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4 font-medium text-slate-900">{{ $order->order_number }}</td>
                            <td class="px-6 py-4">{{ optional($order->customer)->first_name }} {{ optional($order->customer)->last_name }}</td>
                            <td class="px-6 py-4">{{ optional($order->order_date)->format('d/m/Y') }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold {{ $order->status === 'Completed' ? 'bg-emerald-100 text-emerald-700' : ($order->status === 'Cancelled' ? 'bg-rose-100 text-rose-700' : 'bg-amber-100 text-amber-700') }}">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4">{{ number_format($order->total_amount, 2) }} DH</td>
                            <td class="px-6 py-4">
                                <div class="flex flex-wrap gap-2">
                                    <a href="{{ route('orders.show', $order) }}" class="rounded-full border border-slate-200 bg-slate-50 px-3 py-1 text-sm text-brand-700 hover:bg-brand-50">Voir</a>
                                    <a href="{{ route('orders.edit', $order) }}" class="rounded-full border border-slate-200 bg-slate-50 px-3 py-1 text-sm text-slate-600 hover:bg-slate-100">Modifier</a>
                                    <form action="{{ route('orders.destroy', $order) }}" method="POST" class="inline-block" onsubmit="return confirm('Supprimer cette commande ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="rounded-full border border-rose-200 bg-rose-50 px-3 py-1 text-sm font-medium text-rose-700 hover:bg-rose-100">Supprimer</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6">{{ $orders->links() }}</div>
    @endif
</div>

@endsection