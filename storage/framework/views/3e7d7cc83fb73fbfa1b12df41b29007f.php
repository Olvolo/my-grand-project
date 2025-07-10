<?php $__env->startSection('content'); ?>
    
    <div class="py-12 text-center bg-white rounded-lg shadow-lg">
        <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl md:text-6xl">
            Сайт Традиции Дандарона
        </h1>
        <p class="max-w-md mx-auto mt-3 text-base text-gray-500 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
            Онлайн-архив, посвященный жизни и творческим работам Учителя Бидии Дандаровича Дандарона и его учеников.
        </p>
    </div>

    
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            
            <h2 class="mb-6 text-3xl font-bold text-center text-gray-800">Последние статьи</h2>
            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                <?php $__empty_1 = true; $__currentLoopData = $latestArticles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="p-6 transition duration-300 bg-white rounded-lg shadow-md hover:shadow-xl">
                        <h3 class="mb-2 text-xl font-semibold">
                            <a href="<?php echo e(route('articles.show', $article)); ?>" class="text-indigo-600 hover:underline">
                                <?php echo e($article->title); ?>

                            </a>
                        </h3>
                        <p class="text-sm text-gray-600">
                            <?php echo e($article->published_at->format('d.m.Y')); ?>

                        </p>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="text-center text-gray-500 md:col-span-3">Статей пока нет.</p>
                <?php endif; ?>
            </div>

            
            <h2 class="mt-16 mb-6 text-3xl font-bold text-center text-gray-800">Новое в библиотеке</h2>
            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                <?php $__empty_1 = true; $__currentLoopData = $latestBooks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="p-6 transition duration-300 bg-white rounded-lg shadow-md hover:shadow-xl">
                        <h3 class="mb-2 text-xl font-semibold">
                            <a href="<?php echo e(route('books.show', $book)); ?>" class="text-indigo-600 hover:underline">
                                <?php echo e($book->title); ?>

                            </a>
                        </h3>
                        <p class="text-sm text-gray-600">
                            <?php if($book->publication_year): ?>
                                Год: <?php echo e($book->publication_year); ?>

                            <?php endif; ?>
                        </p>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="text-center text-gray-500 md:col-span-3">Книг пока нет.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH N:\www\my-grand-project\resources\views/welcome.blade.php ENDPATH**/ ?>