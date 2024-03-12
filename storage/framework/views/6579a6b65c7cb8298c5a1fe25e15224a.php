


<?php $__env->startSection('title', 'Posts'); ?>

<?php $__env->startSection('content'); ?>

    <form action="<?php echo e(route('create-post')); ?>" class="p-2 bg-light mb-3" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="row">
            <div class="col-4">
                <input type="file" name="image" id="image" />
            </div>
            <div class="col-6">
                <textarea name="description" placeholder="Description" class="form-control"></textarea>
            </div>
            <div class="col-2">
                <button type="submit" class="btn btn-sm btn-outline-primary">Submit</button>
            </div>
        </div>
    </form>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger mb-4">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if(Session::get('status')): ?>
        <div class="alert alert-info mb-4">
            <?php echo e(Session::get('status')); ?>

        </div>
    <?php endif; ?>

    <?php if($posts && count($posts) > 0): ?>
    <div class="row">
        <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
        <div class="col-3 my-1">
            <div class="card">
                <div style="background-image: url(<?php echo e(asset('storage/posts/'.$post->image)); ?>); background-size: cover; height: 220px;"></div>
                <div class="card-body d-flex justify-content-between">
                    <div class="likes">
                        <a href="<?php echo e(route('like-post', ['id' => $post->id])); ?>">
                            <?php
                                $user_reaction = $post->likes()->where('user_id', auth()->id())->where('post_id', $post->id)->first();
                                $icon = 'bi-heart';

                                if(!is_null($user_reaction) && $user_reaction->like == 1) {
                                    $icon = 'bi-heart-fill';
                                }
                            ?>

                            <i class="bi <?php echo e($icon); ?>"></i>
                            <?php echo e($post->likes()->where('like', 1)->count()); ?>

                        </a>
                    </div>
                    <div class="comments">
                        <a href="<?php echo e(route('show-post', ['id' => $post->id])); ?>">
                            <i class="bi bi-chat"></i> 
                            <?php echo e($post->comments()->count()); ?>

                        </a>
                    </div>
                </div>
            </div> <!-- ./card -->
        </div> <!-- ./col -->
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php else: ?>
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <strong>Sorry!</strong> Zero posts.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.social', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Administrator\Desktop\social-media\resources\views/posts.blade.php ENDPATH**/ ?>