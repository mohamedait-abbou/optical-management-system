@extends('layouts.crm')
@section('page-title', 'Bons de Commande')
@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-sm font-semibold uppercase tracking-wider text-indigo-600">Achats</p>
            <h2 class="text-3xl font-bold text-slate-900">Bons de Commande</h2>
        </div>
        <a href="{{ route('purchase-orders.create') }}" class="btn-premium inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-500/30 hover:bg-indigo-700">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Nouveau bon
        </a>
    </div>

    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-slate-500">N° Bon</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-slate-500">Fournisseur</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-slate-500">Date</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-slate-500">Montant</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-slate-500">Statut</th>
                    <th class="px-6 py-4 text-right text-xs font-semibold uppercase text-slate-500">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 bg-white">
                @forelse($orders as $order)
                <tr class="hover:bg-slate-50 transition">
                    <td class="px-6 py-4 font-bold text-slate-900">{{ $order->order_number }}</td>
                    <td class="px-6 py-4 text-sm text-slate-600">{{ $order->supplier->name }}</td>
                    <td class="px-6 py-4 text-sm text-slate-600">{{ $order->order_date->format('d/m/Y') }}</td>
                    <td class="px-6 py-4 font-semibold text-slate-900">{{ number_format($order->total_amount, 2) }} DH</td>
                    <td class="px-6 py-4">
                        @if($order->status == 'pending')
                            <span class="rounded-full bg-amber-50 px-3 py-1 text-xs font-semibold text-amber-700">En attente</span>
                        @elseif($order->status == 'received')
                            <span class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700">Reçu</span>
                        @else
                            <span class="rounded-full bg-rose-50 px-3 py-1 text-xs font-semibold text-rose-700">Annulé</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('purchase-orders.show', $order) }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">Voir & Réceptionner</a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="px-6 py-10 text-center text-slate-500">Aucun bon de commande.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection