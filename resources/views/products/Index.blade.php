@extends('layouts.crm')

@section('page-title', 'Produits')

@section('content')

<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold">Produits</h2>
    <a href="{{ route('products.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        + Ajouter un produit
    </a>
</div>

@if (session('success'))
    <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
@endif

<div class="bg-white shadow rounded p-4 mb-4">
    <form method="GET" action="{{ route('products.index') }}" class="flex gap-2">
         <input type="text" name="search" value="{{ $search }}"
             placeholder="Rechercher par nom ou marque..."
               class="border rounded px-3 py-2 w-full">
        <button class="bg-slate-800 text-white px-4 py-2 rounded">Chercher</button>
        @if($search)
            <a href="{{ route('products.index') }}" class="bg-gray-200 px-4 py-2 rounded">Réinitialiser</a>
        @endif
    </form>
</div>

<div class="bg-white shadow rounded overflow-hidden">
    <table class="w-full">
        <thead>
            <tr class="bg-gray-50 border-b text-left">
                <th class="p-3">Image</th>
                <th class="p-3">Nom</th>
                <th class="p-3">Catégorie</th>
                <th class="p-3">Prix</th>
                <th class="p-3">Stock</th>
                <th class="p-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
            <tr class="border-b hover:bg-gray-50">
                <td class="p-3">
                    @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-12 h-12 object-cover rounded">
                    @else
                        <div class="w-12 h-12 bg-gray-100 rounded flex items-center justify-center text-gray-400 text-xs">N/A</div>
                    @endif
                </td>
                <td class="p-3">
                    <a href="{{ route('products.show', $product) }}" class="text-blue-700 hover:underline font-medium">
                        {{ $product->name }}
                    </a>
                    @php
                        $brandRel = $product->brand;
                    @endphp
                    @if ($brandRel instanceof \App\Models\Brand)
                        <p class="text-xs text-gray-500">{{ $brandRel->name }}</p>
                    @elseif(is_string($brandRel) && trim($brandRel) !== '')
                        <p class="text-xs text-gray-500">{{ $brandRel }}</p>
                    @endif
                </td>
                <td class="p-3">{{ $product->category->name }}</td>
                <td class="p-3">{{ number_format($product->price, 2) }} DH</td>
                <td class="p-3">
                    <span class="{{ $product->isLowStock() ? 'text-red-600 font-semibold' : 'text-gray-700' }}">
                        {{ $product->quantity }}
                    </span>
                    @if ($product->isLowStock())
                        <span class="ml-1 text-xs bg-red-100 text-red-700 px-2 py-0.5 rounded">Stock faible</span>
                    @endif
                </td>
                <td class="p-3 flex gap-3">
                    <a href="{{ route('products.edit', $product) }}" class="text-blue-600 hover:underline">Modifier</a>
                    <form action="{{ route('products.destroy', $product) }}" method="POST"
                          onsubmit="return confirm('Confirmer la suppression ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="p-6 text-center text-gray-500">Aucun produit trouvé.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">{{ $products->links() }}</div>

@endsection