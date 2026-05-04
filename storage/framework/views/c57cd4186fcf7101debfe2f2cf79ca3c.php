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
    <style>
        @media print {
            .no-print { display: none !important; }
            body { background: white !important; }
            .surface-card { box-shadow: none !important; border: 1px solid #eee !important; }
            .dash-wrap { padding: 0 !important; }
        }
    </style>

    <div class="dash-wrap animate-fade-in">
        
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8 no-print">
            <div>
                <h2 class="text-2xl font-black text-gray-900 italic">Laporan & Analitik Perpustakaan 📄</h2>
                <p class="text-sm text-gray-500 font-medium">Periode: <?php echo e(\Carbon\Carbon::parse($startDate)->format('d M Y')); ?> - <?php echo e(\Carbon\Carbon::parse($endDate)->format('d M Y')); ?></p>
            </div>
            <div class="flex items-center gap-3">
                <button onclick="window.print()" class="px-5 py-2.5 bg-gray-900 text-white rounded-2xl font-bold text-xs hover:bg-black transition-all shadow-lg flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                    Cetak PDF
                </button>
                <a href="<?php echo e(route('reports.export', ['start_date' => $startDate, 'end_date' => $endDate])); ?>" class="px-5 py-2.5 bg-green-600 text-white rounded-2xl font-bold text-xs hover:bg-green-700 transition-all shadow-lg flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    Export Excel
                </a>
            </div>
        </div>

        
        <div class="surface-card mb-8 no-print">
            <form action="<?php echo e(route('reports.index')); ?>" method="GET" class="flex flex-col md:flex-row items-end gap-6">
                <div class="flex-1">
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Tanggal Mulai</label>
                    <input type="date" name="start_date" value="<?php echo e($startDate); ?>" class="w-full rounded-2xl border-gray-100 bg-gray-50 focus:ring-blue-500 font-bold text-sm">
                </div>
                <div class="flex-1">
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Tanggal Selesai</label>
                    <input type="date" name="end_date" value="<?php echo e($endDate); ?>" class="w-full rounded-2xl border-gray-100 bg-gray-50 focus:ring-blue-500 font-bold text-sm">
                </div>
                <button type="submit" class="px-8 py-3 bg-blue-600 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-blue-700 transition-all shadow-xl shadow-blue-100 italic">
                    Terapkan Filter
                </button>
            </form>
        </div>

        
        <div class="space-y-8">
            
            <div class="surface-card">
                <h3 class="text-sm font-black text-gray-900 uppercase tracking-widest mb-6 flex items-center gap-2 italic">
                    <div class="w-2 h-2 rounded-full bg-blue-600"></div>
                    Riwayat Peminjaman Terperinci
                </h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="border-b-2 border-gray-50">
                                <th class="py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest p-2">Tgl Pinjam</th>
                                <th class="py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest p-2">Buku</th>
                                <th class="py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest p-2">Siswa</th>
                                <th class="py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest p-2">Status</th>
                                <th class="py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest p-2">Tgl Kembali</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            <?php $__empty_1 = true; $__currentLoopData = $loans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td class="py-4 text-sm font-bold text-gray-700 p-2"><?php echo e(\Carbon\Carbon::parse($loan->loan_date)->format('d/m/Y')); ?></td>
                                    <td class="py-4 p-2">
                                        <div class="text-sm font-black text-gray-900 line-clamp-1 italic"><?php echo e($loan->book->title ?? 'Buku Dihapus'); ?></div>
                                        <div class="text-[10px] text-gray-400 font-bold uppercase"><?php echo e($loan->book->author ?? 'Anting'); ?></div>
                                    </td>
                                    <td class="py-4 text-sm font-bold text-gray-700 p-2"><?php echo e($loan->user->name ?? 'User Dihapus'); ?></td>
                                    <td class="py-4 p-2">
                                        <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider
                                            <?php echo e($loan->status == 'returned' ? 'bg-green-50 text-green-600' : 'bg-blue-50 text-blue-600'); ?>">
                                            <?php echo e($loan->status == 'borrowed' ? 'Dipinjam' : 'Kembali'); ?>

                                        </span>
                                    </td>
                                    <td class="py-4 text-xs font-bold text-gray-500 p-2 italic"><?php echo e($loan->actual_return_date ? \Carbon\Carbon::parse($loan->actual_return_date)->format('d/m/Y') : '-'); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="5" class="py-8 text-center text-gray-400 italic text-sm">Tidak ada transaksi di periode ini.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                
                <div class="surface-card">
                    <h3 class="text-sm font-black text-gray-900 uppercase tracking-widest mb-6 flex items-center gap-2 italic">
                        <div class="w-2 h-2 rounded-full bg-amber-500"></div>
                        Buku Terpopuler (Periode Ini)
                    </h3>
                    <div class="space-y-4">
                        <?php $__currentLoopData = $popularBooks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="flex items-center gap-4 p-3 rounded-2xl bg-gray-50 border border-white">
                                <div class="w-8 h-8 rounded-lg bg-amber-100 text-amber-600 flex items-center justify-center font-black text-xs"><?php echo e($index + 1); ?></div>
                                <div class="flex-1">
                                    <p class="text-sm font-black text-gray-800 line-clamp-1 italic"><?php echo e($book->title); ?></p>
                                    <p class="text-[10px] text-gray-400 font-bold uppercase"><?php echo e($book->period_borrow_count); ?>× Pinjam</p>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

                
                <div class="surface-card">
                    <h3 class="text-sm font-black text-gray-900 uppercase tracking-widest mb-6 flex items-center gap-2 italic">
                        <div class="w-2 h-2 rounded-full bg-purple-600"></div>
                        Siswa Teraktif (Periode Ini)
                    </h3>
                    <div class="space-y-4">
                        <?php $__currentLoopData = $activeUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="flex items-center gap-4 p-3 rounded-2xl bg-gray-50 border border-white">
                                <div class="w-8 h-8 rounded-lg bg-purple-100 text-purple-600 flex items-center justify-center font-black text-xs"><?php echo e($index + 1); ?></div>
                                <div class="flex-1">
                                    <p class="text-sm font-black text-gray-800 line-clamp-1 truncate"><?php echo e($user->name); ?></p>
                                    <p class="text-[10px] text-gray-400 font-bold uppercase"><?php echo e($user->period_loans_count); ?> Transaksi</p>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="hidden print:block mt-20 text-right">
            <div class="inline-block border-t border-black pt-2 px-10 text-center">
                <p class="text-sm font-bold">Admin Perpustakaan</p>
                <p class="text-[10px] mt-1"><?php echo e(now()->format('d F Y')); ?></p>
            </div>
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
<?php /**PATH C:\Users\H2rtkos\.gemini\antigravity\scratch\perpustakaan-smpn18\resources\views/reports/index.blade.php ENDPATH**/ ?>