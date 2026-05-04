<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Membaca: <?php echo e($book->title); ?> — ePustaka</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <style>
        body { font-family: 'Inter', sans-serif; background: #1a1a2e; margin: 0; height: 100vh; display: flex; flex-direction: column; }
        .reader-toolbar {
            background: rgba(255,255,255,0.05);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255,255,255,0.08);
            padding: 12px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-shrink: 0;
        }
        .reader-body { flex: 1; display: flex; overflow: hidden; }
        .reader-frame { flex: 1; border: none; }
        .reader-sidebar {
            width: 260px;
            background: rgba(255,255,255,0.04);
            border-left: 1px solid rgba(255,255,255,0.08);
            padding: 20px;
            overflow-y: auto;
            flex-shrink: 0;
        }
        .toolbar-btn {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 6px 14px; border-radius: 999px;
            font-size: 12px; font-weight: 600;
            cursor: pointer; transition: all 0.2s;
        }
        .toolbar-btn-ghost { color: rgba(255,255,255,0.7); background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.12); }
        .toolbar-btn-ghost:hover { background: rgba(255,255,255,0.14); color: white; }
        .toolbar-btn-primary { background: linear-gradient(135deg,#003580,#0071c2); color: white; }
        .toolbar-btn-primary:hover { opacity: 0.9; }
        #sidebarToggle { display: none; }
        @media (max-width: 768px) {
            .reader-sidebar { display: none; }
            #sidebarToggle { display: inline-flex; }
        }
    </style>
</head>
<body>

    <!-- Top Toolbar -->
    <div class="reader-toolbar">
        <div class="flex items-center gap-3">
            <a href="<?php echo e(route('dashboard')); ?>" class="toolbar-btn toolbar-btn-ghost">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Kembali
            </a>
            <span style="color:rgba(255,255,255,0.2);">|</span>
            <div class="flex items-center gap-2">
                <?php if($book->cover_image && !str_starts_with($book->cover_image,'http')): ?>
                    <img src="<?php echo e(asset($book->cover_image)); ?>" class="w-6 h-8 rounded object-cover">
                <?php elseif($book->cover_image): ?>
                    <img src="<?php echo e($book->cover_image); ?>" class="w-6 h-8 rounded object-cover">
                <?php endif; ?>
                <div>
                    <p style="color:white;font-size:13px;font-weight:600;line-height:1.2"><?php echo e($book->title); ?></p>
                    <p style="color:rgba(255,255,255,0.4);font-size:11px;"><?php echo e($book->author); ?></p>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-2">
            <button id="sidebarToggle" class="toolbar-btn toolbar-btn-ghost">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/></svg>
                Info
            </button>
            <a href="<?php echo e(route('dashboard')); ?>" class="toolbar-btn toolbar-btn-primary">
                Selesai Membaca
            </a>
        </div>
    </div>

    <!-- Reader Body -->
    <div class="reader-body">

        <!-- PDF Frame -->
        <div style="flex:1;display:flex;align-items:center;justify-content:center;background:#2d2d44;overflow:hidden;">
            <?php if($book->file_path): ?>
                <iframe
                    src="<?php echo e(asset($book->file_path)); ?>#toolbar=0&navpanes=0&scrollbar=1"
                    class="reader-frame"
                    style="width:100%;height:100%;"
                    title="eReader — <?php echo e($book->title); ?>"
                ></iframe>
            <?php else: ?>
                <div style="text-align:center;color:rgba(255,255,255,0.4);padding:60px 20px;">
                    <svg width="80" height="80" style="margin:0 auto 20px;opacity:0.2;" fill="none" stroke="white" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    <h3 style="font-size:18px;font-weight:600;color:rgba(255,255,255,0.6);">File e-Book Belum Tersedia</h3>
                    <p style="font-size:13px;margin-top:8px;">Hubungi pustakawan untuk mengunggah file buku ini.</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Right Sidebar: Book Info -->
        <div class="reader-sidebar" id="infoSidebar">
            <div style="color:rgba(255,255,255,0.9);">
                <h3 style="font-size:14px;font-weight:700;margin-bottom:16px;padding-bottom:12px;border-bottom:1px solid rgba(255,255,255,0.1);">Informasi Buku</h3>

                <?php if($book->cover_image && !str_starts_with($book->cover_image,'http')): ?>
                <img src="<?php echo e(asset($book->cover_image)); ?>" class="w-full rounded-xl mb-4 object-cover" style="max-height:200px;">
                <?php elseif($book->cover_image): ?>
                <img src="<?php echo e($book->cover_image); ?>" class="w-full rounded-xl mb-4 object-cover" style="max-height:200px;">
                <?php else: ?>
                <div style="height:160px;border-radius:12px;margin-bottom:16px;background:linear-gradient(135deg,#003580,#0071c2);display:flex;align-items:center;justify-content:center;font-size:3rem;color:white;font-weight:800;"><?php echo e(strtoupper(substr($book->title,0,1))); ?></div>
                <?php endif; ?>

                <h4 style="font-size:15px;font-weight:700;margin-bottom:4px;"><?php echo e($book->title); ?></h4>
                <p style="font-size:12px;color:rgba(255,255,255,0.5);margin-bottom:16px;"><?php echo e($book->author); ?></p>

                <div style="space-y:8px;">
                    <?php if($book->publisher): ?>
                    <div style="display:flex;justify-content:space-between;font-size:12px;padding:8px 0;border-bottom:1px solid rgba(255,255,255,0.05);">
                        <span style="color:rgba(255,255,255,0.4);">Penerbit</span>
                        <span style="color:rgba(255,255,255,0.8);"><?php echo e($book->publisher); ?></span>
                    </div>
                    <?php endif; ?>
                    <?php if($book->year): ?>
                    <div style="display:flex;justify-content:space-between;font-size:12px;padding:8px 0;border-bottom:1px solid rgba(255,255,255,0.05);">
                        <span style="color:rgba(255,255,255,0.4);">Tahun</span>
                        <span style="color:rgba(255,255,255,0.8);"><?php echo e($book->year); ?></span>
                    </div>
                    <?php endif; ?>
                    <?php if($book->category): ?>
                    <div style="display:flex;justify-content:space-between;font-size:12px;padding:8px 0;border-bottom:1px solid rgba(255,255,255,0.05);">
                        <span style="color:rgba(255,255,255,0.4);">Kategori</span>
                        <span style="color:rgba(255,255,255,0.8);"><?php echo e($book->category->name); ?></span>
                    </div>
                    <?php endif; ?>
                    <div style="display:flex;justify-content:space-between;font-size:12px;padding:8px 0;">
                        <span style="color:rgba(255,255,255,0.4);">Total Dibaca</span>
                        <span style="color:rgba(255,255,255,0.8);"><?php echo e($book->borrow_count); ?>×</span>
                    </div>
                </div>

                <!-- Return Book button in sidebar -->
                <?php
                    $loan = \App\Models\Loan::where('user_id', auth()->id())->where('book_id', $book->id)->where('status','borrowed')->first();
                ?>
                <?php if($loan): ?>
                <form action="<?php echo e(route('loans.update', $loan->id)); ?>" method="POST" style="margin-top:20px;">
                    <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                    <input type="hidden" name="status" value="returned">
                    <button type="submit" style="width:100%;padding:10px;border-radius:12px;background:rgba(220,38,38,0.2);color:rgba(255,99,99,0.9);font-size:12px;font-weight:600;border:1px solid rgba(220,38,38,0.3);cursor:pointer;">
                        Kembalikan e-Book
                    </button>
                </form>
                <?php endif; ?>
            </div>
        </div>
    </div>

</body>
</html>
<?php /**PATH C:\Users\H2rtkos\.gemini\antigravity\scratch\perpustakaan-smpn18\resources\views/books/read.blade.php ENDPATH**/ ?>