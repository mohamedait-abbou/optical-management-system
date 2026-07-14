<x-guest-layout>
    <div class="space-y-8">
        <div class="space-y-3 text-center">
            <p class="text-sm uppercase tracking-[0.35em] text-cyan-300">Créer un compte</p>
            <h1 class="text-3xl font-semibold text-white">Rejoignez ClairVue Optique</h1>
            <p class="mx-auto max-w-lg text-sm leading-6 text-slate-300">Inscrivez-vous pour piloter votre magasin optique avec une expérience premium, du client à l’inventaire.</p>
        </div>

        <div class="relative overflow-hidden rounded-[2rem] border border-white/10 bg-gradient-to-br from-slate-950/95 via-slate-900/80 to-violet-950/95 p-8 shadow-2xl shadow-slate-950/50 backdrop-blur-xl">
            <div class="absolute -left-10 top-10 h-36 w-36 rounded-full bg-cyan-400/10 blur-3xl"></div>
            <div class="absolute right-8 bottom-10 h-28 w-28 rounded-full bg-fuchsia-500/10 blur-3xl"></div>

            <div class="relative z-10 mb-8 rounded-3xl bg-slate-950/80 p-6 text-center text-slate-100 shadow-inner shadow-slate-950/20">
                <p class="text-sm uppercase tracking-[0.28em] text-cyan-200">Inscription optique</p>
                <h2 class="mt-3 text-2xl font-semibold text-white">Lancez votre expérience</h2>
                <p class="mt-2 text-sm text-slate-300">Gérez clients, commandes et ordonnances dans un univers de visual design.</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <div>
                    <x-input-label for="name" :value="__('Nom complet')" class="text-slate-200" />
                    <x-text-input id="name" class="mt-2 block w-full rounded-3xl border border-slate-700 bg-slate-900 px-4 py-3 text-white shadow-sm shadow-cyan-500/5 focus:border-cyan-400 focus:ring-cyan-400" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm text-rose-400" />
                </div>

                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-slate-200" />
                    <x-text-input id="email" class="mt-2 block w-full rounded-3xl border border-slate-700 bg-slate-900 px-4 py-3 text-white shadow-sm shadow-cyan-500/5 focus:border-cyan-400 focus:ring-cyan-400" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-rose-400" />
                </div>

                <div class="grid gap-6 sm:grid-cols-2">
                    <div>
                        <x-input-label for="password" :value="__('Mot de passe')" class="text-slate-200" />
                        <x-text-input id="password" class="mt-2 block w-full rounded-3xl border border-slate-700 bg-slate-900 px-4 py-3 text-white shadow-sm shadow-cyan-500/5 focus:border-cyan-400 focus:ring-cyan-400" type="password" name="password" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-rose-400" />
                    </div>

                    <div>
                        <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" class="text-slate-200" />
                        <x-text-input id="password_confirmation" class="mt-2 block w-full rounded-3xl border border-slate-700 bg-slate-900 px-4 py-3 text-white shadow-sm shadow-cyan-500/5 focus:border-cyan-400 focus:ring-cyan-400" type="password" name="password_confirmation" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-rose-400" />
                    </div>
                </div>

                <div class="pt-4">
                    <x-primary-button class="w-full rounded-3xl bg-gradient-to-r from-cyan-400 to-blue-500 px-4 py-3 font-semibold text-slate-950 shadow-lg shadow-cyan-500/20 hover:from-cyan-300 hover:to-blue-400">S’inscrire</x-primary-button>
                </div>
            </form>
        </div>

        <p class="text-center text-sm text-slate-400">Déjà inscrit ? <a href="{{ route('login') }}" class="font-semibold text-cyan-300 hover:text-cyan-200">Se connecter</a></p>
    </div>
</x-guest-layout>
