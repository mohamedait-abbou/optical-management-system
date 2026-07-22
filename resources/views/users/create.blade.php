@extends('layouts.crm')

@section('page-title', 'Nouvel Utilisateur')

@section('content')

<div class="max-w-7xl mx-auto">
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

        <form method="POST" action="{{ route('users.store') }}" class="p-8">
            @csrf

            @if($errors->any())
                <div class="bg-rose-50 border border-rose-200 text-rose-700 px-5 py-4 rounded-2xl mb-6">
                    <ul class="list-disc list-inside text-sm space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Colonne gauche : Infos de base -->
                <div class="lg:col-span-1">
                    <div class="space-y-5">
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

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Mot de passe <span class="text-rose-500">*</span></label>
                            <input type="password" name="password" required
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition"
                                placeholder="••••••••">
                            <p class="mt-1 text-xs text-slate-500">Minimum 8 caractères</p>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Confirmer le mot de passe <span class="text-rose-500">*</span></label>
                            <input type="password" name="password_confirmation" required
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition"
                                placeholder="••••••••">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-3">Rôle <span class="text-rose-500">*</span></label>
                            <select name="role" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition">
                                <option value="">Sélectionner un rôle</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Colonne droite : Matrice des permissions -->
                <div class="lg:col-span-2">
                    <div class="bg-slate-50 rounded-2xl border border-slate-200 p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-bold text-slate-800">Permissions</h3>
                            <div class="flex gap-2">
                                <button type="button" onclick="checkAllPermissions()" class="text-xs px-3 py-2 rounded-lg bg-indigo-100 text-indigo-700 hover:bg-indigo-200 transition font-semibold">
                                    Tout cocher
                                </button>
                                <button type="button" onclick="uncheckAllPermissions()" class="text-xs px-3 py-2 rounded-lg bg-slate-200 text-slate-700 hover:bg-slate-300 transition font-semibold">
                                    Tout décocher
                                </button>
                            </div>
                        </div>

                        <div class="space-y-5">
                            @foreach($groupedPermissions as $module => $permissions)
                                <div class="border border-slate-300 rounded-xl p-5 bg-white">
                                    <div class="flex items-center justify-between mb-4">
                                        <h4 class="font-bold text-slate-800 capitalize">{{ $module }}</h4>
                                        <button type="button" onclick="toggleModule('{{ $module }}')" class="text-xs px-2 py-1 rounded-lg bg-slate-100 hover:bg-slate-200 transition text-slate-600 font-semibold">
                                            Tout cocher
                                        </button>
                                    </div>
                                    <div class="grid grid-cols-2 gap-4">
                                        @foreach($permissions as $permission)
                                            <label class="flex items-center gap-3 cursor-pointer p-2 rounded-lg hover:bg-slate-100 transition">
                                                <input type="checkbox" name="permissions[]" value="{{ $permission }}" 
                                                    data-module="{{ $module }}"
                                                    class="w-5 h-5 rounded-md border-slate-300 text-indigo-600 focus:ring-2 focus:ring-indigo-200">
                                                <span class="text-sm text-slate-700">{{ $permission }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 pt-8 border-t border-slate-100 mt-8">
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

<script>
function checkAllPermissions() {
    document.querySelectorAll('input[name="permissions[]"]').forEach(checkbox => {
        checkbox.checked = true;
    });
}

function uncheckAllPermissions() {
    document.querySelectorAll('input[name="permissions[]"]').forEach(checkbox => {
        checkbox.checked = false;
    });
}

function toggleModule(module) {
    const checkboxes = document.querySelectorAll(`input[data-module="${module}"]`);
    const allChecked = Array.from(checkboxes).every(cb => cb.checked);
    checkboxes.forEach(checkbox => {
        checkbox.checked = !allChecked;
    });
}
</script>

@endsection