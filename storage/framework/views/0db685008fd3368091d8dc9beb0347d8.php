<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="font-sans text-gray-900 antialiased">
<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-sky-100">
    <div>
        <a href="/">
            <img class="block h-12 w-auto" src="<?php echo e(asset('images/logo.webp')); ?>" alt="Логотип">
        </a>
    </div>
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white/80 backdrop-blur-sm shadow-md overflow-hidden sm:rounded-lg">
        <?php echo e($slot); ?>

    </div>
</div>
</body>
</html>
<?php /**PATH N:\www\my-grand-project\resources\views/layouts/guest.blade.php ENDPATH**/ ?>