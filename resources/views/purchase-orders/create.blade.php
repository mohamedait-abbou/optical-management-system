@extends('layouts.crm')
@section('page-title', 'Créer un bon de commande')
@section('content')
<div class="mx-auto max-w-5xl space-y-6">
    <div class="flex items-center gap-4">
        <a href="{{ route('purchase-orders.index') }}" class="rounded-xl bg-slate-100 p-2 hover:bg-slate-200"><svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg></a>
        <h2 class="text-2xl font-bold text-slate-900">Nouveau Bon de Commande</h2>
    </div>

    <form method="POST" action="{{ route('purchase-orders.store') }}" class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm space-y-8">
        @csrf
        <!-- Infos Générales -->
        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
            <div>
                <label class="block text-sm font-medium text-slate-700">Fournisseur *</label>
                <select name="supplier_id" required class="mt-1 w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200">
                    <option value="">Choisir...</option>
                    @foreach($suppliers as $supplier) <option value="{{ $supplier->id }}">{{ $supplier->name }}</option> @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700">Date de commande *</label>
                <input type="date" name="order_date" value="{{ date('Y-m-d') }}" required class="mt-1 w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700">Date de réception prévue</label>
                <input type="date" name="expected_date" class="mt-1 w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200">
            </div>
        </div>

        <!-- Produits -->
        <div>
            <h3 class="text-lg font-bold text-slate-900 mb-4">Articles à commander</h3>
            <div id="items-container" class="space-y-3">
                <div class="grid grid-cols-12 gap-3 items-end item-row">
                    <div class="col-span-6">
                        <label class="block text-xs font-medium text-slate-500 mb-1">Produit</label>
                        <select name="products[0][product_id]" required class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200">
                            <option value="">Choisir un produit...</option>
                            @foreach($products as $product) <option value="{{ $product->id }}">{{ $product->name }} (Stock: {{ $product->quantity }})</option> @endforeach
                        </select>
                    </div>
                    <div class="col-span-2">
                        <label class="block text-xs font-medium text-slate-500 mb-1">Quantité</label>
                        <input type="number" name="products[0][quantity]" min="1" value="1" required class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200">
                    </div>
                    <div class="col-span-3">
                        <label class="block text-xs font-medium text-slate-500 mb-1">Coût unitaire (DH)</label>
                        <input type="number" name="products[0][unit_cost]" step="0.01" min="0" required class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200">
                    </div>
                    <div class="col-span-1">
                        <button type="button" class="remove-btn w-full rounded-xl bg-rose-50 p-3 text-rose-600 hover:bg-rose-100">
                            <svg class="h-5 w-5 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                </div>
            </div>
            <button type="button" id="add-item" class="mt-4 inline-flex items-center gap-2 rounded-xl border-2 border-dashed border-indigo-300 bg-indigo-50 px-5 py-3 text-sm font-semibold text-indigo-700 hover:bg-indigo-100">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Ajouter un produit
            </button>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700">Notes internes</label>
            <textarea name="notes" rows="3" class="mt-1 w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200"></textarea>
        </div>

        <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
            <a href="{{ route('purchase-orders.index') }}" class="rounded-xl border border-slate-300 px-6 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50">Annuler</a>
            <button type="submit" class="rounded-xl bg-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-500/30 hover:bg-indigo-700">Créer le bon</button>
        </div>
    </form>
</div>

<script>
    let itemCount = 1;
    document.getElementById('add-item').addEventListener('click', function() {
        const container = document.getElementById('items-container');
        const firstRow = container.querySelector('.item-row');
        const newRow = firstRow.cloneNode(true);
        newRow.querySelectorAll('select, input').forEach(el => {
            el.name = el.name.replace(/\[\d+\]/, `[${itemCount}]`);
            if(el.tagName === 'INPUT' && el.type === 'number' && el.name.includes('quantity')) el.value = 1;
            if(el.tagName === 'INPUT' && el.type === 'number' && el.name.includes('unit_cost')) el.value = '';
        });
        container.appendChild(newRow);
        itemCount++;
    });

    document.addEventListener('click', function(e) {
        if(e.target.closest('.remove-btn')) {
            const rows = document.querySelectorAll('.item-row');
            if(rows.length > 1) e.target.closest('.item-row').remove();
        }
    });
</script>
@endsection