<?php $__env->startSection('content'); ?>
    <h1 class="text-4xl font-extrabold text-gray-900 mb-8 text-center">
        Тег: "#<?php echo e($tag->name); ?>"
    </h1>

    <?php if($articles->isNotEmpty()): ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white p-6 rounded-lg shadow-md flex flex-col">
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">
                        <a href="<?php echo e(route('articles.show', $article)); ?>" class="hover:text-indigo-600">
                            <?php echo e($article->title); ?>

                        </a>
                        <?php if($article->is_hidden): ?>
                            <span class="ml-2 px-2 py-1 bg-red-100 text-red-700 rounded-full text-xs font-semibold">Скрыто</span>
                        <?php endif; ?>
                    </h2>
                    <div class="text-gray-600 text-sm mb-3">
                        <?php if($article->published_at): ?>
                            Опубликовано: <time datetime="<?php echo e($article->published_at->format('Y-m-d')); ?>">
                                <?php echo e($article->published_at->format('d.m.Y')); ?>

                            </time>
                        <?php endif; ?>
                        <?php if($article->authors->isNotEmpty()): ?>
                            <span class="mx-1">|</span> Авторы:
                            <?php $__currentLoopData = $article->authors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $author): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(route('authors.show', $author)); ?>" class="hover:underline">
                                    <?php echo e($author->name); ?>

                                </a><?php if(!$loop->last): ?>, <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        
                        <?php if($article->category): ?>
                            <span class="mx-1">|</span> Категория:
                            <a href="<?php echo e(route('categories.show', $article->category)); ?>" class="inline-block text-blue-600 hover:underline">
                                <?php echo e($article->category->name); ?>

                            </a>
                        <?php endif; ?>
                    </div>
                    <?php if($article->description): ?>
                        <p class="text-gray-700 text-sm line-clamp-3 mb-4">
                            <?php echo Str::limit(strip_tags($article->description), 150); ?>

                        </p>
                    <?php endif; ?>
                    <div class="mt-auto text-right">
                        <a href="<?php echo e(route('articles.show', $article)); ?>"
                           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition duration-300">
                            Читать статью
                            <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php else: ?>
        <p class="text-center text-gray-600 text-lg">По тегу "#<?php echo e($tag->name); ?>" пока нет статей.</p>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH N:\www\my-grand-project\resources\views/tags/show.blade.php ENDPATH**/ ?>