<x-guest-layout>
    <!-- Title -->
    <div class="mb-10">
        <h1 class="text-4xl font-black italic tracking-tighter text-gray-900 uppercase leading-none">
            Daftar <br>
            <span class="text-blue-600">Anggota</span> Baru
        </h1>
        <p class="text-sm font-bold text-gray-400 mt-4 uppercase tracking-widest">Akses literasi tanpa batas</p>
    </div>

    @if($errors->any())
        <div class="p-4 bg-red-50 text-red-700 text-xs font-bold rounded-2xl border border-red-100 mb-6 space-y-1">
            @foreach ($errors->all() as $error)
                <div class="flex items-center gap-2">
                    <span class="text-red-300">•</span>
                    {{ $error }}
                </div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- Name -->
        <div class="space-y-1.5">
            <label for="name" class="text-[10px] font-black uppercase tracking-[0.3em] text-gray-400 ml-4">Nama Lengkap</label>
            <input
                id="name" type="text" name="name" value="{{ old('name') }}"
                required autofocus
                class="w-full px-6 py-4 bg-white border-2 border-gray-900 rounded-2xl text-sm font-bold text-gray-900 placeholder-gray-400 focus:ring-4 focus:ring-blue-100 transition-all shadow-sm font-outfit"
                placeholder="Nama sesuai akta"
            >
        </div>

        <!-- Email -->
        <div class="space-y-1.5">
            <label for="email" class="text-[10px] font-black uppercase tracking-[0.3em] text-gray-400 ml-4">Alamat Email</label>
            <input
                id="email" type="email" name="email" value="{{ old('email') }}"
                required
                class="w-full px-6 py-4 bg-white border-2 border-gray-900 rounded-2xl text-sm font-bold text-gray-900 placeholder-gray-400 focus:ring-4 focus:ring-blue-100 transition-all shadow-sm font-outfit"
                placeholder="nama@email.com"
            >
        </div>

        <!-- Kelas -->
        <div class="space-y-1.5">
            <label for="kelas" class="text-[10px] font-black uppercase tracking-[0.3em] text-gray-400 ml-4">Kelas</label>
            <input
                id="kelas" type="text" name="kelas" value="{{ old('kelas') }}"
                required
                class="w-full px-6 py-4 bg-white border-2 border-gray-900 rounded-2xl text-sm font-bold text-gray-900 placeholder-gray-400 focus:ring-4 focus:ring-blue-100 transition-all shadow-sm font-outfit"
                placeholder="Contoh: IX - A"
            >
        </div>

        <!-- Password -->
        <div class="space-y-1.5" x-data="{ show: false }">
            <label for="password" class="text-[10px] font-black uppercase tracking-[0.3em] text-gray-400 ml-4">Kata Sandi</label>
            <div class="relative">
                <input
                    id="password" :type="show ? 'text' : 'password'" name="password"
                    required autocomplete="new-password"
                    class="w-full px-6 py-4 bg-white border-2 border-gray-900 rounded-2xl text-sm font-bold text-gray-900 placeholder-gray-400 focus:ring-4 focus:ring-blue-100 transition-all shadow-sm font-outfit"
                    placeholder="Minimal 8 karakter"
                >
                <button type="button" @click="show = !show" class="absolute right-6 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                    <template x-if="!show">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    </template>
                    <template x-if="show">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88L4.222 4.222m10.89 10.89L20.777 20.777M4.221 4.221l15.558 15.558"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21.542 12A10.3 10.3 0 0112 19c-1.34 0-2.61-.26-3.77-.73M21.542 12a9.96 9.96 0 00-1.563-3.029m-5.858-.908a10.03 10.03 0 00-2.121-.263M21.542 12a10.05 10.05 0 00-1.563-3.029"/></svg>
                    </template>
                </button>
            </div>
        </div>

        <!-- Confirm Password -->
        <div class="space-y-1.5" x-data="{ show: false }">
            <label for="password_confirmation" class="text-[10px] font-black uppercase tracking-[0.3em] text-gray-400 ml-4">Konfirmasi Sandi</label>
            <div class="relative">
                <input
                    id="password_confirmation" :type="show ? 'text' : 'password'" name="password_confirmation"
                    required autocomplete="new-password"
                    class="w-full px-6 py-4 bg-white border-2 border-gray-900 rounded-2xl text-sm font-bold text-gray-900 placeholder-gray-400 focus:ring-4 focus:ring-blue-100 transition-all shadow-sm font-outfit"
                    placeholder="Ulangi sandi"
                >
                <button type="button" @click="show = !show" class="absolute right-6 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                    <template x-if="!show">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    </template>
                    <template x-if="show">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88L4.222 4.222m10.89 10.89L20.777 20.777M4.221 4.221l15.558 15.558"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21.542 12A10.3 10.3 0 0112 19c-1.34 0-2.61-.26-3.77-.73M21.542 12a9.96 9.96 0 00-1.563-3.029m-5.858-.908a10.03 10.03 0 00-2.121-.263M21.542 12a10.05 10.05 0 00-1.563-3.029"/></svg>
                    </template>
                </button>
            </div>
        </div>

        <!-- Submit -->
        <div class="pt-4">
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-black italic uppercase tracking-[0.2em] py-5 rounded-2xl shadow-xl shadow-blue-200 transition-all hover:scale-[1.02] active:scale-[0.98]">
                Daftar Sekarang
            </button>
        </div>

        <!-- Login link -->
        <div class="text-center pt-4">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">
                Sudah punya akun? 
                <a href="{{ route('login') }}" class="text-blue-600 hover:underline inline-flex items-center gap-1 ml-1">
                    Masuk di sini <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
