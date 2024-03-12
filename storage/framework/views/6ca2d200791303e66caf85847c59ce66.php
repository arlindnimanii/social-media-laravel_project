


<?php $__env->startSection('title', 'Settings'); ?>

<?php $__env->startSection('content'); ?>
    <?php if(Session::get('status')): ?>
        <div class="alert alert-info">
            <?php echo e(Session::get('status')); ?>

        </div>
    <?php endif; ?>
    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>
    <form action="<?php echo e(route('save-settings')); ?>" method="POST" class="my-3">
        <?php echo csrf_field(); ?> 
        <div class="form-group mb-3">
            <input type="checkbox" name="allow_friend_requests" id="allow_friend_requests" value="1" <?php if(isset($setting)): ?> <?php if($setting->allow_friend_requests == 1): ?> checked <?php endif; ?> <?php endif; ?> />
            <label for="allow_friend_requests">Allow friend requests</label>
        </div>
        <div class="form-group mb-3">
            <input type="number" name="nr_posts_in_homepage" class="w-25 form-control" id="nr_posts_in_homepage" <?php if(isset($setting)): ?> <?php if($setting->nr_posts_in_homepage > 0): ?> value="<?php echo e($setting->nr_posts_in_homepage); ?>" <?php endif; ?> <?php endif; ?> />
        </div>
        <button type="submit" class="btn btn-sm btn-outline-primary">Save</button>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.social', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Administrator\Desktop\social-media\resources\views/settings.blade.php ENDPATH**/ ?>