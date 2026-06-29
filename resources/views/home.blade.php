@extends('layouts.app')

@section('title', 'Beranda — Data Pemain Olahraga')

@section('content')

    {{-- Hero Section --}}
    <section class="relative py-20 lg:py-28 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center animate-fade-in-up">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 text-sm font-medium mb-6">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    Database Pemain Olahraga
                </div>
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black tracking-tight">
                    <span class="text-white">Eksplorasi Data</span><br>
                    <span class="gradient-text">Pemain Olahraga</span>
                </h1>
                <p class="mt-6 text-lg text-slate-400 max-w-2xl mx-auto leading-relaxed">
                    Platform informasi lengkap untuk melihat profil pemain olahraga dari berbagai cabang dan klub terkemuka.
                </p>
            </div>

            {{-- Stats Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-14 max-w-3xl mx-auto">
                <div class="glass-card rounded-2xl p-6 text-center animate-fade-in-up delay-100">
                    <div class="w-12 h-12 mx-auto rounded-xl bg-gradient-to-br from-indigo-500/20 to-indigo-600/20 flex items-center justify-center mb-3">
                        <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <p class="text-3xl font-bold text-white">{{ $totalPemain }}</p>
                    <p class="text-sm text-slate-400 mt-1">Total Pemain</p>
                </div>
                <div class="glass-card rounded-2xl p-6 text-center animate-fade-in-up delay-200">
                    <div class="w-12 h-12 mx-auto rounded-xl bg-gradient-to-br from-purple-500/20 to-purple-600/20 flex items-center justify-center mb-3">
                        <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                        </svg>
                    </div>
                    <p class="text-3xl font-bold text-white">{{ $totalCabang }}</p>
                    <p class="text-sm text-slate-400 mt-1">Cabang Olahraga</p>
                </div>
                <div class="glass-card rounded-2xl p-6 text-center animate-fade-in-up delay-300">
                    <div class="w-12 h-12 mx-auto rounded-xl bg-gradient-to-br from-pink-500/20 to-pink-600/20 flex items-center justify-center mb-3">
                        <svg class="w-6 h-6 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2z"/>
                        </svg>
                    </div>
                    <p class="text-3xl font-bold text-white">{{ $totalKlub }}</p>
                    <p class="text-sm text-slate-400 mt-1">Klub Terdaftar</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Player Cards Section --}}
    <section class="pb-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex items-center justify-between mb-10">
                <div>
                    <h2 class="text-2xl sm:text-3xl font-bold text-white">Daftar Pemain</h2>
                    <p class="text-slate-400 mt-1">Menampilkan seluruh data pemain olahraga</p>
                </div>
            </div>

            @if($pemains->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($pemains as $index => $pemain)
                        <div class="glass-card rounded-2xl overflow-hidden animate-fade-in-up" style="animation-delay: {{ ($index % 8) * 0.08 }}s">
                            {{-- Player Image --}}
                            <div class="relative h-56 overflow-hidden bg-slate-800">
                                @if($pemain->gambar)
                                    <img src="{{ asset('storage/' . $pemain->gambar) }}"
                                         alt="{{ $pemain->nama_pemain }}"
                                         class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-slate-800 to-slate-900">
                                        <svg class="w-16 h-16 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                    </div>
                                @endif
                                {{-- Sport Badge --}}
                                <div class="absolute top-3 left-3">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-indigo-600/90 text-white backdrop-blur-sm shadow-lg">
                                        {{ $pemain->cabang_olahraga }}
                                    </span>
                                </div>
                            </div>

                            {{-- Player Info --}}
                            <div class="p-5">
                                <h3 class="text-lg font-bold text-white truncate">{{ $pemain->nama_pemain }}</h3>

                                <div class="mt-3 space-y-2">
                                    <div class="flex items-center gap-2 text-sm text-slate-400">
                                        <svg class="w-4 h-4 text-purple-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2z"/>
                                        </svg>
                                        <span class="truncate">{{ $pemain->klub }}</span>
                                    </div>
                                    <div class="flex items-center gap-2 text-sm text-slate-400">
                                        <svg class="w-4 h-4 text-pink-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span>{{ $pemain->usia }} tahun</span>
                                    </div>
                                </div>

                                {{-- ID Badge & Action --}}
                                <div class="mt-4 pt-4 border-t border-white/5 flex items-center justify-between">
                                    <span class="text-xs text-slate-500 font-mono">ID #{{ str_pad($pemain->id_pemain, 4, '0', STR_PAD_LEFT) }}</span>
                                    <a href="{{ route('pemain.show', $pemain->id_pemain) }}" class="inline-flex items-center gap-1 text-xs font-semibold text-indigo-400 hover:text-indigo-300 transition-colors">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                {{-- Empty State --}}
                <div class="glass-card rounded-2xl p-16 text-center animate-fade-in">
                    <div class="w-20 h-20 mx-auto rounded-2xl bg-slate-800 flex items-center justify-center mb-6">
                        <svg class="w-10 h-10 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Belum Ada Data Pemain</h3>
                    <p class="text-slate-400 max-w-md mx-auto">Data pemain olahraga belum tersedia. Silakan login sebagai admin untuk menambahkan data.</p>
                </div>
            @endif

        </div>
    </section>

@endsection
