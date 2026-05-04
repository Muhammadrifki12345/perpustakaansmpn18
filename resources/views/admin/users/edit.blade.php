<x-app-layout>
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10 animate-fade-in">
        <div class="mb-8 flex items-center justify-between">
            <div>
                <a href="{{ route('pengguna.index') }}" class="text-sm font-bold text-blue-600 hover:underline flex items-center gap-2 mb-4">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Kembali ke {{ auth()->user()->isSuperAdmin() ? 'Manajemen User' : 'Data Siswa' }}
                </a>
                <h2 class="text-3xl font-black text-gray-900 tracking-tight italic">Edit Data Anggota 📝</h2>
                <p class="text-gray-500 mt-1">Perbarui informasi profil dan kelas siswa.</p>
            </div>
            <div class="nav-avatar w-16 h-16 text-xl shadow-md">{{ strtoupper(substr($user->name,0,1)) }}</div>
        </div>

        <div class="surface-card p-8">
            <form action="{{ route('pengguna.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <!-- Nama Lengkap -->
                    <div class="md:col-span-2">
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                               class="w-full bg-gray-50 border-gray-100 rounded-2xl px-5 py-4 text-sm font-bold focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all"
                               placeholder="Masukkan nama lengkap siswa...">
                        @error('name') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                    </div>

                    <!-- Email Address -->
                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                               class="w-full bg-gray-50 border-gray-100 rounded-2xl px-5 py-4 text-sm font-bold focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all"
                               placeholder="siswa@sekolah.sch.id">
                        @error('email') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                    </div>

                    <!-- Kelas -->
                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Kelas / Unit</label>
                        <input type="text" name="kelas" value="{{ old('kelas', $user->kelas) }}" 
                               class="w-full bg-gray-50 border-gray-100 rounded-2xl px-5 py-4 text-sm font-bold focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all"
                               placeholder="Contoh: XII RPL 1">
                        @error('kelas') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                    </div>

                    @if(auth()->user()->isSuperAdmin())
                    <!-- Role Selection -->
                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Role Pengguna</label>
                        <select name="role" class="w-full bg-gray-50 border-gray-100 rounded-2xl px-5 py-4 text-sm font-bold focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                            <option value="siswa" {{ $user->role === 'siswa' ? 'selected' : '' }}>Siswa / Anggota</option>
                            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Pengurus Perpustakaan (Admin)</option>
                            <option value="superadmin" {{ $user->role === 'superadmin' ? 'selected' : '' }}>Super Admin</option>
                        </select>
                        @error('role') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                    </div>
                    @endif

                    <!-- Password -->
                    <div class="md:col-span-2 mt-4 p-6 bg-blue-50/50 rounded-3xl border border-blue-100">
                        <div class="flex items-center gap-3 mb-4">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            <h3 class="text-xs font-black text-blue-600 uppercase tracking-widest">Keamanan (Opsional)</h3>
                        </div>
                        <p class="text-[10px] text-blue-400 font-bold mb-4 uppercase">Kosongkan jika tidak ingin mengganti password</p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Password Baru</label>
                                <input type="password" name="password"
                                       class="w-full bg-white border-blue-50 rounded-2xl px-5 py-4 text-sm font-bold focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all"
                                       placeholder="••••••••">
                                @error('password') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Konfirmasi Password Baru</label>
                                <input type="password" name="password_confirmation"
                                       class="w-full bg-white border-blue-50 rounded-2xl px-5 py-4 text-sm font-bold focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all"
                                       placeholder="••••••••">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-4 mt-8 pt-8 border-t border-gray-50">
                    <button type="submit" class="btn-primary px-12 py-4 shadow-xl shadow-blue-500/20">
                        Perbarui Data Siswa
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
