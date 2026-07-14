@extends('layouts.crm')

@section('page-title', 'My Profile')

@section('content')

<div class="space-y-8">

    <!-- ========================================== -->
    <!-- PROFILE HEADER -->
    <!-- ========================================== -->
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-indigo-600 via-blue-600 to-cyan-500 p-8 md:p-10 text-white shadow-2xl shadow-indigo-900/20">
        <!-- Decorative Background Elements -->
        <div class="absolute -top-24 -left-24 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
        <div class="absolute top-40 right-0 w-96 h-96 bg-cyan-300/20 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-1/3 w-72 h-72 bg-purple-500/20 rounded-full blur-3xl"></div>

        <div class="relative flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
            <div class="flex items-center gap-6">
                <!-- Avatar -->
                <div class="w-24 h-24 md:w-28 md:h-28 rounded-full bg-white/20 backdrop-blur-xl border-4 border-white/30 flex items-center justify-center text-4xl md:text-5xl font-bold text-white shadow-xl">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>

                <!-- User Info -->
                <div>
                    <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight">
                        {{ Auth::user()->name }}
                    </h1>
                    <p class="text-blue-100 mt-1 text-lg flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 opacity-80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                        {{ Auth::user()->email }}
                    </p>
                    
                    <div class="flex flex-wrap gap-3 mt-4">
                        <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/20 text-white backdrop-blur-md text-sm font-semibold border border-white/10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                            Administrator
                        </span>
                        <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-500/90 text-white text-sm font-semibold shadow-lg shadow-emerald-900/20">
                            <span class="relative flex h-2.5 w-2.5">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-white"></span>
                            </span>
                            Active
                        </span>
                    </div>
                </div>
            </div>

            <a href="#personal-info" class="hidden md:inline-flex items-center gap-2 px-6 py-3 rounded-2xl bg-white text-indigo-700 font-bold shadow-xl hover:shadow-2xl hover:scale-105 transition-all duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
                Edit Profile
            </a>
        </div>
    </div>

    <!-- ========================================== -->
    <!-- MAIN PROFILE LAYOUT -->
    <!-- ========================================== -->
    <div class="grid lg:grid-cols-[300px_1fr] gap-8">
        
        <!-- LEFT SIDEBAR: Navigation & Info -->
        <aside class="space-y-6">
            <!-- Navigation Menu -->
            <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-4">
                <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400 px-4 mb-3">Settings</h3>
                <nav class="space-y-1">
                    <a href="#personal-info" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-indigo-600 bg-indigo-50 transition-all duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        Personal Information
                    </a>
                    <a href="#security" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition-all duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        Security & Password
                    </a>
                    <a href="#danger-zone" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-rose-600 hover:bg-rose-50 transition-all duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                        Danger Zone
                    </a>
                </nav>
            </div>

            <!-- Account Meta Info -->
            <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-6">
                <h3 class="text-sm font-bold text-slate-900 mb-4">Account Details</h3>
                <div class="space-y-4">
                    <div class="flex items-start gap-3">
                        <div class="p-2 rounded-lg bg-slate-100 text-slate-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 font-medium">Member Since</p>
                            <p class="text-sm font-semibold text-slate-900">{{ Auth::user()->created_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="p-2 rounded-lg bg-slate-100 text-slate-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v20"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 font-medium">Current Plan</p>
                            <p class="text-sm font-semibold text-slate-900">Administrator Access</p>
                        </div>
                    </div>
                </div>
            </div>
        </aside>

        <!-- RIGHT CONTENT: Forms -->
        <main class="space-y-8">
            
            <!-- 1. Personal Information -->
            <div id="personal-info" class="bg-white rounded-3xl shadow-sm border border-slate-100 p-8 scroll-mt-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="p-2 rounded-xl bg-indigo-50 text-indigo-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-slate-900">Personal Information</h2>
                        <p class="text-sm text-slate-500">Update your account's profile information and email address.</p>
                    </div>
                </div>
                <div class="pt-4 border-t border-slate-100">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- 2. Update Password -->
            <div id="security" class="bg-white rounded-3xl shadow-sm border border-slate-100 p-8 scroll-mt-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="p-2 rounded-xl bg-emerald-50 text-emerald-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-slate-900">Update Password</h2>
                        <p class="text-sm text-slate-500">Ensure your account is using a long, random password to stay secure.</p>
                    </div>
                </div>
                <div class="pt-4 border-t border-slate-100">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- 3. Danger Zone -->
            <div id="danger-zone" class="rounded-3xl shadow-sm border-2 border-rose-100 bg-gradient-to-br from-rose-50/50 to-white p-8 scroll-mt-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="p-2 rounded-xl bg-rose-100 text-rose-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-rose-600">Danger Zone</h2>
                        <p class="text-sm text-rose-400/80">Once your account is deleted, all of its resources and data will be permanently deleted.</p>
                    </div>
                </div>
                <div class="pt-4 border-t border-rose-100">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </main>
    </div>
</div>

@endsection