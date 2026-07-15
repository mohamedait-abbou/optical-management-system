@php
    $order = $order ?? null;
@endphp

<div class="space-y-8">
    <!-- Section 1: Order Info -->
    <div>
        <div class="flex items-center gap-3 mb-6">
            <div class="p-2 rounded-xl bg-indigo-50 text-indigo-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
            </div>
            <h3 class="text-lg font-bold text-slate-900">Informations de la commande</h3>
        </div>

        <div class="grid gap-6 md:grid-cols-3">
            @php $selectedCustomerId = old('customer_id', optional($order)->customer_id); @endphp

            <!-- Client -->
            <div>
                <div class="flex items-center justify-between gap-3 mb-2">
                    <label class="text-sm font-semibold text-slate-700">Client</label>
                    <button type="button"
                            class="inline-flex items-center gap-1 rounded-full border border-indigo-200 bg-indigo-50 px-3 py-1.5 text-xs font-semibold text-indigo-700 hover:bg-indigo-100 transition"
                            @click="$dispatch('open-modal', 'quick-add-customer')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 5v14M5 12h14"/>
                        </svg>
                        Nouveau client
                    </button>
                </div>
                <select
                    id="customer_id"
                    name="customer_id"
                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition">

                    <option value="">Sélectionnez un client</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}" {{ $selectedCustomerId == $customer->id ? 'selected' : '' }}>
                            {{ $customer->first_name }} {{ $customer->last_name }}@if($customer->cin) ({{ $customer->cin }})@endif
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Date -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Date de commande</label>
                <input
                    type="date"
                    name="order_date"
                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition"
                    value="{{ old('order_date', date('Y-m-d')) }}"
                />
            </div>

            <!-- Status -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Statut</label>
                <select
                    name="status"
                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition">

                    <option value="Pending" {{ old('status') === 'Pending' ? 'selected' : '' }}>En attente</option>
                    <option value="Processing" {{ old('status') === 'Processing' ? 'selected' : '' }}>En cours</option>
                    <option value="Completed" {{ old('status') === 'Completed' ? 'selected' : '' }}>Terminée</option>
                    <option value="Cancelled" {{ old('status') === 'Cancelled' ? 'selected' : '' }}>Annulée</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Divider -->
    <div class="border-t border-slate-200"></div>

    <!-- Section 2: Products -->
    <div>
        <div class="flex items-center gap-3 mb-6">
            <div class="p-2 rounded-xl bg-fuchsia-50 text-fuchsia-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 7h16M4 12h16M4 17h16"/>
                </svg>
            </div>
            <div class="flex-1">
                <h3 class="text-lg font-bold text-slate-900">Produits</h3>
                <p class="text-xs text-slate-500">Ajoutez les produits à cette commande</p>
            </div>
        </div>

        <!-- Products Table -->
        <div class="overflow-hidden rounded-2xl border border-slate-200">
            <table class="w-full">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Produit</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Prix unitaire</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Quantité</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">Sous-total</th>
                        <th class="px-4 py-3"></th>
                    </tr>
                </thead>
                <tbody id="productsTable" class="divide-y divide-slate-100 bg-white">
                    @if(isset($order) && $order->items->isNotEmpty())
                        @foreach($order->items as $item)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-4 py-3">
                                    <select name="products[]" class="product w-full rounded-lg border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200">
                                        @foreach($products as $product)
                                            <option value="{{ $product->id }}" data-price="{{ $product->price }}" {{ $product->id === $item->product_id ? 'selected' : '' }}>
                                                {{ $product->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="px-4 py-3">
                                    <input readonly class="price w-full rounded-lg border border-slate-200 bg-slate-100 px-3 py-2 text-sm text-slate-700" value="{{ number_format($item->unit_price, 2) }}">
                                </td>
                                <td class="px-4 py-3">
                                    <input type="number" name="quantities[]" value="{{ $item->quantity }}" min="1" class="qty w-full rounded-lg border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200">
                                </td>
                                <td class="px-4 py-3">
                                    <input readonly class="subtotal w-full rounded-lg border border-slate-200 bg-slate-100 px-3 py-2 text-sm font-semibold text-slate-900" value="{{ number_format($item->subtotal, 2) }}">
                                </td>
                                <td class="px-4 py-3">
                                    <button type="button" class="remove inline-flex items-center justify-center h-8 w-8 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-100 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M18 6 6 18M6 6l12 12"/>
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Add Product Button -->
        <button
            type="button"
            id="addRow"
            class="mt-4 inline-flex items-center gap-2 rounded-2xl border-2 border-dashed border-indigo-300 bg-indigo-50 px-5 py-3 text-sm font-semibold text-indigo-700 hover:bg-indigo-100 hover:border-indigo-400 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M12 5v14M5 12h14"/>
            </svg>
            Ajouter un produit
        </button>

        <input type="hidden" name="total_amount" id="totalAmountField" value="0.00">
    </div>

    <!-- Total Section -->
    <div class="rounded-3xl bg-gradient-to-br from-indigo-600 to-fuchsia-600 p-6 text-white shadow-lg shadow-indigo-600/20">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-indigo-100">Total de la commande</p>
                <p class="mt-1 text-xs text-indigo-200">Montant TTC en Dirhams</p>
            </div>
            <div class="text-right">
                <p class="text-4xl font-bold">
                    <span id="grandTotal">0.00</span>
                    <span class="text-xl font-medium text-indigo-200 ml-2">DH</span>
                </p>
            </div>
        </div>
    </div>
</div>

<script>
const products = @json($products);
const table = document.getElementById('productsTable');
const totalAmountField = document.getElementById('totalAmountField');

function addOrderRow(productId = null, quantity = 1) {
    let options = '';

    products.forEach(product => {
        options += `
            <option value="${product.id}" data-price="${product.price}" ${product.id == productId ? 'selected' : ''}>
                ${product.name}
            </option>`;
    });

    table.insertAdjacentHTML('beforeend', `
        <tr class="hover:bg-slate-50 transition-colors">
            <td class="px-4 py-3">
                <select name="products[]" class="product w-full rounded-lg border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200">
                    ${options}
                </select>
            </td>
            <td class="px-4 py-3">
                <input readonly class="price w-full rounded-lg border border-slate-200 bg-slate-100 px-3 py-2 text-sm text-slate-700">
            </td>
            <td class="px-4 py-3">
                <input type="number" name="quantities[]" value="${quantity}" min="1" class="qty w-full rounded-lg border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200">
            </td>
            <td class="px-4 py-3">
                <input readonly class="subtotal w-full rounded-lg border border-slate-200 bg-slate-100 px-3 py-2 text-sm font-semibold text-slate-900">
            </td>
            <td class="px-4 py-3">
                <button type="button" class="remove inline-flex items-center justify-center h-8 w-8 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-100 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M18 6 6 18M6 6l12 12"/>
                    </svg>
                </button>
            </td>
        </tr>
    `);

    update();
}

document.getElementById('addRow').onclick = function () {
    addOrderRow();
};

function update() {
    let total = 0;

    document.querySelectorAll('#productsTable tr').forEach(row => {
        const select = row.querySelector('.product');
        const price = parseFloat(select.selectedOptions[0].dataset.price || 0);
        const qty = Math.max(1, parseFloat(row.querySelector('.qty').value || 1));
        const subtotal = price * qty;

        row.querySelector('.price').value = price.toFixed(2);
        row.querySelector('.subtotal').value = subtotal.toFixed(2);
        total += subtotal;
    });

    document.getElementById('grandTotal').innerText = total.toFixed(2);
    totalAmountField.value = total.toFixed(2);
}

document.addEventListener('change', function (e) {
    if (e.target.matches('.product, .qty')) {
        update();
    }
});

document.addEventListener('input', function (e) {
    if (e.target.matches('.qty')) {
        update();
    }
});

document.addEventListener('click', function (e) {
    if (e.target.classList.contains('remove') || e.target.closest('.remove')) {
        e.target.closest('tr').remove();
        update();
    }
});

update();
</script>