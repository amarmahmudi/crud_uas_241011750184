<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Pemain Olahraga</title>
    <style>
        @page {
            margin: 0.8cm 1.0cm 0.8cm 1.0cm;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 10px;
            color: #334155;
            line-height: 1.4;
            background-color: #ffffff;
        }

        .header-container {
            width: 100%;
            margin-bottom: 12px;
            border-bottom: 2px solid #4f46e5;
            padding-bottom: 8px;
        }

        .header-title {
            font-size: 18px;
            font-weight: bold;
            color: #1e1b4b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .header-subtitle {
            font-size: 9px;
            color: #64748b;
            margin-top: 2px;
        }

        .meta-table {
            width: 100%;
            margin-bottom: 8px;
            border: none;
        }

        .meta-table td {
            border: none;
            padding: 0;
            font-size: 9px;
            color: #64748b;
        }

        .meta-right {
            text-align: right;
        }

        .total-info {
            margin-bottom: 10px;
            padding: 6px 12px;
            background-color: #f8fafc;
            border-radius: 6px;
            border-left: 3px solid #4f46e5;
            font-size: 9px;
            color: #475569;
        }

        .total-info span {
            font-weight: bold;
            color: #4f46e5;
        }

        table.data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        table.data-table thead th {
            background-color: #4f46e5;
            color: #ffffff;
            padding: 6px 8px;
            text-align: left;
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
            border: 1px solid #4f46e5;
        }

        table.data-table thead th.center {
            text-align: center;
        }

        table.data-table tbody td {
            padding: 5px 8px;
            border: 1px solid #e2e8f0;
            font-size: 9px;
            vertical-align: middle;
            color: #334155;
        }

        table.data-table tbody td.center {
            text-align: center;
        }

        table.data-table tbody tr:nth-child(even) {
            background-color: #f8fafc;
        }

        .player-img {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            border: 1px solid #cbd5e1;
        }

        .no-img {
            width: 28px;
            height: 28px;
            background-color: #f1f5f9;
            border-radius: 50%;
            color: #94a3b8;
            font-size: 7px;
            text-align: center;
            line-height: 26px;
            border: 1px solid #cbd5e1;
            display: inline-block;
        }

        .badge {
            display: inline-block;
            padding: 2px 6px;
            background-color: #eef2ff;
            color: #4338ca;
            border-radius: 4px;
            font-size: 8.5px;
            font-weight: bold;
            border: 1px solid #e0e7ff;
        }

        .footer {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding-top: 6px;
            border-top: 1px solid #e2e8f0;
            text-align: center;
            font-size: 8px;
            color: #94a3b8;
        }
    </style>
</head>
<body>

    {{-- Header --}}
    <table class="meta-table">
        <tr>
            <td>
                <div class="header-title">Laporan Data Pemain Olahraga</div>
                <div class="header-subtitle">Sistem Informasi Data Pemain Olahraga — UAS Rekayasa Web</div>
            </td>
            <td class="meta-right" style="vertical-align: bottom;">
                <div>Dicetak pada: {{ now()->format('d F Y, H:i') }} WIB</div>
            </td>
        </tr>
    </table>

    <div class="header-container"></div>

    {{-- Summary --}}
    <div class="total-info">
        Total <span>{{ $pemains->count() }}</span> pemain terdaftar dari
        <span>{{ $pemains->unique('cabang_olahraga')->count() }}</span> cabang olahraga dan
        <span>{{ $pemains->unique('klub')->count() }}</span> klub terdaftar.
    </div>

    {{-- Data Table --}}
    <table class="data-table">
        <thead>
             <tr>
                <th class="center" style="width: 25px;">No</th>
                <th class="center" style="width: 60px;">ID Pemain</th>
                @if(!env('VERCEL'))
                    <th class="center" style="width: 45px;">Gambar</th>
                @endif
                <th style="{{ env('VERCEL') ? 'width: 250px;' : '' }}">Nama Pemain</th>
                <th>Cabang Olahraga</th>
                <th>Klub</th>
                <th class="center" style="width: 60px;">Usia</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pemains as $index => $pemain)
                <tr>
                    <td class="center" style="color: #64748b; font-weight: bold;">{{ $index + 1 }}</td>
                    <td class="center" style="font-family: 'Courier New', Courier, monospace; font-weight: bold; color: #4f46e5;">
                        #{{ str_pad($pemain->id_pemain, 4, '0', STR_PAD_LEFT) }}
                    </td>
                    @if(!env('VERCEL'))
                        <td class="center">
                            @if($pemain->gambar && file_exists(public_path('storage/' . $pemain->gambar)))
                                <img src="{{ public_path('storage/' . $pemain->gambar) }}" class="player-img" alt="{{ $pemain->nama_pemain }}">
                            @else
                                <span class="no-img">No Pic</span>
                            @endif
                        </td>
                    @endif
                    <td style="font-weight: bold; color: #0f172a;">{{ $pemain->nama_pemain }}</td>
                    <td><span class="badge">{{ $pemain->cabang_olahraga }}</span></td>
                    <td>{{ $pemain->klub }}</td>
                    <td class="center">{{ $pemain->usia }} thn</td>
                </tr>
            @empty
                <tr>
                    <td colspan="{{ env('VERCEL') ? 6 : 7 }}" class="center" style="padding: 20px; color: #94a3b8;">
                        Tidak ada data pemain yang tersedia.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Footer --}}
    <div class="footer">
        &copy; {{ date('Y') }} — Laporan Data Pemain Olahraga | UAS Rekayasa Web — NIM 241011750184
    </div>

</body>
</html>
