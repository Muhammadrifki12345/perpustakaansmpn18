<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 animate-fade-in">
            
            <div class="mb-8 px-4 sm:px-0">
                <h2 class="text-2xl font-bold text-gray-800">Selamat Datang, <?php echo e(Auth::user()->name); ?>! 👋</h2>
                <p class="text-gray-500 text-sm">
                    <?php if(auth()->user()->role === 'superadmin'): ?> Panel kontrol utama sistem perpustakaan.
                    <?php elseif(auth()->user()->role === 'admin'): ?> Panel operasional perpustakaan digital.
                    <?php else: ?> Perpustakaan Digital SMPN 18 Surabaya — Temukan buku favoritmu!
                    <?php endif; ?>
                </p>
            </div>

            
            <?php if(auth()->user()->role === 'siswa' && !auth()->user()->is_approved): ?>
                <div class="mb-8 p-6 bg-amber-50 border-2 border-amber-100 rounded-[2rem] flex flex-col md:flex-row items-center gap-6 shadow-xl shadow-amber-100/50 mx-4 sm:mx-0">
                    <div class="w-16 h-16 rounded-2xl bg-amber-500 text-white flex items-center justify-center shrink-0 animate-pulse">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div class="text-center md:text-left">
                        <h3 class="text-lg font-black text-amber-800 uppercase italic">Akunmu Sedang Diverifikasi! ⏳</h3>
                        <p class="text-sm text-amber-600 font-medium">Petugas sedang memeriksa datamu. Kamu bisa melihat-lihat katalog, tapi belum bisa meminjam buku fisik sampai akunmu di-ACC ya!</p>
                    </div>
                </div>
            <?php endif; ?>

            <?php if(auth()->user()->role === 'admin' || auth()->user()->role === 'superadmin'): ?>
                
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6 px-4 sm:px-0">
                    <div class="stat-card">
                        <div class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Total Koleksi</div>
                        <div class="mt-1 text-3xl font-bold text-blue-600"><?php echo e(\App\Models\Book::count()); ?></div>
                        <?php if(($trends['books'] ?? 0) > 0): ?><p class="text-[10px] text-emerald-500 font-bold mt-1">+<?php echo e($trends['books']); ?> hari ini</p><?php endif; ?>
                    </div>
                    <div class="stat-card">
                        <div class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Sedang Dipinjam</div>
                        <div class="mt-1 text-3xl font-bold text-indigo-600"><?php echo e(\App\Models\Loan::where('status','borrowed')->count()); ?></div>
                        <?php if(($trends['loans'] ?? 0) > 0): ?><p class="text-[10px] text-indigo-400 font-bold mt-1">+<?php echo e($trends['loans']); ?> hari ini</p><?php endif; ?>
                    </div>
                    <div class="stat-card">
                        <div class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Anggota Siswa</div>
                        <div class="mt-1 text-3xl font-bold text-emerald-600"><?php echo e(\App\Models\User::where('role','siswa')->count()); ?></div>
                        <?php if(($trends['users'] ?? 0) > 0): ?><p class="text-[10px] text-emerald-400 font-bold mt-1">+<?php echo e($trends['users']); ?> minggu ini</p><?php endif; ?>
                    </div>
                    <?php if(auth()->user()->role === 'admin'): ?>
                    <div class="stat-card">
                        <div class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Menunggu ACC</div>
                        <div class="mt-1 text-3xl font-bold text-amber-500"><?php echo e(\App\Models\Loan::where('status','pending')->count()); ?></div>
                        <a href="<?php echo e(route('admin.persetujuan')); ?>" class="text-[8px] text-amber-600 font-black mt-2 uppercase tracking-tighter no-underline hover:underline">Kelola ACC →</a>
                    </div>
                    <div class="stat-card">
                        <div class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Daftar Tunggu</div>
                        <div class="mt-1 text-3xl font-bold text-red-500"><?php echo e(\App\Models\Waitlist::where('status','waiting')->count()); ?></div>
                        <a href="<?php echo e(route('admin.daftar-tunggu')); ?>" class="text-[8px] text-red-600 font-black mt-2 uppercase tracking-tighter no-underline hover:underline">Lihat Daftar Tunggu →</a>
                    </div>
                    <?php else: ?>
                    <div class="stat-card">
                        <div class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Total Staff</div>
                        <div class="mt-1 text-3xl font-bold text-purple-600"><?php echo e(\App\Models\User::whereIn('role',['admin','superadmin'])->count()); ?></div>
                    </div>
                    <?php endif; ?>
                </div>

                
                <?php if(auth()->user()->role === 'admin'): ?>
                    <?php $overdueCount = \App\Models\Loan::where('status','borrowed')->where('expected_return_date','<',now()->startOfDay())->count(); ?>
                    <?php if($overdueCount > 0): ?>
                    <div class="bg-red-50 border border-red-200 p-5 rounded-xl mb-6 mx-4 sm:mx-0 flex items-center gap-4">
                        <div class="w-10 h-10 bg-red-100 rounded-xl flex items-center justify-center shrink-0">⚠️</div>
                        <div>
                            <p class="text-sm font-bold text-red-800"><?php echo e($overdueCount); ?> peminjaman melewati batas!</p>
                            <p class="text-xs text-red-600 mt-0.5">Segera ingatkan siswa untuk mengembalikan buku.</p>
                        </div>
                        <a href="<?php echo e(route('peminjaman.index')); ?>" class="ml-auto px-4 py-2 bg-red-100 text-red-700 rounded-lg text-xs font-bold hover:bg-red-200 transition no-underline shrink-0">Lihat</a>
                    </div>
                    <?php endif; ?>
                <?php endif; ?>

                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6 px-4 sm:px-0">
                    <div class="insight-card">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center text-sm">📅</div>
                            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Hari Tersibuk</span>
                        </div>
                        <p class="text-lg font-bold text-gray-800"><?php echo e($smartInsights['busiestDay'] ?? 'N/A'); ?></p>
                    </div>
                    <div class="insight-card">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="w-8 h-8 rounded-lg bg-purple-50 flex items-center justify-center text-sm">🏷️</div>
                            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Genre Terpopuler</span>
                        </div>
                        <p class="text-lg font-bold text-gray-800"><?php echo e($smartInsights['topGenre'] ?? 'N/A'); ?></p>
                    </div>
                    <div class="insight-card">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="w-8 h-8 rounded-lg bg-red-50 flex items-center justify-center text-sm">🐢</div>
                            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Sering Terlambat</span>
                        </div>
                        <p class="text-lg font-bold text-gray-800"><?php echo e($smartInsights['mostLateUser'] ?? 'N/A'); ?></p>
                    </div>
                </div>

                
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6 px-4 sm:px-0">
                    
                    <div class="lg:col-span-2 bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wider">Statistik Peminjaman (Tahun <?php echo e(date('Y')); ?>)</h3>
                        </div>
                        <div class="chart-container"><canvas id="loanChart"></canvas></div>
                    </div>
                    
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wider mb-4">Aksi Cepat</h3>
                        <div class="grid grid-cols-2 gap-3">
                            <a href="<?php echo e(route('buku.index')); ?>" class="flex flex-col items-center p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition no-underline">
                                <span class="text-2xl mb-1">📚</span><span class="text-[10px] font-bold text-gray-600">Katalog</span>
                            </a>
                            <?php if(auth()->user()->role === 'admin'): ?>
                            <a href="<?php echo e(route('peminjaman.index')); ?>" class="flex flex-col items-center p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition no-underline text-center">
                                <span class="text-2xl mb-1">📋</span><span class="text-[10px] font-bold text-gray-600 leading-none">Data Peminjaman</span>
                            </a>
                            <a href="<?php echo e(route('admin.persetujuan')); ?>" class="flex flex-col items-center p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition no-underline text-center">
                                <span class="text-2xl mb-1">✅</span><span class="text-[10px] font-bold text-gray-600 leading-none">Persetujuan ACC</span>
                            </a>
                            <a href="<?php echo e(route('admin.daftar-tunggu')); ?>" class="flex flex-col items-center p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition no-underline text-center">
                                <span class="text-2xl mb-1">⏳</span><span class="text-[10px] font-bold text-gray-600 leading-none">Daftar Tunggu</span>
                            </a>
                            <a href="<?php echo e(route('rak.index')); ?>" class="flex flex-col items-center p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition no-underline text-center">
                                <span class="text-2xl mb-1">📦</span><span class="text-[10px] font-bold text-gray-600 leading-none">Rak Buku</span>
                            </a>
                            <?php endif; ?>
                            <?php if(auth()->user()->role === 'superadmin'): ?>
                            <a href="<?php echo e(route('pengguna.index')); ?>" class="flex flex-col items-center p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition no-underline">
                                <span class="text-2xl mb-1">👥</span><span class="text-[10px] font-bold text-gray-600">User</span>
                            </a>
                            <a href="<?php echo e(route('laporan.index')); ?>" class="flex flex-col items-center p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition no-underline">
                                <span class="text-2xl mb-1">📊</span><span class="text-[10px] font-bold text-gray-600">Laporan</span>
                            </a>
                            <a href="<?php echo e(route('pengaturan.index')); ?>" class="flex flex-col items-center p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition no-underline">
                                <span class="text-2xl mb-1">⚙️</span><span class="text-[10px] font-bold text-gray-600">Setting</span>
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6 px-4 sm:px-0">
                    
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wider mb-4">🔥 Buku Terpopuler</h3>
                        <div class="space-y-3">
                            <?php $__empty_1 = true; $__currentLoopData = $popularBooks ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="flex items-center gap-3">
                                <span class="w-6 h-6 rounded-full bg-gray-100 flex items-center justify-center text-[10px] font-bold text-gray-500"><?php echo e($i+1); ?></span>
                                <span class="text-sm font-bold text-gray-700 flex-1 truncate"><?php echo e($b->title); ?></span>
                                <span class="text-xs text-gray-400 font-bold"><?php echo e($b->borrow_count); ?>x</span>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <p class="text-sm text-gray-400 italic text-center py-4">Belum ada data.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <?php if(auth()->user()->role === 'admin'): ?>
                    
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wider mb-4">🏆 Pembaca Teraktif</h3>
                        <div class="space-y-3">
                            <?php $__empty_1 = true; $__currentLoopData = $activeUsers ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="flex items-center gap-3">
                                <span class="w-6 h-6 rounded-full bg-gray-100 flex items-center justify-center text-[10px] font-bold text-gray-500"><?php echo e($i+1); ?></span>
                                <span class="text-sm font-bold text-gray-700 flex-1 truncate"><?php echo e($u->name); ?></span>
                                <span class="text-xs text-gray-400 font-bold"><?php echo e($u->loans_count); ?> buku</span>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <p class="text-sm text-gray-400 italic text-center py-4">Belum ada data.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php else: ?>
                    
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wider mb-4">📊 Aktivitas Sistem</h3>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Total Transaksi</span>
                                <span class="text-sm font-bold text-gray-900"><?php echo e(\App\Models\Loan::count()); ?></span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Aktivitas Hari Ini</span>
                                <span class="text-sm font-bold text-gray-900"><?php echo e(\App\Models\Activity::whereDate('created_at', now())->count()); ?></span>
                            </div>
                            <div class="mt-4 pt-4 border-t border-gray-50 text-center">
                                <a href="<?php echo e(route('laporan.index')); ?>" class="text-[10px] font-bold text-primary uppercase tracking-widest">Detail Laporan Global →</a>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>

                <?php if(auth()->user()->role === 'admin'): ?>
                
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 mx-4 sm:mx-0">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wider">Menunggu Persetujuan</h3>
                        <a href="<?php echo e(route('admin.persetujuan')); ?>" class="text-[10px] font-bold text-blue-600 hover:underline uppercase tracking-wider">Lihat Semua →</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="data-table">
                            <thead><tr><th>Siswa</th><th>Buku</th><th>Invoice</th><th>Status</th><th class="text-right">Aksi</th></tr></thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $globalPendingRequests ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $req): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td class="font-bold text-gray-700"><?php echo e($req->user->name); ?></td>
                                    <td class="text-gray-600"><?php echo e($req->book->title); ?></td>
                                    <td class="text-[10px] text-gray-400 font-mono"><?php echo e($req->invoice_number ?? '-'); ?></td>
                                    <td><span class="badge badge-amber text-[9px]">Menunggu</span></td>
                                    <td class="text-right"><a href="<?php echo e(route('admin.persetujuan')); ?>" class="text-blue-600 text-xs font-bold hover:underline">ACC</a></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr><td colspan="5" class="text-center text-gray-400 italic py-6">Tidak ada permintaan.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php endif; ?>

                
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const monthlyData = <?php echo json_encode($monthlyLoanData ?? [], 15, 512) ?>;
                        
                        // Palette warna-warni premium (seperti contoh gambar)
                        const colorPalette = [
                            'rgba(255, 99, 132, 0.7)',  // Jan
                            'rgba(54, 162, 235, 0.7)',  // Feb
                            'rgba(255, 206, 86, 0.7)',  // Mar
                            'rgba(75, 192, 192, 0.7)',  // Apr
                            'rgba(153, 102, 255, 0.7)', // Mei
                            'rgba(255, 159, 64, 0.7)',  // Jun
                            'rgba(199, 199, 199, 0.7)', // Jul
                            'rgba(83, 102, 255, 0.7)',  // Agu
                            'rgba(40, 167, 69, 0.7)',   // Sep
                            'rgba(220, 53, 69, 0.7)',   // Okt
                            'rgba(23, 162, 184, 0.7)',  // Nov
                            'rgba(102, 16, 242, 0.7)'   // Des
                        ];

                        const ctx = document.getElementById('loanChart');
                        if (!ctx) return;
                        
                        let chart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: monthlyData.map(d => d.month),
                                datasets: [{
                                    label: 'Jumlah Peminjaman',
                                    data: monthlyData.map(d => d.count),
                                    backgroundColor: colorPalette,
                                    borderRadius: 8,
                                    borderSkipped: false,
                                    borderWidth: 1,
                                    borderColor: 'rgba(0,0,0,0.1)'
                                }]
                            },
                            options: {
                                responsive: true, 
                                maintainAspectRatio: false,
                                plugins: { 
                                    legend: { display: false },
                                    tooltip: {
                                        backgroundColor: 'rgba(255,255,255,0.9)',
                                        titleColor: '#1f2937',
                                        bodyColor: '#1f2937',
                                        borderColor: '#e5e7eb',
                                        borderWidth: 1,
                                        padding: 10,
                                        displayColors: false
                                    }
                                },
                                scales: { 
                                    y: { 
                                        beginAtZero: true, 
                                        ticks: { stepSize: 1, font: { weight: 'bold' } },
                                        grid: { color: 'rgba(0,0,0,0.05)' }
                                    }, 
                                    x: { 
                                        grid: { display: false },
                                        ticks: { font: { weight: 'bold', size: 10 } }
                                    } 
                                }
                            }
                        });
                    });
                </script>

            <?php else: ?>
                
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 px-4 sm:px-0">
                    <div class="lg:col-span-2 space-y-6">
                        
                        <?php if(count($spkBooks ?? []) > 0): ?>
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wider">⭐ Buku Terbaik (Paling Direkomendasikan)</h3>
                            </div>
                            <div class="flex gap-4 overflow-x-auto pb-2">
                                <?php $__currentLoopData = $spkBooks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(route('buku.show', $book->id)); ?>" class="shrink-0 w-28 group no-underline">
                                    <div class="h-40 bg-gray-100 rounded-lg overflow-hidden mb-2 shadow-sm group-hover:shadow-md transition">
                                        <?php if($book->cover_image): ?><img src="<?php echo e(asset($book->cover_image)); ?>" class="w-full h-full object-cover">
                                        <?php else: ?> <div class="w-full h-full flex items-center justify-center text-gray-300 font-bold text-2xl bg-gray-200"><?php echo e(substr($book->title,0,1)); ?></div><?php endif; ?>
                                    </div>
                                    <p class="text-[11px] font-bold text-gray-800 line-clamp-2"><?php echo e($book->title); ?></p>
                                    <p class="text-[9px] text-gray-400 font-bold">Kecocokan: <?php echo e(number_format($book->spk_score * 100, 0)); ?>%</p>
                                </a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <?php endif; ?>

                        
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wider">Rekomendasi Untukmu</h3>
                                <a href="<?php echo e(route('buku.index')); ?>" class="text-[10px] font-bold text-blue-600 hover:underline uppercase">Semua →</a>
                            </div>
                            <div class="flex gap-4 overflow-x-auto pb-2">
                                <?php $__currentLoopData = $recommendedBooks ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(route('buku.show', $book->id)); ?>" class="shrink-0 w-28 group no-underline">
                                    <div class="h-40 bg-gray-100 rounded-lg overflow-hidden mb-2 shadow-sm group-hover:shadow-md transition">
                                        <?php if($book->cover_image): ?><img src="<?php echo e(asset($book->cover_image)); ?>" class="w-full h-full object-cover">
                                        <?php else: ?> <div class="w-full h-full flex items-center justify-center text-gray-300 font-bold text-2xl bg-gray-200"><?php echo e(substr($book->title,0,1)); ?></div><?php endif; ?>
                                    </div>
                                    <p class="text-[11px] font-bold text-gray-800 line-clamp-2"><?php echo e($book->title); ?></p>
                                </a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>

                    
                    <div class="space-y-6">
                        
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                            <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wider mb-4">📖 Buku Dipinjam</h3>
                            <div class="space-y-3">
                                <?php $__empty_1 = true; $__currentLoopData = $rakBuku ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <div class="flex items-center gap-3 p-3 rounded-lg bg-gray-50 border border-gray-100">
                                    <div class="w-10 h-14 bg-gray-200 rounded shrink-0 overflow-hidden">
                                        <?php if($loan->book->cover_image): ?><img src="<?php echo e(asset($loan->book->cover_image)); ?>" class="w-full h-full object-cover"><?php endif; ?>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p class="text-xs font-bold text-gray-800 truncate"><?php echo e($loan->book->title); ?></p>
                                        <p class="text-[10px] text-gray-400 mt-0.5">Batas: <?php echo e($loan->expected_return_date ? $loan->expected_return_date->format('d M Y') : '-'); ?></p>
                                        <a href="<?php echo e(route('peminjaman.invoice', $loan->id)); ?>" class="text-[10px] font-bold text-blue-600 hover:underline">Invoice →</a>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <p class="text-sm text-gray-400 italic text-center py-4">Belum ada buku dipinjam.</p>
                                <?php endif; ?>
                            </div>
                        </div>

                        
                        <?php if(count($pendingRequests ?? []) > 0): ?>
                        <div class="bg-amber-50 p-6 rounded-xl shadow-sm border border-amber-100">
                            <h3 class="text-[10px] font-bold text-amber-800 uppercase tracking-wider mb-3">⏳ Menunggu ACC</h3>
                            <div class="space-y-2">
                                <?php $__currentLoopData = $pendingRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="flex items-center gap-2">
                                    <div class="w-2 h-2 bg-amber-500 rounded-full animate-pulse shrink-0"></div>
                                    <span class="text-xs text-amber-700 truncate flex-1"><?php echo e($p->book->title); ?></span>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <?php endif; ?>

                        
                        <?php if(count($waitlists ?? []) > 0): ?>
                        <div class="bg-blue-50 p-6 rounded-xl shadow-sm border border-blue-100">
                            <h3 class="text-[10px] font-bold text-blue-800 uppercase tracking-wider mb-3">📋 Daftar Tunggu Saya</h3>
                            <div class="space-y-2">
                                <?php $__currentLoopData = $waitlists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $w): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="flex items-center gap-2">
                                    <div class="w-2 h-2 bg-blue-500 rounded-full shrink-0"></div>
                                    <span class="text-xs text-blue-700 truncate flex-1"><?php echo e($w->book->title); ?></span>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\Users\H2rtkos\.gemini\antigravity\scratch\perpustakaan-smpn18\resources\views/dashboard.blade.php ENDPATH**/ ?>