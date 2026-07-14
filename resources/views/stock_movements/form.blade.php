@csrf

<div class="space-y-6">
    <div>
        <label for="product_id" class="block text-sm font-semibold text-slate-700">Produit</label>
        <select id="product_id" name="product_id" class="mt-2 w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-700">
            <option value="">Sélectionnez un produit</option>
            @foreach($products as $product)
                <option value="{{ $product->id }}" {{ old('product_id', $stockMovement->product_id ?? '') == $product->id ? 'selected' : '' }}>
                    {{ $product->name }} (Stock: {{ $product->quantity }})
                </option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('product_id')" class="mt-2" />
    </div>

    <div>
        <label for="type" class="block text-sm font-semibold text-slate-700">Type de mouvement</label>
        <select id="type" name="type" class="mt-2 w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-700">
            <option value="IN" {{ old('type', $stockMovement->type ?? '') === 'IN' ? 'selected' : '' }}>IN</option>
            <option value="OUT" {{ old('type', $stockMovement->type ?? '') === 'OUT' ? 'selected' : '' }}>OUT</option>
        </select>
        <x-input-error :messages="$errors->get('type')" class="mt-2" />
    </div>

    <div>
        <label for="quantity" class="block text-sm font-semibold text-slate-700">Quantité</label>
        <input id="quantity" name="quantity" type="number" min="1" value="{{ old('quantity', $stockMovement->quantity ?? '') }}" class="mt-2 w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-700" />
        <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
    </div>

    <div>
        <label for="reference" class="block text-sm font-semibold text-slate-700">Référence</label>
        <input id="reference" name="reference" type="text" value="{{ old('reference', $stockMovement->reference ?? '') }}" class="mt-2 w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-700" />
        <x-input-error :messages="$errors->get('reference')" class="mt-2" />
    </div>

    <div>
        <label for="notes" class="block text-sm font-semibold text-slate-700">Notes</label>
        <textarea id="notes" name="notes" rows="4" class="mt-2 w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-700">{{ old('notes', $stockMovement->notes ?? '') }}</textarea>
        <x-input-error :messages="$errors->get('notes')" class="mt-2" />
    </div>
</div>
