<?php $__env->startSection('content'); ?>
    <div class="py-12">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Добавление нового автора</h1>

            <form action="<?php echo e(route('admin.authors.store')); ?>" method="POST" class="p-6 bg-white rounded-lg shadow-md space-y-6">
                <?php echo csrf_field(); ?>
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Имя автора</label>
                    <input type="text" name="name" id="name" value="<?php echo e(old('name')); ?>" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div>
                    <label for="bio" class="block text-sm font-medium text-gray-700">Биография (Markdown)</label>
                    <textarea name="bio" id="bio" rows="10" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm"><?php echo e(old('bio')); ?></textarea>
                </div>
                <div class="flex items-center">
                    <input type="checkbox" name="is_teacher" id="is_teacher" value="1" <?php if(old('is_teacher')): echo 'checked'; endif; ?> class="w-4 h-4 text-indigo-600 border-gray-300 rounded">
                    <label for="is_teacher" class="ml-2 block text-sm text-gray-900">Является Учителем</label>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="px-6 py-2 font-semibold text-white bg-green-600 rounded-lg hover:bg-green-700">
                        Создать автора
                    </button>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH N:\www\my-grand-project\resources\views/admin/authors/create.blade.php ENDPATH**/ ?>