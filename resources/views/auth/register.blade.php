<x-guest-layout>
    <div class="space-y-8">
        <!-- Header -->
        <div class="space-y-3 text-center">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-fuchsia-500/10 border border-fuchsia-500/20">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-fuchsia-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-fuchsia-500"></span>
                </span>
                <p class="text-xs font-semibold uppercase tracking-[0.3em] text-fuchsia-300">Inscription</p>
            </div>
            <h1 class="text-4xl font-bold bg-gradient-to-r from-white via-fuchsia-200 to-cyan-200 bg-clip-text text-transparent">Rejoignez Optical CRM</h1>
            <p class="mx-auto max-w-lg text-sm leading-6 text-slate-400">Créez votre compte et découvrez une gestion optique nouvelle génération.</p>
        </div>

        <!-- Main Card -->
        <div class="relative overflow-hidden rounded-[2rem] border border-white/10 bg-gradient-to-br from-slate-900/90 via-slate-800/80 to-fuchsia-950/90 p-8 shadow-2xl backdrop-blur-xl">
            <!-- Animated Glow Effects -->
            <div class="absolute -left-20 -top-20 h-64 w-64 rounded-full bg-gradient-to-r from-fuchsia-500/20 to-pink-500/20 animate-pulse-glow"></div>
            <div class="absolute -right-16 bottom-0 h-48 w-48 rounded-full bg-gradient-to-r from-cyan-500/20 to-blue-500/20 animate-pulse-glow" style="animation-delay: 2s;"></div>
            
            <!-- Shimmer Effect -->
            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/5 to-transparent -skew-x-12 animate-[shimmer_3s_infinite]"></div>

            <!-- Welcome Box -->
            <div class="relative z-10 mb-8 rounded-3xl bg-gradient-to-br from-slate-950/80 to-slate-900/80 p-6 text-center border border-white/10 shadow-inner">
                <div class="inline-flex h-16 w-16 rounded-2xl bg-gradient-to-br from-fuchsia-400 to-pink-500 items-center justify-center mb-4 shadow-lg shadow-fuchsia-500/20">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                </div>
                <p class="text-sm uppercase tracking-[0.28em] text-fuchsia-300 font-semibold">Création de compte</p>
                <h2 class="mt-2 text-xl font-semibold text-white">Commencez gratuitement</h2>
                <p class="mt-2 text-sm text-slate-400">Rejoignez des centaines d'opticiens satisfaits</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-6 relative z-10">
                @csrf

                <!-- Name Field -->
                <div class="group">
                    <x-input-label for="name" :value="__('Nom complet')" class="text-slate-300 text-sm font-semibold mb-2 block" />
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-500 group-focus-within:text-fuchsia-400 transition-colors" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                <circle cx="12" cy="7" r="4"/>
                            </svg>
                        </div>
                        <x-text-input id="name" class="block w-full rounded-2xl border border-slate-700 bg-slate-950/50 pl-11 pr-4 py-3.5 text-white placeholder-slate-500 transition-all duration-300 focus:border-fuchsia-400 focus:ring-2 focus:ring-fuchsia-400/20 input-glow" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Jean Dupont" />
                    </div>
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm text-rose-400" />
                </div>

                <!-- Email Field -->
                <div class="group">
                    <x-input-label for="email" :value="__('Email')" class="text-slate-300 text-sm font-semibold mb-2 block" />
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-500 group-focus-within:text-cyan-400 transition-colors" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="2" y="4" width="20" height="16" rx="2"/>
                                <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                            </svg>
                        </div>
                        <x-text-input id="email" class="block w-full rounded-2xl border border-slate-700 bg-slate-950/50 pl-11 pr-4 py-3.5 text-white placeholder-slate-500 transition-all duration-300 focus:border-cyan-400 focus:ring-2 focus:ring-cyan-400/20 input-glow" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="votre@email.com" />
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-rose-400" />
                </div>

                <!-- Password Fields Grid -->
                <div class="grid gap-6 sm:grid-cols-2">
                    <div class="group">
                        <x-input-label for="password" :value="__('Mot de passe')" class="text-slate-300 text-sm font-semibold mb-2 block" />
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-500 group-focus-within:text-fuchsia-400 transition-colors" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect width="18" height="11" x="3" y="11" rx="2" ry="2"/>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                                </svg>
                            </div>
                            <x-text-input id="password" class="block w-full rounded-2xl border border-slate-700 bg-slate-950/50 pl-11 pr-4 py-3.5 text-white placeholder-slate-500 transition-all duration-300 focus:border-fuchsia-400 focus:ring-2 focus:ring-fuchsia-400/20 input-glow" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-rose-400" />
                    </div>

                    <div class="group">
                        <x-input-label for="password_confirmation" :value="__('Confirmer')" class="text-slate-300 text-sm font-semibold mb-2 block" />
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-500 group-focus-within:text-cyan-400 transition-colors" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M9 12l2 2 4-4"/>
                                    <circle cx="12" cy="12" r="10"/>
                                </svg>
                            </div>
                            <x-text-input id="password_confirmation" class="block w-full rounded-2xl border border-slate-700 bg-slate-950/50 pl-11 pr-4 py-3.5 text-white placeholder-slate-500 transition-all duration-300 focus:border-cyan-400 focus:ring-2 focus:ring-cyan-400/20 input-glow" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-rose-400" />
                    </div>
                </div>

                <!-- Terms Checkbox -->
                <div class="flex items-start gap-3">
                    <label class="inline-flex items-start gap-2 cursor-pointer group">
                        <div class="relative mt-0.5">
                            <input type="checkbox" class="peer sr-only" required>
                            <div class="w-5 h-5 border-2 border-slate-600 rounded peer-checked:bg-gradient-to-r peer-checked:from-fuchsia-400 peer-checked:to-pink-500 peer-checked:border-transparent transition-all"></div>
                            <svg class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-3.5 h-3.5 text-white opacity-0 peer-checked:opacity-100 transition-opacity" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                                <polyline points="20 6 9 17 4 12"/>
                            </svg>
                        </div>
                        <span class="text-sm text-slate-400 group-hover:text-slate-300 transition-colors">
                            J'accepte les <a href="#" class="text-fuchsia-400 hover:text-fuchsia-300 underline">conditions d'utilisation</a> et la <a href="#" class="text-fuchsia-400 hover:text-fuchsia-300 underline">politique de confidentialité</a>
                        </span>
                    </label>
                </div>

                <!-- Submit Button -->
                <div class="pt-4">
                    <button type="submit" class="group relative w-full overflow-hidden rounded-2xl bg-gradient-to-r from-fuchsia-500 via-pink-500 to-rose-500 px-4 py-4 font-bold text-white shadow-lg shadow-fuchsia-500/25 transition-all duration-300 hover:shadow-fuchsia-500/40 hover:scale-[1.02] active:scale-[0.98]">
                        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-700"></div>
                        <span class="relative flex items-center justify-center gap-2">
                            Créer mon compte
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform group-hover:translate-x-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M5 12h14"/>
                                <path d="m12 5 7 7-7 7"/>
                            </svg>
                        </span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Login Link -->
        <p class="text-center text-sm text-slate-400">
            Déjà inscrit ? 
            <a href="{{ route('login') }}" class="font-semibold bg-gradient-to-r from-fuchsia-400 to-cyan-400 bg-clip-text text-transparent hover:from-fuchsia-300 hover:to-cyan-300 transition-all">
                Se connecter →
            </a>
        </p>
    </div>
</x-guest-layout>