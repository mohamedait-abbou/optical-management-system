<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Optical CRM') }} - Authentification</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        /* Animation des blobs */
        @keyframes float {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
        }
        
        @keyframes float-reverse {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(-30px, 50px) scale(1.1); }
            66% { transform: translate(20px, -20px) scale(0.9); }
        }
        
        @keyframes pulse-glow {
            0%, 100% { opacity: 0.4; filter: blur(80px); }
            50% { opacity: 0.6; filter: blur(100px); }
        }
        
        @keyframes gradient-shift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        @keyframes shimmer {
            0% { background-position: -1000px 0; }
            100% { background-position: 1000px 0; }
        }
        
        .animate-float { animation: float 20s ease-in-out infinite; }
        .animate-float-reverse { animation: float-reverse 25s ease-in-out infinite; }
        .animate-pulse-glow { animation: pulse-glow 8s ease-in-out infinite; }
        
        .gradient-animated {
            background: linear-gradient(-45deg, #0e7490, #1e1b4b, #4c1d95, #0f766e, #be185d);
            background-size: 400% 400%;
            animation: gradient-shift 15s ease infinite;
        }
        
        .glass-card {
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .input-glow:focus {
            box-shadow: 0 0 30px rgba(56, 189, 248, 0.3);
        }
    </style>
</head>
<!-- CORRECTION : Suppression de overflow-hidden, ajout de overflow-y-auto -->
<body class="min-h-screen gradient-animated font-sans text-white overflow-y-auto">
    
    <!-- Background Animated Blobs (FIXED pour qu'ils ne bougent pas au scroll) -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
        <!-- Blob 1 - Cyan -->
        <div class="absolute -top-40 -left-40 w-96 h-96 bg-cyan-400/30 rounded-full animate-float blur-3xl"></div>
        <!-- Blob 2 - Violet -->
        <div class="absolute top-1/3 -right-32 w-80 h-80 bg-violet-500/30 rounded-full animate-float-reverse blur-3xl"></div>
        <!-- Blob 3 - Fuchsia -->
        <div class="absolute -bottom-32 left-1/3 w-72 h-72 bg-fuchsia-500/30 rounded-full animate-float blur-3xl"></div>
        <!-- Blob 4 - Emerald -->
        <div class="absolute top-1/2 left-1/4 w-64 h-64 bg-emerald-400/20 rounded-full animate-float-reverse blur-3xl"></div>
        
        <!-- Grid Pattern Overlay -->
        <div class="absolute inset-0 bg-[linear-gradient(rgba(255,255,255,0.02)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,0.02)_1px,transparent_1px)] bg-[size:100px_100px]"></div>
        <!-- Radial Gradient Overlay -->
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_50%_50%,rgba(56,189,248,0.1),transparent_70%)]"></div>
    </div>

    <!-- Main Content (Scrollable) -->
    <div class="relative z-10 min-h-screen flex flex-col items-center justify-center px-4 py-12 sm:py-20">
        
        <!-- Logo Header -->
        <header class="mb-8 w-full max-w-4xl">
            <div class="glass-card rounded-3xl px-6 py-5 sm:px-8 sm:py-6 shadow-2xl">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div class="flex items-center gap-4">
                        <div class="relative">
                            <div class="absolute inset-0 bg-gradient-to-r from-cyan-400 to-fuchsia-500 rounded-2xl blur-lg opacity-50 animate-pulse"></div>
                            <div class="relative h-12 w-12 sm:h-14 sm:w-14 rounded-2xl bg-gradient-to-br from-cyan-400 to-fuchsia-500 flex items-center justify-center shadow-xl">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 sm:h-7 sm:w-7 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="6" cy="12" r="3"/>
                                    <circle cx="18" cy="12" r="3"/>
                                    <path d="M9 12h6"/>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <p class="text-lg font-bold bg-gradient-to-r from-cyan-300 to-fuchsia-300 bg-clip-text text-transparent">Optical CRM</p>
                            <p class="text-xs text-slate-400">Espace d'accès sécurisé</p>
                        </div>
                    </div>
                    
                    <div class="inline-flex items-center gap-3 rounded-2xl bg-slate-950/60 px-4 py-2.5 text-sm text-slate-300 shadow-inner border border-white/5">
                        <span class="relative flex h-2.5 w-2.5">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-cyan-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-gradient-to-r from-cyan-400 to-fuchsia-500"></span>
                        </span>
                        <span class="font-medium">Interface Premium</span>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Card (S'adapte au contenu et permet le scroll si nécessaire) -->
        <div class="w-full max-w-xl glass-card rounded-[2rem] sm:rounded-[2.5rem] p-6 sm:p-10 shadow-[0_0_100px_rgba(0,0,0,0.5)]">
            {{ $slot }}
        </div>

        <!-- Footer -->
        <footer class="mt-8 text-center text-sm text-slate-400/80">
            <p>© {{ date('Y') }} Optical CRM. Tous droits réservés.</p>
        </footer>
    </div>

</body>
</html>