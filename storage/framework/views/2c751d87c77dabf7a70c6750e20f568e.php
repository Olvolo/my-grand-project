<?php $__env->startSection('content'); ?>
    <div class="p-4 bg-white rounded-lg shadow-md sm:p-6 lg:p-8">
        <h1 class="mb-4 text-3xl font-bold text-gray-800">Биография: <?php echo e($author->name); ?></h1>
        <?php if($author->bio): ?>
            <div class="prose max-w-none lg:prose-lg">
                <?php echo $author->bio; ?>

            </div>
        <?php else: ?>
            <p class="text-gray-600">Биографические данные для этого автора еще не добавлены.</p>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH N:\www\my-grand-project\resources\views/authors/bio.blade.php ENDPATH**/ ?>