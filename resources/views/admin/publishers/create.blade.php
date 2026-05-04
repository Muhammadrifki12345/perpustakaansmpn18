<x-app-layout>
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 animate-fade-in">
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h2 class="text-3xl font-black text-gray-900 italic uppercase tracking-tight">Tambah Penerbit Baru 🏢</h2>
            <p class="text-sm text-gray-500 mt-1 font-medium italic">Masukkan informasi lengkap penerbit untuk database koleksi.</p>
        </div>
        <a href="{{ route('penerbit.index') }}" class="text-xs font-black uppercase tracking-widest text-gray-400 hover:text-gray-900 transition-colors flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali
        </a>
    </div>

    <div class="surface-card">
        <form action="{{ route('penerbit.store') }}" method="POST" class="space-y-8">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="md:col-span-2">
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3">Nama Penerbit</label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Contoh: Gramedia Pustaka Utama..." 
                           class="w-full rounded-2xl border-gray-100 bg-gray-50 focus:ring-amber-500 font-bold text-sm @error('name') border-red-500 @enderror" required>
                    @error('name') <p class="text-[10px] text-red-500 font-black mt-1 uppercase">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3">Email Kontak</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="penerbit@example.com" 
                           class="w-full rounded-2xl border-gray-100 bg-gray-50 focus:ring-amber-500 font-bold text-sm @error('email') border-red-500 @enderror">
                    @error('email') <p class="text-[10px] text-red-500 font-black mt-1 uppercase">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3">Nomor Telepon</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" placeholder="021-xxxxxx" 
                           class="w-full rounded-2xl border-gray-100 bg-gray-50 focus:ring-amber-500 font-bold text-sm @error('phone') border-red-500 @enderror">
                    @error('phone') <p class="text-[10px] text-red-500 font-black mt-1 uppercase">{{ $message }}</p> @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3">Alamat Lengkap</label>
                    <textarea name="address" rows="3" placeholder="Alamat kantor pusat..." 
                              class="w-full rounded-2xl border-gray-100 bg-gray-50 focus:ring-amber-500 font-bold text-sm @error('address') border-red-500 @enderror">{{ old('address') }}</textarea>
                    @error('address') <p class="text-[10px] text-red-500 font-black mt-1 uppercase">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="pt-6 border-t border-gray-50">
                <button type="submit" class="w-full py-4 bg-amber-500 text-white rounded-3xl font-black text-xs uppercase tracking-widest hover:bg-amber-600 transition-all shadow-xl shadow-amber-100 italic flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                    Simpan Penerbit
                </button>
            </div>
        </form>
    </div>
</div>
</x-app-layout>
