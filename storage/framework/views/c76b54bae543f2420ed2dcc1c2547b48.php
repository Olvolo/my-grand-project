<?php $__env->startSection('content'); ?>
    <div class="p-4 bg-white rounded-lg shadow-md sm:p-6 lg:p-8">
        <h1 class="mb-6 text-3xl font-bold text-gray-800">Книги автора: <?php echo e($author->name); ?></h1>
        <div class="space-y-4">
            <?php $__empty_1 = true; $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div>
                    <a href="<?php echo e(route('books.show', $book)); ?>" class="text-xl font-semibold text-indigo-600 hover:underline"><?php echo e($book->title); ?></a>
                    <p class="text-sm text-gray-600"><?php echo e($book->publication_year); ?></p>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="text-gray-600">У этого автора пока нет опубликованных книг.</p>
            <?php endif; ?>
        </div>
        <div class="mt-8">
            <?php echo e($books->links()); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH N:\www\my-grand-project\resources\views/authors/books.blade.php ENDPATH**/ ?>