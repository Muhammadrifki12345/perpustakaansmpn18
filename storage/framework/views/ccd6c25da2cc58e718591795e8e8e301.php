<?php if (isset($component)) { $__componentOriginal69dc84650370d1d4dc1b42d016d7226b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b = $attributes; } ?>
<?php $component = App\View\Components\GuestLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('guest-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\GuestLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <!-- Title -->
    <div class="mb-10">
        <h1 class="text-4xl font-black italic tracking-tighter text-gray-900 uppercase leading-none">
            Masuk <br>
            <span class="text-blue-600">Perpustakaan</span>
        </h1>
        <p class="text-sm font-bold text-gray-400 mt-4 uppercase tracking-widest">Gunakan akun SMPN 18 Surabaya</p>
    </div>

    <!-- Session Status -->
    <?php if(session('status')): ?>
        <div class="p-4 bg-green-50 text-green-700 text-xs font-bold rounded-2xl border border-green-100 mb-6 flex items-center gap-3">
             <div class="w-1.5 h-1.5 rounded-full bg-green-500 animate-ping"></div>
             <?php echo e(session('status')); ?>

        </div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
        <div class="p-4 bg-red-50 text-red-700 text-xs font-bold rounded-2xl border border-red-100 mb-6 space-y-1">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="flex items-center gap-2">
                    <span class="text-red-300">•</span>
                    <?php echo e($error); ?>

                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="<?php echo e(route('login')); ?>" class="space-y-6">
        <?php echo csrf_field(); ?>

        <!-- Email -->
        <div class="space-y-2">
            <label for="email" class="text-[10px] font-black uppercase tracking-[0.3em] text-gray-400 ml-4">Alamat Email</label>
            <input
                id="email" type="email" name="email"
                value="<?php echo e(old('email')); ?>"
                required autofocus autocomplete="username"
                class="w-full px-6 py-4 bg-white border-2 border-gray-900 rounded-2xl text-sm font-bold text-gray-900 placeholder-gray-400 focus:ring-4 focus:ring-blue-100 transition-all shadow-sm"
                placeholder="nama@smpn18.sch.id"
            >
        </div>

        <!-- Password -->
        <div class="space-y-2" x-data="{ show: false }">
            <div class="flex justify-between items-center ml-4">
                <label for="password" class="text-[10px] font-black uppercase tracking-[0.3em] text-gray-400">Kata Sandi</label>
            </div>
            <div class="relative">
                <input
                    id="password" :type="show ? 'text' : 'password'" name="password"
                    required autocomplete="current-password"
                    class="w-full px-6 py-4 bg-white border-2 border-gray-900 rounded-2xl text-sm font-bold text-gray-900 placeholder-gray-400 focus:ring-4 focus:ring-blue-100 transition-all shadow-sm"
                    placeholder="••••••••"
                >
                <button type="button" @click="show = !show" class="absolute right-6 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                    <template x-if="!show">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    </template>
                    <template x-if="show">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88L4.222 4.222m10.89 10.89L20.777 20.777M4.221 4.221l15.558 15.558"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21.542 12A10.3 10.3 0 0112 19c-1.34 0-2.61-.26-3.77-.73M21.542 12a9.96 9.96 0 00-1.563-3.029m-5.858-.908a10.03 10.03 0 00-2.121-.263M21.542 12a10.05 10.05 0 00-1.563-3.029"/></svg>
                    </template>
                </button>
            </div>
        </div>

        <!-- Remember + Forgot -->
        <div class="flex items-center justify-between pt-1 px-2">
            <label for="remember_me" class="flex items-center gap-3 text-xs font-bold text-gray-400 cursor-pointer group">
                <input id="remember_me" type="checkbox" name="remember"
                       class="w-5 h-5 rounded-lg border-gray-100 bg-gray-50 text-blue-600 focus:ring-blue-500 focus:ring-offset-0 transition-all">
                <span class="group-hover:text-gray-600">Ingat saya</span>
            </label>
            <?php if(Route::has('password.request')): ?>
                <a href="<?php echo e(route('password.request')); ?>" class="text-xs font-black italic uppercase tracking-widest text-blue-600 hover:text-blue-700 transition-colors">
                    Lupa?
                </a>
            <?php endif; ?>
        </div>

        <!-- Submit -->
        <div class="pt-2">
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-black italic uppercase tracking-[0.2em] py-5 rounded-2xl shadow-xl shadow-blue-200 transition-all hover:scale-[1.02] active:scale-[0.98]">
                Masuk Sekarang
            </button>
        </div>

        <!-- Register link -->
        <div class="text-center pt-4">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">
                Belum terdaftar? 
                <a href="<?php echo e(route('register')); ?>" class="text-blue-600 hover:underline inline-flex items-center gap-1 ml-1">
                    Daftar Akun <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </p>
        </div>
    </form>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $attributes = $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $component = $__componentOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?>
<?php /**PATH C:\Users\H2rtkos\.gemini\antigravity\scratch\perpustakaan-smpn18\resources\views/auth/login.blade.php ENDPATH**/ ?>