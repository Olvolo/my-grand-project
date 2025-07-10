<?php $__env->startSection('content'); ?>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <h1 class="mb-6 text-3xl font-bold text-gray-800">
                Панель администратора
            </h1>
            <p class="text-gray-700 text-lg">
                Добро пожаловать в панель администратора! Здесь вы можете управлять контентом сайта.
            </p>

            
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">

                <a href="<?php echo e(route('home')); ?>" class="block p-6 overflow-hidden text-white transition duration-300 bg-gray-500 rounded-lg shadow-md hover:bg-gray-600">
                    <p class="text-sm font-medium uppercase">На сайт</p>
                    <p class="mt-2 text-3xl font-extrabold">
                        &larr; Вернуться
                    </p>
                </a>

                <a href="<?php echo e(route('admin.books.index')); ?>" class="block p-6 overflow-hidden text-white transition duration-300 bg-indigo-600 rounded-lg shadow-md hover:bg-indigo-700">
                    <p class="text-sm font-medium uppercase">Книги</p>
                    <p class="mt-2 text-4xl font-extrabold">
                        <?php echo e($stats['books_count']); ?>

                    </p>
                </a>

                <a href="<?php echo e(route('admin.articles.index')); ?>" class="block p-6 overflow-hidden text-white transition duration-300 bg-green-600 rounded-lg shadow-md hover:bg-green-700">
                    <p class="text-sm font-medium uppercase">Статьи</p>
                    <p class="mt-2 text-4xl font-extrabold">
                        <?php echo e($stats['articles_count']); ?>

                    </p>
                </a>

                <a href="<?php echo e(route('admin.categories.index')); ?>" class="block p-6 text-white transition duration-300 bg-purple-600 rounded-lg shadow-md hover:bg-purple-700">
                    <p class="text-sm font-medium uppercase">Категории</p>
                    <p class="mt-2 text-4xl font-extrabold"><?php echo e($stats['categories_count']); ?></p>
                </a>

                <a href="<?php echo e(route('admin.tags.index')); ?>" class="block p-6 text-white transition duration-300 bg-pink-600 rounded-lg shadow-md hover:bg-pink-700">
                    <p class="text-sm font-medium uppercase">Теги</p>
                    <p class="mt-2 text-4xl font-extrabold"><?php echo e($stats['tags_count']); ?></p>
                </a>

                <a href="<?php echo e(route('admin.authors.index')); ?>" class="block p-6 overflow-hidden text-white transition duration-300 bg-blue-600 rounded-lg shadow-md hover:bg-blue-700">
                    <p class="text-sm font-medium uppercase">Авторы</p>
                    <p class="mt-2 text-4xl font-extrabold">
                        <?php echo e($stats['authors_count']); ?>

                    </p>
                </a>

            </div>

            
            <div class="mt-10">
                <h2 class="mb-4 text-2xl font-bold text-gray-800">Быстрые действия</h2>
                <div class="space-x-4">
                    
                    <button class="px-6 py-3 font-semibold text-white bg-gray-500 rounded-lg hover:bg-gray-600">
                        Добавить статью (скоро)
                    </button>
                </div>
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH N:\www\my-grand-project\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>