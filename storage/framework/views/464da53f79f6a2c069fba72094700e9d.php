    <!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e(config('app.name', 'Традиция Дандарона')); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="font-sans antialiased min-h-screen flex flex-col">


<?php echo $__env->make('layouts.navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>


<main class="flex-grow w-full bg-cover bg-center bg-no-repeat relative" style="background-image: url('<?php echo e(asset('images/Pan_cut_compressed.webp')); ?>');">
    
    <div class="absolute inset-0 bg-black/20"></div>

    
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <?php echo $__env->yieldContent('content'); ?>
    </div>
</main>


<footer class="w-full bg-gray-800 text-white py-6">
    <div class="text-center">
        &copy; <?php echo e(date('Y')); ?> <?php echo e(config('app.name', 'Традиция Дандарона')); ?>. Все права защищены.
    </div>
</footer>

</body>
</html>
<?php /**PATH N:\www\my-grand-project\resources\views/layouts/app.blade.php ENDPATH**/ ?>