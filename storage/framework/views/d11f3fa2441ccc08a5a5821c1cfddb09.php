<?php $__env->startSection('content'); ?>
    <div class="p-4 bg-white rounded-lg shadow-md sm:p-6 lg:p-8">

        <header class="pb-6 mb-6 border-b border-gray-200">
            <h1 class="mb-4 text-4xl font-extrabold text-gray-900"><?php echo e($article->title); ?></h1>
            <div class="space-y-2 text-sm text-gray-600">
                <?php if($article->published_at): ?>
                    <div>
                        <strong>Опубликовано:</strong>
                        <time datetime="<?php echo e($article->published_at->format('Y-m-d')); ?>"><?php echo e($article->published_at->format('d.m.Y')); ?></time>
                    </div>
                <?php endif; ?>
                <?php if($article->authors->isNotEmpty()): ?>
                    <div>
                        <strong>Автор(ы):</strong>
                        <?php $__currentLoopData = $article->authors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $author): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('authors.show', $author)); ?>" class="text-indigo-600 hover:underline"><?php echo e($author->name); ?></a><?php echo e(!$loop->last ? ',' : ''); ?>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
                <?php if($article->category): ?>
                    <div>
                        <strong>Категория:</strong>
                        <a href="<?php echo e(route('categories.show', $article->category)); ?>" class="text-indigo-600 hover:underline"><?php echo e($article->category->name); ?></a>
                    </div>
                <?php endif; ?>
            </div>
        </header>

        <div class="prose max-w-none lg:prose-lg">
            <?php echo $article->content_html; ?>

        </div>

        <?php if($article->tags->isNotEmpty()): ?>
            <footer class="pt-6 mt-8 border-t border-gray-200">
                <h3 class="mb-3 text-lg font-semibold text-gray-800">Теги:</h3>
                <div class="flex flex-wrap gap-2">
                    <?php $__currentLoopData = $article->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('tags.show', $tag)); ?>" class="inline-block px-3 py-1 text-sm font-semibold text-gray-700 bg-gray-200 rounded-full hover:bg-gray-300">
                            #<?php echo e($tag->name); ?>

                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </footer>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH N:\www\my-grand-project\resources\views/articles/show.blade.php ENDPATH**/ ?>