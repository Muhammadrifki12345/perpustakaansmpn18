<x-app-layout>
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12 animate-fade-in">
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h2 class="text-3xl font-black text-gray-900 italic uppercase tracking-tight">Edit Kategori 📂</h2>
            <p class="text-sm text-gray-500 mt-1 font-medium italic">Memperbarui informasi kategori <span class="text-blue-600">"{{ $kategori->name }}"</span></p>
        </div>
        <a href="{{ route('kategori.index') }}" class="text-xs font-black uppercase tracking-widest text-gray-400 hover:text-gray-900 transition-colors flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali
        </a>
    </div>

    <div class="surface-card">
        <form action="{{ route('kategori.update', $kategori->id) }}" method="POST" class="space-y-8">
            @csrf
            @method('PUT')
            
            <div class="space-y-6">
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3">Nama Kategori</label>
                    <input type="text" name="name" value="{{ old('name', $kategori->name) }}" placeholder="Contoh: Fiksi, Sains, Sejarah..." 
                           class="w-full rounded-2xl border-gray-100 bg-gray-50 focus:ring-blue-500 font-bold text-sm @error('name') border-red-500 @enderror" required>
                    @error('name') <p class="text-[10px] text-red-500 font-black mt-1 uppercase">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3">Deskripsi (Opsional)</label>
                    <textarea name="description" rows="4" placeholder="Jelaskan cakupan kategori ini..." 
                              class="w-full rounded-2xl border-gray-100 bg-gray-50 focus:ring-blue-500 font-bold text-sm @error('description') border-red-500 @enderror">{{ old('description', $kategori->description) }}</textarea>
                    @error('description') <p class="text-[10px] text-red-500 font-black mt-1 uppercase">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="pt-6 border-t border-gray-50">
                <button type="submit" class="w-full py-4 bg-blue-600 text-white rounded-3xl font-black text-xs uppercase tracking-widest hover:bg-blue-700 transition-all shadow-xl shadow-blue-100 italic flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
</x-app-layout>
