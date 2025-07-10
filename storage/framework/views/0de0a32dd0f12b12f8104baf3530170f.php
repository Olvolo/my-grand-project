<?php $__env->startSection('content'); ?>
    <div class="bg-white p-8 rounded-lg shadow-md">
        <h1 class="text-4xl font-extrabold text-gray-900 mb-6 text-center">Результаты поиска</h1>

        <?php if($query): ?>
            <p class="text-lg text-gray-700 mb-6 text-center">
                Ваш запрос: "<span class="font-semibold text-indigo-700"><?php echo e($query); ?></span>"
            </p>
        <?php else: ?>
            <p class="text-lg text-gray-700 mb-6 text-center">
                Введите что-нибудь в поле поиска, чтобы начать.
            </p>
        <?php endif; ?>

        <?php if($articles->isEmpty() && $chapters->isEmpty() && $query): ?>
            <p class="text-xl text-center text-gray-600 mt-10">
                По запросу "<span class="font-semibold"><?php echo e($query); ?></span>" ничего не найдено.
            </p>
        <?php elseif($query): ?>
            
            <?php if($articles->isNotEmpty()): ?>
                <h2 class="text-3xl font-bold text-gray-800 mt-8 mb-4 border-b pb-2">Статьи</h2>
                <div class="space-y-6">
                    <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="bg-gray-50 p-6 rounded-lg shadow-sm">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">
                                <a href="<?php echo e(route('articles.show', $article)); ?>" class="hover:text-indigo-600">
                                    <?php echo e($article->title); ?>

                                </a>
                            </h3>
                            <div class="text-gray-600 text-sm mb-2">
                                <?php if($article->published_at): ?>
                                    Опубликовано: <?php echo e($article->published_at->format('d.m.Y')); ?>

                                <?php endif; ?>
                                <?php if($article->authors->isNotEmpty()): ?>
                                    <span class="mx-1">|</span> Авторы:
                                    <?php $__currentLoopData = $article->authors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $author): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a href="<?php echo e(route('authors.show', $author)); ?>" class="hover:underline">
                                            <?php echo e($author->name); ?>

                                        </a><?php if(!$loop->last): ?>, <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </div>
                            
                            <p class="text-gray-700 text-sm line-clamp-2">
                                <?php echo Str::limit(strip_tags($article->content), 200); ?>

                            </p>
                            <a href="<?php echo e(route('articles.show', $article)); ?>" class="text-indigo-600 hover:underline text-sm mt-2 block">
                                Читать далее &rarr;
                            </a>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>

            
            <?php if($chapters->isNotEmpty()): ?>
                <h2 class="text-3xl font-bold text-gray-800 mt-8 mb-4 border-b pb-2">Главы книг</h2>
                <div class="space-y-6">
                    <?php $__currentLoopData = $chapters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chapter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="bg-gray-50 p-6 rounded-lg shadow-sm">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">
                                <a href="<?php echo e(route('books.chapters.show', [$chapter->book, $chapter])); ?>" class="hover:text-indigo-600">
                                    Книга: "<?php echo e($chapter->book->title); ?>" &ndash; Глава: <?php echo e($chapter->order); ?>. <?php echo e($chapter->title); ?>

                                </a>
                            </h3>
                            <div class="text-gray-600 text-sm mb-2">
                                Авторы книги:
                                <?php $__currentLoopData = $chapter->book->authors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $author): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a href="<?php echo e(route('authors.show', $author)); ?>" class="hover:underline">
                                        <?php echo e($author->name); ?>

                                    </a><?php if(!$loop->last): ?>, <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            
                            <p class="text-gray-700 text-sm line-clamp-2">
                                <?php echo Str::limit(strip_tags($chapter->content), 200); ?>

                            </p>
                            <a href="<?php echo e(route('books.chapters.show', [$chapter->book, $chapter])); ?>" class="text-indigo-600 hover:underline text-sm mt-2 block">
                                Читать далее &rarr;
                            </a>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH N:\www\my-grand-project\resources\views/search/index.blade.php ENDPATH**/ ?>