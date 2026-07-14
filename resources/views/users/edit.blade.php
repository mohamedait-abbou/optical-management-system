<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('users.index') }}" class="p-2 rounded-xl bg-slate-100 hover:bg-slate-200 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 12H5"></path>
                    <path d="m12 19-7-7 7-7"></path>
                </svg>
            </a>
            <div>
                <h2 class="text-3xl font-bold text-slate-900">Modifier l'utilisateur</h2>
                <p class="mt-1 text-slate-500">Mettre à jour les informations de <strong>{{ $user->name }}</strong></p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">

                {{-- Header avec avatar --}}
                <div class="bg-gradient-to-r from-amber-500 to-orange-600 px-8 py-6">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 rounded-full bg-white/20 backdrop-blur border-2 border-white/30 flex items-center justify-center text-2xl font-bold text-white">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-white">{{ $user->name }}</h3>
                            <p class="text-amber-100 text-sm">{{ $user->email }}</p>
                        </div>
                        <div class="ml-auto">
                            <span class="px-3 py-1.5 rounded-full bg-white/20 text-white text-xs font-semibold backdrop-blur">
                                Membre depuis {{ $user->created_at->format('M Y') }}
                            </span>
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('users.update', $user) }}" class="p-8 space-y-6">
                    @csrf
                    @method('PUT')

                    {{-- Erreurs --}}
                    @if($errors->any())
                        <div class="bg-rose-50 border border-rose-200 text-rose-700 px-5 py-4 rounded-2xl">
                            <div class="flex items-start gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                                <ul class="list-disc list-inside text-sm space-y-1">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    {{-- Name & Email --}}
                    <div class="grid md:grid-cols-2 gap-5">
                        <div>
                            <label class="flex items-center gap-2 text-sm font-semibold text-slate-700 mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                Nom complet <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" name="name" required value="{{ old('name', $user->name) }}"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition">
                        </div>

                        <div>
                            <label class="flex items-center gap-2 text-sm font-semibold text-slate-700 mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                                Email <span class="text-rose-500">*</span>
                            </label>
                            <input type="email" name="email" required value="{{ old('email', $user->email) }}"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition">
                        </div>
                    </div>

                    {{-- Password --}}
                    <div class="p-5 rounded-2xl bg-amber-50/50 border border-amber-100">
                        <label class="flex items-center gap-2 text-sm font-semibold text-slate-700 mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-amber-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                            Nouveau mot de passe
                        </label>
                        <input type="password" name="password"
                            class="w-full px-4 py-3 rounded-xl border border-amber-200 bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition"
                            placeholder="Laisser vide pour conserver l'actuel">
                        <p class="mt-2 text-xs text-amber-700 flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                            Laissez vide si vous ne souhaitez pas changer le mot de passe
                        </p>
                    </div>

                    {{-- Role --}}
                    <div>
                        <label class="flex items-center gap-2 text-sm font-semibold text-slate-700 mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                            Rôle <span class="text-rose-500">*</span>
                        </label>
                        <div class="grid md:grid-cols-3 gap-3">
                            @foreach($roles as $role)
                                <label class="relative cursor-pointer">
                                    <input type="radio" name="role" value="{{ $role->name }}" class="peer sr-only"
                                        {{ $user->hasRole($role->name) ? 'checked' : '' }}>
                                    <div class="p-4 rounded-2xl border-2 border-slate-200 peer-checked:border-indigo-500 peer-checked:bg-indigo-50 transition">
                                        <div class="flex items-center gap-3">
                                            @if($role->name == 'Admin')
                                                <div class="p-2 bg-rose-100 rounded-xl">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-rose-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                                                </div>
                                            @elseif($role->name == 'Manager')
                                                <div class="p-2 bg-blue-100 rounded-xl">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                                                </div>
                                            @else
                                                <div class="p-2 bg-emerald-100 rounded-xl">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-emerald-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                                </div>
                                            @endif
                                            <span class="font-semibold text-slate-900">{{ $role->name }}</span>
                                        </div>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="flex items-center justify-between pt-6 border-t border-slate-100">
                        <form action="{{ route('users.destroy', $user) }}" method="POST"
                            onsubmit="return confirm('⚠️ Êtes-vous sûr de vouloir supprimer définitivement cet utilisateur ? Cette action est irréversible.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-2xl bg-rose-50 hover:bg-rose-100 text-rose-700 font-semibold transition border border-rose-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 6h18"></path>
                                    <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                                    <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                                </svg>
                                Supprimer
                            </button>
                        </form>

                        <div class="flex items-center gap-3">
                            <a href="{{ route('users.index') }}"
                                class="px-6 py-3 rounded-2xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold transition">
                                Annuler
                            </a>
                            <button type="submit"
                                class="inline-flex items-center gap-2 px-6 py-3 rounded-2xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold shadow-lg shadow-indigo-600/20 transition hover:scale-105">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                                    <polyline points="17 21 17 13 7 13 7 21"></polyline>
                                </svg>
                                Enregistrer
                            </button>
                        </div>
                    </div>

                </form>
            </div>

        </div>
    </div>

</x-app-layout>