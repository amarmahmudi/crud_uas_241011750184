@extends('layouts.app')

@section('title', 'Dashboard Admin — Data Pemain Olahraga')

@section('content')

    <!-- jQuery & DataTables CDN -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    <style>
        /* Custom dark theme styles for jQuery DataTables */
        .dataTables_wrapper {
            padding: 1.5rem 0 !important;
        }
        .dataTables_wrapper .dataTables_length, 
        .dataTables_wrapper .dataTables_filter, 
        .dataTables_wrapper .dataTables_info, 
        .dataTables_wrapper .dataTables_processing, 
        .dataTables_wrapper .dataTables_paginate {
            color: #94a3b8 !important; /* text-slate-400 */
            font-size: 0.875rem;
            margin-bottom: 1.5rem;
        }
        .dataTables_wrapper .dataTables_filter input {
            background-color: rgba(30, 41, 59, 0.4) !important; /* bg-slate-800/40 */
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            border-radius: 0.75rem !important;
            color: white !important;
            padding: 0.5rem 1rem !important;
            margin-left: 0.5rem !important;
            outline: none !important;
            transition: all 0.2s;
        }
        .dataTables_wrapper .dataTables_filter input:focus {
            border-color: #6366f1 !important; /* focus:border-indigo-500 */
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2) !important;
        }
        .dataTables_wrapper .dataTables_length select {
            background-color: rgba(30, 41, 59, 0.4) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            border-radius: 0.5rem !important;
            color: white !important;
            padding: 0.25rem 0.75rem !important;
            margin: 0 0.25rem !important;
            outline: none !important;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            color: #94a3b8 !important;
            border-radius: 0.5rem !important;
            border: 1px solid transparent !important;
            padding: 0.375rem 0.75rem !important;
            transition: all 0.2s;
            cursor: pointer;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button.current, 
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            background: linear-gradient(135deg, #4f46e5, #7c3aed) !important;
            color: white !important;
            border: 1px solid transparent !important;
            font-weight: 600;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: rgba(255, 255, 255, 0.1) !important;
            color: white !important;
            border: 1px solid transparent !important;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled,
        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover,
        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active {
            color: #475569 !important; /* text-slate-600 */
            background: transparent !important;
            cursor: not-allowed;
        }
        table.dataTable {
            border-collapse: collapse !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05) !important;
            margin-top: 1rem !important;
            margin-bottom: 1rem !important;
            width: 100% !important;
        }
        table.dataTable.no-footer {
            border-bottom: 1px solid rgba(255, 255, 255, 0.05) !important;
        }
        table.dataTable thead th {
            border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
        }
        table.dataTable thead th:last-child {
            text-align: center !important;
            padding: 12px !important;
        }
        table.dataTable thead th:last-child::after,
        table.dataTable thead th:last-child::before {
            display: none !important;
            content: "" !important;
            padding: 0 !important;
        }
        table.dataTable thead th:last-child * {
            text-align: center !important;
            margin: 0 auto !important;
            justify-content: center !important;
        }
        table.dataTable tbody td:last-child {
            text-align: center !important;
            padding: 12px !important;
        }
    </style>

    <section class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Page Header --}}
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8 animate-fade-in-up">
                <div>
                    <h1 class="text-3xl font-bold text-white">Dashboard Admin</h1>
                    <p class="text-slate-400 mt-1">Kelola data pemain olahraga</p>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.pemain.exportPdf') }}"
                       target="_blank"
                       class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-emerald-600/20 border border-emerald-500/30 text-emerald-400 font-medium text-sm hover:bg-emerald-600/30 hover:border-emerald-500/50 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Export PDF
                    </a>
                    <a href="{{ route('admin.pemain.create') }}"
                       class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold text-sm shadow-lg shadow-indigo-500/25 hover:shadow-indigo-500/40 hover:from-indigo-500 hover:to-purple-500 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Tambah Pemain
                    </a>
                </div>
            </div>

            {{-- Stats Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
                <div class="glass-card rounded-2xl p-5 animate-fade-in-up delay-100">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-indigo-500/20 to-indigo-600/20 flex items-center justify-center">
                            <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-white">{{ $totalPemain }}</p>
                            <p class="text-sm text-slate-400">Total Pemain</p>
                        </div>
                    </div>
                </div>
                <div class="glass-card rounded-2xl p-5 animate-fade-in-up delay-200">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-500/20 to-purple-600/20 flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-white">{{ $totalCabang }}</p>
                            <p class="text-sm text-slate-400">Cabang Olahraga</p>
                        </div>
                    </div>
                </div>
                <div class="glass-card rounded-2xl p-5 animate-fade-in-up delay-300">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-pink-500/20 to-pink-600/20 flex items-center justify-center">
                            <svg class="w-6 h-6 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-white">{{ $totalKlub }}</p>
                            <p class="text-sm text-slate-400">Klub Terdaftar</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Data Table --}}
            <div class="glass-card rounded-2xl overflow-hidden animate-fade-in-up delay-400">
                <div class="px-6 py-5 border-b border-white/5">
                    <h2 class="text-lg font-bold text-white">Data Pemain Olahraga</h2>
                </div>

                @if($pemains->count() > 0)
                    <div class="overflow-x-auto">
                        <table id="pemainTable" class="w-full dataTable">
                            <thead>
                                <tr class="border-b border-white/5">
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">No</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">ID Pemain</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">Gambar</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">Nama Pemain</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">Cabang Olahraga</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">Klub</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">Usia</th>
                                    <th style="text-align: center !important; padding-right: 0 !important; padding-left: 0 !important; background-image: none !important;" class="py-4 text-center text-xs font-semibold text-slate-400 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @foreach($pemains as $index => $pemain)
                                    <tr class="hover:bg-white/[0.02] transition-colors">
                                        <td class="px-6 py-4">
                                            <span class="text-sm text-slate-400 font-mono">{{ $index + 1 }}</span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="text-xs font-semibold text-indigo-400 font-mono">#{{ str_pad($pemain->id_pemain, 4, '0', STR_PAD_LEFT) }}</span>
                                        </td>
                                        <td class="px-6 py-4">
                                            @if($pemain->gambar)
                                                <img src="{{ str_starts_with($pemain->gambar, 'data:') ? $pemain->gambar : asset('storage/' . $pemain->gambar) }}"
                                                     alt="{{ $pemain->nama_pemain }}"
                                                     class="w-12 h-12 rounded-xl object-cover ring-2 ring-white/10">
                                            @else
                                                <div class="w-12 h-12 rounded-xl bg-slate-800 flex items-center justify-center ring-2 ring-white/10">
                                                    <svg class="w-6 h-6 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                                    </svg>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="text-sm font-semibold text-white">{{ $pemain->nama_pemain }}</span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium bg-indigo-500/10 text-indigo-400 border border-indigo-500/20">
                                                {{ $pemain->cabang_olahraga }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="text-sm text-slate-300">{{ $pemain->klub }}</span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="text-sm text-slate-300">{{ $pemain->usia }} thn</span>
                                        </td>
                                        <td style="text-align: center !important;" class="py-4">
                                            <div class="flex items-center justify-center gap-2 w-full">
                                                <a href="{{ route('pemain.show', $pemain->id_pemain) }}"
                                                   class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-medium bg-indigo-500/10 text-indigo-400 border border-indigo-500/20 hover:bg-indigo-500/20 transition-all">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                    </svg>
                                                    Detail
                                                </a>
                                                <a href="{{ route('admin.pemain.edit', $pemain->id_pemain) }}"
                                                   class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-medium bg-amber-500/10 text-amber-400 border border-amber-500/20 hover:bg-amber-500/20 transition-all">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                    </svg>
                                                    Edit
                                                </a>
                                                <form method="POST" action="{{ route('admin.pemain.destroy', $pemain->id_pemain) }}"
                                                      onsubmit="return confirm('Yakin ingin menghapus data pemain {{ $pemain->nama_pemain }}?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-medium bg-red-500/10 text-red-400 border border-red-500/20 hover:bg-red-500/20 transition-all cursor-pointer">
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                        </svg>
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="p-16 text-center">
                        <div class="w-20 h-20 mx-auto rounded-2xl bg-slate-800 flex items-center justify-center mb-6">
                            <svg class="w-10 h-10 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">Data Masih Kosong</h3>
                        <p class="text-slate-400 mb-6">Belum ada data pemain olahraga yang tercatat.</p>
                        <a href="{{ route('admin.pemain.create') }}"
                           class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold text-sm shadow-lg shadow-indigo-500/25 hover:shadow-indigo-500/40 transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Tambah Pemain Pertama
                        </a>
                    </div>
                @endif
            </div>

        </div>
    </section>

    <script>
        $(document).ready(function() {
            $('#pemainTable').DataTable({
                "language": {
                    "lengthMenu": "Tampilkan _MENU_ data per halaman",
                    "zeroRecords": "Data tidak ditemukan",
                    "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                    "infoEmpty": "Tidak ada data tersedia",
                    "infoFiltered": "(difilter dari _MAX_ total data)",
                    "search": "Cari:",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Lanjut",
                        "previous": "Kembali"
                    }
                },
                "columnDefs": [
                    { "orderable": false, "targets": [2, 7] } // Nonaktifkan sorting pada kolom Gambar dan Aksi (bergeser karena adanya kolom ID Pemain)
                ]
            });
        });
    </script>

@endsection
