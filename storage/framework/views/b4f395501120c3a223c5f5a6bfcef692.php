


<?php $__env->startSection('title', 'Messages'); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-3">
            <div class="messages">
                <button type="button" class="btn btn-sm btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#newMessageModal">
                    New message
                </button>
                <?php if($users && count($users) > 0): ?>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($user->id != auth()->id()): ?>
                        <a href="?sender=<?php echo e($user->id); ?>">
                            <div class="card mb-2">
                                <div class="card-body">
                                    <p class="p-0 m-0" style="font-weight: bold"><?php echo e($user->name); ?></p>
                                    <small><?php echo e($user->email); ?></small>
                                </div>
                            </div>
                        </a>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?> 
                    <p>Inbox is empty</p>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-9">
            <?php if(Request::input('sender') !== null): ?>
            <div class="message">
                <?php 
                    $sender_id = Request::input('sender');
                    $receiver_id = auth()->id();

                    $_messages = App\Models\Message::get();

                    $msgs = [];

                    foreach($_messages as $message) {
                        if( 
                        (($message->sender_id == $sender_id) && ($message->receiver_id == $receiver_id)) 
                        ||
                        (($message->sender_id == $receiver_id) && ($message->receiver_id == $sender_id))
                        ) {
                            $msgs[] = $message->toArray();
                        }
                    }
                ?>
                <?php if($msgs && count($msgs) > 0): ?>
                    <div class="d-flex mb-4 p-2 bg-primary-subtle justify-content-between align-items-center">
                        <p class="p-0 m-0">You are writing with: <?php echo e(App\Models\User::find($sender_id)->name); ?></p>
                        <a 
                        href="<?php echo e(route('delete-message', ['sender_id' => $sender_id])); ?>" 
                        onclick="return confirm('Are you sure?')"
                        class="btn btn-sm btn-danger">Delete message</a>
                    </div>
                    <?php $__currentLoopData = $msgs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="card w-75 mb-3 p-2 <?php if($message['sender_id'] === auth()->id()): ?> float-end bg-light <?php endif; ?>">
                        <?php echo e($message['message']); ?>

                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?> 
                    <p>0 messages</p>
                <?php endif; ?>
            </div>
            <form action="<?php echo e(route('send-message')); ?>" method="post" class="d-flex align-items-center" style="clear: both !important">
                <?php echo csrf_field(); ?> 
                <input type="hidden" name="sender_id" value="<?php echo e(Request::input('sender')); ?>">
                <textarea name="message" class="form-control" placeholder="Enter message here..."></textarea>
                <button type="submit" class="btn btn-sm btn-outline-primary ms-2">Send</button>
            </form>
            <?php endif; ?>
        </div>
    </div>

    <!-- New Message Modal -->
    <div class="modal fade" id="newMessageModal" tabindex="-1" aria-labelledby="newMessageModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="<?php echo e(route('send-message')); ?>" method="post" class="d-flex align-items-center" style="clear: both !important">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="newMessageModalLabel">New message</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php echo csrf_field(); ?> 
                        <div class="form-group mb-3">
                            <select name="receiver_id" class="form-control">
                                <option value="">Select friend</option>
                                <?php if(count($friends)): ?>
                                    <?php $__currentLoopData = $friends; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $friend): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($friend->status === 1): ?>
                                            <?php if($friend->user_id == auth()->id()): ?>
                                                <option value="<?php echo e(App\Models\User::find($friend->friend_id)->id); ?>">
                                                <?php echo e(App\Models\User::find($friend->friend_id)->name); ?>

                                                </option>
                                            <?php else: ?> 
                                                <option value="<?php echo e(App\Models\User::find($friend->user_id)->id); ?>">
                                                <?php echo e(App\Models\User::find($friend->user_id)->name); ?>

                                                </option>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <textarea name="message" class="form-control" placeholder="Enter message here..."></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Send</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.social', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Administrator\Desktop\social-media\resources\views/messages.blade.php ENDPATH**/ ?>