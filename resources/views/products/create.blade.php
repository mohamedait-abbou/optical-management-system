@extends('layouts.crm')

@section('page-title', 'Ajouter un produit')

@section('content')

<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div class="flex items-center gap-4">
            <a href="{{ route('products.index') }}" class="p-2 rounded-xl bg-slate-100 hover:bg-slate-200 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 12H5M12 19l-7-7 7-7"/>
                </svg>
            </a>
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.3em] text-indigo-600">Nouveau produit</p>
                <h2 class="text-3xl font-semibold text-slate-900">Ajouter un produit</h2>
                <p class="mt-1 text-sm text-slate-500">Remplissez les informations pour ajouter un nouveau produit à l'inventaire.</p>
            </div>
        </div>
        <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
            Retour à la liste
        </a>
    </div>

    <!-- Form Card -->
    <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
        <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data" class="space-y-8">
            @csrf

            <!-- Section 1: Basic Info -->
            <div>
                <div class="flex items-center gap-3 mb-6">
                    <div class="p-2 rounded-xl bg-indigo-50 text-indigo-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 7h16M4 12h16M4 17h16"/></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">Informations générales</h3>
                        <p class="text-xs text-slate-500">Nom, marque et catégorie du produit</p>
                    </div>
                </div>

                <div class="grid gap-6 md:grid-cols-2">
                    <!-- Name -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Nom du produit <span class="text-rose-500">*</span></label>
                        <input type="text" name="name" value="{{ old('name') }}" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition @error('name') border-rose-500 @enderror" placeholder="Ex: Monture Ray-Ban Aviator">
                        @error('name') <p class="mt-2 text-sm text-rose-600 flex items-center gap-1"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg> {{ $message }}</p> @enderror
                    </div>

                    <!-- Brand -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Marque</label>
                        <select name="brand_id" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition @error('brand_id') border-rose-500 @enderror">
                            <option value="">-- Aucune --</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                            @endforeach
                        </select>
                        @error('brand_id') <p class="mt-2 text-sm text-rose-600">{{ $message }}</p> @enderror
                    </div>

                    <!-- Category -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Catégorie <span class="text-rose-500">*</span></label>
                        <select name="category_id" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition @error('category_id') border-rose-500 @enderror">
                            <option value="">-- Sélectionner --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id') <p class="mt-2 text-sm text-rose-600">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <!-- Divider -->
            <div class="border-t border-slate-200"></div>

            <!-- Section 2: Pricing & Stock -->
            <div>
                <div class="flex items-center gap-3 mb-6">
                    <div class="p-2 rounded-xl bg-emerald-50 text-emerald-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">Prix et stock</h3>
                        <p class="text-xs text-slate-500">Informations financières et gestion des stocks</p>
                    </div>
                </div>

                <div class="grid gap-6 md:grid-cols-2">
                    <!-- Selling Price -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Prix de vente (DH) <span class="text-rose-500">*</span></label>
                        <div class="relative">
                            <input type="number" step="0.01" name="price" value="{{ old('price') }}" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 pr-12 text-sm text-slate-900 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition @error('price') border-rose-500 @enderror" placeholder="0.00">
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-sm font-semibold text-slate-400">DH</span>
                        </div>
                        @error('price') <p class="mt-2 text-sm text-rose-600">{{ $message }}</p> @enderror
                    </div>

                    <!-- Cost Price -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Prix d'achat (DH)</label>
                        <div class="relative">
                            <input type="number" step="0.01" name="cost_price" value="{{ old('cost_price') }}" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 pr-12 text-sm text-slate-900 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition" placeholder="0.00">
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-sm font-semibold text-slate-400">DH</span>
                        </div>
                    </div>

                    <!-- Quantity -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Quantité en stock <span class="text-rose-500">*</span></label>
                        <input type="number" name="quantity" value="{{ old('quantity', 0) }}" min="0" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition @error('quantity') border-rose-500 @enderror">
                        @error('quantity') <p class="mt-2 text-sm text-rose-600">{{ $message }}</p> @enderror
                    </div>

                    <!-- Alert Threshold -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Seuil d'alerte stock faible</label>
                        <input type="number" name="alert_threshold" value="{{ old('alert_threshold', 5) }}" min="0" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition">
                        <p class="mt-1 text-xs text-slate-500">Vous serez alerté quand le stock atteindra ce niveau</p>
                    </div>
                </div>
            </div>

            <!-- Divider -->
            <div class="border-t border-slate-200"></div>

            <!-- Section 3: Image & Description -->
            <div>
                <div class="flex items-center gap-3 mb-6">
                    <div class="p-2 rounded-xl bg-fuchsia-50 text-fuchsia-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">Image et description</h3>
                        <p class="text-xs text-slate-500">Photo du produit et détails supplémentaires</p>
                    </div>
                </div>

                <div class="grid gap-6 md:grid-cols-2">
                    <!-- Image Upload -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Image du produit</label>
                        <div class="relative">
                            <input type="file" name="image" accept="image/*" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 @error('image') border-rose-500 @enderror">
                        </div>
                        @error('image') <p class="mt-2 text-sm text-rose-600">{{ $message }}</p> @enderror
                        <p class="mt-1 text-xs text-slate-500">Formats acceptés : JPG, PNG (max 2MB)</p>
                    </div>

                    <!-- Description -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Description</label>
                        <textarea name="description" rows="4" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition" placeholder="Description détaillée du produit...">{{ old('description') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between pt-6 border-t border-slate-100">
                <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6 6 18M6 6l12 12"/></svg>
                    Annuler
                </a>
                <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-gradient-to-r from-indigo-600 to-fuchsia-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-600/20 transition hover:scale-[1.02]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    Enregistrer le produit
                </button>
            </div>
        </form>
    </div>
</div>

@endsection