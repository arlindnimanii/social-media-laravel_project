@extends('layouts.social')


@section('title')
    {{ $post->description }}
@endsection

@section('content')
    <div class="row">
        <div class="col-5">
            <img src="{{ asset('storage/posts/'.$post->image) }}" class="img-fluid mb-4" alt="{{ $post->description }}">
            <a href="{{ route('like-post', ['id' => $post->id]) }}">
                @php
                    $user_reaction = $post->likes()->where('user_id', auth()->id())->where('post_id', $post->id)->first();
                    $icon = 'bi-heart';

                    if(!is_null($user_reaction) && $user_reaction->like == 1) {
                        $icon = 'bi-heart-fill';
                    }
                @endphp

                <i class="bi {{ $icon }}"></i>
                {{ $post->likes()->where('like', 1)->count() }}
            </a>

            <a href="#" id="add-to-fav" class="mx-4"><i class="bi bi-bookmark-heart"></i></a>

            @if($post->user_id === auth()->id()) 
                <a href="{{ route('delete-post', ['id' => $post->id] ) }}" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">
                    Delete
                </a>
            @endif
        </div> <!-- ./col -->
        <div class="col-6 offset-1">
            @if($post->comments()->count() > 0)
                @foreach($post->comments()->get() as $comment)
                <p style="border-bottom: 1px solid #e3e3e3;" class="py-2 mb-2">
                    <strong>&#64;{{ App\Models\User::find($comment->user_id)->name }}</strong>: "{{ $comment->comment }}"
                    <br />
                    <small>{{ $comment->created_at }}</small> 
                    @if($comment->user_id === auth()->id() || $post->user_id === auth()->id())
                    | <a href="{{ route('delete-comment', ['id' => $comment->id]) }}" onclick="return confirm('Are you sure?')">Delete</a>
                    @endif
                </p>
                @endforeach
            @else 
                <p>0 comments</p>
            @endif
            @auth
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0 pb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('post-comment', ['id' => $post->id]) }}" method="POST" class="my-3">
                @csrf 
                <textarea name="comment" class="form-control mb-2" placeholder="Add comment"></textarea>
                <button type="submit" class="btn btn-sm btn-outline-primary">Comment</button>
            </form>
            @endauth
        </div> <!-- ./col -->
    </div>
@endsection

@section('js')
<script> 
    const add_to_fav_btn = document.getElementById('add-to-fav')
    const favs_ls = localStorage.getItem('favs')
    const favs = (favs_ls !== null) ? JSON.parse(favs_ls) : []

    add_to_fav_btn.addEventListener('click', e => {
        e.preventDefault()

        const post = {
            'id' : {{ $post->id }},
            'image' : "{{ $post->image }}",
            'description' : "{{ $post->description }}"
        }

        if(favs.length > 0) {
            const found = favs.filter(fav => fav.id === {{ $post->id }})

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
@endsection