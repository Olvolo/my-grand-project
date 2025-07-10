<?php $__env->startSection('content'); ?>
    <div class="bg-white p-8 rounded-lg shadow-md mb-8">
        <h1 class="text-4xl font-extrabold text-gray-900 mb-4"><?php echo e($book->title); ?>

            <?php if($book->is_hidden): ?>
                <span class="ml-4 px-3 py-1 bg-red-100 text-red-700 rounded-full text-base font-semibold align-middle">Скрыто</span>
            <?php endif; ?>
        </h1>

        <div class="text-gray-600 text-sm mb-4">
            <?php if($book->publication_year): ?>
                Год публикации: <?php echo e($book->publication_year); ?>

            <?php endif; ?>
            <?php if($book->language): ?>
                <span class="mx-2">|</span> Язык: <?php echo e(strtoupper($book->language)); ?>

            <?php endif; ?>
            <?php if($book->publisher): ?>
                <span class="mx-2">|</span> Издательство: <?php echo e($book->publisher); ?>

            <?php endif; ?>
            <?php if($book->authors->isNotEmpty()): ?>
                <span class="mx-2">|</span>
                Авторы:
                <?php $__currentLoopData = $book->authors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $author): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('authors.show', $author)); ?>" class="text-indigo-600 hover:underline">
                        <?php echo e($author->name); ?>

                    </a><?php if(!$loop->last): ?>, <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>

        <?php if($book->description): ?>
            <div class="prose lg:prose-lg xl:prose-xl max-w-none text-gray-800 leading-relaxed mt-6">
                <?php echo $book->description; ?>

            </div>
        <?php endif; ?>
    </div>

    <div class="bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-3xl font-bold text-gray-900 mb-6">Оглавление</h2>

        <?php if($book->chapters->isNotEmpty()): ?>
            <ul class="space-y-2">
                <?php $__currentLoopData = $book->chapters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chapter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="flex items-center justify-between text-lg text-gray-800 transition duration-200">
                        <a href="<?php echo e(route('books.chapters.show', [$book, $chapter])); ?>" class="flex-grow hover:text-indigo-700">
                            <span class="font-semibold w-8 text-right mr-2"><?php echo e($chapter->order); ?>.</span>
                            <?php echo e($chapter->title); ?>

                        </a>

                        
                        <?php if(auth()->guard()->check()): ?>
                            <?php ($user = auth()->user()); ?>
                            <?php if($user instanceof \App\Models\User && $user->is_admin): ?>
                                <a href="<?php echo e(route('admin.chapters.edit', $chapter)); ?>" class="ml-4 text-sm text-blue-600 hover:underline">
                                    (Редактировать)
                                </a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        <?php else: ?>
            <p class="text-gray-600">В этой книге пока нет глав.</p>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH N:\www\my-grand-project\resources\views/books/show.blade.php ENDPATH**/ ?>