@extends('layouts.crm')

@section('page-title', 'Facture ' . $invoice->invoice_number)

@section('content')

<div class="space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-brand-600">Facture</p>
            <h2 class="text-3xl font-semibold text-slate-900">{{ $invoice->invoice_number }}</h2>
            <p class="mt-2 text-sm text-slate-500">Détails de la facture émise.</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('invoices.pdf', $invoice) }}" class="inline-flex items-center justify-center rounded-2xl bg-brand-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-brand-700">Télécharger PDF</a>
            <a href="{{ route('invoices.index') }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Retour</a>
        </div>
    </div>

    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <div class="grid gap-6 lg:grid-cols-[1fr_auto]">
            <div>
                <p class="text-sm font-semibold text-slate-500">Optical CRM</p>
                <p class="mt-2 text-base font-semibold text-slate-900">Boutique d'optique</p>
                <p class="mt-2 text-sm text-slate-600">RUE DE L'OPTIQUE<br>Casablanca, Maroc<br>info@opticalcrm.com</p>
            </div>
            <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                <p class="text-sm font-semibold text-slate-500">Facture</p>
                <p class="mt-2 text-lg font-semibold text-slate-900">{{ $invoice->invoice_number }}</p>
                <p class="mt-4 text-sm text-slate-500">Date d'émission</p>
                <p class="mt-2 text-base font-medium text-slate-900">{{ optional($invoice->issue_date)->format('d/m/Y') }}</p>
            </div>
        </div>

        <div class="mt-10 grid gap-6 lg:grid-cols-2">
            <div>
                <p class="text-sm font-semibold text-slate-500">Facturé à</p>
                <p class="mt-3 text-base font-medium text-slate-900">{{ optional($invoice->order->customer)->first_name }} {{ optional($invoice->order->customer)->last_name }}</p>
                <p class="mt-2 text-sm text-slate-600">{{ optional($invoice->order->customer)->email }}</p>
                <p class="mt-1 text-sm text-slate-600">{{ optional($invoice->order->customer)->phone }}</p>
            </div>
            <div>
                <p class="text-sm font-semibold text-slate-500">Commande</p>
                <p class="mt-3 text-base font-medium text-slate-900">{{ $invoice->order->order_number }}</p>
                <p class="mt-2 text-sm text-slate-600">Date commande : {{ optional($invoice->order->order_date)->format('d/m/Y') }}</p>
            </div>
        </div>

        <div class="mt-10 overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-sm">
                <thead class="bg-slate-100 text-slate-600">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold">Produit</th>
                        <th class="px-4 py-3 text-left font-semibold">Quantité</th>
                        <th class="px-4 py-3 text-left font-semibold">Prix unitaire</th>
                        <th class="px-4 py-3 text-left font-semibold">Sous-total</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 bg-white">
                    @foreach($invoice->order->items as $item)
                        <tr>
                            <td class="px-4 py-4">{{ optional($item->product)->name ?? 'Produit supprimé' }}</td>
                            <td class="px-4 py-4">{{ $item->quantity }}</td>
                            <td class="px-4 py-4">{{ number_format($item->unit_price, 2) }} DH</td>
                            <td class="px-4 py-4">{{ number_format($item->subtotal, 2) }} DH</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-8 grid gap-4 md:grid-cols-[1fr_280px]">
            <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6">
                <p class="text-sm font-semibold text-slate-500">Notes</p>
                <p class="mt-3 text-sm text-slate-700">Merci pour votre confiance. Le paiement est dû à réception de la facture.</p>
            </div>
            <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6">
                <div class="flex items-center justify-between text-sm text-slate-500">
                    <span>Total HT</span>
                    <span>{{ number_format($invoice->total_ht, 2) }} DH</span>
                </div>
                <div class="mt-4 flex items-center justify-between text-sm text-slate-500">
                    <span>TVA ({{ number_format($invoice->tax_rate, 2) }}%)</span>
                    <span>{{ number_format($invoice->total_ttc - $invoice->total_ht, 2) }} DH</span>
                </div>
                <div class="mt-6 border-t border-slate-200 pt-4 text-base font-semibold text-slate-900 flex items-center justify-between">
                    <span>Total TTC</span>
                    <span>{{ number_format($invoice->total_ttc, 2) }} DH</span>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
