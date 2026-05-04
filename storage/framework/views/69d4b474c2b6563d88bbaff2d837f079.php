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

    
    <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h1 class="text-3xl font-black tracking-tight text-gray-900 uppercase">
                <?php if(Auth::user()->isAdmin()): ?> Manajemen Peminjaman 📑 <?php else: ?> Riwayat Peminjaman 📑 <?php endif; ?>
            </h1>
            <p class="text-sm text-gray-500 mt-1 font-medium italic">
                <?php echo e($loans->count()); ?> transaksi peminjaman tercatat dalam sistem.
            </p>
        </div>
        <?php if(!Auth::user()->isAdmin()): ?>
        <a href="<?php echo e(route('books.index')); ?>" class="flex items-center gap-2 px-6 py-3 bg-[#4F7DF3] text-white rounded-xl font-black text-xs uppercase tracking-widest hover:bg-blue-700 transition-all shadow-lg shadow-blue-200 no-underline">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
            Pinjam Buku Baru
        </a>
        <?php endif; ?>
    </div>

    
    <div class="flex items-center gap-8 mb-8 border-b border-gray-200">
        <a href="<?php echo e(route('loans.index')); ?>" class="pb-4 text-xs font-black uppercase tracking-widest transition-all <?php echo e(!request('status') ? 'text-[#1E3A8A] border-b-4 border-[#1E3A8A]' : 'text-[#9CA3AF] hover:text-gray-600'); ?> no-underline">Semua</a>
        <a href="<?php echo e(route('loans.index', ['status' => 'active'])); ?>" class="pb-4 text-xs font-black uppercase tracking-widest transition-all <?php echo e(request('status') === 'active' ? 'text-[#1E3A8A] border-b-4 border-[#1E3A8A]' : 'text-[#9CA3AF] hover:text-gray-600'); ?> no-underline">Buku Dipinjam</a>
        <a href="<?php echo e(route('loans.index', ['status' => 'returned'])); ?>" class="pb-4 text-xs font-black uppercase tracking-widest transition-all <?php echo e(request('status') === 'returned' ? 'text-[#1E3A8A] border-b-4 border-[#1E3A8A]' : 'text-[#9CA3AF] hover:text-gray-600'); ?> no-underline">Sudah Kembali</a>
    </div>

    
    <div class="space-y-4">
        <?php $__empty_1 = true; $__currentLoopData = $loans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300">
            <div class="flex items-center gap-6">
                
                <div class="w-16 h-20 rounded-lg overflow-hidden shrink-0 shadow-sm border border-gray-50">
                    <?php if($loan->book->cover_image && !str_starts_with($loan->book->cover_image,'http')): ?>
                        <img src="<?php echo e(asset($loan->book->cover_image)); ?>" class="w-full h-full object-cover">
                    <?php elseif($loan->book->cover_image): ?>
                        <img src="<?php echo e($loan->book->cover_image); ?>" class="w-full h-full object-cover">
                    <?php else: ?>
                        <div class="w-full h-full bg-gray-50 flex items-center justify-center text-gray-300 text-sm font-bold uppercase"><?php echo e(substr($loan->book->title,0,1)); ?></div>
                    <?php endif; ?>
                </div>

                
                <div class="flex-1 min-w-0">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h3 class="text-base font-black text-gray-900 line-clamp-1 uppercase italic tracking-tight"><?php echo e($loan->book->title); ?></h3>
                            <p class="text-xs text-gray-400 font-bold uppercase tracking-widest mt-0.5"><?php echo e($loan->book->author); ?></p>
                            <?php if(Auth::user()->isAdmin()): ?>
                            <p class="text-[10px] text-gray-500 mt-1 font-bold">
                                PEMINJAM: <span class="text-[#4F7DF3]"><?php echo e($loan->user->name); ?></span>
                            </p>
                            <?php endif; ?>
                        </div>
                        <div class="shrink-0">
                            <?php if($loan->status === 'returned'): ?>
                                <span class="px-3 py-1.5 bg-green-50 text-green-700 rounded-xl text-[9px] font-black uppercase tracking-widest border border-green-100">Dikembalikan</span>
                            <?php elseif($loan->status === 'pending'): ?>
                                <span class="px-3 py-1.5 bg-amber-50 text-amber-700 rounded-xl text-[9px] font-black uppercase tracking-widest border border-amber-100 italic animate-pulse">Menunggu ACC</span>
                            <?php elseif($loan->status === 'rejected'): ?>
                                <span class="px-3 py-1.5 bg-red-50 text-red-700 rounded-xl text-[9px] font-black uppercase tracking-widest border border-red-100">Ditolak</span>
                            <?php else: ?>
                                <span class="px-3 py-1.5 bg-blue-50 text-blue-700 rounded-xl text-[9px] font-black uppercase tracking-widest border border-blue-100">Dipinjam</span>
                            <?php endif; ?>
                        </div>
                    </div>

                    
                    <div class="flex flex-wrap items-center justify-between gap-4 mt-4 pt-3 border-t border-gray-50">
                        <div class="flex items-center gap-6 text-[10px] font-bold text-gray-400 uppercase">
                            <div class="flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                PINJAM: <span class="text-gray-700"><?php echo e(\Carbon\Carbon::parse($loan->loan_date)->format('d M Y')); ?></span>
                            </div>
                            <?php if($loan->expected_return_date): ?>
                            <div class="flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                BATAS: <span class="<?php echo e($loan->status !== 'returned' && \Carbon\Carbon::parse($loan->expected_return_date)->isPast() ? 'text-red-500' : 'text-gray-700'); ?>"><?php echo e(\Carbon\Carbon::parse($loan->expected_return_date)->format('d M Y')); ?></span>
                            </div>
                            <?php endif; ?>
                            <?php if($loan->actual_return_date): ?>
                            <div class="flex items-center gap-1.5 text-green-600">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                KEMBALI: <span><?php echo e(\Carbon\Carbon::parse($loan->actual_return_date)->format('d M Y')); ?></span>
                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="flex items-center gap-2">
                            <?php if($loan->invoice_number): ?>
                            <a href="<?php echo e(route('loans.invoice', $loan->id)); ?>" class="flex items-center gap-2 px-4 py-2 border-2 border-gray-900 text-gray-900 rounded-xl font-black text-[9px] uppercase tracking-widest hover:bg-gray-900 hover:text-white transition-all no-underline">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                Invoice
                            </a>
                            <?php endif; ?>
                            <?php if($loan->status === 'borrowed' && Auth::user()->isAdmin()): ?>
                            <form action="<?php echo e(route('loans.update', $loan->id)); ?>" method="POST" class="inline">
                                <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                                <input type="hidden" name="status" value="returned">
                                <button type="submit" class="px-5 py-2 bg-green-600 text-white rounded-xl font-black text-[9px] uppercase tracking-widest hover:bg-green-700 transition-all shadow-lg shadow-green-100">Kembalikan</button>
                            </form>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="bg-white p-16 rounded-[2.5rem] border border-gray-100 text-center shadow-sm">
            <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            </div>
            <h3 class="text-xl font-black text-gray-300 uppercase tracking-tighter">Belum ada riwayat peminjaman</h3>
            <a href="<?php echo e(route('books.index')); ?>" class="btn-primary inline-flex mt-6 no-underline bg-[#4F7DF3]">Jelajahi Katalog</a>
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
<?php /**PATH C:\Users\H2rtkos\.gemini\antigravity\scratch\perpustakaan-smpn18\resources\views/loans/index.blade.php ENDPATH**/ ?>