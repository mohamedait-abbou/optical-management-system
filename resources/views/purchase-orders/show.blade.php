@extends('layouts.crm')
@section('page-title', 'Bon ' . $purchaseOrder->order_number)
@section('content')
<div class="mx-auto max-w-5xl space-y-6">
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-4">
            <a href="{{ route('purchase-orders.index') }}" class="rounded-xl bg-slate-100 p-2 hover:bg-slate-200"><svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg></a>
            <div>
                <h2 class="text-2xl font-bold text-slate-900">Bon #{{ $purchaseOrder->order_number }}</h2>
                <p class="text-sm text-slate-500">Fournisseur : {{ $purchaseOrder->supplier->name }}</p>
            </div>
        </div>
        @if($purchaseOrder->status == 'pending')
            <form method="POST" action="{{ route('purchase-orders.receive', $purchaseOrder) }}" onsubmit="return confirm('Confirmer la réception ? Le stock sera automatiquement mis à jour.')">
                @csrf
                <button type="submit" class="btn-premium inline-flex items-center gap-2 rounded-xl bg-emerald-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-emerald-500/30 hover:bg-emerald-700">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Réceptionner le stock
                </button>
            </form>
        @else
            <span class="rounded-full bg-emerald-50 px-4 py-2 text-sm font-semibold text-emerald-700 border border-emerald-200">✅ Reçu le {{ $purchaseOrder->updated_at->format('d/m/Y') }}</span>
        @endif
    </div>

    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-slate-500">Produit</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-slate-500">Quantité</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-slate-500">Coût unitaire</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-slate-500">Sous-total</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 bg-white">
                @foreach($purchaseOrder->items as $item)
                <tr>
                    <td class="px-6 py-4 font-medium text-slate-900">{{ $item->product->name }}</td>
                    <td class="px-6 py-4 text-slate-600">{{ $item->quantity }}</td>
                    <td class="px-6 py-4 text-slate-600">{{ number_format($item->unit_cost, 2) }} DH</td>
                    <td class="px-6 py-4 font-bold text-slate-900">{{ number_format($item->subtotal, 2) }} DH</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot class="bg-slate-50">
                <tr>
                    <td colspan="3" class="px-6 py-4 text-right font-bold text-slate-900">Total :</td>
                    <td class="px-6 py-4 text-xl font-bold text-indigo-600">{{ number_format($purchaseOrder->total_amount, 2) }} DH</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection