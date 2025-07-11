<?php $__env->startSection('content'); ?>
    <div class="py-12">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">
                Редактирование книги: <?php echo e($book->title); ?>

            </h1>

            <form action="<?php echo e(route('admin.books.update', $book)); ?>" method="POST" class="p-6 bg-white rounded-lg shadow-md space-y-6">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PATCH'); ?>

                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Название</label>
                    <input type="text" name="title" id="title" value="<?php echo e(old('title', $book->title)); ?>" class="markdown-editor block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                </div>

                <div>
                    <label for="authors" class="block text-sm font-medium text-gray-700">Авторы</label>
                    <select name="authors[]" id="authors" multiple class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                        <?php $__currentLoopData = $authors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $author): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($author->id); ?>" <?php if(in_array($author->id, old('authors', $book->authors->pluck('id')->toArray()))): echo 'selected'; endif; ?>>
                                <?php echo e($author->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="publication_year" class="block text-sm font-medium text-gray-700">Год публикации</label>
                        <input type="text" name="publication_year" id="publication_year" value="<?php echo e(old('publication_year', $book->publication_year)); ?>" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div>
                        <label for="publisher" class="block text-sm font-medium text-gray-700">Издательство</label>
                        <input type="text" name="publisher" id="publisher" value="<?php echo e(old('publisher', $book->publisher)); ?>" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div>
                        <label for="language" class="block text-sm font-medium text-gray-700">Язык</label>
                        <input type="text" name="language" id="language" value="<?php echo e(old('language', $book->language)); ?>" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                    </div>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" name="is_hidden" id="is_hidden" value="1" <?php if(old('is_hidden', $book->is_hidden)): echo 'checked'; endif; ?> class="w-4 h-4 text-indigo-600 border-gray-300 rounded">
                    <label for="is_hidden" class="ml-2 block text-sm text-gray-900">Скрыть книгу</label>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="px-6 py-2 font-semibold text-white bg-indigo-600 rounded-lg hover:bg-indigo-700">
                        Сохранить изменения
                    </button>
                </div>

                <div class="mt-6 pt-6 border-t border-gray-200">
                    <h3 class="text-lg font-medium text-red-600">Опасная зона</h3>
                    <form action="<?php echo e(route('admin.books.destroy', $book)); ?>" method="POST" onsubmit="return confirm('Вы уверены? Это действие удалит книгу и ВСЕ её главы!');">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="px-4 py-2 font-semibold text-white bg-red-600 rounded-lg hover:bg-red-700">
                            Удалить книгу
                        </button>
                    </form>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH N:\www\my-grand-project\resources\views/admin/books/edit.blade.php ENDPATH**/ ?>