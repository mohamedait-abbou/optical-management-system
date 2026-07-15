@extends('layouts.crm')
@section('page-title', 'Ajouter un fournisseur')
@section('content')
<div class="mx-auto max-w-3xl space-y-6">
    <div class="flex items-center gap-4">
        <a href="{{ route('suppliers.index') }}" class="rounded-xl bg-slate-100 p-2 hover:bg-slate-200"><svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg></a>
        <h2 class="text-2xl font-bold text-slate-900">Nouveau Fournisseur</h2>
    </div>
    <form method="POST" action="{{ route('suppliers.store') }}" class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm space-y-6">
        @csrf
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-slate-700">Nom de l'entreprise *</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="mt-1 w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700">Nom du contact</label>
                <input type="text" name="contact_name" value="{{ old('contact_name') }}" class="mt-1 w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700">Téléphone</label>
                <input type="text" name="phone" value="{{ old('phone') }}" class="mt-1 w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200">
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-slate-700">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="mt-1 w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200">
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-slate-700">Adresse</label>
                <textarea name="address" rows="3" class="mt-1 w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200">{{ old('address') }}</textarea>
            </div>
        </div>
        <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
            <a href="{{ route('suppliers.index') }}" class="rounded-xl border border-slate-300 px-6 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50">Annuler</a>
            <button type="submit" class="rounded-xl bg-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-500/30 hover:bg-indigo-700">Enregistrer</button>
        </div>
    </form>
</div>
@endsection