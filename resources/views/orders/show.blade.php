@extends('layouts.crm')

@section('page-title', 'Commande')

@section('content')

<div class="space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-brand-600">Commande</p>
            <h2 class="text-3xl font-semibold text-slate-900">Détails de la commande</h2>
            <p class="mt-2 text-sm text-slate-500">Aperçu détaillé de la commande sélectionnée.</p>
        </div>
        <a href="{{ route('orders.index') }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Retour à la liste</a>
    </div>

    <div class="grid gap-6 lg:grid-cols-[1fr_320px]">
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="grid gap-6 sm:grid-cols-2">
                <div>
                    <p class="text-sm font-semibold text-slate-500">Client</p>
                    <p class="mt-2 text-base font-medium text-slate-900">{{ optional($order->customer)->first_name }} {{ optional($order->customer)->last_name }}</p>
                </div>
                <div>
                    <p class="text-sm font-semibold text-slate-500">Numéro de commande</p>

                    <p class="mt-2 text-base font-medium text-slate-900">{{ $order->order_number }}</p>
                </div>
                <div>
                    <p class="text-sm font-semibold text-slate-500">Date</p>
                    <p class="mt-2 text-base font-medium text-slate-900">{{ optional($order->order_date)->format('d/m/Y') }}</p>
                </div>
                <div>
                    <p class="text-sm font-semibold text-slate-500">Statut</p>
                    <p class="mt-2 inline-flex items-center rounded-full bg-amber-100 px-3 py-1 text-sm font-semibold text-amber-700">{{ $order->status }}</p>
                </div>
            </div>

            <div class="mt-8 rounded-3xl bg-slate-50 p-6">
                <h3 class="text-lg font-semibold text-slate-900">Montant</h3>
                <p class="mt-3 text-3xl font-semibold text-slate-900">{{ number_format($order->total_amount, 2) }} DH</p>
                <div class="mt-6 grid gap-3 sm:grid-cols-2">
                    <div>
                        <p class="text-sm font-semibold text-slate-500">Montant payé</p>
                        <p class="mt-2 text-base font-medium text-slate-900">{{ number_format($order->paid_amount, 2) }} DH</p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-slate-500">Reste à payer  </p>
                        <p class="mt-2 text-base font-medium text-slate-900">{{ number_format($order->remaining_amount, 2) }} DH</p>
                    </div>
                </div>
                <div class="mt-6">
                    <p class="text-sm font-semibold text-slate-500">Notes</p>
                    <p class="mt-2 text-sm text-slate-700">{{ $order->notes ?? 'Aucune note' }}</p>
                </div>
            </div>

            <div class="mt-8 rounded-3xl border border-slate-200 bg-slate-50 p-6">
                <h3 class="text-lg font-semibold text-slate-900">Paiements enregistrés</h3>

                @if($order->payments->isEmpty())
                    <p class="mt-4 text-sm text-slate-600">Aucun paiement n'a encore été enregistré pour cette commande.</p>
                @else
                    <div class="mt-4 overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-200 text-sm text-left">
                            <thead class="bg-slate-100 text-slate-600">
                                <tr>
                                    <th class="px-4 py-3">Date</th>
                                    <th class="px-4 py-3">Montant</th>
                                    <th class="px-4 py-3">Méthode</th>
                                    <th class="px-4 py-3">Notes</th>
                                    <th class="px-4 py-3"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200 bg-white">
                                @foreach($order->payments as $payment)
                                    <tr>
                                        <td class="px-4 py-3">{{ $payment->payment_date->format('d/m/Y') }}</td>
                                        <td class="px-4 py-3">{{ number_format($payment->amount, 2) }} DH</td>
                                        <td class="px-4 py-3">{{ ucfirst($payment->payment_method) }}</td>
                                        <td class="px-4 py-3">{{ $payment->notes ?? '—' }}</td>
                                        <td class="px-4 py-3 text-right">
                                            <form action="{{ route('payments.destroy', [$order, $payment]) }}" method="POST" onsubmit="return confirm('Supprimer ce paiement ?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="rounded-full border border-rose-200 bg-rose-50 px-3 py-1 text-xs font-semibold text-rose-700 hover:bg-rose-100">Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        <div class="space-y-4 rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <a href="{{ route('orders.edit', $order) }}" class="inline-flex w-full items-center justify-center rounded-2xl bg-brand-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-brand-700">Modifier</a>
            <form action="{{ route('orders.destroy', $order) }}" method="POST" onsubmit="return confirm('Supprimer cette commande ?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex w-full items-center justify-center rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm font-semibold text-rose-700 transition hover:bg-rose-100">Supprimer</button>
            </form>

            <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6">
                <h3 class="text-lg font-semibold text-slate-900">Facture</h3>
                @if($order->invoice)
                    <div class="space-y-3">
                        <p class="text-sm text-slate-600">Facture générée : <span class="font-semibold text-slate-900">{{ $order->invoice->invoice_number }}</span></p>
                        <div class="flex flex-col gap-3 sm:flex-row">
                            <a href="{{ route('invoices.show', $order->invoice) }}" class="inline-flex w-full items-center justify-center rounded-2xl bg-brand-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-brand-700">Voir la facture</a>
                            <a href="{{ route('invoices.pdf', $order->invoice) }}" class="inline-flex w-full items-center justify-center rounded-2xl border border-brand-200 bg-brand-50 px-4 py-3 text-sm font-semibold text-brand-700 transition hover:bg-brand-100">Télécharger PDF</a>
                        </div>
                    </div>
                @else
                    <form action="{{ route('invoices.store', $order) }}" method="POST" class="space-y-3">
                        @csrf
                        <button type="submit" class="inline-flex w-full items-center justify-center rounded-2xl bg-brand-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-brand-700">Générer la facture</button>
                    </form>
                @endif
            </div>

            <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6">
                <h3 class="text-lg font-semibold text-slate-900">Ajouter un paiement</h3>
                <form action="{{ route('payments.store', $order) }}" method="POST" class="space-y-4 mt-4">
                    @csrf
                    <div>
                        <label for="amount" class="block text-sm font-semibold text-slate-700">Montant</label>
                        <input id="amount" name="amount" type="number" step="0.01" min="0.01" max="{{ $order->remaining_amount }}" value="{{ old('amount') }}" class="mt-2 w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-700" />
                        @error('amount')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="payment_date" class="block text-sm font-semibold text-slate-700">Date de paiement</label>
                        <input id="payment_date" name="payment_date" type="date" value="{{ old('payment_date', now()->toDateString()) }}" class="mt-2 w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-700" />
                        @error('payment_date')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="payment_method" class="block text-sm font-semibold text-slate-700">Méthode</label>
                        <select id="payment_method" name="payment_method" class="mt-2 w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-700">
                            <option value="especes" {{ old('payment_method') === 'especes' ? 'selected' : '' }}>Espèces</option>
                            <option value="carte" {{ old('payment_method') === 'carte' ? 'selected' : '' }}>Carte</option>
                            <option value="virement" {{ old('payment_method') === 'virement' ? 'selected' : '' }}>Virement</option>
                            <option value="cheque" {{ old('payment_method') === 'cheque' ? 'selected' : '' }}>Chèque</option>
                        </select>
                        @error('payment_method')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="notes" class="block text-sm font-semibold text-slate-700">Notes</label>
                        <textarea id="notes" name="notes" rows="3" class="mt-2 w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-700">{{ old('notes') }}</textarea>
                        @error('notes')<p class="mt-2 text-sm text-rose-600">{{ $message }}</p>@enderror
                    </div>

                    <button type="submit" class="inline-flex w-full items-center justify-center rounded-2xl bg-brand-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-brand-700">Enregistrer le paiement</button>
                </form>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-slate-50 p-4 text-sm text-slate-600">
                <p class="font-semibold">Info paiement</p>
                <p class="mt-2">Utilisez ce formulaire pour enregistrer un paiement partiel ou total sur la commande.</p>
            </div>
        </div>
    </div>
</div>

@endsection