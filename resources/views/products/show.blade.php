@extends('layouts.crm')

@section('page-title', 'Détails du produit')

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
                <p class="text-sm font-semibold uppercase tracking-[0.3em] text-indigo-600">Produit</p>
                <h2 class="text-3xl font-semibold text-slate-900">{{ $product->name }}</h2>
                <p class="mt-1 text-sm text-slate-500">Fiche détaillée du produit</p>
            </div>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('products.edit', $product) }}" class="inline-flex items-center gap-2 rounded-2xl bg-amber-500 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-amber-500/20 transition hover:bg-amber-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/>
                </svg>
                Modifier
            </a>
            <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                Retour à la liste
            </a>
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-[1fr_360px]">
        <!-- Main Content -->
        <div class="space-y-6">
            <!-- Product Info Card -->
            <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
                <div class="flex items-start gap-6">
                    @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" class="h-40 w-40 rounded-3xl object-cover shadow-lg border border-slate-100">
                    @else
                        <div class="flex h-40 w-40 items-center justify-center rounded-3xl bg-gradient-to-br from-indigo-100 to-fuchsia-100 text-indigo-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/>
                            </svg>
                        </div>
                    @endif

                    <div class="flex-1">
                        <h3 class="text-2xl font-bold text-slate-900">{{ $product->name }}</h3>
                        @php $brandRel = $product->brand; @endphp
                        @if ($brandRel instanceof \App\Models\Brand)
                            <p class="mt-2 text-sm font-medium text-slate-600 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/></svg>
                                Marque : {{ $brandRel->name }}
                            </p>
                        @elseif(is_string($brandRel) && trim($brandRel) !== '')
                            <p class="mt-2 text-sm font-medium text-slate-600">Marque : {{ $brandRel }}</p>
                        @endif
                        <div class="mt-3 flex flex-wrap gap-2">
                            <span class="inline-flex items-center rounded-full bg-indigo-50 px-3 py-1 text-xs font-semibold text-indigo-700 border border-indigo-100">
                                {{ $product->category->name }}
                            </span>
                            @if ($product->isLowStock())
                                <span class="inline-flex items-center gap-1 rounded-full bg-rose-50 px-3 py-1 text-xs font-semibold text-rose-700 border border-rose-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                                    Stock faible
                                </span>
                            @else
                                <span class="inline-flex items-center rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700 border border-emerald-100">
                                    En stock
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                @if($product->description)
                    <div class="mt-8 pt-6 border-t border-slate-100">
                        <h4 class="text-sm font-semibold uppercase tracking-wider text-slate-500 mb-3">Description</h4>
                        <p class="text-slate-700 leading-relaxed">{{ $product->description }}</p>
                    </div>
                @endif
            </div>

            <!-- Pricing & Stock Card -->
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex items-center gap-3 mb-6">
                    <div class="p-2 rounded-xl bg-emerald-50 text-emerald-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900">Informations financières et stock</h3>
                </div>

                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    <div class="rounded-2xl bg-gradient-to-br from-indigo-50 to-indigo-100/50 border border-indigo-100 p-5">
                        <p class="text-xs font-semibold uppercase tracking-wider text-indigo-700">Prix de vente</p>
                        <p class="mt-2 text-2xl font-bold text-indigo-900">{{ number_format($product->price, 2, ',', ' ') }} <span class="text-sm font-medium">DH</span></p>
                    </div>

                    <div class="rounded-2xl bg-slate-50 border border-slate-100 p-5">
                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-600">Prix d'achat</p>
                        <p class="mt-2 text-2xl font-bold text-slate-900">
                            {{ $product->cost_price ? number_format($product->cost_price, 2, ',', ' ') : '—' }}
                            @if($product->cost_price) <span class="text-sm font-medium">DH</span> @endif
                        </p>
                    </div>

                    <div class="rounded-2xl {{ $product->isLowStock() ? 'bg-rose-50 border-rose-100' : 'bg-emerald-50 border-emerald-100' }} border p-5">
                        <p class="text-xs font-semibold uppercase tracking-wider {{ $product->isLowStock() ? 'text-rose-700' : 'text-emerald-700' }}">Stock actuel</p>
                        <p class="mt-2 text-2xl font-bold {{ $product->isLowStock() ? 'text-rose-900' : 'text-emerald-900' }}">
                            {{ $product->quantity }}
                            <span class="text-sm font-medium">unités</span>
                        </p>
                    </div>

                    <div class="rounded-2xl bg-amber-50 border border-amber-100 p-5">
                        <p class="text-xs font-semibold uppercase tracking-wider text-amber-700">Seuil d'alerte</p>
                        <p class="mt-2 text-2xl font-bold text-amber-900">{{ $product->alert_threshold }} <span class="text-sm font-medium">unités</span></p>
                    </div>
                </div>

                @if($product->cost_price)
                    @php $margin = $product->price - $product->cost_price; $marginPercent = ($margin / $product->price) * 100; @endphp
                    <div class="mt-6 pt-6 border-t border-slate-100">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-semibold text-slate-600">Marge bénéficiaire</span>
                            <div class="text-right">
                                <span class="text-lg font-bold text-emerald-700">{{ number_format($margin, 2, ',', ' ') }} DH</span>
                                <span class="ml-2 text-sm font-medium text-emerald-600">({{ number_format($marginPercent, 1) }}%)</span>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Quick Stats -->
            <div class="rounded-3xl border border-slate-200 bg-gradient-to-br from-indigo-600 to-fuchsia-600 p-6 text-white shadow-lg shadow-indigo-600/20">
                <div class="flex items-center gap-3 mb-4">
                    <div class="p-2 rounded-xl bg-white/20 backdrop-blur">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold">Aperçu rapide</h3>
                </div>
                <div class="space-y-3">
                    <div class="flex justify-between items-center pb-3 border-b border-white/20">
                        <span class="text-sm text-indigo-100">Catégorie</span>
                        <span class="font-semibold">{{ $product->category->name }}</span>
                    </div>
                    <div class="flex justify-between items-center pb-3 border-b border-white/20">
                        <span class="text-sm text-indigo-100">État du stock</span>
                        <span class="font-semibold">{{ $product->isLowStock() ? '⚠️ Faible' : '✅ OK' }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-indigo-100">ID Produit</span>
                        <span class="font-semibold">#{{ $product->id }}</span>
                    </div>
                </div>
            </div>

            <!-- Actions Card -->
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <h3 class="text-lg font-bold text-slate-900 mb-4">Actions rapides</h3>
                <div class="space-y-3">
                    <a href="{{ route('products.edit', $product) }}" class="inline-flex w-full items-center justify-center gap-2 rounded-2xl bg-amber-500 px-4 py-3 text-sm font-semibold text-white transition hover:bg-amber-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/></svg>
                        Modifier ce produit
                    </a>
                    <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Confirmer la suppression de ce produit ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex w-full items-center justify-center gap-2 rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm font-semibold text-rose-700 transition hover:bg-rose-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                            Supprimer ce produit
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection