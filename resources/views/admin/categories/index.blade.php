<x-app-layout>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 animate-fade-in">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h2 class="text-3xl font-black text-gray-900 tracking-tight italic uppercase">Kelola Kategori 📂</h2>
            <p class="text-sm text-gray-500 mt-1 font-medium">Atur kategori buku untuk mempermudah pencarian koleksi.</p>
        </div>
        <a href="{{ route('kategori.create') }}" class="px-6 py-3 bg-blue-600 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-blue-700 transition-all shadow-xl shadow-blue-100 italic flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
            Tambah Kategori
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-emerald-50 border border-emerald-100 text-emerald-600 rounded-2xl text-xs font-bold flex items-center gap-3 animate-slide-up">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="surface-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100">
                        <th class="px-6 py-5 text-[10px] font-black uppercase tracking-widest text-gray-400">ID</th>
                        <th class="px-6 py-5 text-[10px] font-black uppercase tracking-widest text-gray-400">Nama Kategori</th>
                        <th class="px-6 py-5 text-[10px] font-black uppercase tracking-widest text-gray-400">Deskripsi</th>
                        <th class="px-6 py-5 text-[10px] font-black uppercase tracking-widest text-gray-400 text-center">Jumlah Buku</th>
                        <th class="px-6 py-5 text-[10px] font-black uppercase tracking-widest text-gray-400 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($categories as $category)
                        <tr class="hover:bg-gray-50/50 transition-colors group">
                            <td class="px-6 py-4 text-xs font-bold text-gray-400">#{{ $category->id }}</td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-black text-gray-900 italic">{{ $category->name }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-xs text-gray-500 line-clamp-1 max-w-xs">{{ $category->description ?? '-' }}</p>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="bg-blue-50 text-blue-600 px-3 py-1 rounded-full text-[10px] font-black italic">
                                    {{ $category->books_count }} Koleksi
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('kategori.edit', $category->id) }}" class="px-4 py-2 border-2 border-blue-600 text-blue-600 rounded-xl font-black text-[9px] uppercase tracking-widest no-underline text-center hover:bg-blue-50 transition-colors flex items-center justify-center min-w-[70px]">
                                        EDIT
                                    </a>
                                    <form action="{{ route('kategori.destroy', $category->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus kategori ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-xl font-black text-[9px] uppercase tracking-widest hover:bg-red-600 transition-colors shadow-lg shadow-red-100 flex items-center justify-center border-2 border-red-500 min-w-[70px]">
                                            HAPUS
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-20 text-center">
                                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                                </div>
                                <p class="text-sm text-gray-400 font-medium italic">Belum ada kategori yang terdaftar.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
</x-app-layout>
