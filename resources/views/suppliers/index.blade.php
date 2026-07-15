@extends('layouts.crm')
@section('page-title', 'Fournisseurs')
@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-sm font-semibold uppercase tracking-wider text-indigo-600">Gestion</p>
            <h2 class="text-3xl font-bold text-slate-900">Fournisseurs</h2>
        </div>
        <a href="{{ route('suppliers.create') }}" class="btn-premium inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-500/30 hover:bg-indigo-700">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Nouveau fournisseur
        </a>
    </div>

    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-slate-500">Nom</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-slate-500">Contact</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-slate-500">Téléphone</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-slate-500">Commandes</th>
                    <th class="px-6 py-4 text-right text-xs font-semibold uppercase text-slate-500">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 bg-white">
                @forelse($suppliers as $supplier)
                <tr class="hover:bg-slate-50 transition">
                    <td class="px-6 py-4 font-semibold text-slate-900">{{ $supplier->name }}</td>
                    <td class="px-6 py-4 text-sm text-slate-600">{{ $supplier->contact_name ?? '-' }}</td>
                    <td class="px-6 py-4 text-sm text-slate-600">{{ $supplier->phone ?? '-' }}</td>
                    <td class="px-6 py-4"><span class="rounded-full bg-indigo-50 px-3 py-1 text-xs font-semibold text-indigo-700">{{ $supplier->purchase_orders_count }}</span></td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('suppliers.edit', $supplier) }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">Modifier</a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="px-6 py-10 text-center text-slate-500">Aucun fournisseur enregistré.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $suppliers->links() }}
</div>
@endsection