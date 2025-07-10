<?php $__env->startSection('content'); ?>
    <div class="py-12">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">
                Добавление новой книги
            </h1>

            <form action="<?php echo e(route('admin.books.store')); ?>" method="POST" class="p-6 bg-white rounded-lg shadow-md space-y-6">
                <?php echo csrf_field(); ?>

                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Название</label>
                    <input type="text" name="title" id="title" value="<?php echo e(old('title')); ?>" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                </div>

                <div>
                    <label for="authors" class="block text-sm font-medium text-gray-700">Авторы</label>
                    <select name="authors[]" id="authors" multiple class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                        <?php $__currentLoopData = $authors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $author): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($author->id); ?>" <?php if(in_array($author->id, old('authors', []) ?? [])): echo 'selected'; endif; ?>>
                                <?php echo e($author->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="publication_year" class="block text-sm font-medium text-gray-700">Год публикации</label>
                        <input type="text" name="publication_year" id="publication_year" value="<?php echo e(old('publication_year')); ?>" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div>
                        <label for="publisher" class="block text-sm font-medium text-gray-700">Издательство</label>
                        <input type="text" name="publisher" id="publisher" value="<?php echo e(old('publisher')); ?>" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div>
                        <label for="language" class="block text-sm font-medium text-gray-700">Язык</label>
                        <input type="text" name="language" id="language" value="<?php echo e(old('language', 'ru')); ?>" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                    </div>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" name="is_hidden" id="is_hidden" value="1" <?php if(old('is_hidden')): echo 'checked'; endif; ?> class="w-4 h-4 text-indigo-600 border-gray-300 rounded">
                    <label for="is_hidden" class="ml-2 block text-sm text-gray-900">Скрыть книгу</label>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="px-6 py-2 font-semibold text-white bg-green-600 rounded-lg hover:bg-green-700">
                        Создать книгу
                    </button>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH N:\www\my-grand-project\resources\views/admin/books/create.blade.php ENDPATH**/ ?>