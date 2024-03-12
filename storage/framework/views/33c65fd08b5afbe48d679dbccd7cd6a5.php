<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title'); ?> | Social Media App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <?php echo $__env->yieldContent('css'); ?>
</head>
<body class="m-0 p-0">
    <div class="row m-0 p-0">
        <div class="col-2">
             <!-- Sidebar -->
            <div style="height: 100vh; position: fixed;" class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 280px;">
                <a href="<?php echo e(route('dashboard')); ?>" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                    <span class="fs-4">Social Media App</span>
                </a>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="<?php echo e(route('dashboard')); ?>" class="nav-link link-dark <?php if(\Request::route()->getName() == 'dashboard'): ?> active <?php endif; ?>" aria-current="page">
                    <i class="bi bi-house"></i>
                    Home
                    </a>
                </li>
                <li>
                    <a href="<?php echo e(route('posts')); ?>" class="nav-link link-dark <?php if(\Request::route()->getName() == 'posts'): ?> active <?php endif; ?>">
                    <i class="bi bi-images"></i>
                    Posts
                    </a>
                </li>
                <li>
                    <a href="<?php echo e(route('friends')); ?>" class="nav-link link-dark <?php if(\Request::route()->getName() == 'friends'): ?> active <?php endif; ?>">
                    <i class="bi bi-people-fill"></i>
                    Friends
                    </a>
                </li>
                <li>
                    <a href="<?php echo e(route('messages')); ?>" class="nav-link link-dark <?php if(\Request::route()->getName() == 'messages'): ?> active <?php endif; ?>">
                    <i class="bi bi-chat-left"></i>
                    Messages
                    </a>
                </li>
                <li>
                    <a href="<?php echo e(route('saved-posts')); ?>" class="nav-link link-dark <?php if(\Request::route()->getName() == 'saved-posts'): ?> active <?php endif; ?>">
                    <i class="bi bi-bookmark-heart"></i>
                    Saved Posts
                    </a>
                </li>
                </ul>
                <hr>
                <div class="dropdown">
                <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo e(asset('storage/'.Auth::user()->profile_photo_path)); ?>" alt="" width="32" height="32" class="rounded-circle me-2">
                    <strong><?php echo e(Auth::user()->name); ?></strong>
                </a>
                <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                    <li><a class="dropdown-item" href="<?php echo e(route('settings')); ?>">Settings</a></li>
                    <li><a class="dropdown-item" href="<?php echo e(route('profile.show')); ?>">Profile</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                    <!-- Authentication -->
                    <form method="POST" action="<?php echo e(route('logout')); ?>" x-data>
                        <?php echo csrf_field(); ?>
                        <button class="dropdown-item">
                        Log Out
                        </button>
                    </form>
                    </li>
                </ul>
                </div>
            </div>
        </div>
        <div class="col-9">
            <!-- Content -->
            <div class="my-5">
                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </div>
    </div>

    

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.min.js" integrity="sha384-heAjqF+bCxXpCWLa6Zhcp4fu20XoNIA98ecBC1YkdXhszjoejr5y9Q77hIrv8R9i" crossorigin="anonymous"></script>
    <?php echo $__env->yieldContent('js'); ?>
</body>
</html><?php /**PATH C:\Users\Administrator\Desktop\social-media\resources\views/layouts/social.blade.php ENDPATH**/ ?>