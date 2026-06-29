<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Aplikasi Data Pemain Olahraga — UAS Rekayasa Web">
    <title>@yield('title', 'Data Pemain Olahraga')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    {{-- Tailwind CSS via CDN (fallback jika Vite tidak tersedia) --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                    },
                },
            },
        }
    </script>
    <style>
        /* ===== Custom Animations ===== */
        @keyframes fade-in-up {
            from { opacity: 0; transform: translateY(24px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fade-in {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-6px); }
        }
        .animate-fade-in-up { animation: fade-in-up 0.6s ease-out both; }
        .animate-fade-in { animation: fade-in 0.5s ease-out both; }
        .animate-float { animation: float 3s ease-in-out infinite; }
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
        .delay-400 { animation-delay: 0.4s; }

        /* ===== Glassmorphism ===== */
        .glass {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.12);
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .glass-card:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.18);
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        /* ===== Gradient Text ===== */
        .gradient-text {
            background: linear-gradient(135deg, #818cf8, #c084fc, #f472b6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* ===== Custom Scrollbar ===== */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #0f172a; }
        ::-webkit-scrollbar-thumb { background: #334155; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #475569; }

        * { scroll-behavior: smooth; }
        input:focus, select:focus, textarea:focus {
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.3);
        }
    </style>
</head>
<body class="min-h-screen bg-slate-950 text-slate-100 font-sans antialiased">

    {{-- Ambient Background --}}
    <div class="fixed inset-0 -z-10 overflow-hidden pointer-events-none">
        <div class="absolute top-0 -left-40 w-96 h-96 bg-indigo-600/20 rounded-full blur-3xl"></div>
        <div class="absolute top-1/3 -right-40 w-96 h-96 bg-purple-600/15 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-1/3 w-96 h-96 bg-pink-600/10 rounded-full blur-3xl"></div>
    </div>

    {{-- Navigation --}}
    <nav class="sticky top-0 z-50 glass border-b border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center shadow-lg shadow-indigo-500/25 group-hover:shadow-indigo-500/50 transition-shadow">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <span class="text-lg font-bold gradient-text hidden sm:block">SportData</span>
                </a>

                {{-- Nav Links --}}
                <div class="flex items-center gap-3">
                    <a href="{{ route('home') }}" class="px-4 py-2 text-sm font-medium text-slate-300 hover:text-white rounded-lg hover:bg-white/5 transition-all">
                        Beranda
                    </a>

                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 text-sm font-medium text-slate-300 hover:text-white rounded-lg hover:bg-white/5 transition-all">
                            Dashboard
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="px-4 py-2 text-sm font-medium text-red-400 hover:text-red-300 rounded-lg hover:bg-red-500/10 transition-all cursor-pointer">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="px-5 py-2 text-sm font-semibold text-white bg-gradient-to-r from-indigo-600 to-purple-600 rounded-lg hover:from-indigo-500 hover:to-purple-500 shadow-lg shadow-indigo-500/25 hover:shadow-indigo-500/40 transition-all">
                            Login
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 animate-fade-in">
            <div class="flex items-center gap-3 px-5 py-3 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="mt-20 border-t border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <span class="text-sm font-semibold text-slate-400">SportData</span>
                </div>
                <p class="text-sm text-slate-500">
                    &copy; {{ date('Y') }} UAS Rekayasa Web — NIM 241011750184
                </p>
            </div>
        </div>
    </footer>

</body>
</html>
