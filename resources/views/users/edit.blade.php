@extends('layouts.crm')

@section('page-title', 'Modifier l\'utilisateur')

@section('content')

<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
        
        <!-- Header avec avatar -->
        <div class="bg-gradient-to-r from-amber-500 to-orange-600 px-8 py-6">
            <div class="flex items-center gap-4">
                <a href="{{ route('users.index') }}" class="p-2 rounded-xl bg-white/20 hover:bg-white/30 transition text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 12H5"></path>
                        <path d="m12 19-7-7 7-7"></path>
                    </svg>
                </a>
                <div class="w-14 h-14 rounded-full bg-white/20 backdrop-blur border-2 border-white/30 flex items-center justify-center text-2xl font-bold text-white">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <div>
                    <h3 class="text-xl font-bold text-white">{{ $user->name }}</h3>
                    <p class="text-amber-100 text-sm">{{ $user->email }}</p>
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('users.update', $user) }}" class="p-8 space-y-6">
            @csrf
            @method('PUT')

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
                    <input type="text" name="name" required value="{{ old('name', $user->name) }}"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Email <span class="text-rose-500">*</span></label>
                    <input type="email" name="email" required value="{{ old('email', $user->email) }}"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition">
                </div>
            </div>

            <div class="p-5 rounded-2xl bg-amber-50/50 border border-amber-100">
                <label class="block text-sm font-semibold text-slate-700 mb-2">Nouveau mot de passe</label>
                <input type="password" name="password"
                    class="w-full px-4 py-3 rounded-xl border border-amber-200 bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition"
                    placeholder="Laisser vide pour conserver l'actuel">
                <p class="mt-2 text-xs text-amber-700">Laissez vide si vous ne souhaitez pas changer le mot de passe.</p>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-3">Rôle <span class="text-rose-500">*</span></label>
                <div class="grid md:grid-cols-3 gap-3">
                    @foreach($roles as $role)
                        <label class="relative cursor-pointer">
                            <input type="radio" name="role" value="{{ $role->name }}" class="peer sr-only"
                                {{ $user->hasRole($role->name) ? 'checked' : '' }}>
                            <div class="p-4 rounded-2xl border-2 border-slate-200 peer-checked:border-indigo-500 peer-checked:bg-indigo-50 transition">
                                <span class="font-semibold text-slate-900">{{ $role->name }}</span>
                            </div>
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="flex items-center justify-between pt-6 border-t border-slate-100">
                <form action="{{ route('users.destroy', $user) }}" method="POST"
                    onsubmit="return confirm('⚠️ Êtes-vous sûr de vouloir supprimer définitivement cet utilisateur ?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-2xl bg-rose-50 hover:bg-rose-100 text-rose-700 font-semibold transition border border-rose-200">
                        Supprimer
                    </button>
                </form>

                <div class="flex items-center gap-3">
                    <a href="{{ route('users.index') }}" class="px-6 py-3 rounded-2xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold transition">
                        Annuler
                    </a>
                    <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 rounded-2xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold shadow-lg shadow-indigo-600/20 transition hover:scale-105">
                        Enregistrer
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection