<x-app-layout>
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 animate-fade-in">
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h2 class="text-3xl font-black text-gray-900 italic uppercase tracking-tight">Penugasan Role 🎭</h2>
            <p class="text-sm text-gray-500 mt-1 font-medium italic">Tetapkan peran pengguna untuk mengatur aksesibilitas sistem.</p>
        </div>
        <a href="{{ route('dasbor') }}" class="text-xs font-black uppercase tracking-widest text-gray-400 hover:text-gray-900 transition-colors flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali
        </a>
    </div>

    <div class="surface-card">
        <form action="#" method="POST" class="space-y-8">
            @csrf
            
            <div class="space-y-6">
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3">Pilih Pengguna</label>
                    <select name="user_id" class="w-full rounded-2xl border-gray-100 bg-gray-50 focus:ring-blue-500 font-bold text-sm h-12 px-4 shadow-inner">
                        <option value="">-- Cari Nama atau Email --</option>
                        @foreach(\App\Models\User::all() as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                        @endforeach
                    </select>
                    <p class="text-[10px] text-gray-400 italic mt-2">* Hanya pengguna aktif yang dapat diberikan role baru.</p>
                </div>

                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-4">Pilih Role</label>
                        <label class="relative block p-4 rounded-2xl bg-gray-50 border border-gray-100 cursor-pointer transition-all hover:bg-white hover:shadow-md group">
                            <input type="radio" name="role" value="superadmin" class="sr-only peer">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-xl bg-purple-100 text-purple-600 flex items-center justify-center font-black group-hover:scale-110 transition-transform">SA</div>
                                <div>
                                    <p class="text-sm font-black text-gray-900 italic uppercase">Super Admin</p>
                                    <p class="text-[10px] text-gray-400 font-bold">Akses Keseluruhan Website & Pengaturan</p>
                                </div>
                            </div>
                            <div class="absolute top-4 right-4 text-purple-600 opacity-0 peer-checked:opacity-100">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            </div>
                        </label>

                        <label class="relative block p-4 rounded-2xl bg-gray-50 border border-gray-100 cursor-pointer transition-all hover:bg-white hover:shadow-md group">
                            <input type="radio" name="role" value="admin" class="sr-only peer">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center font-black group-hover:scale-110 transition-transform">PP</div>
                                <div>
                                    <p class="text-sm font-black text-gray-900 italic uppercase">Pengurus Perpustakaan</p>
                                    <p class="text-[10px] text-gray-400 font-bold">Kelola Stok & Peminjaman Buku</p>
                                </div>
                            </div>
                            <div class="absolute top-4 right-4 text-blue-600 opacity-0 peer-checked:opacity-100">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            </div>
                        </label>

                        <label class="relative block p-4 rounded-2xl bg-gray-50 border border-gray-100 cursor-pointer transition-all hover:bg-white hover:shadow-md group">
                            <input type="radio" name="role" value="siswa" class="sr-only peer">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center font-black group-hover:scale-110 transition-transform">S</div>
                                <div>
                                    <p class="text-sm font-black text-gray-900 italic uppercase">Siswa / Anggota</p>
                                    <p class="text-[10px] text-gray-400 font-bold">Akses Baca Online & Pinjam Offline</p>
                                </div>
                            </div>
                            <div class="absolute top-4 right-4 text-emerald-600 opacity-0 peer-checked:opacity-100">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            <div class="pt-6 border-t border-gray-50">
                <button type="submit" class="w-full py-4 bg-gray-900 text-white rounded-3xl font-black text-xs uppercase tracking-widest hover:bg-black transition-all shadow-xl shadow-gray-200 italic flex items-center justify-center gap-2">
                    Terapkan Role
                </button>
                <p class="text-[9px] text-gray-400 text-center mt-4 font-bold uppercase tracking-widest">Aksi Ini Bersifat Permanen Kecil Diubah Secara Manual</p>
            </div>
        </form>
    </div>
</div>
</x-app-layout>
