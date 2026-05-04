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
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10 animate-fade-in">
    
    <a href="<?php echo e(route('books.index')); ?>" class="inline-flex items-center gap-2 text-sm font-bold text-gray-400 hover:text-[#4F7DF3] transition-colors mb-8 no-underline group uppercase tracking-widest">
        <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"/></svg>
        Katalog Buku
    </a>

    <div class="bg-white rounded-[3rem] border border-gray-100 shadow-xl overflow-hidden">
        <div class="flex flex-col md:flex-row">
            
            <div class="md:w-2/5 p-8 bg-gray-50/50 flex flex-col items-center border-r border-gray-50">
                <div class="w-full aspect-[3/4] rounded-[2rem] overflow-hidden shadow-2xl border-4 border-white mb-8">
                    <?php if($book->cover_image && !str_starts_with($book->cover_image,'http')): ?>
                        <img src="<?php echo e(asset($book->cover_image)); ?>" class="w-full h-full object-cover">
                    <?php elseif($book->cover_image): ?>
                        <img src="<?php echo e($book->cover_image); ?>" class="w-full h-full object-cover">
                    <?php else: ?>
                        <div class="w-full h-full flex items-center justify-center bg-gray-100 text-gray-300 text-6xl font-black uppercase italic"><?php echo e(substr($book->title,0,1)); ?></div>
                    <?php endif; ?>
                </div>

                <div class="w-full space-y-3">
                    <?php if(auth()->user()->isAdmin()): ?>
                        <div class="flex gap-2">
                            <a href="<?php echo e(route('books.edit', $book->id)); ?>" class="flex-1 py-4 bg-gray-900 text-white rounded-2xl font-black text-xs uppercase tracking-widest text-center no-underline hover:bg-black transition-all">EDIT BUKU</a>
                            <form action="<?php echo e(route('books.destroy', $book->id)); ?>" method="POST" class="flex-1" onsubmit="return confirm('Hapus buku ini?')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="w-full py-4 bg-red-600 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-red-700 transition-all">HAPUS</button>
                            </form>
                        </div>
                    <?php else: ?>
                        <?php
                            $loan = auth()->user()->loans()->where('book_id', $book->id)->whereIn('status', ['borrowed', 'pending'])->first();
                        ?>

                        
                        <?php if($book->file_path): ?>
                            <a href="<?php echo e(route('books.read', $book->id)); ?>" class="flex items-center justify-center w-full py-5 bg-[#4F7DF3] text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-blue-700 transition-all shadow-xl shadow-blue-100 no-underline mb-4">
                                BACA DIGITAL SEKARANG 📱
                            </a>
                            <div class="relative flex items-center justify-center mb-4">
                                <div class="w-full border-t border-gray-100"></div>
                                <span class="absolute px-4 bg-[#F8FAFC] text-[8px] font-black text-gray-300 uppercase tracking-widest">ATAU</span>
                            </div>
                        <?php endif; ?>

                        
                        <?php if($loan): ?>
                            <div class="p-5 bg-white border border-gray-100 rounded-2xl shadow-sm">
                                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-2">Status Pinjam Fisik</p>
                                <p class="text-xs font-bold text-gray-700 leading-relaxed italic">
                                    <?php if($loan->status == 'pending'): ?>
                                        ⏳ Menunggu ACC pengurus perpustakaan...
                                    <?php else: ?>
                                        ✅ Buku sedang kamu pinjam (Fisik).
                                    <?php endif; ?>
                                </p>
                                <a href="<?php echo e(route('loans.invoice', $loan->id)); ?>" class="mt-4 flex items-center justify-center w-full py-3 border-2 border-gray-900 text-gray-900 rounded-xl font-black text-[10px] uppercase tracking-widest no-underline hover:bg-gray-900 hover:text-white transition-all">INVOICE PINJAMAN</a>
                            </div>
                        <?php else: ?>
                            <form action="<?php echo e(route('loans.store')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="book_id" value="<?php echo e($book->id); ?>">
                                <button type="submit" class="w-full py-4 <?php echo e($book->file_path ? 'border-2 border-gray-200 text-gray-500 bg-white' : 'bg-[#4F7DF3] text-white shadow-lg shadow-blue-100'); ?> rounded-2xl font-black text-xs uppercase tracking-widest hover:brightness-95 transition-all">
                                    <?php echo e($book->stock > 0 ? 'PINJAM BUKU FISIK 📦' : 'IKUT ANTREAN FISIK ⏳'); ?>

                                </button>
                                <?php if($book->stock <= 0): ?>
                                    <p class="text-[9px] text-center text-amber-500 font-bold uppercase mt-2 italic">Stok fisik habis, kamu akan masuk daftar tunggu.</p>
                                <?php endif; ?>
                            </form>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>

            
            <div class="md:w-3/5 p-10">
                <div class="mb-8">
                    <span class="px-4 py-1.5 bg-gray-100 text-gray-500 rounded-full text-[10px] font-black uppercase tracking-widest border border-gray-200">
                        <?php echo e($book->category->name ?? 'Kategori Umum'); ?>

                    </span>
                    <h1 class="text-4xl font-black text-gray-900 mt-4 leading-tight uppercase italic tracking-tighter"><?php echo e($book->title); ?></h1>
                    <p class="text-lg text-gray-400 font-bold uppercase mt-1 tracking-widest italic"><?php echo e($book->author); ?></p>
                </div>

                <div class="grid grid-cols-2 gap-6 mb-10">
                    <div class="p-5 bg-gray-50 rounded-2xl border border-gray-100">
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Posisi Buku</p>
                        <p class="text-sm font-black text-gray-800 uppercase italic">RAK: <?php echo e($book->shelf->name ?? '-'); ?> (<?php echo e($book->shelf->location_code ?? 'Area Utama'); ?>)</p>
                    </div>
                    <div class="p-5 bg-gray-50 rounded-2xl border border-gray-100">
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Ketersediaan</p>
                        <p class="text-sm font-black <?php echo e($book->stock > 0 ? 'text-green-600' : 'text-red-600'); ?> uppercase">
                            <?php echo e($book->stock > 0 ? 'Tersedia: '.$book->stock.' Buku' : 'Stok Sedang Habis'); ?>

                        </p>
                    </div>
                    <div class="p-5 bg-gray-50 rounded-2xl border border-gray-100">
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Penerbit</p>
                        <p class="text-sm font-black text-gray-800 uppercase italic"><?php echo e($book->publisher ?: '-'); ?></p>
                    </div>
                    <div class="p-5 bg-gray-50 rounded-2xl border border-gray-100">
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Tahun Terbit</p>
                        <p class="text-sm font-black text-gray-800"><?php echo e($book->year ?: '-'); ?></p>
                    </div>
                </div>

                <div class="prose prose-sm max-w-none text-gray-600">
                    <h4 class="text-xs font-black text-gray-900 uppercase tracking-widest mb-3 flex items-center gap-2">
                        <svg class="w-4 h-4 text-[#4F7DF3]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Sinopsis Buku
                    </h4>
                    <p class="leading-relaxed font-medium italic">
                        <?php echo e($book->synopsis ?? 'Belum ada sinopsis untuk buku ini. Silakan hubungi petugas perpustakaan untuk informasi lebih lanjut mengenai konten buku.'); ?>

                    </p>
                </div>

                <div class="mt-10 pt-8 border-t border-gray-100 flex items-center justify-between">
                    <div class="flex items-center gap-6">
                        <div class="text-center">
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Dipinjam</p>
                            <p class="text-xl font-black text-gray-900"><?php echo e($book->borrow_count ?? 0); ?><span class="text-xs ml-0.5 opacity-30">x</span></p>
                        </div>
                        <div class="w-px h-8 bg-gray-100"></div>
                        <div class="text-center">
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Koleksi</p>
                            <p class="text-xl font-black text-gray-900">#<?php echo e($book->id); ?></p>
                        </div>
                    </div>
                    
                    <form action="<?php echo e(route('books.favorite', $book->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="flex items-center gap-2 px-6 py-3 rounded-full <?php echo e(auth()->user()->hasFavorited($book) ? 'bg-yellow-50 text-yellow-600 border border-yellow-100' : 'bg-gray-50 text-gray-400 border border-gray-100'); ?> transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="<?php echo e(auth()->user()->hasFavorited($book) ? 'currentColor' : 'none'); ?>" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                            </svg>
                            <span class="text-[10px] font-black uppercase tracking-widest"><?php echo e(auth()->user()->hasFavorited($book) ? 'Tersimpan' : 'Simpan'); ?></span>
                        </button>
                    </form>
                </div>
            </div>
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
<?php /**PATH C:\Users\H2rtkos\.gemini\antigravity\scratch\perpustakaan-smpn18\resources\views/books/show.blade.php ENDPATH**/ ?>