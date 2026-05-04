<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Perpustakaan SMPN 18 Surabaya</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;700;900&display=swap" rel="stylesheet">

        <!-- Styles / Scripts -->
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

        <style>
            body {
                font-family: 'Outfit', sans-serif;
            }
            .glass-card {
                background: rgba(255, 255, 255, 0.8);
                backdrop-filter: blur(12px);
                border: 1px solid rgba(255, 255, 255, 0.3);
            }
        </style>
    </head>
    <body class="bg-gray-50 text-gray-900 min-h-screen flex flex-col">
        <header class="w-full px-6 py-8 flex justify-end">
            <?php if(Route::has('login')): ?>
                <nav class="flex gap-4">
                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(url('/dashboard')); ?>" class="font-bold text-gray-600 hover:text-blue-600 transition-colors">Dashboard</a>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>" class="font-bold text-gray-600 hover:text-blue-600 transition-colors">Log in</a>
                        <?php if(Route::has('register')): ?>
                            <a href="<?php echo e(route('register')); ?>" class="font-bold text-gray-600 hover:text-blue-600 transition-colors">Register</a>
                        <?php endif; ?>
                    <?php endif; ?>
                </nav>
            <?php endif; ?>
        </header>

        <main class="flex-grow flex items-center justify-center px-4">
            <div class="max-w-6xl w-full grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Text Content -->
                <div class="space-y-8">
                    <div class="flex items-center gap-4">
                        <?php if (isset($component)) { $__componentOriginal8892e718f3d0d7a916180885c6f012e7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8892e718f3d0d7a916180885c6f012e7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.application-logo','data' => ['class' => 'h-20 w-auto drop-shadow-2xl']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('application-logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'h-20 w-auto drop-shadow-2xl']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8892e718f3d0d7a916180885c6f012e7)): ?>
<?php $attributes = $__attributesOriginal8892e718f3d0d7a916180885c6f012e7; ?>
<?php unset($__attributesOriginal8892e718f3d0d7a916180885c6f012e7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8892e718f3d0d7a916180885c6f012e7)): ?>
<?php $component = $__componentOriginal8892e718f3d0d7a916180885c6f012e7; ?>
<?php unset($__componentOriginal8892e718f3d0d7a916180885c6f012e7); ?>
<?php endif; ?>
                        <div class="h-12 w-1 bg-blue-600 rounded-full"></div>
                        <span class="text-xs font-black uppercase tracking-[0.5em] text-blue-600">Portal Literasi</span>
                    </div>
                    
                    <h1 class="text-6xl lg:text-7xl font-black text-gray-900 leading-[0.95] tracking-tighter uppercase italic">
                        Digital <br>
                        <span class="text-blue-600">Perpustakaan</span><br>
                        SMPN 18
                    </h1>

                    <p class="text-xl text-gray-500 font-medium max-w-md leading-relaxed">
                        Akses ribuan koleksi buku digital, jurnal, dan materi belajar berkualitas dari mana saja, kapan saja.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="<?php echo e(route('login')); ?>" class="inline-block px-12 py-5 bg-blue-600 text-white text-center rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-blue-700 hover:scale-105 transition-all shadow-2xl shadow-blue-200 italic">
                            Mulai Membaca
                        </a>
                        <div class="flex items-center gap-3 px-6 py-4 bg-white rounded-2xl border border-gray-100 shadow-sm">
                            <div class="w-3 h-3 rounded-full bg-green-500 animate-pulse"></div>
                            <span class="text-xs font-black text-gray-400 uppercase tracking-widest">Sistem Aktif</span>
                        </div>
                    </div>
                </div>

                <!-- Visual Content -->
                <div class="relative hidden lg:block">
                    <div class="absolute -inset-4 bg-gradient-to-tr from-blue-600 to-blue-400 rounded-[4rem] opacity-10 blur-3xl animate-pulse"></div>
                    <div class="glass-card rounded-[3rem] p-12 shadow-[0_32px_64px_-12px_rgba(0,0,0,0.1)] relative overflow-hidden">
                        <?php if (isset($component)) { $__componentOriginal8892e718f3d0d7a916180885c6f012e7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8892e718f3d0d7a916180885c6f012e7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.application-logo','data' => ['class' => 'w-full h-auto opacity-10 blur-sm absolute -bottom-10 -right-10 rotate-12']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('application-logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-full h-auto opacity-10 blur-sm absolute -bottom-10 -right-10 rotate-12']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8892e718f3d0d7a916180885c6f012e7)): ?>
<?php $attributes = $__attributesOriginal8892e718f3d0d7a916180885c6f012e7; ?>
<?php unset($__attributesOriginal8892e718f3d0d7a916180885c6f012e7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8892e718f3d0d7a916180885c6f012e7)): ?>
<?php $component = $__componentOriginal8892e718f3d0d7a916180885c6f012e7; ?>
<?php unset($__componentOriginal8892e718f3d0d7a916180885c6f012e7); ?>
<?php endif; ?>
                        <div class="relative z-10 text-center space-y-8">
                            <div class="w-48 h-48 bg-white rounded-[3rem] shadow-2xl mx-auto flex items-center justify-center transform hover:rotate-6 transition-transform duration-500 border-8 border-blue-50">
                                <?php if (isset($component)) { $__componentOriginal8892e718f3d0d7a916180885c6f012e7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8892e718f3d0d7a916180885c6f012e7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.application-logo','data' => ['class' => 'w-28 h-auto']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('application-logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-28 h-auto']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8892e718f3d0d7a916180885c6f012e7)): ?>
<?php $attributes = $__attributesOriginal8892e718f3d0d7a916180885c6f012e7; ?>
<?php unset($__attributesOriginal8892e718f3d0d7a916180885c6f012e7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8892e718f3d0d7a916180885c6f012e7)): ?>
<?php $component = $__componentOriginal8892e718f3d0d7a916180885c6f012e7; ?>
<?php unset($__componentOriginal8892e718f3d0d7a916180885c6f012e7); ?>
<?php endif; ?>
                            </div>
                            <div class="space-y-2">
                                <h3 class="text-2xl font-black italic text-gray-900 uppercase tracking-tight">SMP NEGERI 18 SURABAYA</h3>
                                <p class="text-sm font-bold text-blue-400 uppercase tracking-[0.4em]">Cerdas & Beradab</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <footer class="py-12 text-center">
            <p class="text-[10px] font-black uppercase tracking-[0.5em] text-gray-300">
                &copy; <?php echo e(date('Y')); ?> SMP Negeri 18 Surabaya • Dikembangkan untuk Masa Depan Bangsa
            </p>
        </footer>
    </body>
</html>
<?php /**PATH C:\Users\H2rtkos\.gemini\antigravity\scratch\perpustakaan-smpn18\resources\views/welcome.blade.php ENDPATH**/ ?>