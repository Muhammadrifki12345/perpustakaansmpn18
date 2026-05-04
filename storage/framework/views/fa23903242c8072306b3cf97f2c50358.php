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
        .approval-wrap {
            max-width: 1000px;
            margin: 0 auto;
            padding: 1rem 0.75rem;
        }

        @media (min-width: 768px) {
            .approval-wrap {
                padding: 2rem 1.5rem;
            }
        }

        .surface-card {
            background: #fff;
            border-radius: 1.5rem;
            padding: 1.25rem;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(0, 0, 0, 0.03);
        }

        @media (min-width: 768px) {
            .surface-card {
                border-radius: 2rem;
                padding: 2rem;
            }
        }

        .approval-card {
            transition: all 0.3s ease;
            border: 1px solid #f1f5f9;
        }

        .approval-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.08);
            border-color: #3b82f6;
        }

        .btn-acc {
            background: #059669;
            color: white;
            padding: 0.75rem;
            border-radius: 1rem;
            font-weight: 800;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.2s;
        }

        .btn-acc:hover {
            background: #047857;
            transform: scale(1.02);
        }

        .btn-reject {
            background: #fee2e2;
            color: #dc2626;
            padding: 0.75rem;
            border-radius: 1rem;
            font-weight: 800;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.2s;
        }

        .btn-reject:hover {
            background: #fecaca;
        }
    </style>

    <div class="approval-wrap">
        <!-- Page Header -->
        <div class="mb-10 relative overflow-hidden rounded-[2.5rem] p-8 md:p-10 text-white shadow-xl"
            style="background: linear-gradient(135deg, #10b981, #059669);">
            <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <div class="flex items-center gap-2 mb-3">
                        <span
                            class="px-3 py-1 rounded-full bg-white/20 backdrop-blur-md text-[9px] font-black uppercase tracking-[0.2em] border border-white/10">Menunggu
                            Persetujuan</span>
                    </div>
                    <h1 class="text-4xl font-black italic tracking-tighter italic uppercase">Persetujuan Peminjaman 🕒</h1>
                    <p class="text-sm opacity-80 mt-2 font-medium italic">
                        Kelola permohonan peminjaman buku dari siswa. Setelah disetujui, siswa dapat mengambil buku di perpustakaan.
                    </p>
                </div>
                <a href="<?php echo e(route('dashboard')); ?>"
                    class="flex items-center gap-2 px-6 py-3 bg-white/10 hover:bg-white/20 rounded-2xl font-black text-xs text-white uppercase tracking-widest transition-all border border-white/10 italic">
                    ← Kembali
                </a>
            </div>
            <!-- Decorative Elements -->
            <div class="absolute top-0 right-0 -mr-20 -mt-20 w-80 h-80 bg-white/5 rounded-full blur-3xl"></div>
        </div>

        <?php if(count($globalPendingRequests) > 0): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <?php $__currentLoopData = $globalPendingRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $req): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="surface-card approval-card">
                        <div class="flex items-start gap-4 mb-6">
                            <div
                                class="w-12 h-12 rounded-2xl bg-blue-100 text-blue-600 flex items-center justify-center font-black text-xl shadow-inner">
                                <?php echo e(substr($req->user->name, 0, 1)); ?>

                            </div>
                            <div class="flex-1">
                                <h3 class="font-black text-gray-900 text-lg leading-tight"><?php echo e($req->user->name); ?></h3>
                                <p class="text-xs text-gray-400 font-bold uppercase tracking-widest mt-1">
                                    <?php echo e($req->user->email); ?>

                                </p>
                            </div>
                            <span
                                class="px-3 py-1 bg-amber-100 text-amber-700 rounded-full text-[10px] font-black uppercase tracking-wider">
                                Request Pinjam
                            </span>
                        </div>

                        <div class="p-4 rounded-2xl bg-gray-50 border border-gray-100 mb-6 flex items-center gap-4">
                            <div class="w-16 h-20 rounded-xl overflow-hidden shadow-md shrink-0">
                                <?php if($req->book->cover_image): ?>
                                    <img src="<?php echo e(asset($req->book->cover_image)); ?>" class="w-full h-full object-cover">
                                <?php else: ?>
                                    <div
                                        class="w-full h-full bg-gray-200 flex items-center justify-center font-black text-gray-400">
                                        ?</div>
                                <?php endif; ?>
                            </div>
                            <div class="min-w-0">
                                <p class="text-[10px] font-black text-blue-500 uppercase tracking-widest mb-1">Detail Buku</p>
                                <h4 class="font-bold text-gray-800 text-sm truncate"><?php echo e($req->book->title); ?></h4>
                                <p class="text-xs text-gray-500 mt-1"><?php echo e($req->book->author); ?></p>
                                <?php if($req->invoice_number): ?>
                                    <p class="text-[10px] text-gray-400 font-mono mt-1"><?php echo e($req->invoice_number); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <form action="<?php echo e(route('loans.approve', $req->id)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="w-full btn-acc shadow-lg shadow-green-500/20">Setujui
                                    (ACC)</button>
                            </form>
                            <form action="<?php echo e(route('loans.reject', $req->id)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="w-full btn-reject">Tolak Request</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php else: ?>
            <div class="surface-card text-center py-20 bg-gray-50/50 border-dashed border-2 border-gray-200">
                <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center mx-auto mb-6 shadow-sm">
                    <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <h3 class="text-xl font-black text-gray-400 italic">Tidak Ada Permintaan! 🎉</h3>
                <p class="text-gray-400 font-medium">Semua permintaan sudah diproses.</p>
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
<?php endif; ?><?php /**PATH C:\Users\H2rtkos\.gemini\antigravity\scratch\perpustakaan-smpn18\resources\views/admin/approvals.blade.php ENDPATH**/ ?>