<?php $__env->startSection('content'); ?>
    <article class="bg-white p-8 rounded-lg shadow-md">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">
            <a href="<?php echo e(route('books.show', $book)); ?>" class="text-indigo-600 hover:underline">
                <?php echo e($book->title); ?>

            </a>
        </h1>
        <h2 class="text-4xl font-extrabold text-gray-900 mb-6"><?php echo e($chapter->order); ?>. <?php echo e($chapter->title); ?></h2>

        <hr class="my-6 border-gray-300">

        
        <div class="prose lg:prose-lg xl:prose-xl max-w-none text-gray-800 leading-relaxed">
            <?php echo $chapter->content_html; ?>

        </div>

        <hr class="my-6 border-gray-300">

        
        <nav class="flex justify-between items-center mt-6">
            
            <div class="relative w-1/2 md:w-1/3 mr-4">
                <select onchange="window.location.href = this.value;"
                        class="block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-indigo-500">
                    <?php $__currentLoopData = $allChapters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chap): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e(route('books.chapters.show', [$book, $chap])); ?>"
                                <?php if($chap->id === $chapter->id): ?> selected <?php endif; ?>>
                            <?php echo e($chap->order); ?>. <?php echo e($chap->title); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                </div>
            </div>

            
            <div class="flex-grow flex justify-end space-x-4">
                <?php if($previousChapter): ?>
                    <a href="<?php echo e(route('books.chapters.show', [$book, $previousChapter])); ?>"
                       class="flex items-center text-indigo-600 hover:underline">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8m-7 1V4a2 2 0 012-2h4a2 2 0 012 2v16a2 2 0 01-2 2H9a2 2 0 01-2-2v-4"></path></svg>
                        Предыдущая
                    </a>
                <?php endif; ?>

                <?php if($nextChapter): ?>
                    <a href="<?php echo e(route('books.chapters.show', [$book, $nextChapter])); ?>"
                       class="flex items-center text-indigo-600 hover:underline">
                        Следующая
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 9l3 3m0 0l-3 3m3-3H6m7 1V4a2 2 0 012-2h4a2 2 0 012 2v16a2 2 0 01-2 2H9a2 2 0 01-2-2v-4"></path></svg>
                    </a>
                <?php endif; ?>
            </div>
        </nav>
    </article>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH N:\www\my-grand-project\resources\views/chapters/show.blade.php ENDPATH**/ ?>