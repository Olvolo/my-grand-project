<?php $__env->startSection('content'); ?>
    <article class="bg-white p-8 rounded-lg shadow-md">
        <h1 class="text-4xl font-extrabold text-gray-900 mb-4"><?php echo e($article->title); ?></h1>

        <div class="text-gray-600 text-sm mb-4">
            <?php if($article->published_at): ?>
                Опубликовано: <time datetime="<?php echo e($article->published_at->format('Y-m-d')); ?>">
                    <?php echo e($article->published_at->format('d.m.Y')); ?>

                </time>
            <?php endif; ?>
            <?php if($article->authors->isNotEmpty()): ?>
                <span class="mx-2">|</span>
                Авторы:
                <?php $__currentLoopData = $article->authors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $author): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('authors.show', $author)); ?>" class="text-indigo-600 hover:underline">
                        <?php echo e($author->name); ?>

                    </a><?php if(!$loop->last): ?>, <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>

        
        <?php if($article->category): ?>
            <div class="text-gray-700 text-sm mb-2">
                Категория: <a href="<?php echo e(route('categories.show', $article->category)); ?>" class="text-blue-600 hover:underline">
                    <?php echo e($article->category->name); ?>

                </a>
            </div>
        <?php endif; ?>

        
        <?php if($article->tags->isNotEmpty()): ?>
            <div class="text-gray-700 text-sm mb-4">
                Теги:
                <?php $__currentLoopData = $article->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('tags.show', $tag)); ?>" class="inline-block bg-gray-200 rounded-full px-3 py-1 text-xs font-semibold text-gray-700 mr-2 mb-2 hover:bg-gray-300">
                        #<?php echo e($tag->name); ?>

                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>

        <hr class="my-6 border-gray-300">

        
        <div class="prose lg:prose-lg xl:prose-xl max-w-none text-gray-800 leading-relaxed">
            <?php echo $article->content; ?>

        </div>

        
    </article>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH N:\www\my-grand-project\resources\views/articles/show.blade.php ENDPATH**/ ?>