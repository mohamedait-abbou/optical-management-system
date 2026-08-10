@extends('layouts.crm')

@section('page-title', 'Modifier la catégorie')

@section('content')

<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold">Modifier la Catégorie</h2>
    <a href="{{ route('categories.index') }}" class="text-gray-600 hover:underline">← Retour à la liste</a>
</div>

<div class="bg-white shadow rounded p-6 max-w-xl">
    <form method="POST" action="{{ route('categories.update', $category) }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Nom *</label>
            <input type="text" name="name" value="{{ old('name', $category->name) }}"
                   class="w-full border rounded p-2 @error('name') border-red-500 @enderror">
            @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium mb-1">Description</label>
            <textarea name="description" rows="3" class="w-full border rounded p-2">{{ old('description', $category->description) }}</textarea>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700">
                Mettre à jour
            </button>
            <a href="{{ route('categories.index') }}" class="bg-gray-200 px-5 py-2 rounded">
                Annuler
            </a>
        </div>
    </form>
</div>

@endsection
