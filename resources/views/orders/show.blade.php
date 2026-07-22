@extends('layouts.crm')

@section('page-title', 'Commande #' . $order->order_number)

@section('content')

<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div class="flex items-center gap-4">
            <a href="{{ route('orders.index') }}" class="p-2 rounded-xl bg-slate-100 hover:bg-slate-200 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 12H5M12 19l-7-7 7-7"/>
                </svg>
            </a>
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.3em] text-indigo-600">Commande</p>
                <h2 class="text-3xl font-semibold text-slate-900 flex items-center gap-3">
                    #{{ $order->order_number }}
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
                </h2>
                <p class="mt-1 text-sm text-slate-500">Détails et suivi de la commande</p>
            </div>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('orders.edit', $order) }}" class="inline-flex items-center gap-2 rounded-2xl bg-amber-500 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-amber-500/20 transition hover:bg-amber-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/>
                </svg>
                Modifier
            </a>
            <form action="{{ route('orders.destroy', $order) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette commande ?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center gap-2 rounded-2xl border border-rose-200 bg-rose-50 px-5 py-3 text-sm font-semibold text-rose-700 transition hover:bg-rose-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 6h18M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                    </svg>
                    Supprimer
                </button>
            </form>
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-[1fr_360px]">
        <!-- MAIN CONTENT -->
        <div class="space-y-6">
            <!-- Order Info Card -->
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex items-center gap-3 mb-6">
                    <div class="p-2 rounded-xl bg-indigo-50 text-indigo-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900">Informations générales</h3>
                </div>

                <div class="grid gap-6 sm:grid-cols-2">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Client</p>
                        @if($order->customer)
                            <div class="mt-2 flex items-center gap-3">
                                <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-gradient-to-br from-indigo-500 to-fuchsia-500 text-sm font-bold text-white shadow-sm">
                                    {{ strtoupper(substr($order->customer->first_name, 0, 1)) }}{{ strtoupper(substr($order->customer->last_name, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-semibold text-slate-900">{{ $order->customer->first_name }} {{ $order->customer->last_name }}</p>
                                    <p class="text-xs text-slate-500">{{ $order->customer->phone ?? 'Pas de téléphone' }}</p>
                                </div>
                            </div>
                        @else
                            <p class="mt-2 text-slate-400 italic">Client inconnu</p>
                        @endif
                    </div>

                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Numéro de commande</p>
                        <p class="mt-2 text-base font-bold text-slate-900 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 6v12a3 3 0 1 0 3-3H6a3 3 0 1 0 3 3V6a3 3 0 1 0-3 3h12a3 3 0 1 0-3-3"/></svg>
                            {{ $order->order_number }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Date de commande</p>
                        <p class="mt-2 text-base font-semibold text-slate-900 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                            {{ optional($order->order_date)->format('d/m/Y') }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Notes</p>
                        <p class="mt-2 text-sm text-slate-700">{{ $order->notes ?? 'Aucune note pour cette commande.' }}</p>
                    </div>
                </div>
            </div>

            <!-- Payment Progress Card -->
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-3">
                        <div class="p-2 rounded-xl bg-emerald-50 text-emerald-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900">Suivi des paiements</h3>
                    </div>
                    <p class="text-3xl font-bold text-slate-900">{{ number_format($order->total_amount, 2, ',', ' ') }} <span class="text-base font-medium text-slate-500">DH</span></p>
                </div>

                <!-- Progress Bar -->
                @php
                    $progress = $order->total_amount > 0 ? min(100, ($order->paid_amount / $order->total_amount) * 100) : 0;
                    $isFullyPaid = $order->remaining_amount <= 0;
                @endphp
                <div class="mb-6">
                    <div class="flex justify-between text-sm mb-2">
                        <span class="font-medium text-slate-600">Progression du paiement</span>
                        <span class="font-bold {{ $isFullyPaid ? 'text-emerald-600' : 'text-amber-600' }}">{{ number_format($progress, 0) }}%</span>
                    </div>
                    <div class="h-3 w-full rounded-full bg-slate-100 overflow-hidden">
                        <div class="h-full rounded-full transition-all duration-500 {{ $isFullyPaid ? 'bg-gradient-to-r from-emerald-400 to-emerald-600' : 'bg-gradient-to-r from-indigo-400 to-fuchsia-500' }}" style="width: {{ $progress }}%"></div>
                    </div>
                </div>

                <div class="grid gap-4 sm:grid-cols-3">
                    <div class="rounded-2xl bg-emerald-50 border border-emerald-100 p-4">
                        <p class="text-xs font-semibold uppercase tracking-wider text-emerald-700">Montant payé</p>
                        <p class="mt-1 text-xl font-bold text-emerald-900">{{ number_format($order->paid_amount, 2, ',', ' ') }} DH</p>
                    </div>
                    <div class="rounded-2xl {{ $isFullyPaid ? 'bg-slate-50 border border-slate-100' : 'bg-amber-50 border border-amber-100' }} p-4">
                        <p class="text-xs font-semibold uppercase tracking-wider {{ $isFullyPaid ? 'text-slate-600' : 'text-amber-700' }}">Reste à payer</p>
                        <p class="mt-1 text-xl font-bold {{ $isFullyPaid ? 'text-slate-900' : 'text-amber-900' }}">{{ number_format($order->remaining_amount, 2, ',', ' ') }} DH</p>
                    </div>
                    <div class="rounded-2xl bg-indigo-50 border border-indigo-100 p-4">
                        <p class="text-xs font-semibold uppercase tracking-wider text-indigo-700">Total commande</p>
                        <p class="mt-1 text-xl font-bold text-indigo-900">{{ number_format($order->total_amount, 2, ',', ' ') }} DH</p>
                    </div>
                </div>
            </div>

            <!-- Payments List Card -->
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex items-center gap-3 mb-6">
                    <div class="p-2 rounded-xl bg-blue-50 text-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 12V7H5a2 2 0 0 1 0-4h14v4"/><path d="M3 5v14a2 2 0 0 0 2 2h16v-5"/><path d="M18 12a2 2 0 0 0 0 4h4v-4Z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-lg font-bold text-slate-900">Historique des paiements</h3>
                        <p class="text-xs text-slate-500">{{ $order->payments->count() }} paiement(s) enregistré(s)</p>
                    </div>
                </div>

                @if($order->payments->isEmpty())
                    <div class="rounded-2xl border border-dashed border-slate-300 bg-slate-50 p-8 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-10 w-10 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M21 12V7H5a2 2 0 0 1 0-4h14v4"/><path d="M3 5v14a2 2 0 0 0 2 2h16v-5"/><path d="M18 12a2 2 0 0 0 0 4h4v-4Z"/>
                        </svg>
                        <p class="mt-3 text-sm text-slate-600">Aucun paiement enregistré pour cette commande.</p>
                        <p class="mt-1 text-xs text-slate-500">Utilisez le formulaire à droite pour ajouter un paiement.</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-200 text-sm">
                            <thead class="bg-slate-50 text-slate-500">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider">Date</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider">Montant</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider">Méthode</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider">Notes</th>
                                    <th class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 bg-white">
                                @foreach($order->payments as $payment)
                                    <tr class="hover:bg-slate-50 transition-colors">
                                        <td class="px-4 py-3 font-medium text-slate-900 whitespace-nowrap">
                                            {{ $payment->payment_date->format('d/m/Y') }}
                                        </td>
                                        <td class="px-4 py-3 font-bold text-emerald-700 whitespace-nowrap">
                                            + {{ number_format($payment->amount, 2, ',', ' ') }} DH
                                        </td>
                                        <td class="px-4 py-3">
                                            @php
                                                $methodConfig = [
                                                    'especes' => ['icon' => '💵', 'label' => 'Espèces', 'color' => 'bg-emerald-50 text-emerald-700'],
                                                    'carte' => ['icon' => '💳', 'label' => 'Carte', 'color' => 'bg-blue-50 text-blue-700'],
                                                    'virement' => ['icon' => '🏦', 'label' => 'Virement', 'color' => 'bg-purple-50 text-purple-700'],
                                                    'cheque' => ['icon' => '', 'label' => 'Chèque', 'color' => 'bg-amber-50 text-amber-700'],
                                                ];
                                                $method = $methodConfig[$payment->payment_method] ?? ['icon' => '💰', 'label' => ucfirst($payment->payment_method), 'color' => 'bg-slate-100 text-slate-700'];
                                            @endphp
                                            <span class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-1 text-xs font-semibold {{ $method['color'] }}">
                                                <span>{{ $method['icon'] }}</span>
                                                {{ $method['label'] }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-slate-600">{{ $payment->notes ?? '—' }}</td>
                                        <td class="px-4 py-3 text-right">
                                            <form action="{{ route('payments.destroy', [$order, $payment]) }}" method="POST" onsubmit="return confirm('Supprimer ce paiement ?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center gap-1 rounded-lg border border-rose-200 bg-rose-50 px-2.5 py-1 text-xs font-semibold text-rose-700 hover:bg-rose-100 transition">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/></svg>
                                                    Supprimer
                                                </button>
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

        <!-- SIDEBAR -->
        <div class="space-y-6">
            <!-- Invoice Card -->
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex items-center gap-3 mb-4">
                    <div class="p-2 rounded-xl bg-fuchsia-50 text-fuchsia-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900">Facture</h3>
                </div>

                @if($order->invoice)
                    <div class="space-y-3">
                        <div class="rounded-2xl bg-emerald-50 border border-emerald-100 p-3">
                            <p class="text-xs font-semibold text-emerald-700">Facture générée</p>
                            <p class="mt-1 text-sm font-bold text-emerald-900">{{ $order->invoice->invoice_number }}</p>
                        </div>
                        <a href="{{ route('invoices.show', $order->invoice) }}" class="inline-flex w-full items-center justify-center gap-2 rounded-2xl bg-indigo-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-indigo-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                            Voir la facture
                        </a>
                        <a href="{{ route('invoices.pdf', $order->invoice) }}" class="inline-flex w-full items-center justify-center gap-2 rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                            Télécharger PDF
                        </a>
                    </div>
                @else
                    <form action="{{ route('invoices.store', $order) }}" method="POST">
                        @csrf
                        <button type="submit" class="inline-flex w-full items-center justify-center gap-2 rounded-2xl bg-gradient-to-r from-fuchsia-500 to-pink-500 px-4 py-3 text-sm font-semibold text-white shadow-lg shadow-fuchsia-500/20 transition hover:scale-[1.02]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                            Générer la facture
                        </button>
                    </form>
                @endif
            </div>

            <!-- Add Payment Card -->
            @if(!$isFullyPaid)
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex items-center gap-3 mb-4">
                    <div class="p-2 rounded-xl bg-emerald-50 text-emerald-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"/><path d="M12 8v8"/><path d="M8 12h8"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900">Ajouter un paiement</h3>
                </div>
              

                <form action="{{ route('payments.store', $order) }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="amount" class="block text-xs font-semibold uppercase tracking-wider text-slate-600 mb-1">Montant (DH)</label>
                        <input id="amount" name="amount" type="number" step="0.01" min="0.01" max="{{ $order->remaining_amount }}" value="{{ old('amount') }}" 
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition" 
                            placeholder="0.00" />
                        @error('amount')<p class="mt-1 text-xs text-rose-600">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="payment_date" class="block text-xs font-semibold uppercase tracking-wider text-slate-600 mb-1">Date</label>
                        <input id="payment_date" name="payment_date" type="date" value="{{ old('payment_date', now()->toDateString()) }}" 
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition" />
                        @error('payment_date')<p class="mt-1 text-xs text-rose-600">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="payment_method" class="block text-xs font-semibold uppercase tracking-wider text-slate-600 mb-1">Méthode</label>
                        <select id="payment_method" name="payment_method" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition">
                            <option value="especes" {{ old('payment_method') === 'especes' ? 'selected' : '' }}>💵 Espèces</option>
                            <option value="carte" {{ old('payment_method') === 'carte' ? 'selected' : '' }}>💳 Carte bancaire</option>
                            <option value="virement" {{ old('payment_method') === 'virement' ? 'selected' : '' }}>🏦 Virement</option>
                            <option value="cheque" {{ old('payment_method') === 'cheque' ? 'selected' : '' }}>📝 Chèque</option>
                        </select>
                        @error('payment_method')<p class="mt-1 text-xs text-rose-600">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="notes" class="block text-xs font-semibold uppercase tracking-wider text-slate-600 mb-1">Notes (optionnel)</label>
                        <textarea id="notes" name="notes" rows="2" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-900 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition">{{ old('notes') }}</textarea>
                        @error('notes')<p class="mt-1 text-xs text-rose-600">{{ $message }}</p>@enderror
                    </div>

                    <button type="submit" class="inline-flex w-full items-center justify-center gap-2 rounded-2xl bg-emerald-600 px-4 py-3 text-sm font-semibold text-white shadow-lg shadow-emerald-600/20 transition hover:bg-emerald-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v14M5 12h14"/></svg>
                        Enregistrer le paiement
                    </button>
                </form>
            </div>
            @else
            <div class="rounded-3xl border border-emerald-200 bg-gradient-to-br from-emerald-50 to-white p-6 shadow-sm text-center">
                <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-emerald-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-emerald-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>
                    </svg>
                </div>
                <h3 class="mt-3 text-lg font-bold text-emerald-900">Commande payée !</h3>
                <p class="mt-1 text-sm text-emerald-700">Tous les paiements ont été enregistrés.</p>
            </div>
            @endif
        </div>
    </div>
</div>
  @if($order->customer && $order->customer->phone)
    @php
        // Clean the phone number (keep only digits)
        $phone = preg_replace('/[^0-9]/', '', $order->customer->phone);
        // Pre-fill the message
        $message = urlencode("Bonjour {$order->customer->first_name} 👋,\n\nBonne nouvelle ! Votre commande #{$order->order_number} d'un montant de " . number_format($order->total_amount, 2) . " DH est prête à être récupérée en magasin.\n\nNos horaires : Lun-Sam, 9h-19h.\nÀ bientôt, L'équipe Optical CRM 👓");
    @endphp
    
    <a href="https://wa.me/{{ $phone }}?text={{ $message }}" target="_blank" 
       class="inline-flex items-center gap-2 rounded-xl bg-green-500 px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-green-500/30 transition hover:bg-green-600 hover:scale-[1.02]">
        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
        </svg>
        Notifier sur WhatsApp
    </a>
@endif

@endsection