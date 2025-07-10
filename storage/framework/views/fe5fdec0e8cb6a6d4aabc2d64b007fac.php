<?php $__env->startSection('content'); ?>
    <div class="py-12">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            <h1 class="mb-6 text-3xl font-bold text-gray-800">
                Создание новой статьи
            </h1>

            <?php if($errors->any()): ?>
                
            <?php endif; ?>

            <form action="<?php echo e(route('admin.articles.store')); ?>" method="POST" class="p-6 bg-white rounded-lg shadow-md space-y-6">
                <?php echo csrf_field(); ?>

                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Заголовок</label>
                    <input type="text" name="title" id="title" value="<?php echo e(old('title')); ?>" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                </div>

                <div>
                    <label for="content_markdown" class="block text-sm font-medium text-gray-700">Содержимое (Markdown)</label>
                    <textarea name="content_markdown" id="content_markdown" rows="15" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm"><?php echo e(old('content_markdown')); ?></textarea>
                </div>

                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700">Категория</label>
                    <select name="category_id" id="category_id" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($category->id); ?>" <?php if(old('category_id') == $category->id): echo 'selected'; endif; ?>>
                                <?php echo e($category->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
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

                <div>
                    <label for="tags" class="block text-sm font-medium text-gray-700">Теги</label>
                    <select name="tags[]" id="tags" multiple class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                        <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($tag->id); ?>" <?php if(in_array($tag->id, old('tags', []) ?? [])): echo 'selected'; endif; ?>>
                                <?php echo e($tag->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" name="is_hidden" id="is_hidden" value="1" <?php if(old('is_hidden')): echo 'checked'; endif; ?> class="w-4 h-4 text-indigo-600 border-gray-300 rounded">
                    <label for="is_hidden" class="ml-2 block text-sm text-gray-900">Скрыть статью</label>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="px-6 py-2 font-semibold text-white bg-indigo-600 rounded-lg hover:bg-indigo-700">
                        Создать статью
                    </button>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH N:\www\my-grand-project\resources\views/admin/articles/create.blade.php ENDPATH**/ ?>