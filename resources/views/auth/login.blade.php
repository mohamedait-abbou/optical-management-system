<x-guest-layout>
    <div class="space-y-8">
        <!-- Header -->
        <div class="space-y-3 text-center">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-cyan-500/10 border border-cyan-500/20">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-cyan-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-cyan-500"></span>
                </span>
                <p class="text-xs font-semibold uppercase tracking-[0.3em] text-cyan-300">Connexion</p>
            </div>
            <h1 class="text-4xl font-bold bg-gradient-to-r from-white via-cyan-200 to-fuchsia-200 bg-clip-text text-transparent">Espace Opticien</h1>
            <p class="mx-auto max-w-lg text-sm leading-6 text-slate-400">Accédez à votre tableau de bord et gérez votre magasin optique en toute simplicité.</p>
        </div>

        <!-- Main Card -->
        <div class="relative overflow-hidden rounded-[2rem] border border-white/10 bg-gradient-to-br from-slate-900/90 via-slate-800/80 to-indigo-950/90 p-8 shadow-2xl backdrop-blur-xl">
            <!-- Animated Glow Effects -->
            <div class="absolute -right-20 -top-20 h-64 w-64 rounded-full bg-gradient-to-r from-cyan-500/20 to-blue-500/20 animate-pulse-glow"></div>
            <div class="absolute -left-16 bottom-0 h-48 w-48 rounded-full bg-gradient-to-r from-fuchsia-500/20 to-purple-500/20 animate-pulse-glow" style="animation-delay: 2s;"></div>
            
            <!-- Shimmer Effect -->
            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/5 to-transparent -skew-x-12 animate-[shimmer_3s_infinite]"></div>

            <!-- Welcome Box -->
            <div class="relative z-10 mb-8 rounded-3xl bg-gradient-to-br from-slate-950/80 to-slate-900/80 p-6 text-center border border-white/10 shadow-inner">
                <div class="inline-flex h-16 w-16 rounded-2xl bg-gradient-to-br from-cyan-400 to-fuchsia-500 items-center justify-center mb-4 shadow-lg shadow-cyan-500/20">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                        <circle cx="12" cy="7" r="4"/>
                    </svg>
                </div>
                <p class="text-sm uppercase tracking-[0.28em] text-cyan-300 font-semibold">Bienvenue</p>
                <h2 class="mt-2 text-xl font-semibold text-white">Connectez-vous</h2>
                <p class="mt-2 text-sm text-slate-400">Gérez clients, stocks et commandes en un clic</p>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-6 relative z-10">
                @csrf

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
                        <x-text-input id="email" class="block w-full rounded-2xl border border-slate-700 bg-slate-950/50 pl-11 pr-4 py-3.5 text-white placeholder-slate-500 transition-all duration-300 focus:border-cyan-400 focus:ring-2 focus:ring-cyan-400/20 input-glow" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="votre@email.com" />
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-rose-400" />
                </div>

                <!-- Password Field -->
                <div class="group">
                    <x-input-label for="password" :value="__('Mot de passe')" class="text-slate-300 text-sm font-semibold mb-2 block" />
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-500 group-focus-within:text-fuchsia-400 transition-colors" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect width="18" height="11" x="3" y="11" rx="2" ry="2"/>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                            </svg>
                        </div>
                        <x-text-input id="password" class="block w-full rounded-2xl border border-slate-700 bg-slate-950/50 pl-11 pr-4 py-3.5 text-white placeholder-slate-500 transition-all duration-300 focus:border-fuchsia-400 focus:ring-2 focus:ring-fuchsia-400/20 input-glow" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-rose-400" />
                </div>

                <!-- Remember & Forgot -->
                <div class="flex items-center justify-between gap-3 text-sm">
                    <label class="inline-flex items-center gap-2 cursor-pointer group">
                        <div class="relative">
                            <input id="remember_me" type="checkbox" class="peer sr-only" name="remember">
                            <div class="w-5 h-5 border-2 border-slate-600 rounded peer-checked:bg-gradient-to-r peer-checked:from-cyan-400 peer-checked:to-fuchsia-500 peer-checked:border-transparent transition-all"></div>
                            <svg class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-3.5 h-3.5 text-white opacity-0 peer-checked:opacity-100 transition-opacity" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                                <polyline points="20 6 9 17 4 12"/>
                            </svg>
                        </div>
                        <span class="text-slate-400 group-hover:text-slate-300 transition-colors">Se souvenir de moi</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a class="text-cyan-400 hover:text-cyan-300 font-medium transition-colors hover:underline" href="{{ route('password.request') }}">Mot de passe oublié ?</a>
                    @endif
                </div>

                <!-- Submit Button -->
                <div class="pt-4">
                    <button type="submit" class="group relative w-full overflow-hidden rounded-2xl bg-gradient-to-r from-cyan-500 via-blue-500 to-fuchsia-500 px-4 py-4 font-bold text-white shadow-lg shadow-cyan-500/25 transition-all duration-300 hover:shadow-cyan-500/40 hover:scale-[1.02] active:scale-[0.98]">
                        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-700"></div>
                        <span class="relative flex items-center justify-center gap-2">
                            Se connecter
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform group-hover:translate-x-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M5 12h14"/>
                                <path d="m12 5 7 7-7 7"/>
                            </svg>
                        </span>
                    </button>
                </div>
            </form>

            <!-- Divider -->
            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-white/10"></div>
                </div>
                <div class="relative flex justify-center text-xs uppercase">
                    <span class="bg-slate-900/50 px-2 text-slate-500 rounded-full">Ou continuer avec</span>
                </div>
            </div>

            <!-- Social Login (Optional) -->
            <div class="grid grid-cols-2 gap-3">
                <button class="flex items-center justify-center gap-2 rounded-xl border border-white/10 bg-slate-950/50 py-3 text-sm font-medium text-slate-300 transition-all hover:bg-white/5 hover:border-white/20">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                        <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                        <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                        <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                    </svg>
                    Google
                </button>
                <button class="flex items-center justify-center gap-2 rounded-xl border border-white/10 bg-slate-950/50 py-3 text-sm font-medium text-slate-300 transition-all hover:bg-white/5 hover:border-white/20">
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.24-.604-1.024-3.046.221-6.294 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23 1.246 3.249.462 5.691.223 6.294.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                    </svg>
                    GitHub
                </button>
            </div>
        </div>

        <!-- Register Link -->
        <p class="text-center text-sm text-slate-400">
            Pas encore de compte ? 
            <a href="{{ route('register') }}" class="font-semibold bg-gradient-to-r from-cyan-400 to-fuchsia-400 bg-clip-text text-transparent hover:from-cyan-300 hover:to-fuchsia-300 transition-all">
                Créer un compte →
            </a>
        </p>
    </div>
</x-guest-layout>