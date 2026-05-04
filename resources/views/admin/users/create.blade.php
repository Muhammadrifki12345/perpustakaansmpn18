<x-app-layout>
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10 animate-fade-in">
        <div class="mb-8">
            <a href="{{ route('pengguna.index') }}" class="text-sm font-bold text-blue-600 hover:underline flex items-center gap-2 mb-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali ke {{ auth()->user()->isSuperAdmin() ? 'Manajemen User' : 'Data Siswa' }}
            </a>
            <h2 class="text-3xl font-black text-gray-900 tracking-tight italic">Tambah Anggota Baru 👤</h2>
            <p class="text-gray-500 mt-1">Daftarkan siswa baru ke dalam sistem perpustakaan.</p>
        </div>

        <div class="surface-card p-8">
            <form action="{{ route('pengguna.store') }}" method="POST">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <!-- Nama Lengkap -->
                    <div class="md:col-span-2">
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name') }}" required
                               class="w-full bg-gray-50 border-gray-100 rounded-2xl px-5 py-4 text-sm font-bold focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all"
                               placeholder="Masukkan nama lengkap siswa...">
                        @error('name') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                    </div>

                    <!-- Email Address -->
                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                               class="w-full bg-gray-50 border-gray-100 rounded-2xl px-5 py-4 text-sm font-bold focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all"
                               placeholder="siswa@sekolah.sch.id">
                        @error('email') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                    </div>

                    <!-- Kelas -->
                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Kelas</label>
                        <input type="text" name="kelas" value="{{ old('kelas') }}" required
                               class="w-full bg-gray-50 border-gray-100 rounded-2xl px-5 py-4 text-sm font-bold focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all"
                               placeholder="Contoh: XII RPL 1">
                        @error('kelas') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Password</label>
                        <input type="password" name="password" required
                               class="w-full bg-gray-50 border-gray-100 rounded-2xl px-5 py-4 text-sm font-bold focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all"
                               placeholder="••••••••">
                        @error('password') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" required
                               class="w-full bg-gray-50 border-gray-100 rounded-2xl px-5 py-4 text-sm font-bold focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all"
                               placeholder="••••••••">
                    </div>

                    @if(auth()->user()->isSuperAdmin())
                    <!-- Role Selection -->
                    <div class="md:col-span-2">
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Role Pengguna</label>
                        <select name="role" class="w-full bg-gray-50 border-gray-100 rounded-2xl px-5 py-4 text-sm font-bold focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                            <option value="siswa">Siswa / Anggota</option>
                            <option value="admin">Pengurus Perpustakaan (Admin)</option>
                            <option value="superadmin">Super Admin</option>
                        </select>
                        @error('role') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                    </div>
                    @endif
                </div>

                <div class="flex items-center justify-end gap-4">
                    <button type="reset" class="px-6 py-4 text-sm font-bold text-gray-500 hover:text-gray-900 transition-colors">Reset Form</button>
                    <button type="submit" class="btn-primary px-10 py-4 shadow-xl shadow-blue-500/20">
                        Simpan Anggota
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
