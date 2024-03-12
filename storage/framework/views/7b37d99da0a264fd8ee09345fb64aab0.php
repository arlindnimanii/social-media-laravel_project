


<?php $__env->startSection('title', 'Friends'); ?>

<?php $__env->startSection('content'); ?>


    <?php if($friends && count($friends) > 0): ?>
        <?php $counter = 0; ?>
        <h3>Friend requests</h3>
        <div class="row">
            <?php $__currentLoopData = $friends; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $friend): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($friend->status === 0): ?>
                <?php $counter += 1; ?>
                <div class="col-3">
                    <div class="border border-success-subtle p-2 d-flex justify-content-between">
                        <div>
                            <h4><i class="bi bi-person"></i> <?php echo e(App\Models\User::find($friend->user_id)->name); ?></h4>
                            <p><?php echo e(App\Models\Friend::where('friend_id', $friend->friend_id)->orWhere('user_id', $friend->friend_id)->where('status', 1)->count()); ?> friends</p>
                        </div>
                        <div>
                            <a href="<?php echo e(route('accept', ['id' => $friend->user_id])); ?>" class="btn btn-sm btn-primary">
                                Accept
                            </a>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <?php if($counter === 0): ?> <p>0 friend requests</p> <?php endif; ?>

        <br><br><br>
    <?php endif; ?>

    <?php if($friends && count($friends) > 0): ?>
        <h3>Friends</h3>
        <div class="row">
            <?php $__currentLoopData = $friends; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $friend): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($friend->status === 1): ?>
                <div class="col-3">
                    <div class="border border-success-subtle p-2 d-flex justify-content-between">
                        <div>
                            <h4>
                                <i class="bi bi-person"></i> 
                                <?php if($friend->user_id == auth()->id()): ?>
                                    <?php echo e(App\Models\User::find($friend->friend_id)->name); ?>

                                <?php else: ?> 
                                    <?php echo e(App\Models\User::find($friend->user_id)->name); ?>

                                <?php endif; ?>
                            </h4>
                            <p><?php echo e(0); ?> friends</p>
                        </div>
                        <div>
                            <a href="<?php echo e(route('unfriend', ['id' => $friend->friend_id])); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                Unfriend
                            </a>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <br><br><br>
    <?php endif; ?>

    <?php if($users && count($users) > 0): ?>
        <h3>Users</h3>
        <div class="row">
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-3">
                    <div class="border border-danger-subtle p-2 d-flex justify-content-between">
                        <div>
                            <h4><i class="bi bi-person"></i> <?php echo e($user->name); ?></h4>
                        </div>
                        <div>
                            <a href="<?php echo e(route('send-friend-request', ['id' => $user->id])); ?>" class="btn btn-sm btn-outline-primary">
                                Add friend
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.social', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Administrator\Desktop\social-media\resources\views/friends.blade.php ENDPATH**/ ?>