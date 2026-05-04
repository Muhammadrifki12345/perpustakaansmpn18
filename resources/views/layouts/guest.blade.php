<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ isset($title) ? $title . ' — ' : '' }}Akses Perpustakaan SMPN 18 Surabaya</title>

        <!-- Fonts: Outfit -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body { font-family: 'Outfit', sans-serif !important; }
            .bg-portal {
                background: linear-gradient(135deg, #001f5e 0%, #003580 50%, #0071c2 100%);
            }
            .glass-auth {
                background: rgba(255, 255, 255, 0.9);
                backdrop-filter: blur(20px);
                border: 1px solid rgba(255, 255, 255, 0.5);
            }
        </style>
    </head>
    <body class="antialiased min-h-screen">
        <div class="min-h-screen flex flex-col lg:flex-row">
            <!-- Left Side: School Branding Panel -->
            <div class="hidden lg:flex lg:w-1/2 bg-portal p-16 flex-col relative overflow-hidden">
                <!-- Branding Elements -->
                <div class="relative z-10 mb-24">
                    <a href="/" class="flex items-center gap-4 group">
                        <div class="bg-white p-2 rounded-2xl shadow-xl group-hover:scale-110 transition-transform">
                            <x-application-logo class="h-10 w-auto" />
                        </div>
                        <span class="text-white font-black text-xl italic tracking-tighter uppercase">SMPN 18 <span class="text-blue-200">Surabaya</span></span>
                    </a>
                </div>

                <div class="relative z-10 mb-auto">
                    <h1 class="text-6xl font-black text-white leading-[0.95] tracking-tighter italic uppercase mb-6">
                        Portal Literasi <br>
                        <span class="text-blue-300">Digital</span> Masa Dekat
                    </h1>
                    <p class="text-blue-100/60 font-medium text-lg max-w-md leading-relaxed">
                        Bergabunglah dengan ribuan siswa lainnya yang telah bertransformasi melalui literasi digital berkualitas tinggi di SMPN 18 Surabaya.
                    </p>
                </div>

                <div class="relative z-10 flex items-center gap-3">
                    <div class="w-12 h-1 bg-blue-400/30 rounded-full"></div>
                    <span class="text-[10px] font-black text-blue-200/40 uppercase tracking-[0.4em]">Integrated Library System v2.0</span>
                </div>

                <!-- Abstract Decorations -->
                <div class="absolute -top-24 -left-24 w-96 h-96 bg-white/5 rounded-full blur-3xl"></div>
                <div class="absolute bottom-20 -right-24 w-80 h-80 bg-blue-400/10 rounded-full blur-3xl"></div>
                <x-application-logo class="absolute -bottom-20 -left-20 w-80 h-auto opacity-5 grayscale blur-sm rotate-12" />
            </div>

            <!-- Right Side: Interaction Panel -->
            <div class="flex-1 flex items-center justify-center p-6 sm:p-12 lg:p-24 bg-white">
                <div class="w-full max-w-md">
                    <!-- Mobile View Header -->
                    <div class="lg:hidden flex items-center justify-center gap-3 mb-10">
                         <x-application-logo class="h-10 w-auto" />
                         <h2 class="font-black text-lg italic uppercase tracking-tighter">SMPN 18 Surabaya</h2>
                    </div>

                    <!-- Auth Card -->
                    <div class="bg-white rounded-[2.5rem] p-8 sm:p-10 shadow-[0_25px_60px_-15px_rgba(0,0,0,0.1)] border border-gray-100">
                        {{ $slot }}
                    </div>

                    <!-- Footer -->
                    <p class="text-center mt-8 text-[10px] font-black text-gray-300 uppercase tracking-[0.3em]">
                        &copy; {{ date('Y') }} Perpustakaan SMPN 18 Surabaya
                    </p>
                </div>
            </div>
        </div>
    </body>
</html>
