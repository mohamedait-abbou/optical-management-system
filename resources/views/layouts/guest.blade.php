<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'ClairVue Optique') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-slate-950 text-white">
        <div class="relative overflow-hidden">
            <div class="pointer-events-none absolute -left-16 top-6 h-36 w-36 rounded-full bg-cyan-400/20 blur-3xl"></div>
            <div class="pointer-events-none absolute right-0 top-32 h-24 w-24 rounded-full bg-violet-500/15 blur-3xl"></div>
            <div class="pointer-events-none absolute inset-x-0 bottom-0 h-48 bg-[radial-gradient(circle_at_center,_rgba(56,189,248,0.18),_transparent_60%)]"></div>
            <div class="relative flex min-h-screen flex-col items-center justify-center px-6 py-10">
                <header class="mb-8 w-full max-w-3xl rounded-3xl border border-white/10 bg-slate-900/90 px-6 py-5 shadow-2xl shadow-slate-950/30 backdrop-blur-xl">
                    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm uppercase tracking-[0.32em] text-cyan-300">ClairVue Optique</p>
                            <p class="mt-2 text-xl font-semibold text-white">Espace d’accès sécurisé</p>
                        </div>
                        <div class="inline-flex items-center gap-2 rounded-3xl bg-slate-950/70 px-4 py-2 text-sm text-slate-300 shadow-inner shadow-slate-950/20">
                            <span class="inline-flex h-2.5 w-2.5 rounded-full bg-cyan-400"></span>
                              Identité visuelle premium 
                        </div>
                    </div>
                </header>
                <div class="w-full max-w-xl rounded-[2rem] border border-white/10 bg-slate-900/95 p-8 shadow-2xl shadow-slate-950/40 backdrop-blur-xl">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
