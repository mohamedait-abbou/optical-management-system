@php
$order = $order ?? null;
@endphp

<div class="grid gap-6">

    <div class="grid md:grid-cols-3 gap-5">

        @php $selectedCustomerId = old('customer_id', optional($order)->customer_id); @endphp

        <div>
            <div class="flex items-center justify-between gap-3">
                <x-input-label value="Client"/>
                <button type="button"
                        class="rounded-full border border-slate-300 bg-white px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50"
                        @click="$dispatch('open-modal', 'quick-add-customer')">
                    + Nouveau client
                </button>
            </div>

            <select
                id="customer_id"
                name="customer_id"
                class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3">

                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}" {{ $selectedCustomerId == $customer->id ? 'selected' : '' }}>
                        {{ $customer->first_name }} {{ $customer->last_name }}@if($customer->cin) ({{ $customer->cin }})@endif
                    </option>
                @endforeach

            </select>

        </div>

        <div>

            <x-input-label value="Order Date"/>

            <x-text-input
                type="date"
                name="order_date"
                class="mt-2 w-full"
                value="{{ old('order_date',date('Y-m-d')) }}"
            />

        </div>

        <div>

            <x-input-label value="Status"/>

            <select
                name="status"
                class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3">

                <option>Pending</option>
                <option>Processing</option>
                <option>Completed</option>
                <option>Cancelled</option>

            </select>

        </div>

    </div>

    <hr>

    <div>

        <h2 class="text-xl font-bold mb-4">

            Products

        </h2>

        <table class="w-full border rounded-xl overflow-hidden">

            <thead class="bg-slate-100">

            <tr>

                <th class="p-3">Product</th>

                <th class="p-3">Price</th>

                <th class="p-3">Qty</th>

                <th class="p-3">Subtotal</th>

                <th></th>

            </tr>

            </thead>

            <tbody id="productsTable">
                @if(isset($order) && $order->items->isNotEmpty())
                    @foreach($order->items as $item)
                        <tr>
                            <td>
                                <select name="products[]" class="product w-full border rounded-lg p-2">
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}" data-price="{{ $product->price }}" {{ $product->id === $item->product_id ? 'selected' : '' }}>
                                            {{ $product->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input readonly class="price w-full border rounded-lg p-2" value="{{ number_format($item->unit_price, 2) }}">
                            </td>
                            <td>
                                <input type="number" name="quantities[]" value="{{ $item->quantity }}" min="1" class="qty w-full border rounded-lg p-2">
                            </td>
                            <td>
                                <input readonly class="subtotal w-full border rounded-lg p-2" value="{{ number_format($item->subtotal, 2) }}">
                            </td>
                            <td>
                                <button type="button" class="remove text-red-600">X</button>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>

        </table>

        <button
            type="button"
            id="addRow"
            class="mt-4 px-5 py-2 rounded-xl bg-blue-600 text-white">

            + Add Product

        </button>

        <input type="hidden" name="total_amount" id="totalAmountField" value="0.00">

    </div>

    <div class="text-right">

        <h2 class="text-2xl font-bold">

            Total :

            <span id="grandTotal">

                0.00

            </span>

            MAD

        </h2>

    </div>

</div>

<script>

const products=@json($products);

const table=document.getElementById('productsTable');
const totalAmountField=document.getElementById('totalAmountField');

function addOrderRow(productId = null, quantity = 1) {
    let options = '';

    products.forEach(product => {
        options += `
            <option value="${product.id}" data-price="${product.price}" ${product.id == productId ? 'selected' : ''}>
                ${product.name}
            </option>`;
    });

    table.insertAdjacentHTML('beforeend', `
        <tr>
            <td>
                <select name="products[]" class="product w-full border rounded-lg p-2">
                    ${options}
                </select>
            </td>
            <td>
                <input readonly class="price w-full border rounded-lg p-2">
            </td>
            <td>
                <input type="number" name="quantities[]" value="${quantity}" min="1" class="qty w-full border rounded-lg p-2">
            </td>
            <td>
                <input readonly class="subtotal w-full border rounded-lg p-2">
            </td>
            <td>
                <button type="button" class="remove text-red-600">X</button>
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
    if (e.target.classList.contains('remove')) {
        e.target.closest('tr').remove();
        update();
    }
});

update();


</script>