<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Menunggu Persetujuan — Perpustakaan SMPN 18</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;700;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>body{font-family:'Outfit',sans-serif;}</style>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full text-center space-y-6">
        <div class="w-20 h-20 bg-amber-100 rounded-2xl mx-auto flex items-center justify-center text-3xl">⏳</div>
        <h1 class="text-2xl font-black text-gray-900 uppercase tracking-tight">Menunggu Persetujuan</h1>
        <p class="text-sm text-gray-500 leading-relaxed">
            Akun kamu sedang dalam proses verifikasi oleh pengurus perpustakaan. 
            Silakan tunggu hingga akunmu disetujui untuk mengakses sistem.
        </p>
        <div class="pt-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="px-8 py-3 bg-gray-200 text-gray-700 rounded-xl font-bold text-sm hover:bg-gray-300 transition">Keluar</button>
            </form>
        </div>
    </div>
</body>
</html>
