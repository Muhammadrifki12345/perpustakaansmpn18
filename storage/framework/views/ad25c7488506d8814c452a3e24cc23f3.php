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
    <div class="dash-wrap animate-fade-in px-4">
        <!-- Page Header (Universal) -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-800">Riwayat Aktivitas 🔄</h2>
            <p class="text-gray-600">Pantau jejak aktivitas peminjaman dan interaksi sistem.</p>
        </div>

        <?php if(auth()->user()->isAdmin()): ?>
            

            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Buku</p>
                        <p class="text-2xl font-black text-gray-900"><?php echo e($stats['total_books']); ?></p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex items-center gap-4">
                    <div
                        class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Dipinjam</p>
                        <p class="text-2xl font-black text-gray-900"><?php echo e($stats['total_borrowed']); ?></p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-red-50 text-red-600 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Terlambat</p>
                        <p class="text-2xl font-black text-red-600"><?php echo e($stats['total_late']); ?></p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-green-50 text-green-600 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Siswa Aktif</p>
                        <p class="text-2xl font-black text-gray-900"><?php echo e($stats['active_students']); ?></p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <div class="lg:col-span-2 space-y-6">
                    <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2 mb-2">
                        <span class="w-2 h-6 bg-blue-600 rounded-full"></span>
                        Aktivitas Terbaru
                    </h3>

                    <?php $__empty_1 = true; $__currentLoopData = $feed; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="bg-white rounded-3xl p-5 shadow-sm border border-gray-100 transition-all hover:shadow-md">
                            <div class="flex items-start gap-4">
                                
                                <?php
                                    $iconMap = [
                                        'borrowed' => ['class' => 'bg-blue-50 text-blue-600', 'svg' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'],
                                        'returned' => ['class' => 'bg-green-50 text-green-600', 'svg' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                                        'reviewed' => ['class' => 'bg-amber-50 text-amber-600', 'svg' => 'M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.54 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.784.57-1.838-.196-1.539-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z'],
                                        'book_added' => ['class' => 'bg-purple-50 text-purple-600', 'svg' => 'M12 4v16m8-8H4'],
                                    ];
                                    $action = $iconMap[$activity->type] ?? ['class' => 'bg-gray-50 text-gray-600', 'svg' => ''];
                                ?>
                                <div
                                    class="w-10 h-10 rounded-2xl <?php echo e($action['class']); ?> flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="<?php echo e($action['svg']); ?>" />
                                    </svg>
                                </div>

                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between">
                                        <p class="text-sm font-bold text-gray-900"><?php echo e($activity->user->name ?? 'User Dihapus'); ?>

                                        </p>
                                        <span
                                            class="text-[10px] text-gray-400 font-medium"><?php echo e(optional($activity->created_at)->diffForHumans() ?? '-'); ?></span>
                                    </div>
                                    <p class="text-xs text-gray-600 mt-0.5">
                                        <?php if($activity->type == 'borrowed'): ?>
                                            Meminjam <span
                                                class="font-bold text-blue-600">"<?php echo e(data_get($activity->details, 'title', 'Buku')); ?>"</span>
                                        <?php elseif($activity->type == 'returned'): ?>
                                            Mengembalikan <span
                                                class="font-bold text-green-600">"<?php echo e(data_get($activity->details, 'title', 'Buku')); ?>"</span>
                                        <?php elseif($activity->type == 'reviewed'): ?>
                                            Memberi ulasan <span
                                                class="font-bold text-amber-600">"<?php echo e(data_get($activity->details, 'title', 'Buku')); ?>"</span>
                                        <?php elseif($activity->type == 'book_added'): ?>
                                            Menambahkan buku baru <span
                                                class="font-bold text-purple-600">"<?php echo e(data_get($activity->details, 'title', 'Buku')); ?>"</span>
                                        <?php endif; ?>
                                    </p>

                                    <?php if($activity->type == 'reviewed'): ?>
                                        <p
                                            class="text-[11px] italic text-gray-500 mt-2 bg-gray-50 p-2 rounded-xl border-l-2 border-amber-200">
                                            "<?php echo e(data_get($activity->details, 'text', '')); ?>"
                                        </p>
                                    <?php endif; ?>

                                    
                                    <div class="flex items-center gap-2 mt-4">
                                        <?php if($activity->type == 'borrowed' && data_get($activity->details, 'loan_id')): ?>
                                            <?php $loanId = data_get($activity->details, 'loan_id'); ?>
                                            <form action="<?php echo e(route('loans.update', $loanId)); ?>" method="POST">
                                                <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                                                <input type="hidden" name="status" value="returned">
                                                <button type="submit"
                                                    class="px-3 py-1.5 bg-green-600 text-white text-[10px] font-bold rounded-xl hover:bg-green-700 shadow-sm shadow-green-100 transition-all flex items-center gap-1">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M5 13l4 4L19 7" />
                                                    </svg>
                                                    Tandai Dikembalikan
                                                </button>
                                            </form>
                                        <?php endif; ?>

                                        <?php if($activity->type == 'reviewed'): ?>
                                            <button
                                                onclick="document.getElementById('comments-<?php echo e($activity->id); ?>').classList.toggle('hidden')"
                                                class="px-3 py-1.5 bg-blue-50 text-blue-600 text-[10px] font-bold rounded-xl hover:bg-blue-100 transition-all flex items-center gap-1">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                                </svg>
                                                Balas Ulasan
                                            </button>
                                        <?php endif; ?>

                                        <form action="<?php echo e(route('activities.destroy', $activity->id)); ?>" method="POST">
                                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                            <button type="submit" onclick="return confirm('Hapus log ini?')"
                                                class="px-3 py-1.5 bg-gray-50 text-gray-400 text-[10px] font-bold rounded-xl hover:bg-red-50 hover:text-red-500 transition-all">
                                                Hapus Log
                                            </button>
                                        </form>
                                    </div>

                                    
                                    <div id="comments-<?php echo e($activity->id); ?>" class="hidden mt-4 animate-fade-in">
                                        <?php $__currentLoopData = $activity->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="flex items-start gap-2 mb-2">
                                                <div
                                                    class="w-6 h-6 rounded-lg bg-blue-600 flex items-center justify-center text-white text-[8px] font-black shrink-0">
                                                    ADM</div>
                                                <div
                                                    class="flex-1 bg-blue-50/50 p-2 rounded-2xl rounded-tl-none border border-blue-100">
                                                    <p class="text-[10px] text-gray-800"><?php echo e($comment->content); ?></p>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <form action="<?php echo e(route('activities.comment', $activity->id)); ?>" method="POST"
                                            class="flex gap-2">
                                            <?php echo csrf_field(); ?>
                                            <input type="text" name="content" placeholder="Tulis balasan..."
                                                class="flex-1 text-[10px] py-1.5 px-3 rounded-xl border-gray-100 focus:ring-blue-500 focus:border-blue-500 bg-gray-50">
                                            <button type="submit"
                                                class="p-1 px-3 bg-blue-600 text-white rounded-xl text-[10px] font-bold">Kirim</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div
                            class="p-8 text-center bg-gray-50 rounded-3xl border-2 border-dashed border-gray-100 text-gray-400 text-xs font-medium">
                            Belum ada aktivitas hari ini.
                        </div>
                    <?php endif; ?>

                    <div class="mt-4">
                        <?php echo e($feed->links()); ?>

                    </div>
                </div>

                
                <div class="space-y-8">
                    <div>
                        <h3 class="text-sm font-bold text-red-600 flex items-center gap-2 mb-4">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            Notifikasi Penting
                        </h3>
                        <div class="space-y-3">
                            <?php if($notifications['late_loans']->count() > 0): ?>
                                <div class="bg-red-50 p-4 rounded-3xl border border-red-100">
                                    <p class="text-xs font-bold text-red-700 mb-2">⚠️
                                        <?php echo e($notifications['late_loans']->count()); ?> Buku Terlambat
                                    </p>
                                    <div class="space-y-2">
                                        <?php $__currentLoopData = $notifications['late_loans']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $late): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div
                                                class="flex items-center justify-between bg-white/50 p-2 rounded-xl text-[10px] border border-red-50">
                                                <span class="font-bold text-gray-700 truncate w-24"><?php echo e($late->user->name); ?></span>
                                                <span
                                                    class="text-red-600 font-black"><?php echo e($late->expected_return_date->diffInDays(now())); ?>

                                                    Hari</span>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                    <a href="<?php echo e(route('loans.index')); ?>"
                                        class="block text-center mt-3 text-[10px] font-bold text-red-600 hover:underline">Kelola
                                        Peminjaman</a>
                                </div>
                            <?php endif; ?>

                            <?php if($notifications['low_stock']->count() > 0): ?>
                                <div class="bg-amber-50 p-4 rounded-3xl border border-amber-100">
                                    <p class="text-xs font-bold text-amber-700 mb-2">⚠️
                                        <?php echo e($notifications['low_stock']->count()); ?> Buku Stok Habis
                                    </p>
                                    <div class="space-y-2">
                                        <?php $__currentLoopData = $notifications['low_stock']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div
                                                class="bg-white/50 p-2 rounded-xl text-[10px] border border-amber-50 flex justify-between items-center gap-2">
                                                <span class="truncate"><?php echo e($book->title); ?></span>
                                                <a href="<?php echo e(route('books.show', $book->id)); ?>"
                                                    class="text-amber-600 font-black hover:underline shrink-0">Update Stok</a>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div
                                    class="p-4 rounded-3xl border-2 border-dashed border-gray-100 text-center text-gray-400 text-[10px] italic">
                                    Semua stok dalam kondisi aman.
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    
                    <div class="bg-gray-900 p-6 rounded-3xl text-white shadow-xl">
                        <h4 class="text-xs font-bold uppercase tracking-widest text-gray-500 mb-4">Quick Link</h4>
                        <ul class="space-y-3">
                            <li>
                                <a href="<?php echo e(route('books.create')); ?>"
                                    class="flex items-center justify-between p-3 rounded-2xl bg-white/5 hover:bg-white/10 transition-all text-xs">
                                    <span>Tambah Buku Baru</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4" />
                                    </svg>
                                </a>
                            </li>
                            <?php if(auth()->user()->isSuperAdmin()): ?>
                                <li>
                                    <a href="<?php echo e(route('users.index')); ?>"
                                        class="flex items-center justify-between p-3 rounded-2xl bg-white/5 hover:bg-white/10 transition-all text-xs">
                                        <span>Kelola Pengguna</span>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if(auth()->user()->isAdmin()): ?>
                                <li>
                                    <a href="<?php echo e(route('admin.approvals')); ?>"
                                        class="flex items-center justify-between p-3 rounded-2xl bg-white/5 hover:bg-white/10 transition-all text-xs">
                                        <span>Persetujuan Pinjam</span>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>

        <?php else: ?>
            
            <div class="max-w-2xl mx-auto">
                <h2 class="text-2xl font-bold text-gray-900 mb-8 flex items-center gap-3">
                    <div
                        class="w-10 h-10 rounded-2xl bg-blue-600 flex items-center justify-center text-white shadow-lg shadow-blue-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                        </svg>
                    </div>
                    <span>Riwayat Aktivitas ePustaka</span>
                </h2>

                <div class="space-y-6">
                    <?php $__empty_1 = true; $__currentLoopData = $feed; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        
                        <?php
                            $colors = ['A' => '#3b82f6', 'B' => '#10b981', 'C' => '#f59e0b', 'D' => '#ef4444', 'S' => '#06b6d4'];
                            $firstChar = strtoupper(substr($activity->user->name, 0, 1));
                            $avatarColor = $colors[$firstChar] ?? '#3b82f6';
                        ?>
                        <div
                            class="bg-white rounded-3xl p-5 shadow-sm border border-gray-100 transition-all hover:shadow-md group">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 rounded-full flex items-center justify-center text-white font-bold text-lg shrink-0 shadow-sm"
                                    style="background-color: <?php echo e($avatarColor); ?>">
                                    <?php echo e($firstChar); ?>

                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between mb-1">
                                        <div class="flex items-center gap-2">
                                            <span
                                                class="text-base font-bold text-gray-900"><?php echo e($activity->user->name ?? 'User Dihapus'); ?></span>
                                        </div>
                                        <span
                                            class="text-xs text-gray-400 font-medium"><?php echo e(optional($activity->created_at)->diffForHumans() ?? '-'); ?></span>
                                    </div>

                                    <div class="flex items-start gap-4">
                                        <div class="flex-1">
                                            <?php if($activity->type == 'borrowed'): ?>
                                                <div class="flex items-center gap-2 text-sm text-gray-600">
                                                    <div
                                                        class="w-6 h-6 rounded-lg bg-blue-50 flex items-center justify-center text-blue-500">
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                                        </svg>
                                                    </div>
                                                    <span>meminjam</span>
                                                    <span
                                                        class="font-bold text-gray-900 border-b-2 border-blue-100"><?php echo e(data_get($activity->details, 'title', 'Buku')); ?></span>
                                                </div>
                                            <?php elseif($activity->type == 'reviewed'): ?>
                                                <div class="space-y-2">
                                                    <div class="flex items-center gap-2 text-sm text-gray-600">
                                                        <div
                                                            class="w-6 h-6 rounded-lg bg-amber-50 flex items-center justify-center text-amber-500">
                                                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                                                <path
                                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                            </svg>
                                                        </div>
                                                        <span>memberi ulasan <span
                                                                class="font-bold text-gray-900"><?php echo e(data_get($activity->details, 'rating', '5')); ?>

                                                                / 5</span></span>
                                                    </div>
                                                    <p class="text-xs italic text-gray-500 bg-gray-50 px-4 py-3 rounded-2xl">
                                                        "<?php echo e(data_get($activity->details, 'text', '')); ?>"</p>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <?php if(data_get($activity->details, 'cover_image')): ?>
                                            <div
                                                class="w-12 h-16 rounded-lg overflow-hidden shrink-0 shadow-sm border border-gray-100">
                                                <img src="<?php echo e(asset(data_get($activity->details, 'cover_image'))); ?>"
                                                    class="w-full h-full object-cover">
                                            </div>
                                        <?php elseif(data_get($activity->details, 'title')): ?>
                                            <div
                                                class="w-12 h-16 rounded-lg bg-blue-600 flex items-center justify-center text-white text-[8px] font-bold text-center px-1 shrink-0">
                                                <?php echo e(data_get($activity->details, 'title')); ?>

                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="flex items-center gap-5 mt-4">
                                        <form action="<?php echo e(route('activities.like', $activity->id)); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit"
                                                class="flex items-center gap-1.5 text-xs font-bold transition-all <?php echo e($activity->isLikedBy(auth()->id()) ? 'text-red-500' : 'text-gray-400 hover:text-red-400'); ?>">
                                                <svg class="w-4 h-4 <?php echo e($activity->isLikedBy(auth()->id()) ? 'fill-current' : 'fill-none'); ?>"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                                </svg>
                                                <?php echo e($activity->likes_count); ?>

                                            </button>
                                        </form>
                                        <button class="flex items-center gap-1.5 text-xs font-bold text-gray-400">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                            </svg>
                                            <?php echo e($activity->comments_count); ?>

                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
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
<?php endif; ?><?php /**PATH C:\Users\H2rtkos\.gemini\antigravity\scratch\perpustakaan-smpn18\resources\views/timeline.blade.php ENDPATH**/ ?>