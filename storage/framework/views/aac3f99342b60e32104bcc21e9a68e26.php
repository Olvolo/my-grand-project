<?php $__env->startSection('content'); ?>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h1 class="text-4xl font-extrabold text-gray-900">История</h1>
                <p class="mt-2 text-lg text-gray-600">Тематическая подборка материалов.</p>
            </div>

            <div class="space-y-8">
                
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    
                    <?php if($category->articles->isNotEmpty()): ?>
                        
                        <div class="bg-emerald-50 p-6 rounded-lg shadow-md">
                            <h3 class="text-2xl font-semibold mb-4 text-gray-800 text-center italic">
                                <?php echo e($category->name); ?>

                            </h3>
                            <ul class="list-none space-y-2 text-lg">
                                
                                <?php $__currentLoopData = $category->articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <a href="<?php echo e(route('articles.show', $article)); ?>" class="text-gray-800 hover:text-indigo-600 hover:underline">
                                            &rarr; <?php echo e($article->title); ?>

                                        </a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH N:\www\my-grand-project\resources\views/history/index.blade.php ENDPATH**/ ?>