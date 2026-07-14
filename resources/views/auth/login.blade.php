<x-guest-layout>
    <div class="space-y-8">
        <div class="space-y-3 text-center">
            <p class="text-sm uppercase tracking-[0.35em] text-cyan-300">Connexion</p>
            <h1 class="text-3xl font-semibold text-white">Espace opticien</h1>
            <p class="mx-auto max-w-lg text-sm leading-6 text-slate-300">Entrez vos identifiants et accédez à l’univers ClairVue Optique pour gérer clients, ordonnances et stock.</p>
        </div>

        <div class="relative overflow-hidden rounded-[2rem] border border-white/10 bg-gradient-to-br from-slate-950/95 via-slate-900/80 to-violet-950/95 p-8 shadow-2xl shadow-slate-950/50 backdrop-blur-xl">
            <div class="absolute -right-16 top-8 h-36 w-36 rounded-full bg-cyan-400/10 blur-3xl"></div>
            <div class="absolute left-6 bottom-8 h-28 w-28 rounded-full bg-violet-500/10 blur-3xl"></div>

            <div class="relative z-10 mb-8 rounded-3xl bg-slate-950/80 p-6 text-center text-slate-100 shadow-inner shadow-slate-950/20">
                <p class="text-sm uppercase tracking-[0.28em] text-cyan-200">Connexion premium</p>
                <h2 class="mt-3 text-2xl font-semibold text-white">Opticien connecté</h2>
                <p class="mt-2 text-sm text-slate-300">Votre boutique optique, vos indicateurs et vos commandes, en un seul espace.</p>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-slate-200" />
                    <x-text-input id="email" class="mt-2 block w-full rounded-3xl border border-slate-700 bg-slate-900 px-4 py-3 text-white shadow-sm shadow-cyan-500/5 focus:border-cyan-400 focus:ring-cyan-400" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-rose-400" />
                </div>

                <div>
                    <x-input-label for="password" :value="__('Mot de passe')" class="text-slate-200" />
                    <x-text-input id="password" class="mt-2 block w-full rounded-3xl border border-slate-700 bg-slate-900 px-4 py-3 text-white shadow-sm shadow-cyan-500/5 focus:border-cyan-400 focus:ring-cyan-400" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-rose-400" />
                </div>

                <div class="flex items-center justify-between gap-3 text-sm text-slate-300">
                    <label class="inline-flex items-center gap-2">
                        <input id="remember_me" type="checkbox" class="rounded border-slate-700 bg-slate-900 text-cyan-400 focus:ring-cyan-400" name="remember">
                        Se souvenir de moi
                    </label>
                    @if (Route::has('password.request'))
                        <a class="text-cyan-300 hover:text-cyan-200" href="{{ route('password.request') }}">Mot de passe oublié ?</a>
                    @endif
                </div>

                <div class="pt-4">
                    <x-primary-button class="w-full rounded-3xl bg-gradient-to-r from-cyan-400 to-blue-500 px-4 py-3 font-semibold text-slate-950 shadow-lg shadow-cyan-500/20 hover:from-cyan-300 hover:to-blue-400">Se connecter</x-primary-button>
                </div>
            </form>
        </div>

        <p class="text-center text-sm text-slate-400">Pas encore de compte ? <a href="{{ route('register') }}" class="font-semibold text-cyan-300 hover:text-cyan-200">Créer un compte</a></p>
    </div>
</x-guest-layout>
