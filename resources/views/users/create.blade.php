@extends('layouts.crm')

@section('page-title', 'Nouvel Utilisateur')

@section('content')

<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
        
        <!-- Header coloré -->
        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-8 py-6">
            <div class="flex items-center gap-4">
                <a href="{{ route('users.index') }}" class="p-2 rounded-xl bg-white/20 hover:bg-white/30 transition text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 12H5"></path>
                        <path d="m12 19-7-7 7-7"></path>
                    </svg>
                </a>
                <div>
                    <h3 class="text-xl font-bold text-white">Nouvel Utilisateur</h3>
                    <p class="text-indigo-100 text-sm">Créer un nouveau compte pour un membre de l'équipe</p>
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('users.store') }}" class="p-8 space-y-6">
            @csrf

            @if($errors->any())
                <div class="bg-rose-50 border border-rose-200 text-rose-700 px-5 py-4 rounded-2xl">
                    <ul class="list-disc list-inside text-sm space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Nom complet <span class="text-rose-500">*</span></label>
                    <input type="text" name="name" required value="{{ old('name') }}"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition"
                        placeholder="Jean Dupont">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Email <span class="text-rose-500">*</span></label>
                    <input type="email" name="email" required value="{{ old('email') }}"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition"
                        placeholder="jean@exemple.com">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Mot de passe <span class="text-rose-500">*</span></label>
                <input type="password" name="password" required
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition"
                    placeholder="••••••••">
                <p class="mt-1 text-xs text-slate-500">Minimum 8 caractères</p>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-3">Rôle <span class="text-rose-500">*</span></label>
                <div class="grid md:grid-cols-3 gap-3">
                    @foreach($roles as $role)
                        <label class="relative cursor-pointer">
                            <input type="radio" name="role" value="{{ $role->name }}" class="peer sr-only" {{ old('role') == $role->name ? 'checked' : '' }}>
                            <div class="p-4 rounded-2xl border-2 border-slate-200 peer-checked:border-indigo-500 peer-checked:bg-indigo-50 transition">
                                <span class="font-semibold text-slate-900">{{ $role->name }}</span>
                            </div>
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
                <a href="{{ route('users.index') }}" class="px-6 py-3 rounded-2xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold transition">
                    Annuler
                </a>
                <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 rounded-2xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold shadow-lg shadow-indigo-600/20 transition hover:scale-105">
                    Créer l'utilisateur
                </button>
            </div>
        </form>
    </div>
</div>

@endsection