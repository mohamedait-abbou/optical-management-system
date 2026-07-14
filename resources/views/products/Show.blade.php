@extends('layouts.crm')

@section('page-title', 'Détails du produit')

@section('content')

<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold">Détails du Produit</h2>
    <div class="flex gap-2">
        <a href="{{ route('products.edit', $product) }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Modifier
        </a>
        <a href="{{ route('products.index') }}" class="bg-gray-200 px-4 py-2 rounded">
            ← Retour
        </a>
    </div>
</div>

<div class="bg-white shadow rounded p-6 max-w-3xl">
    <div class="flex gap-6 mb-6">
        @if ($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" class="w-32 h-32 object-cover rounded">
        @else
            <div class="w-32 h-32 bg-gray-100 rounded flex items-center justify-center text-gray-400">Pas d'image</div>
        @endif

        <div>
            <h3 class="text-2xl font-bold">{{ $product->name }}</h3>
            @php $brandRel = $product->brand; @endphp
            @if ($brandRel instanceof \App\Models\Brand)
                <p class="text-gray-500">{{ $brandRel->name }}</p>
            @elseif(is_string($brandRel) && trim($brandRel) !== '')
                <p class="text-gray-500">{{ $brandRel }}</p>
            @endif
            <p class="mt-2 text-sm bg-gray-100 inline-block px-3 py-1 rounded">{{ $product->category->name }}</p>
        </div>
    </div>

    <div class="grid grid-cols-2 gap-6">
        <div>
            <p class="text-gray-500 text-sm">Prix de vente</p>
            <p class="font-medium">{{ number_format($product->price, 2) }} DH</p>
        </div>

        <div>
            <p class="text-gray-500 text-sm">Prix d'achat</p>
            <p class="font-medium">{{ $product->cost_price ? number_format($product->cost_price, 2) . ' DH' : '—' }}</p>
        </div>

        <div>
            <p class="text-gray-500 text-sm">Stock actuel</p>
            <p class="font-medium {{ $product->isLowStock() ? 'text-red-600' : '' }}">
                {{ $product->quantity }}
                @if ($product->isLowStock())
                    <span class="ml-1 text-xs bg-red-100 text-red-700 px-2 py-0.5 rounded">Stock faible</span>
                @endif
            </p>
        </div>

        <div>
            <p class="text-gray-500 text-sm">Seuil d'alerte</p>
            <p class="font-medium">{{ $product->alert_threshold }}</p>
        </div>

        <div class="col-span-2">
            <p class="text-gray-500 text-sm">Description</p>
            <p class="font-medium">{{ $product->description ?? '—' }}</p>
        </div>
    </div>
</div>

@endsection