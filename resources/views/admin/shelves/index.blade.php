<x-app-layout>
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8 animate-fade-in">
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-black text-gray-900 uppercase tracking-tight">Kelola Rak Buku 🗄️</h2>
            <p class="text-sm text-gray-500 mt-1">Atur lokasi fisik rak di perpustakaan.</p>
        </div>
        <a href="{{ route('rak.create') }}" class="btn-primary no-underline">+ Tambah Rak</a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="data-table">
            <thead>
                <tr><th class="pl-6">No</th><th>Nama Rak</th><th>Kode Lokasi</th><th>Jumlah Buku</th><th>Deskripsi</th><th class="text-right pr-6">Aksi</th></tr>
            </thead>
            <tbody>
                @forelse($shelves as $i => $shelf)
                <tr>
                    <td class="pl-6 font-bold text-gray-400">{{ $i + 1 }}</td>
                    <td class="font-bold text-gray-800">{{ $shelf->name }}</td>
                    <td><span class="badge badge-blue text-[9px]">{{ $shelf->location_code ?? '-' }}</span></td>
                    <td class="text-gray-600">{{ $shelf->books_count }} buku</td>
                    <td class="text-gray-500 text-xs max-w-[200px] truncate">{{ $shelf->description ?? '-' }}</td>
                    <td class="text-right pr-6">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('rak.edit', $shelf->id) }}" class="px-4 py-2 border-2 border-indigo-600 text-indigo-600 rounded-xl font-black text-[9px] uppercase tracking-widest no-underline text-center hover:bg-indigo-50 transition-colors flex items-center justify-center min-w-[70px]">
                                EDIT
                            </a>
                            <form method="POST" action="{{ route('rak.destroy', $shelf->id) }}" onsubmit="return confirm('Hapus rak ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-xl font-black text-[9px] uppercase tracking-widest hover:bg-red-600 transition-colors shadow-lg shadow-red-100 flex items-center justify-center border-2 border-red-500 min-w-[70px]">
                                    HAPUS
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-gray-400 italic py-8">Belum ada rak buku.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
</x-app-layout>
