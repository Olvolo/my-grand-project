<?php $__env->startSection('content'); ?>
    <div class="p-4 bg-white rounded-lg shadow-md sm:p-6 lg:p-8">

        
        <header class="pb-6 text-center border-b border-gray-200">
            
            
            <h1 class="text-4xl font-extrabold text-gray-900"><?php echo e($author->name); ?></h1>
            <?php if($author->is_teacher): ?>
                <p class="mt-2 text-lg font-semibold text-indigo-600">Учитель Традиции</p>
            <?php endif; ?>
        </header>

        
        <div class="grid grid-cols-1 gap-8 mt-8 md:grid-cols-3">

            <a href="<?php echo e(route('authors.bio', $author)); ?>" class="block p-6 text-center transition duration-300 bg-gray-100 rounded-lg shadow-sm hover:shadow-lg hover:bg-indigo-50">
                <h2 class="text-2xl font-bold text-gray-800">Биография</h2>
                <p class="mt-2 text-gray-600">Подробные материалы о жизни и деятельности.</p>
            </a>

            <a href="<?php echo e(route('authors.books', $author)); ?>" class="block p-6 text-center transition duration-300 bg-gray-100 rounded-lg shadow-sm hover:shadow-lg hover:bg-indigo-50">
                <h2 class="text-2xl font-bold text-gray-800">Книги</h2>
                <p class="mt-2 text-gray-600">Полный список написанных трудов и работ.</p>
            </a>

            <a href="<?php echo e(route('authors.articles', $author)); ?>" class="block p-6 text-center transition duration-300 bg-gray-100 rounded-lg shadow-sm hover:shadow-lg hover:bg-indigo-50">
                <h2 class="text-2xl font-bold text-gray-800">Статьи</h2>
                <p class="mt-2 text-gray-600">Статьи автора и материалы о нём.</p>
            </a>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH N:\www\my-grand-project\resources\views/authors/show.blade.php ENDPATH**/ ?>