<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClairVue Optique</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-950 text-white">
    <div class="relative overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,_rgba(56,189,248,0.22),_transparent_25%),radial-gradient(circle_at_bottom_right,_rgba(168,85,247,0.18),_transparent_20%)]"></div>
        <div class="relative mx-auto max-w-7xl px-6 py-16 sm:py-24 lg:px-8">
            <div class="grid gap-12 lg:grid-cols-[1.2fr_0.9fr] lg:items-center">
                <div class="space-y-8">
                    <div class="inline-flex items-center gap-3 rounded-full bg-white/10 px-4 py-2 text-sm text-slate-200 backdrop-blur shadow-sm shadow-slate-950/20">
                        <span class="h-2 w-2 rounded-full bg-cyan-400"></span>
                        Gestion optique nouvelle génération
                    </div>
                    <div class="space-y-6">
                        <h1 class="text-5xl font-extrabold tracking-tight text-white sm:text-6xl">
                            ClairVue Optique
                        </h1>
                        <p class="max-w-xl text-lg leading-8 text-slate-300">
                            Pilotez votre magasin avec une expérience visuelle riche : clients, prescriptions, commandes et stock sous contrôle, dans un design premium.
                        </p>
                    </div>
                    <div class="grid gap-4 sm:grid-cols-2 sm:max-w-md">
                        <a href="{{ route('login') }}" class="inline-flex items-center justify-center rounded-3xl bg-gradient-to-r from-cyan-400 to-blue-500 px-6 py-3 text-base font-semibold text-slate-950 shadow-xl shadow-cyan-500/20 transition hover:from-cyan-300 hover:to-blue-400">
                            Connexion
                        </a>
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-3xl border border-white/20 bg-white/5 px-6 py-3 text-base font-semibold text-white transition hover:bg-white/10">
                            Créer un compte
                        </a>
                    </div>
                    <div class="grid gap-4 sm:grid-cols-3">
                        <div class="rounded-3xl bg-white/5 p-5 text-sm text-slate-200 shadow-2xl shadow-slate-950/20 backdrop-blur">
                            <p class="font-semibold">Clients</p>
                            <p class="mt-2 text-slate-300">Dossiers en un coup d'œil.</p>
                        </div>
                        <div class="rounded-3xl bg-white/5 p-5 text-sm text-slate-200 shadow-2xl shadow-slate-950/20 backdrop-blur">
                            <p class="font-semibold">Prescriptions</p>
                            <p class="mt-2 text-slate-300">Ordonnances numériques instantanées.</p>
                        </div>
                        <div class="rounded-3xl bg-white/5 p-5 text-sm text-slate-200 shadow-2xl shadow-slate-950/20 backdrop-blur">
                            <p class="font-semibold">Stock</p>
                            <p class="mt-2 text-slate-300">Alertes automatiques et suivi malin.</p>
                        </div>
                    </div>
                </div>
                <div class="relative overflow-hidden rounded-[2.5rem] border border-white/10 bg-gradient-to-br from-slate-900/90 via-slate-950/80 to-violet-950/90 p-8 shadow-2xl shadow-slate-950/40 backdrop-blur-xl">
                    <div class="pointer-events-none absolute -top-10 -right-10 h-40 w-40 rounded-full bg-cyan-400/10 blur-3xl"></div>
                    <div class="pointer-events-none absolute -bottom-10 -left-10 h-44 w-44 rounded-full bg-violet-500/10 blur-3xl"></div>
                    <div class="relative z-10">
                        <div class="flex items-center justify-between gap-4 rounded-3xl bg-slate-950/95 p-4 shadow-inner shadow-slate-950/20">
                            <div>
                                <p class="text-xs uppercase tracking-[0.3em] text-slate-500">Vision optique</p>
                                <p class="mt-2 text-xl font-semibold text-white">Interface immersive</p>
                            </div>
                            <span class="inline-flex rounded-2xl bg-cyan-400 px-3 py-2 text-sm font-semibold text-slate-950">ClairVue</span>
                        </div>
                        <div class="mt-8 grid gap-4">
                            <div class="rounded-3xl bg-slate-950/80 p-6 shadow-lg shadow-cyan-500/10">
                                <div class="flex items-center gap-4">
                                    <div class="inline-flex h-12 w-12 items-center justify-center rounded-3xl bg-cyan-400/15 text-cyan-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M4 12c0-3.314 4-8 8-8s8 4.686 8 8-4 8-8 8-8-4.686-8-8z" />
                                            <circle cx="12" cy="12" r="3" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm uppercase tracking-[0.24em] text-cyan-200">Vision 360°</p>
                                        <p class="mt-2 text-xl font-semibold text-white">Analyse des ventes</p>
                                    </div>
                                </div>
                                <p class="mt-4 text-sm text-slate-400">Affichez les tendances et adaptez vos offres en temps réel.</p>
                            </div>
                            <div class="grid gap-4 sm:grid-cols-2">
                                <div class="rounded-3xl bg-slate-950/80 p-5 text-slate-300 shadow-lg shadow-slate-950/10">
                                    <p class="text-xs uppercase tracking-[0.24em] text-cyan-200">Performance</p>
                                    <p class="mt-3 text-2xl font-semibold text-white">+18%</p>
                                </div>
                                <div class="rounded-3xl bg-slate-950/80 p-5 text-slate-300 shadow-lg shadow-slate-950/10">
                                    <p class="text-xs uppercase tracking-[0.24em] text-violet-300">Stock</p>
                                    <p class="mt-3 text-2xl font-semibold text-white">OK</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>