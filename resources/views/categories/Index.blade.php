@extends('layouts.crm')

@section('page-title', 'Catégories')

@section('content')

<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold">Catégories</h2>
    <a href="{{ route('categories.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        + Ajouter une catégorie
    </a>
</div>

@if (session('success'))
    <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
@endif

@if (session('error'))
    <div class="bg-red-100 text-red-800 p-3 rounded mb-4">{{ session('error') }}</div>
@endif

<div class="bg-white shadow rounded overflow-hidden">
    <table class="w-full">
        <thead>
            <tr class="bg-gray-50 border-b text-left">
                <th class="p-3">Nom</th>
                <th class="p-3">Description</th>
                <th class="p-3">Produits liés</th>
                <th class="p-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
            <tr class="border-b hover:bg-gray-50">
                <td class="p-3 font-medium">{{ $category->name }}</td>
                <td class="p-3">{{ $category->description ?? '—' }}</td>
                <td class="p-3">{{ $category->products_count }}</td>
                <td class="p-3 flex gap-3">
                    <a href="{{ route('categories.edit', $category) }}" class="text-blue-600 hover:underline">Modifier</a>
                    <form action="{{ route('categories.destroy', $category) }}" method="POST"
                          onsubmit="return confirm('Confirmer la suppression ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="p-6 text-center text-gray-500">Aucune catégorie trouvée.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">{{ $categories->links() }}</div>

@endsection