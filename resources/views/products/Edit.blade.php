@extends('layouts.crm')

@section('page-title', 'Modifier le produit')

@section('content')

<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold">Modifier le Produit</h2>
    <a href="{{ route('products.index') }}" class="text-gray-600 hover:underline">← Retour à la liste</a>
</div>

<div class="bg-white shadow rounded p-6 max-w-2xl">

    @if ($product->image)
        <div class="mb-4">
            <p class="text-sm text-gray-500 mb-1">Image actuelle</p>
            <img src="{{ asset('storage/' . $product->image) }}" class="w-24 h-24 object-cover rounded">
        </div>
    @endif

    <form method="POST" action="{{ route('products.update', $product) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Nom du produit *</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}"
                   class="w-full border rounded p-2 @error('name') border-red-500 @enderror">
            @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Marque</label>
            <select name="brand_id" class="w-full border rounded p-2 @error('brand_id') border-red-500 @enderror">
                <option value="">-- Aucune --</option>
                @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                @endforeach
            </select>
            @error('brand_id') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Catégorie *</label>
            <select name="category_id" class="w-full border rounded p-2 @error('category_id') border-red-500 @enderror">
                <option value="">-- Sélectionner --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-sm font-medium mb-1">Prix de vente (DH) *</label>
                <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}"
                       class="w-full border rounded p-2 @error('price') border-red-500 @enderror">
                @error('price') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Prix d'achat (DH)</label>
                <input type="number" step="0.01" name="cost_price" value="{{ old('cost_price', $product->cost_price) }}"
                       class="w-full border rounded p-2">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-sm font-medium mb-1">Quantité en stock *</label>
                <input type="number" name="quantity" value="{{ old('quantity', $product->quantity) }}"
                       class="w-full border rounded p-2 @error('quantity') border-red-500 @enderror">
                @error('quantity') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Seuil d'alerte stock faible</label>
                <input type="number" name="alert_threshold" value="{{ old('alert_threshold', $product->alert_threshold) }}"
                       class="w-full border rounded p-2">
            </div>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Remplacer l'image</label>
            <input type="file" name="image" accept="image/*"
                   class="w-full border rounded p-2 @error('image') border-red-500 @enderror">
            @error('image') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium mb-1">Description</label>
            <textarea name="description" rows="3" class="w-full border rounded p-2">{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700">
                Mettre à jour
            </button>
            <a href="{{ route('products.index') }}" class="bg-gray-200 px-5 py-2 rounded">
                Annuler
            </a>
        </div>
    </form>
</div>

@endsection