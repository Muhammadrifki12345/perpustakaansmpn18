<x-app-layout>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 animate-fade-in">
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h2 class="text-3xl font-black text-gray-900 tracking-tight italic uppercase">Pengaturan Hak Akses 🔐</h2>
            <p class="text-sm text-gray-500 mt-1 font-medium italic">Konfigurasi izin akses untuk setiap modul di ePustaka.</p>
        </div>
        <a href="{{ route('dasbor') }}" class="px-6 py-2 bg-white border border-gray-200 rounded-xl font-bold text-xs text-gray-600 hover:bg-gray-50 transition-all">← Dashboard</a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Left: Permissions List --}}
        <div class="lg:col-span-2 space-y-6">
            <div class="surface-card">
                <h3 class="text-xs font-black text-gray-400 uppercase tracking-widest mb-6 italic">Modul & Izin Tersedia</h3>
                
                <div class="space-y-4">
                    @php
                        $modules = [
                            'Koleksi Buku' => ['Lihat', 'Tambah', 'Edit', 'Hapus', 'Baca PDF'],
                            'Anggota' => ['Lihat', 'ACC Akun', 'Edit', 'Hapus'],
                            'Transaksi' => ['ACC Pinjam', 'Retur Buku', 'Lihat Laporan'],
                            'Master Data' => ['Kelola Kategori', 'Kelola Penerbit']
                        ];
                    @endphp

                    @foreach($modules as $module => $perms)
                        <div class="p-5 bg-gray-50 rounded-3xl border border-gray-100 transition-all hover:border-blue-200">
                            <div class="flex items-center justify-between mb-4">
                                <h4 class="text-sm font-black text-gray-900 italic">{{ $module }}</h4>
                                <span class="text-[10px] bg-blue-100 text-blue-600 px-2 py-0.5 rounded-full font-bold uppercase">{{ count($perms) }} Izin</span>
                            </div>
                            <div class="flex flex-wrap gap-2">
                                @foreach($perms as $perm)
                                    <span class="px-3 py-1 bg-white border border-gray-100 text-[10px] font-bold text-gray-600 rounded-xl shadow-sm">
                                        {{ $perm }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Right: Info Box --}}
        <div class="space-y-6">
            <div class="bg-gray-900 p-6 rounded-3xl text-white shadow-xl italic">
                <h4 class="text-xs font-black uppercase tracking-widest text-gray-500 mb-4">Catatan Sistem</h4>
                <p class="text-xs text-gray-300 leading-relaxed mb-4">
                    Hak akses ini terhubung langsung dengan sistem Middleware Laravel. Perubahan di sini memerlukan sinkronisasi manual ke database Spatie Roles jika digunakan.
                </p>
                <div class="p-3 bg-white/5 rounded-2xl border border-white/10 text-[10px] space-y-2">
                    <p class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span> <b>Admin</b> memiliki akses penuh.</p>
                    <p class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> <b>Siswa</b> hanya memiliki akses baca & ulasan.</p>
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
