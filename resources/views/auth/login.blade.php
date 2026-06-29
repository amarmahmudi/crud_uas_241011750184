@extends('layouts.app')

@section('title', 'Login — Data Pemain Olahraga')

@section('content')
    <style>
        body {
            background-image: linear-gradient(rgba(15, 23, 42, 0.85), rgba(15, 23, 42, 0.85)), url("{{ asset('images/login_bg.png') }}") !important;
            background-size: cover !important;
            background-position: center !important;
            background-repeat: no-repeat !important;
            background-attachment: fixed !important;
        }
    </style>

    <section class="min-h-[calc(100vh-10rem)] flex items-center justify-center py-12 px-4">
        <div class="w-full max-w-md animate-fade-in-up">

            {{-- Login Card --}}
            <div class="glass-card rounded-2xl p-8 sm:p-10">

                {{-- Header --}}
                <div class="text-center mb-8">
                    <div class="w-16 h-16 mx-auto rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center shadow-lg shadow-indigo-500/25 mb-5 animate-float">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <h1 class="text-2xl font-bold text-white">Selamat Datang</h1>
                    <p class="text-slate-400 mt-2 text-sm">Masukkan kredensial untuk akses panel admin</p>
                </div>

                {{-- Error Messages --}}
                @if($errors->any())
                    <div class="mb-6 px-4 py-3 rounded-xl bg-red-500/10 border border-red-500/20 animate-fade-in">
                        @foreach($errors->all() as $error)
                            <div class="flex items-center gap-2 text-sm text-red-400">
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span>{{ $error }}</span>
                            </div>
                        @endforeach
                    </div>
                @endif

                {{-- Login Form --}}
                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    {{-- Username --}}
                    <div>
                        <label for="username" class="block text-sm font-medium text-slate-300 mb-2">Username</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <input type="text"
                                   id="username"
                                   name="username"
                                   value="{{ old('username') }}"
                                   placeholder="Masukkan username"
                                   required
                                   autofocus
                                   class="w-full pl-12 pr-4 py-3 rounded-xl bg-slate-800/50 border border-white/10 text-white placeholder-slate-500 focus:outline-none focus:border-indigo-500 transition-all">
                        </div>
                    </div>

                    {{-- Password --}}
                    <div>
                        <label for="password" class="block text-sm font-medium text-slate-300 mb-2">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <input type="password"
                                   id="password"
                                   name="password"
                                   placeholder="Masukkan password"
                                   required
                                   class="w-full pl-12 pr-4 py-3 rounded-xl bg-slate-800/50 border border-white/10 text-white placeholder-slate-500 focus:outline-none focus:border-indigo-500 transition-all">
                        </div>
                    </div>

                    {{-- Submit Button --}}
                    <button type="submit"
                            class="w-full py-3 px-6 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold hover:from-indigo-500 hover:to-purple-500 shadow-lg shadow-indigo-500/25 hover:shadow-indigo-500/40 transition-all transform hover:scale-[1.02] active:scale-[0.98] cursor-pointer">
                        Masuk
                    </button>
                </form>

                {{-- Back to Home --}}
                <div class="text-center mt-6">
                    <a href="{{ route('home') }}" class="text-sm text-slate-400 hover:text-indigo-400 transition-colors">
                        ← Kembali ke Beranda
                    </a>
                </div>

            </div>

        </div>
    </section>

@endsection
