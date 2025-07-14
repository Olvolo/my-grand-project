<?php $__env->startSection('content'); ?>
    
    <div class="text-center mb-12">
        <h1 class="text-4xl font-extrabold text-white sm:text-5xl md:text-6xl drop-shadow-lg">
            Традиция Дандарона
        </h1>
        <p class="max-w-md mx-auto mt-3 text-gray-200 sm:text-lg md:mt-5 md:max-w-3xl drop-shadow-md">
            Архив работ Учителя Бидии Дандаровича Дандарона и его учеников, посвящённый сохранению и распространению их духовного наследия.
        </p>
    </div>

    
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
        <a href="<?php echo e(route('tradition.index')); ?>" class="block p-6 bg-white/90 backdrop-blur-sm rounded-lg shadow hover:shadow-lg transition transform hover:-translate-y-1">
            <h2 class="text-xl font-semibold text-gray-800">Традиция</h2>
            <p class="mt-2 text-gray-600">Преемственность, линия Учителей, история.</p>
        </a>
        <a href="<?php echo e(route('authors.show', 'bidiya-dandaron')); ?>" class="block p-6 bg-white/90 backdrop-blur-sm rounded-lg shadow hover:shadow-lg transition transform hover:-translate-y-1">
            <h2 class="text-xl font-semibold text-gray-800">Б.Д. Дандарон</h2>
            <p class="mt-2 text-gray-600">Биография, работы, статьи об Учителе.</p>
        </a>
        <a href="<?php echo e(route('authors.index')); ?>" class="block p-6 bg-white/90 backdrop-blur-sm rounded-lg shadow hover:shadow-lg transition transform hover:-translate-y-1">
            <h2 class="text-xl font-semibold text-gray-800">Лики Традиции</h2>
            <p class="mt-2 text-gray-600">Ученики и последователи.</p>
        </a>
        <a href="<?php echo e(route('teaching.index')); ?>" class="block p-6 bg-white/90 backdrop-blur-sm rounded-lg shadow hover:shadow-lg transition transform hover:-translate-y-1">
            <h2 class="text-xl font-semibold text-gray-800">Учение</h2>
            <p class="mt-2 text-gray-600">Философия, Сутра, Тантра, Садханы.</p>
        </a>
        <a href="<?php echo e(route('history.index')); ?>" class="block p-6 bg-white/90 backdrop-blur-sm rounded-lg shadow hover:shadow-lg transition transform hover:-translate-y-1">
            <h2 class="text-xl font-semibold text-gray-800">История</h2>
            <p class="mt-2 text-gray-600">История буддизма, ключевые моменты.</p>
        </a>
        <a href="<?php echo e(route('materials.index')); ?>" class="block p-6 bg-white/90 backdrop-blur-sm rounded-lg shadow hover:shadow-lg transition transform hover:-translate-y-1">
            <h2 class="text-xl font-semibold text-gray-800">Доп. материалы</h2>
            <p class="mt-2 text-gray-600">Материалы из других источников.</p>
        </a>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH N:\www\my-grand-project\resources\views/welcome.blade.php ENDPATH**/ ?>