@extends('layouts.crm')

@section('page-title', 'Factures')

@section('content')

<div class="space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-brand-600">Factures</p>
            <h2 class="text-3xl font-semibold text-slate-900">Liste des factures</h2>
            <p class="mt-2 text-sm text-slate-500">Toutes les factures générées pour les commandes.</p>
        </div>
    </div>

    @if(session('success'))
        <x-flash-message type="success" :message="session('success')" class="mb-6" />
    @endif
    @if(session('error'))
        <x-flash-message type="error" :message="session('error')" class="mb-6" />
    @endif

    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <form method="GET" action="{{ route('invoices.index') }}" class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center">
            <x-text-input
                name="search"
                type="search"
                class="w-full sm:max-w-xs"
                value="{{ request('search') }}"
                placeholder="Rechercher numéro, client ou date"
            />
            <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-brand-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-brand-700">
                Rechercher
            </button>
        </form>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-sm">
                <thead class="bg-slate-100 text-slate-600">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold">N° Facture</th>
                        <th class="px-4 py-3 text-left font-semibold">Client</th>
                        <th class="px-4 py-3 text-left font-semibold">Date</th>
                        <th class="px-4 py-3 text-left font-semibold">Total TTC</th>
                        <th class="px-4 py-3 text-right font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 bg-white">
                    @forelse($invoices as $invoice)
                        <tr>
                            <td class="px-4 py-4 font-medium text-slate-900">{{ $invoice->invoice_number }}</td>
                            <td class="px-4 py-4">{{ optional($invoice->order->customer)->first_name }} {{ optional($invoice->order->customer)->last_name }}</td>
                            <td class="px-4 py-4">{{ optional($invoice->issue_date)->format('d/m/Y') }}</td>
                            <td class="px-4 py-4">{{ number_format($invoice->total_ttc, 2) }} DH</td>
                            <td class="px-4 py-4 text-right">
                                <div class="inline-flex items-center gap-2">
                                    <a href="{{ route('invoices.show', $invoice) }}" class="rounded-full border border-slate-200 bg-slate-50 px-3 py-1 text-xs font-semibold text-slate-700 hover:bg-slate-100">Voir</a>
                                    <a href="{{ route('invoices.pdf', $invoice) }}" class="rounded-full border border-brand-200 bg-brand-50 px-3 py-1 text-xs font-semibold text-brand-700 hover:bg-brand-100">PDF</a>
                                    
                                    {{-- DELETE BUTTON: Only visible if user has permission --}}
                                   @if(auth()->user()->hasRole('Admin'))
                                        <form action="{{ route('invoices.destroy', $invoice) }}" method="POST" onsubmit="return confirm('Supprimer cette facture ?')" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="rounded-full border border-rose-200 bg-rose-50 px-3 py-1 text-xs font-semibold text-rose-700 hover:bg-rose-100">Supprimer</button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-10 text-center text-sm text-slate-500">Aucune facture trouvée.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $invoices->withQueryString()->links() }}
        </div>
    </div>
</div>

@endsection