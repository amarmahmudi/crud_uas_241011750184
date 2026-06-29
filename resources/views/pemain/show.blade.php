@extends('layouts.app')

@section('title', $pemain->nama_pemain . ' — Detail Pemain')

@section('content')

    <section class="py-16 px-4">
        <div class="max-w-3xl mx-auto">

            {{-- Back Button --}}
            <a href="{{ url()->previous() == url()->current() ? route('home') : url()->previous() }}" class="inline-flex items-center gap-2 text-sm text-slate-400 hover:text-indigo-400 transition-colors mb-8 animate-fade-in">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>

            {{-- Detail Card --}}
            <div class="glass-card rounded-3xl overflow-hidden animate-fade-in-up">
                <div class="flex flex-col md:flex-row">
                    
                    {{-- Player Image --}}
                    <div class="md:w-1/2 relative h-96 md:h-auto bg-slate-900 overflow-hidden">
                        @if($pemain->gambar)
                            <img src="{{ asset('storage/' . $pemain->gambar) }}"
                                 alt="{{ $pemain->nama_pemain }}"
                                 class="w-full h-full object-cover transition-transform duration-700 hover:scale-105">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-slate-800 to-slate-900">
                                <svg class="w-24 h-24 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                        @endif
                        
                        {{-- Sport Badge --}}
                        <div class="absolute top-4 left-4">
                            <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-semibold bg-indigo-600/90 text-white backdrop-blur-md shadow-lg border border-white/10">
                                {{ $pemain->cabang_olahraga }}
                            </span>
                        </div>
                    </div>

                    {{-- Player Details --}}
                    <div class="md:w-1/2 p-8 sm:p-10 flex flex-col justify-between">
                        <div>
                            {{-- ID Badge --}}
                            <span class="text-xs text-slate-500 font-mono tracking-wider uppercase">ID Pemain #{{ str_pad($pemain->id_pemain, 4, '0', STR_PAD_LEFT) }}</span>
                            
                            {{-- Name --}}
                            <h1 class="text-3xl font-extrabold text-white mt-2 leading-tight">{{ $pemain->nama_pemain }}</h1>
                            
                            <hr class="border-white/5 my-6">

                            {{-- Detailed Specs --}}
                            <div class="space-y-5">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-xl bg-purple-500/10 border border-purple-500/20 flex items-center justify-center shrink-0">
                                        <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-slate-500 font-medium">Klub / Tim</p>
                                        <p class="text-base font-semibold text-slate-200">{{ $pemain->klub }}</p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-xl bg-pink-500/10 border border-pink-500/20 flex items-center justify-center shrink-0">
                                        <svg class="w-5 h-5 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-slate-500 font-medium">Usia Pemain</p>
                                        <p class="text-base font-semibold text-slate-200">{{ $pemain->usia }} Tahun</p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-xl bg-indigo-500/10 border border-indigo-500/20 flex items-center justify-center shrink-0">
                                        <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-slate-500 font-medium">Kategori Entri</p>
                                        <p class="text-base font-semibold text-slate-200">Data Pemain Olahraga</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Footer Actions (Only for Admin) --}}
                        @auth
                            <div class="mt-8 pt-6 border-t border-white/5 flex gap-3">
                                <a href="{{ route('admin.pemain.edit', $pemain->id_pemain) }}" 
                                   class="flex-1 py-2.5 px-4 rounded-xl bg-amber-500/20 border border-amber-500/30 text-amber-400 font-semibold text-sm text-center hover:bg-amber-500/30 transition-all">
                                    Edit Profil
                                </a>
                            </div>
                        @endauth
                    </div>

                </div>
            </div>

        </div>
    </section>

@endsection
