<?php $__env->startSection('content'); ?>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-800">Управление книгой: <?php echo e($book->title); ?></h1>
            <p class="text-gray-600">Здесь вы можете добавлять, редактировать и упорядочивать главы.</p>

            
            <div class="mt-8 bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-2xl font-bold mb-4">Оглавление</h2>
                <?php $__empty_1 = true; $__currentLoopData = $book->chapters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chapter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="flex justify-between items-center py-2 border-b">
                        <span><?php echo e($chapter->order); ?>. <?php echo e($chapter->title); ?></span>
                        <a href="<?php echo e(route('admin.chapters.edit', $chapter)); ?>" class="text-sm text-indigo-600 hover:underline">Редактировать</a>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="text-gray-500">В этой книге пока нет глав.</p>
                <?php endif; ?>
            </div>

            
            <div class="mt-8 bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-2xl font-bold mb-4">Добавить новую главу</h2>
                
                <form action="<?php echo e(route('admin.chapters.store', $book)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="space-y-4">
                        <input type="text" name="title" placeholder="Название главы" class="block w-full border-gray-300 rounded-md shadow-sm" required>
                        <textarea name="content_markdown" rows="10" placeholder="Содержимое главы в формате Markdown..." class="block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                        <div class="flex justify-end">
                            <button type="submit" class="px-6 py-2 font-semibold text-white bg-green-600 rounded-lg hover:bg-green-700">Добавить главу</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH N:\www\my-grand-project\resources\views/admin/books/manage.blade.php ENDPATH**/ ?>