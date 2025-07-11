<?php $__env->startSection('content'); ?>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl font-extrabold text-gray-900">Традиция</h1>
                <p class="mt-2 text-lg text-gray-600">Непрерывная череда Учителей и учеников.</p>
            </div>

            
            <?php if($teachers->isNotEmpty()): ?>
                <div class="mt-12">
                    <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Ключевые фигуры</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <?php $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('authors.show', $teacher)); ?>" class="block p-6 text-center bg-white rounded-lg shadow-lg hover:shadow-2xl transition-shadow duration-300">
                                <h3 class="text-2xl font-semibold text-indigo-700"><?php echo e($teacher->name); ?></h3>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php endif; ?>

            
            <?php if($articles->isNotEmpty()): ?>
                <div class="mt-16">
                    <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">
                        Материалы по теме "<?php echo e($traditionCategory->name ?? 'Традиция'); ?>"
                    </h2>
                    <div class="space-y-4 max-w-4xl mx-auto">
                        <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('articles.show', $article)); ?>" class="block p-4 bg-white rounded-lg shadow-sm hover:bg-gray-50 transition-colors duration-200">
                                <p class="text-xl font-semibold text-gray-800 hover:text-indigo-600">
                                    <?php echo e($article->title); ?>

                                </p>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH N:\www\my-grand-project\resources\views/tradition/index.blade.php ENDPATH**/ ?>