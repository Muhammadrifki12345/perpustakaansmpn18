<nav x-data="{ open: false }" class="epustaka-nav px-4 lg:px-8">
    <div class="max-w-7xl mx-auto h-full grid grid-cols-2 lg:grid-cols-3 items-center">
        
        <!-- 1. SISI KIRI: Brand/Logo -->
        <div class="flex items-center justify-start">
            <a href="{{ route('dasbor') }}" class="flex items-center gap-3 group no-underline">
                <div class="p-1.5 bg-white rounded-xl shadow-lg shadow-gray-100 group-hover:scale-110 transition-transform duration-300">
                    <x-application-logo class="h-8 w-auto" />
                </div>
                <div class="hidden sm:flex flex-col">
                    <span class="text-[7px] font-black text-gray-400 leading-none tracking-[0.2em] uppercase mb-0.5">E-PUSTAKA</span>
                    <span class="text-sm font-black text-gray-900 leading-none tracking-tighter uppercase">SMPN 18 <span class="text-primary">SBY</span></span>
                </div>
            </a>
        </div>

        <!-- 2. SISI TENGAH: Menu Utama (Centered & Reordered) -->
        <div class="hidden lg:flex items-center justify-center gap-1 z-20">
            <a href="{{ route('dasbor') }}" class="nav-link {{ request()->routeIs('dasbor') ? 'active' : '' }} no-underline">Dashboard</a>
            
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('buku.index') }}" class="nav-link {{ request()->routeIs('buku.*') ? 'active' : '' }} no-underline">Katalog</a>
                <a href="{{ route('peminjaman.index') }}" class="nav-link {{ request()->routeIs('peminjaman.*') ? 'active' : '' }} no-underline">Data Peminjaman</a>
                <a href="{{ route('admin.persetujuan') }}" class="nav-link {{ request()->routeIs('admin.persetujuan') ? 'active' : '' }} no-underline relative">
                    Persetujuan
                    @php $pendingCount = \App\Models\User::where('role', 'siswa')->where('is_approved', false)->count(); @endphp
                    @if($pendingCount > 0) <span class="absolute top-2 -right-0.5 h-2 w-2 bg-red-500 rounded-full"></span> @endif
                </a>
                <a href="{{ route('admin.daftar-tunggu') }}" class="nav-link {{ request()->routeIs('admin.daftar-tunggu') ? 'active' : '' }} no-underline">Daftar Tunggu</a>
            @elseif(auth()->user()->role === 'superadmin')
                <a href="{{ route('admin.daftar-tunggu') }}" class="nav-link {{ request()->routeIs('admin.daftar-tunggu') ? 'active' : '' }} no-underline">Daftar Tunggu</a>
                <a href="{{ route('pengguna.index') }}" class="nav-link {{ request()->routeIs('pengguna.*') ? 'active' : '' }} no-underline relative">
                    Akun
                    @php $pendingCount = \App\Models\User::where('role', 'siswa')->where('is_approved', false)->count(); @endphp
                    @if($pendingCount > 0) <span class="absolute top-2 -right-0.5 h-2 w-2 bg-red-500 rounded-full"></span> @endif
                </a>
                <a href="{{ route('laporan.index') }}" class="nav-link {{ request()->routeIs('laporan.*') ? 'active' : '' }} no-underline">Laporan</a>
            @else
                <a href="{{ route('buku.index') }}" class="nav-link {{ request()->routeIs('buku.*') ? 'active' : '' }} no-underline">Katalog</a>
                <a href="{{ route('peminjaman.index') }}" class="nav-link {{ request()->routeIs('peminjaman.*') ? 'active' : '' }} no-underline relative">
                    Pinjaman
                    @php $hasWaitlist = \App\Models\Waitlist::where('user_id', auth()->id())->where('status', 'waiting')->exists(); @endphp
                    @if($hasWaitlist) <span class="absolute top-2 -right-0.5 h-2 w-2 bg-emerald-500 rounded-full"></span> @endif
                </a>
                <a href="{{ route('favorit.index') }}" class="nav-link {{ request()->routeIs('favorit.*') ? 'active' : '' }} no-underline">Favorit</a>
            @endif
        </div>

        <!-- 3. SISI KANAN: Profil & Hamburger -->
        <div class="flex items-center justify-end gap-4">
            <div class="hidden sm:flex flex-col text-right">
                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest leading-none mb-0.5">{{ Auth::user()->role_name }}</p>
                <p class="text-xs font-black text-gray-900 leading-none">{{ Auth::user()->name }}</p>
            </div>
            
            <x-dropdown align="right" width="56">
                <x-slot name="trigger">
                    <button class="flex items-center group">
                        <div class="w-10 h-10 rounded-xl bg-gray-50 flex items-center justify-center font-black text-primary text-sm shadow-inner group-hover:bg-primary group-hover:text-white transition-all duration-300">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                    </button>
                </x-slot>
                <x-slot name="content">
                    <div class="px-4 py-3 bg-gray-50/50 border-b border-gray-100">
                        <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Akun Saya</p>
                        <p class="text-xs font-bold text-gray-900 truncate">{{ Auth::user()->email }}</p>
                    </div>
                    
                    <x-dropdown-link :href="route('profil.edit')">Profil Saya</x-dropdown-link>

                    @if(auth()->user()->isSiswa())
                        <x-dropdown-link :href="route('favorit.index')">Koleksi Favorit</x-dropdown-link>
                        <x-dropdown-link :href="route('peminjaman.index')">Riwayat Pinjam</x-dropdown-link>
                    @endif

                    @if(auth()->user()->role === 'admin')
                        <div class="border-t border-gray-100 my-1"></div>
                        <p class="px-4 py-1 text-[9px] font-black text-gray-400 uppercase">Operasional Perpus</p>
                        <x-dropdown-link :href="route('admin.daftar-tunggu')">Daftar Tunggu</x-dropdown-link>
                        <x-dropdown-link :href="route('kategori.index')">Kelola Kategori</x-dropdown-link>
                        <x-dropdown-link :href="route('penerbit.index')">Kelola Penerbit</x-dropdown-link>
                    @endif

                    @can('superadmin-only')
                        <div class="border-t border-gray-100 my-1"></div>
                        <p class="px-4 py-1 text-[9px] font-black text-gray-400 uppercase">Sistem & Global</p>
                        <x-dropdown-link :href="route('pengaturan.index')">Konfigurasi Sistem</x-dropdown-link>
                    @endcan

                    <div class="border-t border-gray-100 mt-1">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-red-600 font-bold">
                                Keluar
                            </x-dropdown-link>
                        </form>
                    </div>
                </x-slot>
            </x-dropdown>

            <!-- Mobile Hamburger -->
            <button @click="open = !open" class="lg:hidden p-2 rounded-xl hover:bg-gray-100 transition">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="open" x-transition class="lg:hidden absolute top-[80px] left-0 right-0 bg-white border-b border-gray-100 shadow-lg z-50 p-4 space-y-1">
        <a href="{{ route('dasbor') }}" class="block px-4 py-3 rounded-xl text-sm font-bold {{ request()->routeIs('dasbor') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-50' }} no-underline">Dashboard</a>
        
        @if(auth()->user()->role === 'admin')
            <div class="pt-2 pb-1 px-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Petugas</div>
            <a href="{{ route('buku.index') }}" class="block px-4 py-3 rounded-xl text-sm font-bold {{ request()->routeIs('buku.*') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-50' }} no-underline">Katalog</a>
            <a href="{{ route('peminjaman.index') }}" class="block px-4 py-3 rounded-xl text-sm font-bold {{ request()->routeIs('peminjaman.*') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-50' }} no-underline">Data Peminjaman</a>
            <a href="{{ route('admin.persetujuan') }}" class="block px-4 py-3 rounded-xl text-sm font-bold {{ request()->routeIs('admin.persetujuan') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-50' }} no-underline">Persetujuan ACC</a>
            <a href="{{ route('admin.daftar-tunggu') }}" class="block px-4 py-3 rounded-xl text-sm font-bold {{ request()->routeIs('admin.daftar-tunggu') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-50' }} no-underline">Daftar Tunggu</a>
        @elseif(auth()->user()->role === 'superadmin')
            <div class="pt-2 pb-1 px-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Super Admin</div>
            <a href="{{ route('admin.daftar-tunggu') }}" class="block px-4 py-3 rounded-xl text-sm font-bold {{ request()->routeIs('admin.daftar-tunggu') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-50' }} no-underline">Daftar Tunggu</a>
            <a href="{{ route('pengguna.index') }}" class="block px-4 py-3 rounded-xl text-sm font-bold {{ request()->routeIs('pengguna.*') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-50' }} no-underline">Kelola Akun</a>
            <a href="{{ route('laporan.index') }}" class="block px-4 py-3 rounded-xl text-sm font-bold {{ request()->routeIs('laporan.*') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-50' }} no-underline">Laporan Global</a>
        @else
            <div class="pt-2 pb-1 px-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Siswa</div>
            <a href="{{ route('buku.index') }}" class="block px-4 py-3 rounded-xl text-sm font-bold {{ request()->routeIs('buku.*') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-50' }} no-underline">Katalog</a>
            <a href="{{ route('peminjaman.index') }}" class="block px-4 py-3 rounded-xl text-sm font-bold {{ request()->routeIs('peminjaman.*') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-50' }} no-underline">Pinjaman Saya</a>
            <a href="{{ route('favorit.index') }}" class="block px-4 py-3 rounded-xl text-sm font-bold {{ request()->routeIs('favorit.*') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-50' }} no-underline">Favorit Saya</a>
        @endif
    </div>
</nav>
