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
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8 animate-fade-in">
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-black text-gray-900 uppercase tracking-tight">Kelola Rak Buku 🗄️</h2>
            <p class="text-sm text-gray-500 mt-1">Atur lokasi fisik rak di perpustakaan.</p>
        </div>
        <a href="<?php echo e(route('rak.create')); ?>" class="btn-primary no-underline">+ Tambah Rak</a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="data-table">
            <thead>
                <tr><th class="pl-6">No</th><th>Nama Rak</th><th>Kode Lokasi</th><th>Jumlah Buku</th><th>Deskripsi</th><th class="text-right pr-6">Aksi</th></tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $shelves; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $shelf): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td class="pl-6 font-bold text-gray-400"><?php echo e($i + 1); ?></td>
                    <td class="font-bold text-gray-800"><?php echo e($shelf->name); ?></td>
                    <td><span class="badge badge-blue text-[9px]"><?php echo e($shelf->location_code ?? '-'); ?></span></td>
                    <td class="text-gray-600"><?php echo e($shelf->books_count); ?> buku</td>
                    <td class="text-gray-500 text-xs max-w-[200px] truncate"><?php echo e($shelf->description ?? '-'); ?></td>
                    <td class="text-right pr-6">
                        <div class="flex items-center justify-end gap-2">
                            <a href="<?php echo e(route('rak.edit', $shelf->id)); ?>" class="text-blue-600 text-xs font-bold hover:underline">Edit</a>
                            <form method="POST" action="<?php echo e(route('rak.destroy', $shelf->id)); ?>" onsubmit="return confirm('Hapus rak ini?')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button class="text-red-500 text-xs font-bold hover:underline">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="6" class="text-center text-gray-400 italic py-8">Belum ada rak buku.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
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
<?php /**PATH C:\Users\H2rtkos\.gemini\antigravity\scratch\perpustakaan-smpn18\resources\views/admin/shelves/index.blade.php ENDPATH**/ ?>