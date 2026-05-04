<x-app-layout>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 animate-fade-in">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-3xl font-black text-gray-900 tracking-tight italic uppercase flex items-center gap-3">
                <div class="w-10 h-10 rounded-2xl bg-amber-500 flex items-center justify-center text-white shadow-lg shadow-amber-500/30">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                Daftar Tunggu Siswa
            </h2>
            <p class="text-sm text-gray-500 mt-2 font-medium">Pantau siswa yang sedang dalam daftar tunggu untuk buku dengan stok habis.</p>
        </div>
        <a href="{{ route('dasbor') }}" class="btn-outline flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Kembali ke Dasbor
        </a>
    </div>

    <div class="surface-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100">
                        <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-gray-400 w-16">No.</th>
                        <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-gray-400">Identitas Siswa</th>
                        <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-gray-400">Buku yang Ditunggu</th>
                        <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-gray-400">Waktu Permintaan</th>
                        <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-gray-400 text-center">Posisi</th>
                        <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-gray-400 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($waitlists as $item)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4 text-sm font-bold text-gray-500">
                            {{ $loop->iteration }}
                        </td>
                        <td class="px-6 py-4">
                            <div>
                                <div class="text-sm font-black text-gray-900 italic">{{ optional($item->user)->name ?? 'User Dihapus' }}</div>
                                <div class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">{{ optional($item->user)->email ?? '-' }}</div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-10 rounded overflow-hidden shrink-0 bg-gray-100 shadow-sm">
                                    @if($item->book && $item->book->cover_image)
                                        <img src="{{ asset($item->book->cover_image) }}" class="w-full h-full object-cover">
                                    @endif
                                </div>
                                @if($item->book)
                                    <a href="{{ route('buku.show', $item->book->id) }}" class="text-sm font-bold text-blue-600 hover:underline">
                                        {{ $item->book->title }}
                                    </a>
                                @else
                                    <span class="text-sm font-bold text-gray-400 italic">Buku Dihapus</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-xs font-bold text-gray-600 bg-gray-50 px-3 py-1 rounded-xl">
                                {{ $item->created_at->format('d M Y, H:i') }}
                            </span>
                            <div class="text-[10px] text-gray-400 mt-1 uppercase tracking-widest">{{ $item->created_at->diffForHumans() }}</div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if($loop->iteration == 1)
                                <span class="bg-amber-100 text-amber-600 px-3 py-1.5 rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-sm">#1 (Berikutnya)</span>
                            @else
                                <span class="bg-gray-100 text-gray-600 px-3 py-1.5 rounded-2xl text-[10px] font-black uppercase tracking-widest">#{{ $loop->iteration }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <form action="{{ route('admin.daftar-tunggu.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan/menghapus dari daftar tunggu ini?')" class="inline-block">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2 text-red-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus dari Daftar Tunggu">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <div class="text-gray-300 mb-2">
                                <svg class="w-12 h-12 mx-auto text-amber-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <p class="text-gray-500 font-bold uppercase tracking-widest text-[11px]">Tidak ada daftar tunggu aktif saat ini.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
</x-app-layout>
