<nav x-data="{ open: false }" class="epustaka-nav px-4 lg:px-8">
    <div class="max-w-7xl mx-auto h-full grid grid-cols-2 lg:grid-cols-3 items-center">
        
        <!-- 1. SISI KIRI: Brand/Logo -->
        <div class="flex items-center justify-start">
            <a href="<?php echo e(route('dasbor')); ?>" class="flex items-center gap-3 group no-underline">
                <div class="p-1.5 bg-white rounded-xl shadow-lg shadow-gray-100 group-hover:scale-110 transition-transform duration-300">
                    <?php if (isset($component)) { $__componentOriginal8892e718f3d0d7a916180885c6f012e7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8892e718f3d0d7a916180885c6f012e7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.application-logo','data' => ['class' => 'h-8 w-auto']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('application-logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'h-8 w-auto']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8892e718f3d0d7a916180885c6f012e7)): ?>
<?php $attributes = $__attributesOriginal8892e718f3d0d7a916180885c6f012e7; ?>
<?php unset($__attributesOriginal8892e718f3d0d7a916180885c6f012e7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8892e718f3d0d7a916180885c6f012e7)): ?>
<?php $component = $__componentOriginal8892e718f3d0d7a916180885c6f012e7; ?>
<?php unset($__componentOriginal8892e718f3d0d7a916180885c6f012e7); ?>
<?php endif; ?>
                </div>
                <div class="hidden sm:flex flex-col">
                    <span class="text-[7px] font-black text-gray-400 leading-none tracking-[0.2em] uppercase mb-0.5">E-PUSTAKA</span>
                    <span class="text-sm font-black text-gray-900 leading-none tracking-tighter uppercase">SMPN 18 <span class="text-primary">SBY</span></span>
                </div>
            </a>
        </div>

        <!-- 2. SISI TENGAH: Menu Utama (Centered & Reordered) -->
        <div class="hidden lg:flex items-center justify-center gap-1 z-20">
            <a href="<?php echo e(route('dasbor')); ?>" class="nav-link <?php echo e(request()->routeIs('dasbor') ? 'active' : ''); ?> no-underline">Dashboard</a>
            
            <?php if(auth()->user()->role === 'admin'): ?>
                <a href="<?php echo e(route('buku.index')); ?>" class="nav-link <?php echo e(request()->routeIs('buku.*') ? 'active' : ''); ?> no-underline">Katalog</a>
                <a href="<?php echo e(route('peminjaman.index')); ?>" class="nav-link <?php echo e(request()->routeIs('peminjaman.*') ? 'active' : ''); ?> no-underline">Data Peminjaman</a>
                <a href="<?php echo e(route('admin.persetujuan')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.persetujuan') ? 'active' : ''); ?> no-underline relative">
                    Persetujuan
                    <?php $pendingCount = \App\Models\User::where('role', 'siswa')->where('is_approved', false)->count(); ?>
                    <?php if($pendingCount > 0): ?> <span class="absolute top-2 -right-0.5 h-2 w-2 bg-red-500 rounded-full"></span> <?php endif; ?>
                </a>
                <a href="<?php echo e(route('admin.daftar-tunggu')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.daftar-tunggu') ? 'active' : ''); ?> no-underline">Daftar Tunggu</a>
            <?php elseif(auth()->user()->role === 'superadmin'): ?>
                <a href="<?php echo e(route('admin.daftar-tunggu')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.daftar-tunggu') ? 'active' : ''); ?> no-underline">Daftar Tunggu</a>
                <a href="<?php echo e(route('pengguna.index')); ?>" class="nav-link <?php echo e(request()->routeIs('pengguna.*') ? 'active' : ''); ?> no-underline relative">
                    Akun
                    <?php $pendingCount = \App\Models\User::where('role', 'siswa')->where('is_approved', false)->count(); ?>
                    <?php if($pendingCount > 0): ?> <span class="absolute top-2 -right-0.5 h-2 w-2 bg-red-500 rounded-full"></span> <?php endif; ?>
                </a>
                <a href="<?php echo e(route('laporan.index')); ?>" class="nav-link <?php echo e(request()->routeIs('laporan.*') ? 'active' : ''); ?> no-underline">Laporan</a>
            <?php else: ?>
                <a href="<?php echo e(route('buku.index')); ?>" class="nav-link <?php echo e(request()->routeIs('buku.*') ? 'active' : ''); ?> no-underline">Katalog</a>
                <a href="<?php echo e(route('peminjaman.index')); ?>" class="nav-link <?php echo e(request()->routeIs('peminjaman.*') ? 'active' : ''); ?> no-underline relative">
                    Pinjaman
                    <?php $hasWaitlist = \App\Models\Waitlist::where('user_id', auth()->id())->where('status', 'waiting')->exists(); ?>
                    <?php if($hasWaitlist): ?> <span class="absolute top-2 -right-0.5 h-2 w-2 bg-emerald-500 rounded-full"></span> <?php endif; ?>
                </a>
                <a href="<?php echo e(route('favorit.index')); ?>" class="nav-link <?php echo e(request()->routeIs('favorit.*') ? 'active' : ''); ?> no-underline">Favorit</a>
            <?php endif; ?>
        </div>

        <!-- 3. SISI KANAN: Profil & Hamburger -->
        <div class="flex items-center justify-end gap-4">
            <div class="hidden sm:flex flex-col text-right">
                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest leading-none mb-0.5"><?php echo e(Auth::user()->role_name); ?></p>
                <p class="text-xs font-black text-gray-900 leading-none"><?php echo e(Auth::user()->name); ?></p>
            </div>
            
            <?php if (isset($component)) { $__componentOriginaldf8083d4a852c446488d8d384bbc7cbe = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldf8083d4a852c446488d8d384bbc7cbe = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dropdown','data' => ['align' => 'right','width' => '56']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dropdown'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['align' => 'right','width' => '56']); ?>
                 <?php $__env->slot('trigger', null, []); ?> 
                    <button class="flex items-center group">
                        <div class="w-10 h-10 rounded-xl bg-gray-50 flex items-center justify-center font-black text-primary text-sm shadow-inner group-hover:bg-primary group-hover:text-white transition-all duration-300">
                            <?php echo e(substr(Auth::user()->name, 0, 1)); ?>

                        </div>
                    </button>
                 <?php $__env->endSlot(); ?>
                 <?php $__env->slot('content', null, []); ?> 
                    <div class="px-4 py-3 bg-gray-50/50 border-b border-gray-100">
                        <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Akun Saya</p>
                        <p class="text-xs font-bold text-gray-900 truncate"><?php echo e(Auth::user()->email); ?></p>
                    </div>
                    
                    <?php if (isset($component)) { $__componentOriginal68cb1971a2b92c9735f83359058f7108 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal68cb1971a2b92c9735f83359058f7108 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dropdown-link','data' => ['href' => route('profil.edit')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dropdown-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('profil.edit'))]); ?>Profil Saya <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal68cb1971a2b92c9735f83359058f7108)): ?>
<?php $attributes = $__attributesOriginal68cb1971a2b92c9735f83359058f7108; ?>
<?php unset($__attributesOriginal68cb1971a2b92c9735f83359058f7108); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal68cb1971a2b92c9735f83359058f7108)): ?>
<?php $component = $__componentOriginal68cb1971a2b92c9735f83359058f7108; ?>
<?php unset($__componentOriginal68cb1971a2b92c9735f83359058f7108); ?>
<?php endif; ?>

                    <?php if(auth()->user()->isSiswa()): ?>
                        <?php if (isset($component)) { $__componentOriginal68cb1971a2b92c9735f83359058f7108 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal68cb1971a2b92c9735f83359058f7108 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dropdown-link','data' => ['href' => route('favorit.index')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dropdown-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('favorit.index'))]); ?>Koleksi Favorit <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal68cb1971a2b92c9735f83359058f7108)): ?>
<?php $attributes = $__attributesOriginal68cb1971a2b92c9735f83359058f7108; ?>
<?php unset($__attributesOriginal68cb1971a2b92c9735f83359058f7108); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal68cb1971a2b92c9735f83359058f7108)): ?>
<?php $component = $__componentOriginal68cb1971a2b92c9735f83359058f7108; ?>
<?php unset($__componentOriginal68cb1971a2b92c9735f83359058f7108); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginal68cb1971a2b92c9735f83359058f7108 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal68cb1971a2b92c9735f83359058f7108 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dropdown-link','data' => ['href' => route('peminjaman.index')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dropdown-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('peminjaman.index'))]); ?>Riwayat Pinjam <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal68cb1971a2b92c9735f83359058f7108)): ?>
<?php $attributes = $__attributesOriginal68cb1971a2b92c9735f83359058f7108; ?>
<?php unset($__attributesOriginal68cb1971a2b92c9735f83359058f7108); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal68cb1971a2b92c9735f83359058f7108)): ?>
<?php $component = $__componentOriginal68cb1971a2b92c9735f83359058f7108; ?>
<?php unset($__componentOriginal68cb1971a2b92c9735f83359058f7108); ?>
<?php endif; ?>
                    <?php endif; ?>

                    <?php if(auth()->user()->role === 'admin'): ?>
                        <div class="border-t border-gray-100 my-1"></div>
                        <p class="px-4 py-1 text-[9px] font-black text-gray-400 uppercase">Operasional Perpus</p>
                        <?php if (isset($component)) { $__componentOriginal68cb1971a2b92c9735f83359058f7108 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal68cb1971a2b92c9735f83359058f7108 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dropdown-link','data' => ['href' => route('admin.daftar-tunggu')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dropdown-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.daftar-tunggu'))]); ?>Daftar Tunggu <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal68cb1971a2b92c9735f83359058f7108)): ?>
<?php $attributes = $__attributesOriginal68cb1971a2b92c9735f83359058f7108; ?>
<?php unset($__attributesOriginal68cb1971a2b92c9735f83359058f7108); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal68cb1971a2b92c9735f83359058f7108)): ?>
<?php $component = $__componentOriginal68cb1971a2b92c9735f83359058f7108; ?>
<?php unset($__componentOriginal68cb1971a2b92c9735f83359058f7108); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginal68cb1971a2b92c9735f83359058f7108 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal68cb1971a2b92c9735f83359058f7108 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dropdown-link','data' => ['href' => route('kategori.index')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dropdown-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('kategori.index'))]); ?>Kelola Kategori <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal68cb1971a2b92c9735f83359058f7108)): ?>
<?php $attributes = $__attributesOriginal68cb1971a2b92c9735f83359058f7108; ?>
<?php unset($__attributesOriginal68cb1971a2b92c9735f83359058f7108); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal68cb1971a2b92c9735f83359058f7108)): ?>
<?php $component = $__componentOriginal68cb1971a2b92c9735f83359058f7108; ?>
<?php unset($__componentOriginal68cb1971a2b92c9735f83359058f7108); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginal68cb1971a2b92c9735f83359058f7108 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal68cb1971a2b92c9735f83359058f7108 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dropdown-link','data' => ['href' => route('penerbit.index')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dropdown-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('penerbit.index'))]); ?>Kelola Penerbit <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal68cb1971a2b92c9735f83359058f7108)): ?>
<?php $attributes = $__attributesOriginal68cb1971a2b92c9735f83359058f7108; ?>
<?php unset($__attributesOriginal68cb1971a2b92c9735f83359058f7108); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal68cb1971a2b92c9735f83359058f7108)): ?>
<?php $component = $__componentOriginal68cb1971a2b92c9735f83359058f7108; ?>
<?php unset($__componentOriginal68cb1971a2b92c9735f83359058f7108); ?>
<?php endif; ?>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('superadmin-only')): ?>
                        <div class="border-t border-gray-100 my-1"></div>
                        <p class="px-4 py-1 text-[9px] font-black text-gray-400 uppercase">Sistem & Global</p>
                        <?php if (isset($component)) { $__componentOriginal68cb1971a2b92c9735f83359058f7108 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal68cb1971a2b92c9735f83359058f7108 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dropdown-link','data' => ['href' => route('pengaturan.index')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dropdown-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('pengaturan.index'))]); ?>Konfigurasi Sistem <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal68cb1971a2b92c9735f83359058f7108)): ?>
<?php $attributes = $__attributesOriginal68cb1971a2b92c9735f83359058f7108; ?>
<?php unset($__attributesOriginal68cb1971a2b92c9735f83359058f7108); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal68cb1971a2b92c9735f83359058f7108)): ?>
<?php $component = $__componentOriginal68cb1971a2b92c9735f83359058f7108; ?>
<?php unset($__componentOriginal68cb1971a2b92c9735f83359058f7108); ?>
<?php endif; ?>
                    <?php endif; ?>

                    <div class="border-t border-gray-100 mt-1">
                        <form method="POST" action="<?php echo e(route('logout')); ?>">
                            <?php echo csrf_field(); ?>
                            <?php if (isset($component)) { $__componentOriginal68cb1971a2b92c9735f83359058f7108 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal68cb1971a2b92c9735f83359058f7108 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dropdown-link','data' => ['href' => route('logout'),'onclick' => 'event.preventDefault(); this.closest(\'form\').submit();','class' => 'text-red-600 font-bold']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dropdown-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('logout')),'onclick' => 'event.preventDefault(); this.closest(\'form\').submit();','class' => 'text-red-600 font-bold']); ?>
                                Keluar
                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal68cb1971a2b92c9735f83359058f7108)): ?>
<?php $attributes = $__attributesOriginal68cb1971a2b92c9735f83359058f7108; ?>
<?php unset($__attributesOriginal68cb1971a2b92c9735f83359058f7108); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal68cb1971a2b92c9735f83359058f7108)): ?>
<?php $component = $__componentOriginal68cb1971a2b92c9735f83359058f7108; ?>
<?php unset($__componentOriginal68cb1971a2b92c9735f83359058f7108); ?>
<?php endif; ?>
                        </form>
                    </div>
                 <?php $__env->endSlot(); ?>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldf8083d4a852c446488d8d384bbc7cbe)): ?>
<?php $attributes = $__attributesOriginaldf8083d4a852c446488d8d384bbc7cbe; ?>
<?php unset($__attributesOriginaldf8083d4a852c446488d8d384bbc7cbe); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldf8083d4a852c446488d8d384bbc7cbe)): ?>
<?php $component = $__componentOriginaldf8083d4a852c446488d8d384bbc7cbe; ?>
<?php unset($__componentOriginaldf8083d4a852c446488d8d384bbc7cbe); ?>
<?php endif; ?>

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
        <a href="<?php echo e(route('dasbor')); ?>" class="block px-4 py-3 rounded-xl text-sm font-bold <?php echo e(request()->routeIs('dasbor') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-50'); ?> no-underline">Dashboard</a>
        
        <?php if(auth()->user()->role === 'admin'): ?>
            <div class="pt-2 pb-1 px-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Petugas</div>
            <a href="<?php echo e(route('buku.index')); ?>" class="block px-4 py-3 rounded-xl text-sm font-bold <?php echo e(request()->routeIs('buku.*') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-50'); ?> no-underline">Katalog</a>
            <a href="<?php echo e(route('peminjaman.index')); ?>" class="block px-4 py-3 rounded-xl text-sm font-bold <?php echo e(request()->routeIs('peminjaman.*') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-50'); ?> no-underline">Data Peminjaman</a>
            <a href="<?php echo e(route('admin.persetujuan')); ?>" class="block px-4 py-3 rounded-xl text-sm font-bold <?php echo e(request()->routeIs('admin.persetujuan') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-50'); ?> no-underline">Persetujuan ACC</a>
            <a href="<?php echo e(route('admin.daftar-tunggu')); ?>" class="block px-4 py-3 rounded-xl text-sm font-bold <?php echo e(request()->routeIs('admin.daftar-tunggu') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-50'); ?> no-underline">Daftar Tunggu</a>
        <?php elseif(auth()->user()->role === 'superadmin'): ?>
            <div class="pt-2 pb-1 px-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Super Admin</div>
            <a href="<?php echo e(route('admin.daftar-tunggu')); ?>" class="block px-4 py-3 rounded-xl text-sm font-bold <?php echo e(request()->routeIs('admin.daftar-tunggu') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-50'); ?> no-underline">Daftar Tunggu</a>
            <a href="<?php echo e(route('pengguna.index')); ?>" class="block px-4 py-3 rounded-xl text-sm font-bold <?php echo e(request()->routeIs('pengguna.*') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-50'); ?> no-underline">Kelola Akun</a>
            <a href="<?php echo e(route('laporan.index')); ?>" class="block px-4 py-3 rounded-xl text-sm font-bold <?php echo e(request()->routeIs('laporan.*') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-50'); ?> no-underline">Laporan Global</a>
        <?php else: ?>
            <div class="pt-2 pb-1 px-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Siswa</div>
            <a href="<?php echo e(route('buku.index')); ?>" class="block px-4 py-3 rounded-xl text-sm font-bold <?php echo e(request()->routeIs('buku.*') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-50'); ?> no-underline">Katalog</a>
            <a href="<?php echo e(route('peminjaman.index')); ?>" class="block px-4 py-3 rounded-xl text-sm font-bold <?php echo e(request()->routeIs('peminjaman.*') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-50'); ?> no-underline">Pinjaman Saya</a>
            <a href="<?php echo e(route('favorit.index')); ?>" class="block px-4 py-3 rounded-xl text-sm font-bold <?php echo e(request()->routeIs('favorit.*') ? 'bg-primary text-white' : 'text-gray-700 hover:bg-gray-50'); ?> no-underline">Favorit Saya</a>
        <?php endif; ?>
    </div>
</nav>
<?php /**PATH C:\Users\H2rtkos\.gemini\antigravity\scratch\perpustakaan-smpn18\resources\views/layouts/navigation.blade.php ENDPATH**/ ?>