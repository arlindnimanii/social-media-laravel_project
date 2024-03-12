


<?php $__env->startSection('title', 'Saved Posts'); ?>

<?php $__env->startSection('content'); ?>
    <div class="row" id="favs-container">
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('js/dynamicListener.min.js')); ?>"></script>
<script>
    const favs_ls = localStorage.getItem('favs')
    const favs = (favs_ls !== null) ? JSON.parse(favs_ls) : []
    const favs_container = document.getElementById('favs-container')
    let saved_posts = ''

    if(favs.length > 0) {
        favs.forEach(post => {
            saved_posts += `
            <div class="col-3 my-1">
                <div class="card" style="width: 18rem;">
                    <div style="background-image: url(http://127.0.0.1:8000/storage/posts/${post.image}); background-size: cover; height: 220px;"></div>
                    <div class="card-body d-flex justify-content-between">
                        <a href="posts/${post.id}">View post</a>
                    </div>
                    <a href="#" id="remove-post" post="${post.id}" class="btn bnt-sm btn-outline-danger">Remove</a>
                </div> <!-- ./card -->
            </div> <!-- ./col -->
            `
        })
        favs_container.innerHTML = saved_posts
    } else {
        favs_container.innerHTML = '<p>0 saved posts</p>'
    }

    addDynamicEventListener(document.body, 'click', '#remove-post', e => {
        e.preventDefault()
        console.log(e)
        const filtered_favs = favs.filter(fav => fav.id != e.target.getAttribute('post'))
        localStorage.setItem('favs', JSON.stringify(filtered_favs))
        window.location.href = 'http://127.0.0.1:8000/saved-posts'
    })
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.social', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Administrator\Desktop\social-media\resources\views/saved-posts.blade.php ENDPATH**/ ?>