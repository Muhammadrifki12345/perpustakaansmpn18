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
        <a href="<?php echo e(route('dashboard')); ?>" class="btn-outline flex items-center gap-2">
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
                    <?php $__empty_1 = true; $__currentLoopData = $waitlists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4 text-sm font-bold text-gray-500">
                            <?php echo e($loop->iteration); ?>

                        </td>
                        <td class="px-6 py-4">
                            <div>
                                <div class="text-sm font-black text-gray-900 italic"><?php echo e(optional($item->user)->name ?? 'User Dihapus'); ?></div>
                                <div class="text-[10px] text-gray-400 font-bold uppercase tracking-wider"><?php echo e(optional($item->user)->email ?? '-'); ?></div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-10 rounded overflow-hidden shrink-0 bg-gray-100 shadow-sm">
                                    <?php if($item->book && $item->book->cover_image): ?>
                                        <img src="<?php echo e(asset($item->book->cover_image)); ?>" class="w-full h-full object-cover">
                                    <?php endif; ?>
                                </div>
                                <?php if($item->book): ?>
                                    <a href="<?php echo e(route('books.show', $item->book->id)); ?>" class="text-sm font-bold text-blue-600 hover:underline">
                                        <?php echo e($item->book->title); ?>

                                    </a>
                                <?php else: ?>
                                    <span class="text-sm font-bold text-gray-400 italic">Buku Dihapus</span>
                                <?php endif; ?>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-xs font-bold text-gray-600 bg-gray-50 px-3 py-1 rounded-xl">
                                <?php echo e($item->created_at->format('d M Y, H:i')); ?>

                            </span>
                            <div class="text-[10px] text-gray-400 mt-1 uppercase tracking-widest"><?php echo e($item->created_at->diffForHumans()); ?></div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <?php if($loop->iteration == 1): ?>
                                <span class="bg-amber-100 text-amber-600 px-3 py-1.5 rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-sm">#1 (Berikutnya)</span>
                            <?php else: ?>
                                <span class="bg-gray-100 text-gray-600 px-3 py-1.5 rounded-2xl text-[10px] font-black uppercase tracking-widest">#<?php echo e($loop->iteration); ?></span>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <form action="<?php echo e(route('admin.daftar-tunggu.destroy', $item->id)); ?>" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan/menghapus dari daftar tunggu ini?')" class="inline-block">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="p-2 text-red-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus dari Daftar Tunggu">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <div class="text-gray-300 mb-2">
                                <svg class="w-12 h-12 mx-auto text-amber-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <p class="text-gray-500 font-bold uppercase tracking-widest text-[11px]">Tidak ada daftar tunggu aktif saat ini.</p>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
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
<?php /**PATH C:\Users\H2rtkos\.gemini\antigravity\scratch\perpustakaan-smpn18\resources\views/admin/waitlist.blade.php ENDPATH**/ ?>