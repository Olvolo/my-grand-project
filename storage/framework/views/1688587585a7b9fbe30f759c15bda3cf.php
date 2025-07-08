<?php $__env->startSection('content'); ?>
    <h1 class="text-4xl font-extrabold text-gray-900 mb-8 text-center">Наши Авторы</h1>

    <?php if($authors->isNotEmpty()): ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php $__currentLoopData = $authors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $author): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white p-6 rounded-lg shadow-md flex items-center space-x-4">
                    <?php if($author->photo): ?>
                        <img src="<?php echo e(asset('storage/' . $author->photo)); ?>" alt="<?php echo e($author->name); ?>"
                             class="w-16 h-16 rounded-full object-cover border-2 border-indigo-500">
                    <?php else: ?>
                        <div class="w-16 h-16 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 font-bold text-xl">
                            <?php echo e(mb_substr($author->name, 0, 1)); ?>

                        </div>
                    <?php endif; ?>
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800">
                            <a href="<?php echo e(route('authors.show', $author)); ?>" class="hover:text-indigo-600">
                                <?php echo e($author->name); ?>

                            </a>
                        </h2>
                        
                        
                        <p class="text-gray-600 text-sm mt-1">Книг: <?php echo e($author->books->count()); ?>, Статей: <?php echo e($author->articles->count()); ?></p>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php else: ?>
        <p class="text-center text-gray-600 text-lg">Пока нет зарегистрированных авторов.</p>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH N:\www\my-grand-project\resources\views/authors/index.blade.php ENDPATH**/ ?>