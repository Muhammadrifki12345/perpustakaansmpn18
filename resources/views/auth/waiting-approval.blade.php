<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Menunggu Persetujuan | {{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Outfit', sans-serif; background: #f8fafc; }
        .surface-card { background: white; border-radius: 2rem; border: 1px solid #f1f5f9; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.05); }
    </style>
</head>
<body class="antialiased">
    <div class="min-h-screen flex flex-col items-center justify-center p-6 text-center">
        <div class="max-w-md w-full surface-card p-10 animate-fade-in">
            <!-- Icon -->
            <div class="mb-8 relative inline-block">
                <div class="w-24 h-24 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-4 border-8 border-white shadow-sm">
                    <svg class="w-10 h-10 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div class="absolute -right-2 -bottom-2 bg-amber-400 text-white p-2 rounded-xl shadow-lg border-4 border-white">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/></svg>
                </div>
            </div>

            <h1 class="text-2xl font-black text-gray-900 mb-4 italic tracking-tight uppercase">Akun Sedang Ditinjau 🚀</h1>
            <p class="text-gray-500 text-sm leading-relaxed mb-8">
                Terima kasih telah mendaftar di <b>{{ config('app.name') }}</b>! Pustakawan kami sedang meninjau akunmu. 
                Kamu akan bisa mengakses koleksi buku segera setelah akunmu <b>disetujui (ACC)</b>.
            </p>

            <div class="bg-blue-50/50 rounded-2xl p-4 border border-blue-100 flex items-center gap-4 mb-8 text-left">
                <div class="w-10 h-10 rounded-xl bg-white border border-blue-100 flex items-center justify-center shrink-0 shadow-sm">
                    <span class="text-xs font-black text-blue-600">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                </div>
                <div>
                    <p class="text-[10px] text-blue-600 font-black uppercase tracking-widest">Status Siswa</p>
                    <p class="text-sm font-bold text-gray-900 truncate">{{ Auth::user()->name }}</p>
                    <p class="text-[10px] text-amber-500 font-bold uppercase italic">Menunggu Persetujuan...</p>
                </div>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-xs font-black text-gray-400 hover:text-red-500 transition-colors uppercase tracking-widest border-b-2 border-transparent hover:border-red-500 pb-1">
                    Batal & Keluar
                </button>
            </form>
        </div>
        
        <p class="mt-8 text-[10px] font-black text-gray-300 uppercase tracking-widest italic">
            &copy; {{ date('Y') }} {{ config('app.name') }} - Digital Library System
        </p>
    </div>
</body>
</html>
