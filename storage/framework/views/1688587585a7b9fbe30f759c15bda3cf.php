<?php $__env->startSection('content'); ?>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Авторы и их работы</h1>

            <div class="space-y-4">
                <?php $__empty_1 = true; $__currentLoopData = $authors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $author): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    
                    <div x-data="{ isOpen: false }" class="bg-white rounded-lg shadow-sm">
                        
                        <div @click="isOpen = !isOpen" class="p-4 flex justify-between items-center cursor-pointer">
                            <h3 class="text-xl font-semibold text-gray-900"><?php echo e($author->name); ?></h3>
                            <div class="flex items-center space-x-4">
                                <?php if($author->books_count > 0): ?>
                                    <span class="text-sm text-gray-500">Книг: <?php echo e($author->books_count); ?></span>
                                <?php endif; ?>
                                <span class="text-sm font-medium text-indigo-600" x-text="isOpen ? 'Свернуть' : 'Показать статьи'"></span>
                            </div>
                        </div>

                        
                        <div x-show="isOpen" x-transition.duration.300ms class="border-t border-gray-200">
                            <ul class="p-4 space-y-2">
                                <?php $__empty_2 = true; $__currentLoopData = $author->articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>
                                    <li>
                                        <a href="<?php echo e(route('articles.show', $article)); ?>" class="text-gray-700 hover:text-indigo-700 hover:underline">
                                            &rarr; <?php echo e($article->title); ?>

                                        </a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>
                                    <li class="text-gray-500">У этого автора пока нет статей.</li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="text-center text-gray-600">На сайте пока нет авторов.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH N:\www\my-grand-project\resources\views/authors/index.blade.php ENDPATH**/ ?>