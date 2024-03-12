<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title><?php echo e(config('app.name', 'Social Media App')); ?></title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

        <!-- Styles -->
        <?php echo \Livewire\Livewire::styles(); ?>

    
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    </head>
    <body class="font-sans antialiased">

        <div style="width: 800px" class="mx-auto mt-5">
            <div class="row">
                <div class="col-6 text-center">
                    <img src="<?php echo e(asset('images/welcome.png')); ?>" alt="Social Media App" />
                </div>
                <div class="col-6 d-flex flex-column justify-content-center align-items-center">
                    <h3>Social Media App</h3>
                    <p class="my-4">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus, aut commodi, laudantium assumenda nulla molestiae sequi pariatur, culpa quae quisquam dolore ipsa architecto debitis a modi rem corrupti est fugit?
                    </p>
                    <a href="<?php echo e(route('login')); ?>" class="btn btn-sm btn-link">Login</a>
                    <a href="<?php echo e(route('register')); ?>" class="btn btn-sm btn-link">Register</a>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.min.js" integrity="sha384-heAjqF+bCxXpCWLa6Zhcp4fu20XoNIA98ecBC1YkdXhszjoejr5y9Q77hIrv8R9i" crossorigin="anonymous"></script>
    </body>
</html>
<?php /**PATH C:\Users\Administrator\Desktop\social-media\resources\views/welcome.blade.php ENDPATH**/ ?>