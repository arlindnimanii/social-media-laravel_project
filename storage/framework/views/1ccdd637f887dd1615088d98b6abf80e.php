


<?php $__env->startSection('title'); ?>
    <?php echo e($post->description); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-5">
            <img src="<?php echo e(asset('storage/posts/'.$post->image)); ?>" class="img-fluid mb-4" alt="<?php echo e($post->description); ?>">
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

            <a href="#" id="add-to-fav" class="mx-4"><i class="bi bi-bookmark-heart"></i></a>

            <?php if($post->user_id === auth()->id()): ?> 
                <a href="<?php echo e(route('delete-post', ['id' => $post->id] )); ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">
                    Delete
                </a>
            <?php endif; ?>
        </div> <!-- ./col -->
        <div class="col-6 offset-1">
            <?php if($post->comments()->count() > 0): ?>
                <?php $__currentLoopData = $post->comments()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <p style="border-bottom: 1px solid #e3e3e3;" class="py-2 mb-2">
                    <strong>&#64;<?php echo e(App\Models\User::find($comment->user_id)->name); ?></strong>: "<?php echo e($comment->comment); ?>"
                    <br />
                    <small><?php echo e($comment->created_at); ?></small> 
                    <?php if($comment->user_id === auth()->id() || $post->user_id === auth()->id()): ?>
                    | <a href="<?php echo e(route('delete-comment', ['id' => $comment->id])); ?>" onclick="return confirm('Are you sure?')">Delete</a>
                    <?php endif; ?>
                </p>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?> 
                <p>0 comments</p>
            <?php endif; ?>
            <?php if(auth()->guard()->check()): ?>
            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0 pb-0">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>
            <form action="<?php echo e(route('post-comment', ['id' => $post->id])); ?>" method="POST" class="my-3">
                <?php echo csrf_field(); ?> 
                <textarea name="comment" class="form-control mb-2" placeholder="Add comment"></textarea>
                <button type="submit" class="btn btn-sm btn-outline-primary">Comment</button>
            </form>
            <?php endif; ?>
        </div> <!-- ./col -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script> 
    const add_to_fav_btn = document.getElementById('add-to-fav')
    const favs_ls = localStorage.getItem('favs')
    const favs = (favs_ls !== null) ? JSON.parse(favs_ls) : []

    add_to_fav_btn.addEventListener('click', e => {
        e.preventDefault()

        const post = {
            'id' : <?php echo e($post->id); ?>,
            'image' : "<?php echo e($post->image); ?>",
            'description' : "<?php echo e($post->description); ?>"
        }

        if(favs.length > 0) {
            const found = favs.filter(fav => fav.id === <?php echo e($post->id); ?>)

            if(found.length > 0) {
                alert('This post is alerdy in favs!')
                return;
            }

            // update
            localStorage.setItem('favs', JSON.stringify([...favs, post]))
                alert('Post was added to favs!')
        } else {
            // add
            localStorage.setItem('favs', JSON.stringify([post]))
                alert('Post was added to favs!')
        }
    })
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.social', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Administrator\Desktop\social-media\resources\views/post.blade.php ENDPATH**/ ?>