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
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-6 animate-fade-in">

    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm mb-6" style="color:#6b7280;">
        <a href="<?php echo e(route('books.index')); ?>" class="hover:text-blue-600">Koleksi</a>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <span style="color:#1a1a2e;">Edit Buku</span>
    </nav>

    <div class="surface-card">
        <!-- Book preview header -->
        <div class="flex items-center gap-4 mb-6 pb-5 border-b border-gray-100">
            <div class="w-14 h-20 rounded-lg overflow-hidden shrink-0 bg-gray-200">
                <?php if($book->cover_image && !str_starts_with($book->cover_image,'http')): ?>
                    <img src="<?php echo e(asset($book->cover_image)); ?>" class="w-full h-full object-cover">
                <?php elseif($book->cover_image): ?>
                    <img src="<?php echo e($book->cover_image); ?>" class="w-full h-full object-cover">
                <?php else: ?>
                    <div class="w-full h-full gradient-primary flex items-center justify-center text-white text-xl font-bold"><?php echo e(strtoupper(substr($book->title,0,1))); ?></div>
                <?php endif; ?>
            </div>
            <div>
                <h1 class="text-xl font-bold" style="color:#1a1a2e;">Edit: <?php echo e($book->title); ?></h1>
                <p class="text-sm text-gray-400 mt-1"><?php echo e($book->author); ?> · <?php echo e($book->year); ?></p>
            </div>
        </div>

        <?php if($errors->any()): ?>
        <div class="alert alert-error mb-4">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><div><?php echo e($e); ?></div><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php endif; ?>

        <form action="<?php echo e(route('books.update', $book)); ?>" method="POST" enctype="multipart/form-data" class="space-y-5">
            <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div class="sm:col-span-2">
                    <label class="form-label">Judul Buku <span class="text-red-500">*</span></label>
                    <input type="text" name="title" value="<?php echo e(old('title', $book->title)); ?>" required class="form-input">
                </div>
                <div>
                    <label class="form-label">Pengarang <span class="text-red-500">*</span></label>
                    <input type="text" name="author" value="<?php echo e(old('author', $book->author)); ?>" required class="form-input">
                </div>
                <div>
                    <label class="form-label">Penerbit</label>
                    <input type="text" name="publisher" value="<?php echo e(old('publisher', $book->publisher)); ?>" class="form-input">
                </div>
                <div>
                    <label class="form-label">Tahun Terbit</label>
                    <input type="number" name="year" value="<?php echo e(old('year', $book->year)); ?>" class="form-input">
                </div>
                <div>
                    <label class="form-label">Kategori</label>
                    <select name="category_id" class="form-input">
                        <option value="">-- Pilih Kategori --</option>
                        <?php $__currentLoopData = \App\Models\Category::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($cat->id); ?>" <?php echo e(old('category_id', $book->category_id) == $cat->id ? 'selected' : ''); ?>><?php echo e($cat->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div>
                    <label class="form-label">Stok Buku (Eksemplar) <span class="text-red-500">*</span></label>
                    <input type="number" name="stock" value="<?php echo e(old('stock', $book->stock)); ?>" min="0" required class="form-input">
                </div>
                <div>
                    <label class="form-label">Lokasi / Rak Buku</label>
                    <select name="shelf_id" class="form-input">
                        <option value="">-- Pilih Rak --</option>
                        <?php $__currentLoopData = \App\Models\Shelf::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shelf): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($shelf->id); ?>" <?php echo e(old('shelf_id', $book->shelf_id) == $shelf->id ? 'selected' : ''); ?>><?php echo e($shelf->name); ?> <?php echo e($shelf->location_code ? '('.$shelf->location_code.')' : ''); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="sm:col-span-2">
                    <label class="form-label">Sinopsis Buku</label>
                    <textarea name="synopsis" rows="4" class="form-input" placeholder="Tulis ringkasan cerita atau gambaran umum isi buku..."><?php echo e(old('synopsis', $book->synopsis)); ?></textarea>
                </div>
            </div>

            <!-- File Upload -->
            <div class="border-t border-gray-100 pt-5">
                <h3 class="text-sm font-bold mb-4" style="color:#1a1a2e;">Perbarui File Digital</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="form-label">Ganti File e-Book (PDF)</label>
                        <div class="border-2 border-dashed rounded-xl p-4 text-center" style="border-color:#e5e7eb;">
                            <?php if($book->file_path): ?>
                                <p class="text-xs text-green-600 mb-2">✅ File tersedia: <?php echo e(basename($book->file_path)); ?></p>
                            <?php else: ?>
                                <p class="text-xs text-gray-400 mb-2">Belum ada file PDF</p>
                            <?php endif; ?>
                            <input type="file" name="pdf_file" accept=".pdf" class="text-xs text-gray-600 w-full">
                        </div>
                    </div>
                    <div>
                        <label class="form-label">Ganti Cover Buku</label>
                        <div class="border-2 border-dashed rounded-xl p-4 text-center" style="border-color:#e5e7eb;">
                            <?php if($book->cover_image): ?>
                                <p class="text-xs text-green-600 mb-2">✅ Cover tersedia</p>
                            <?php else: ?>
                                <p class="text-xs text-gray-400 mb-2">Belum ada cover</p>
                            <?php endif; ?>
                            <input type="file" name="cover_file" accept="image/*" class="text-xs text-gray-600 w-full">
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="btn-primary">Simpan Perubahan</button>
                <a href="<?php echo e(route('books.index')); ?>" class="btn-outline">Batal</a>
            </div>
        </form>
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
<?php /**PATH C:\Users\H2rtkos\.gemini\antigravity\scratch\perpustakaan-smpn18\resources\views/books/edit.blade.php ENDPATH**/ ?>