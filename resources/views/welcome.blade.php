<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Optical CRM - La Gestion Optique Nouvelle Génération</title>
    <meta name="description" content="Plateforme de gestion complète pour opticiens - Clients, commandes, stocks et ordonnances">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(2deg); }
        }
        
        @keyframes float-delayed {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-15px) rotate(-2deg); }
        }
        
        @keyframes gradient-shift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        @keyframes pulse-glow {
            0%, 100% { opacity: 0.4; transform: scale(1); }
            50% { opacity: 0.6; transform: scale(1.1); }
        }
        
        @keyframes slide-up {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .animate-float { animation: float 6s ease-in-out infinite; }
        .animate-float-delayed { animation: float-delayed 7s ease-in-out infinite; animation-delay: 1s; }
        .animate-pulse-glow { animation: pulse-glow 8s ease-in-out infinite; }
        .animate-slide-up { animation: slide-up 0.8s ease-out forwards; }
        
        .gradient-animated {
            background: linear-gradient(-45deg, #0891b2, #1e1b4b, #6d28d9, #0d9488, #be185d, #0891b2);
            background-size: 400% 400%;
            animation: gradient-shift 15s ease infinite;
        }
        
        .glass-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }
        
        .text-gradient {
            background: linear-gradient(135deg, #22d3ee 0%, #a78bfa 50%, #f472b6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>
<body class="gradient-animated min-h-screen overflow-x-hidden">
    <!-- Animated Background Blobs -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -left-40 w-96 h-96 bg-cyan-400/30 rounded-full animate-float blur-3xl"></div>
        <div class="absolute top-1/3 -right-32 w-80 h-80 bg-violet-500/30 rounded-full animate-float-delayed blur-3xl"></div>
        <div class="absolute -bottom-32 left-1/3 w-72 h-72 bg-fuchsia-500/30 rounded-full animate-float blur-3xl"></div>
        <div class="absolute top-1/2 left-1/4 w-64 h-64 bg-emerald-400/20 rounded-full animate-float-delayed blur-3xl"></div>
        <div class="absolute inset-0 bg-[linear-gradient(rgba(255,255,255,0.02)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,0.02)_1px,transparent_1px)] bg-[size:100px_100px]"></div>
    </div>

    <!-- Navigation -->
    <nav class="relative z-50 px-6 py-6">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-cyan-400 to-fuchsia-500 rounded-2xl blur-lg opacity-50 animate-pulse"></div>
                    <div class="relative h-12 w-12 rounded-2xl bg-gradient-to-br from-cyan-400 to-fuchsia-500 flex items-center justify-center shadow-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="6" cy="12" r="3"/>
                            <circle cx="18" cy="12" r="3"/>
                            <path d="M9 12h6"/>
                        </svg>
                    </div>
                </div>
                <span class="text-xl font-bold text-white">Optical CRM</span>
            </div>
            
            <div class="flex items-center gap-4">
                @if (Route::has('login'))
                    <a href="{{ route('login') }}" class="hidden sm:inline-flex px-6 py-2.5 text-white font-medium hover:text-cyan-300 transition-colors">
                        Connexion
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="inline-flex px-6 py-2.5 rounded-full bg-gradient-to-r from-cyan-500 to-fuchsia-500 text-white font-semibold shadow-lg shadow-cyan-500/25 hover:shadow-cyan-500/40 transition-all hover:scale-105">
                            Essai gratuit
                        </a>
                    @endif
                @endif
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <main class="relative z-10 px-6 py-20">
        <div class="max-w-7xl mx-auto">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                
                <!-- Left Content -->
                <div class="space-y-8 animate-slide-up">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 border border-white/20 backdrop-blur-sm">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-cyan-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-cyan-400"></span>
                        </span>
                        <span class="text-sm text-cyan-200 font-medium">Nouvelle version disponible</span>
                    </div>
                    
                    <h1 class="text-5xl sm:text-6xl lg:text-7xl font-bold text-white leading-tight">
                        La gestion optique <br/>
                        <span class="text-gradient">réinventée</span>
                    </h1>
                    
                    <p class="text-xl text-slate-300 leading-relaxed max-w-2xl">
                        Une plateforme tout-en-un pour gérer votre magasin d'optique. 
                        Clients, commandes, stocks et ordonnances simplifiés.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center gap-2 px-8 py-4 rounded-2xl bg-gradient-to-r from-cyan-500 via-blue-500 to-fuchsia-500 text-white font-bold text-lg shadow-2xl shadow-cyan-500/30 hover:shadow-cyan-500/50 transition-all hover:scale-105 group">
                            Commencer gratuitement
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform group-hover:translate-x-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M5 12h14"/>
                                <path d="m12 5 7 7-7 7"/>
                            </svg>
                        </a>
                        <a href="#features" class="inline-flex items-center justify-center gap-2 px-8 py-4 rounded-2xl glass-card text-white font-semibold text-lg hover:bg-white/10 transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polygon points="5 3 19 12 5 21 5 3"/>
                            </svg>
                            Voir la démo
                        </a>
                    </div>
                    
                    <div class="flex items-center gap-6 pt-4">
                        <div class="flex -space-x-3">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-cyan-400 to-blue-500 border-2 border-slate-900"></div>
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-fuchsia-400 to-pink-500 border-2 border-slate-900"></div>
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-emerald-400 to-teal-500 border-2 border-slate-900"></div>
                            <div class="w-10 h-10 rounded-full bg-slate-700 border-2 border-slate-900 flex items-center justify-center text-xs font-bold text-white">+99</div>
                        </div>
                        <div class="text-slate-300">
                            <p class="text-white font-semibold">Rejoint par 100+ opticiens</p>
                            <p class="text-sm">Cette semaine</p>
                        </div>
                    </div>
                </div>

                <!-- Right Content - Visual -->
                <div class="relative animate-slide-up" style="animation-delay: 0.2s;">
                    <div class="relative">
                        <!-- Main Dashboard Preview -->
                        <div class="glass-card rounded-3xl p-6 shadow-2xl">
                            <div class="flex items-center gap-2 mb-6">
                                <div class="w-3 h-3 rounded-full bg-red-500"></div>
                                <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                                <div class="w-3 h-3 rounded-full bg-green-500"></div>
                            </div>
                            
                            <!-- Mock Interface -->
                            <div class="space-y-4">
                                <div class="flex gap-4">
                                    <div class="flex-1 h-24 rounded-2xl bg-gradient-to-br from-cyan-500/20 to-blue-500/20 border border-cyan-500/20 p-4">
                                        <div class="h-2 w-16 bg-cyan-400/40 rounded mb-2"></div>
                                        <div class="h-6 w-24 bg-white/60 rounded"></div>
                                    </div>
                                    <div class="flex-1 h-24 rounded-2xl bg-gradient-to-br from-fuchsia-500/20 to-pink-500/20 border border-fuchsia-500/20 p-4">
                                        <div class="h-2 w-16 bg-fuchsia-400/40 rounded mb-2"></div>
                                        <div class="h-6 w-24 bg-white/60 rounded"></div>
                                    </div>
                                </div>
                                <div class="h-32 rounded-2xl bg-slate-800/50 border border-white/10 p-4">
                                    <div class="flex items-end justify-between h-full gap-2">
                                        <div class="flex-1 bg-gradient-to-t from-cyan-500/40 to-cyan-400/20 rounded-t-lg" style="height: 60%"></div>
                                        <div class="flex-1 bg-gradient-to-t from-fuchsia-500/40 to-fuchsia-400/20 rounded-t-lg" style="height: 80%"></div>
                                        <div class="flex-1 bg-gradient-to-t from-blue-500/40 to-blue-400/20 rounded-t-lg" style="height: 45%"></div>
                                        <div class="flex-1 bg-gradient-to-t from-emerald-500/40 to-emerald-400/20 rounded-t-lg" style="height: 90%"></div>
                                        <div class="flex-1 bg-gradient-to-t from-violet-500/40 to-violet-400/20 rounded-t-lg" style="height: 70%"></div>
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <div class="h-12 rounded-xl bg-slate-800/50 border border-white/10 flex items-center px-4 gap-3">
                                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-cyan-400 to-blue-500"></div>
                                        <div class="flex-1 h-2 bg-white/20 rounded"></div>
                                    </div>
                                    <div class="h-12 rounded-xl bg-slate-800/50 border border-white/10 flex items-center px-4 gap-3">
                                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-fuchsia-400 to-pink-500"></div>
                                        <div class="flex-1 h-2 bg-white/20 rounded"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Floating Elements -->
                        <div class="absolute -top-8 -right-8 glass-card rounded-2xl p-4 shadow-xl animate-float">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-emerald-500/20 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-slate-400">Commande validée</p>
                                    <p class="text-sm font-bold text-white">+2 450 DH</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="absolute -bottom-6 -left-6 glass-card rounded-2xl p-4 shadow-xl animate-float-delayed">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-cyan-500/20 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-slate-400">Nouveau client</p>
                                    <p class="text-sm font-bold text-white">Inscrit</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <section id="features" class="max-w-7xl mx-auto mt-32">
            <div class="text-center mb-16">
                <p class="text-cyan-300 font-semibold uppercase tracking-wider text-sm mb-3">Fonctionnalités</p>
                <h2 class="text-4xl sm:text-5xl font-bold text-white mb-6">
                    Tout ce dont vous avez <span class="text-gradient">besoin</span>
                </h2>
                <p class="text-xl text-slate-300 max-w-3xl mx-auto">
                    Une suite complète d'outils pour optimiser la gestion de votre magasin d'optique
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="feature-card glass-card rounded-3xl p-8 transition-all duration-300">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-cyan-400 to-blue-500 flex items-center justify-center mb-6 shadow-lg shadow-cyan-500/20">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M23 21v-2a4 4 0 00-3-3.87"/>
                            <path d="M16 3.13a4 4 0 010 7.75"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Gestion Clients</h3>
                    <p class="text-slate-400 leading-relaxed">Fiches patients complètes avec historique, ordonnances et préférences de montures.</p>
                </div>

                <!-- Feature 2 -->
                <div class="feature-card glass-card rounded-3xl p-8 transition-all duration-300">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-fuchsia-400 to-pink-500 flex items-center justify-center mb-6 shadow-lg shadow-fuchsia-500/20">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Commandes</h3>
                    <p class="text-slate-400 leading-relaxed">Suivi complet des commandes, de la prise de commande à la livraison.</p>
                </div>

                <!-- Feature 3 -->
                <div class="feature-card glass-card rounded-3xl p-8 transition-all duration-300">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-400 to-teal-500 flex items-center justify-center mb-6 shadow-lg shadow-emerald-500/20">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Stock Intelligent</h3>
                    <p class="text-slate-400 leading-relaxed">Gestion des stocks en temps réel avec alertes automatiques de réapprovisionnement.</p>
                </div>

                <!-- Feature 4 -->
                <div class="feature-card glass-card rounded-3xl p-8 transition-all duration-300">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-amber-400 to-orange-500 flex items-center justify-center mb-6 shadow-lg shadow-amber-500/20">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Rendez-vous</h3>
                    <p class="text-slate-400 leading-relaxed">Calendrier intégré pour gérer les rendez-vous et envoyer des rappels automatiques.</p>
                </div>

                <!-- Feature 5 -->
                <div class="feature-card glass-card rounded-3xl p-8 transition-all duration-300">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-violet-400 to-purple-500 flex items-center justify-center mb-6 shadow-lg shadow-violet-500/20">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Ordonnances</h3>
                    <p class="text-slate-400 leading-relaxed">Numérisation et stockage sécurisé des ordonnances avec historique complet.</p>
                </div>

                <!-- Feature 6 -->
                <div class="feature-card glass-card rounded-3xl p-8 transition-all duration-300">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-rose-400 to-red-500 flex items-center justify-center mb-6 shadow-lg shadow-rose-500/20">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Rapports</h3>
                    <p class="text-slate-400 leading-relaxed">Tableaux de bord analytiques pour suivre vos performances et prendre les bonnes décisions.</p>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="max-w-5xl mx-auto mt-32 mb-20">
            <div class="relative glass-card rounded-[2.5rem] p-12 text-center overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-r from-cyan-500/10 via-fuchsia-500/10 to-blue-500/10"></div>
                <div class="absolute -top-24 -right-24 w-64 h-64 bg-cyan-400/20 rounded-full blur-3xl animate-pulse-glow"></div>
                <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-fuchsia-400/20 rounded-full blur-3xl animate-pulse-glow" style="animation-delay: 2s;"></div>
                
                <div class="relative z-10">
                    <h2 class="text-4xl sm:text-5xl font-bold text-white mb-6">
                        Prêt à transformer votre <span class="text-gradient">magasin</span> ?
                    </h2>
                    <p class="text-xl text-slate-300 mb-10 max-w-2xl mx-auto">
                        Rejoignez des centaines d'opticiens qui ont déjà adopté Optical CRM pour gérer leur activité.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center gap-2 px-10 py-5 rounded-2xl bg-gradient-to-r from-cyan-500 via-blue-500 to-fuchsia-500 text-white font-bold text-lg shadow-2xl shadow-cyan-500/30 hover:shadow-cyan-500/50 transition-all hover:scale-105">
                            Commencer gratuitement
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M5 12h14"/>
                                <path d="m12 5 7 7-7 7"/>
                            </svg>
                        </a>
                        <a href="{{ route('login') }}" class="inline-flex items-center justify-center gap-2 px-10 py-5 rounded-2xl glass-card text-white font-bold text-lg hover:bg-white/10 transition-all">
                            Se connecter
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="border-t border-white/10 pt-12 pb-8">
            <div class="max-w-7xl mx-auto px-6">
                <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                    <div class="flex items-center gap-3">
                        <div class="h-10 w-10 rounded-xl bg-gradient-to-br from-cyan-400 to-fuchsia-500 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="6" cy="12" r="3"/>
                                <circle cx="18" cy="12" r="3"/>
                                <path d="M9 12h6"/>
                            </svg>
                        </div>
                        <span class="text-lg font-bold text-white">Optical CRM</span>
                    </div>
                    <p class="text-slate-400 text-sm">© {{ date('Y') }} Optical CRM. Tous droits réservés.</p>
                </div>
            </div>
        </footer>
    </main>

    <script>
        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });
    </script>
</body>
</html>