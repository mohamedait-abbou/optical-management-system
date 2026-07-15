@extends('layouts.crm')

@section('page-title', 'Modifier le fournisseur')

@section('content')
<div class="mx-auto max-w-3xl space-y-6">
    <!-- Header -->
    <div class="flex items-center gap-4">
        <a href="{{ route('suppliers.index') }}" class="rounded-xl bg-slate-100 p-2 hover:bg-slate-200 transition">
            <svg class="h-5 w-5 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </a>
        <div>
            <h2 class="text-2xl font-bold text-slate-900">Modifier le fournisseur</h2>
            <p class="text-sm text-slate-500">Mettez à jour les informations de {{ $supplier->name }}</p>
        </div>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ route('suppliers.update', $supplier) }}" class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm space-y-6">
        @csrf
        @method('PUT') {{-- Important pour la mise à jour --}}

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <!-- Nom de l'entreprise -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-slate-700">Nom de l'entreprise *</label>
                <input type="text" name="name" value="{{ old('name', $supplier->name) }}" required 
                       class="mt-1 w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition">
                @error('name') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
            </div>

            <!-- Nom du contact -->
            <div>
                <label class="block text-sm font-medium text-slate-700">Nom du contact</label>
                <input type="text" name="contact_name" value="{{ old('contact_name', $supplier->contact_name) }}" 
                       class="mt-1 w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition">
            </div>

            <!-- Téléphone -->
            <div>
                <label class="block text-sm font-medium text-slate-700">Téléphone</label>
                <input type="text" name="phone" value="{{ old('phone', $supplier->phone) }}" 
                       class="mt-1 w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition">
            </div>

            <!-- Email -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-slate-700">Email</label>
                <input type="email" name="email" value="{{ old('email', $supplier->email) }}" 
                       class="mt-1 w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition">
                @error('email') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
            </div>

            <!-- Adresse -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-slate-700">Adresse</label>
                <textarea name="address" rows="3" 
                          class="mt-1 w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition">{{ old('address', $supplier->address) }}</textarea>
            </div>

            <!-- Notes (Optionnel) -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-slate-700">Notes internes</label>
                <textarea name="notes" rows="3" 
                          class="mt-1 w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition">{{ old('notes', $supplier->notes) }}</textarea>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
            <a href="{{ route('suppliers.index') }}" class="rounded-xl border border-slate-300 px-6 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition">
                Annuler
            </a>
            <button type="submit" class="rounded-xl bg-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-500/30 hover:bg-indigo-700 transition">
                Enregistrer les modifications
            </button>
        </div>
    </form>
</div>
@endsection