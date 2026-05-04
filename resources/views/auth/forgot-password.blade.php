<x-guest-layout>
    <div class="mb-8">
        <h1 class="text-3xl font-black italic tracking-tighter text-gray-900 uppercase leading-none mb-4">
            Reset <br>
            <span class="text-blue-600">Kata Sandi</span>
        </h1>
        <p class="text-xs font-bold text-gray-400 leading-relaxed uppercase tracking-widest">
            {{ __('Lupa kata sandi? Masukkan email Anda dan kami akan mengirimkan tautan pemulihan.') }}
        </p>
    </div>

    <!-- Session Status -->
    @if(session('status'))
        <div class="p-4 bg-blue-50 text-blue-700 text-xs font-bold rounded-2xl border border-blue-100 mb-6 flex items-center gap-3">
             <div class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-ping"></div>
             {{ session('status') }}
        </div>
    @endif

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

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div class="space-y-2">
            <label for="email" class="text-[10px] font-black uppercase tracking-[0.3em] text-gray-400 ml-4">Alamat Email Terdaftar</label>
            <input
                id="email" type="email" name="email"
                value="{{ old('email') }}"
                required autofocus
                class="w-full px-6 py-4 bg-white border-2 border-gray-900 rounded-2xl text-sm font-bold text-gray-900 placeholder-gray-400 focus:ring-4 focus:ring-blue-100 transition-all shadow-sm font-outfit"
                placeholder="nama@email.com"
            >
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-black italic uppercase tracking-[0.2em] py-5 rounded-2xl shadow-xl shadow-blue-200 transition-all hover:scale-[1.02] active:scale-[0.98]">
                Kirim Tautan Reset
            </button>
        </div>

        <div class="text-center pt-4">
            <a href="{{ route('login') }}" class="text-xs font-black italic uppercase tracking-widest text-gray-400 hover:text-blue-600 transition-colors">
                Kembali ke Login
            </a>
        </div>
    </form>
</x-guest-layout>
