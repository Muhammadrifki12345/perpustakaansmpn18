<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 animate-fade-in">
        <div class="flex items-center justify-between mb-10">
            <div>
                <div class="flex items-center gap-2 mb-2">
                    <span
                        class="px-3 py-1 rounded-full bg-blue-50 text-blue-600 text-[9px] font-black uppercase tracking-widest border border-blue-100">Database
                        Master</span>
                </div>
                <h2 class="text-4xl font-black text-gray-900 tracking-tight italic uppercase">
                    {{ auth()->user()->isSuperAdmin() ? 'Manajemen User 👤' : 'Data Siswa 👤' }}</h2>
                <p class="text-sm text-gray-500 mt-1 font-medium italic">Monitor data anggota, proses aktivasi, dan
                    kelola hak akses sistem.</p>
            </div>
            <a href="{{ route('pengguna.create') }}"
                class="flex items-center gap-3 px-8 py-4 bg-gray-900 text-white rounded-[2rem] font-black text-xs uppercase tracking-widest hover:bg-black transition-all shadow-xl shadow-gray-200 italic">
                <div class="w-6 h-6 rounded-lg bg-white/20 flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                </div>
                Tambah {{ auth()->user()->isSuperAdmin() ? 'Pengguna' : 'Siswa' }}
            </a>
        </div>

        <!-- QUICK STATS -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
            <div class="bg-white p-6 rounded-[2rem] border border-gray-100 shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Total Anggota</p>
                    <p class="text-2xl font-black text-gray-900">{{ \App\Models\User::where('role', 'siswa')->count() }}
                    </p>
                </div>
            </div>
            <div
                class="bg-white p-6 rounded-[2rem] border border-gray-100 shadow-sm flex items-center gap-4 border-l-4 border-l-amber-400">
                <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Menunggu ACC</p>
                    <p class="text-2xl font-black text-amber-600">
                        {{ \App\Models\User::where('is_approved', false)->count() }}</p>
                </div>
            </div>
            @if(auth()->user()->isSuperAdmin())
                <div class="bg-white p-6 rounded-[2rem] border border-gray-100 shadow-sm flex items-center gap-4">
                    <div
                        class="w-12 h-12 rounded-2xl bg-purple-50 text-purple-600 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Admin/Pengurus</p>
                        <p class="text-2xl font-black text-purple-600">
                            {{ \App\Models\User::where('role', 'admin')->count() }}</p>
                    </div>
                </div>
            @endif
            <div class="bg-gray-900 p-6 rounded-[2rem] text-white flex items-center gap-4 shadow-xl shadow-gray-200">
                <div class="w-12 h-12 rounded-2xl bg-white/10 text-white flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <div>
                    <p class="text-[10px] font-black text-gray-500 uppercase tracking-widest">Siswa Aktif</p>
                    <p class="text-2xl font-black text-white">{{ $users->where('is_active', true)->count() }}</p>
                </div>
            </div>
        </div>

        <!-- TABS -->
        <div class="flex items-center gap-6 mb-8 border-b border-gray-100 pb-1">
            <a href="{{ route('pengguna.index') }}"
                class="pb-4 text-xs font-black uppercase tracking-widest transition-all {{ (!request('filter') && !request('role')) ? 'text-blue-600 border-b-4 border-blue-600' : 'text-gray-400 hover:text-gray-600 border-b-4 border-transparent' }}">
                {{ auth()->user()->isSuperAdmin() ? 'Semua Pengguna' : 'Anggota Aktif (ACC)' }}
            </a>
            @if(auth()->user()->isSuperAdmin())
                <a href="{{ route('pengguna.index', ['role' => 'admin']) }}"
                    class="pb-4 text-xs font-black uppercase tracking-widest transition-all {{ request('role') === 'admin' ? 'text-purple-600 border-b-4 border-purple-600' : 'text-gray-400 hover:text-gray-600 border-b-4 border-transparent' }}">
                    Pengurus (Admin)
                </a>
                <a href="{{ route('pengguna.index', ['role' => 'superadmin']) }}"
                    class="pb-4 text-xs font-black uppercase tracking-widest transition-all {{ request('role') === 'superadmin' ? 'text-red-600 border-b-4 border-red-600' : 'text-gray-400 hover:text-gray-600 border-b-4 border-transparent' }}">
                    Super Admin
                </a>
            @endif
            <a href="{{ route('pengguna.index', ['filter' => 'pending']) }}"
                class="pb-4 text-xs font-black uppercase tracking-widest transition-all {{ request('filter') === 'pending' ? 'text-amber-500 border-b-4 border-amber-500' : 'text-gray-400 hover:text-gray-600 border-b-4 border-transparent' }}">
                Menunggu Persetujuan
                @php $pendingCount = \App\Models\User::where('role', 'siswa')->where('is_approved', false)->count(); @endphp
                @if($pendingCount > 0)
                    <span
                        class="ml-2 bg-amber-100 text-amber-600 px-2 py-0.5 rounded-full text-[10px]">{{ $pendingCount }}</span>
                @endif
            </a>
        </div>

        <div class="surface-card overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-100">
                            <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-gray-400 w-16">No.
                            </th>
                            <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-gray-400">
                                {{ auth()->user()->isSuperAdmin() ? 'Identitas Pengguna' : 'Identitas Siswa' }}</th>
                            @if(auth()->user()->isSuperAdmin())
                                <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-gray-400">Role</th>
                            @endif
                            <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-gray-400">Kelas / Unit
                            </th>
                            <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-gray-400">Status</th>
                            <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-gray-400 text-center">
                                Pinjam</th>
                            <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-gray-400 text-right">
                                Kelola</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($users as $u)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4 text-sm font-bold text-gray-500">
                                    {{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}
                                </td>
                                <td class="px-6 py-4">
                                    <div>
                                        <div class="text-sm font-black text-gray-900 italic">{{ $u->name }}</div>
                                        <div class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">
                                            {{ $u->email }}</div>
                                    </div>
                                </td>
                                @if(auth()->user()->isSuperAdmin())
                                    <td class="px-6 py-4">
                                        @if($u->role === 'superadmin')
                                            <span
                                                class="bg-red-50 text-red-600 px-3 py-1 rounded-xl text-[10px] font-black uppercase tracking-tighter border border-red-100">Super
                                                Admin</span>
                                        @elseif($u->role === 'admin')
                                            <span
                                                class="bg-purple-50 text-purple-600 px-3 py-1 rounded-xl text-[10px] font-black uppercase tracking-tighter border border-purple-100">Pengurus</span>
                                        @else
                                            <span
                                                class="bg-blue-50 text-blue-600 px-3 py-1 rounded-xl text-[10px] font-black uppercase tracking-tighter border border-blue-100">Siswa</span>
                                        @endif
                                    </td>
                                @endif
                                <td class="px-6 py-4">
                                    <span
                                        class="text-[10px] font-black text-gray-500 px-3 py-1 bg-gray-100 rounded-xl uppercase tracking-tighter">
                                        {{ $u->kelas ?? ($u->role !== 'siswa' ? 'STAFF' : 'TIDAK ADA') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @if(!$u->is_approved)
                                        <span
                                            class="bg-amber-50 text-amber-600 px-3 py-1.5 rounded-2xl text-[10px] font-black animate-pulse uppercase tracking-widest border border-amber-100">
                                            MENUNGGU ACC
                                        </span>
                                    @elseif($u->is_active)
                                        <span
                                            class="bg-blue-50 text-blue-600 px-3 py-1.5 rounded-2xl text-[10px] font-black uppercase tracking-widest border border-blue-100">
                                            AKTIF
                                        </span>
                                    @else
                                        <span
                                            class="bg-gray-100 text-gray-400 px-3 py-1.5 rounded-2xl text-[10px] font-black uppercase tracking-widest">
                                            PASIF
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="text-xs font-black text-blue-600">{{ $u->loans_count }}</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        @if(!$u->is_approved)
                                            <form action="{{ route('pengguna.approve', $u->id) }}" method="POST"
                                                class="inline-block">
                                                @csrf
                                                <button type="submit"
                                                    class="bg-emerald-500 text-white px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-emerald-600 transition-all shadow-md shadow-emerald-500/20">
                                                    ACC Akun
                                                </button>
                                            </form>
                                        @endif

                                        <a href="{{ route('pengguna.edit', $u->id) }}"
                                            class="p-2 text-blue-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('pengguna.destroy', $u->id) }}" method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun ini? Semua riwayat pinjamannya juga akan terhapus.')"
                                            class="inline-block">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                class="p-2 text-red-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ auth()->user()->isSuperAdmin() ? '7' : '6' }}"
                                    class="px-6 py-12 text-center">
                                    <div class="text-gray-300 mb-2">
                                        <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                    <p class="text-gray-500">Belum ada anggota siswa yang terdaftar.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-6">
            {{ $users->links() }}
        </div>
    </div>
</x-app-layout>
