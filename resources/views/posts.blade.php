@extends('layouts.social')


@section('title', 'Posts')

@section('content')

    <form action="{{ route('create-post') }}" class="p-2 bg-light mb-3" method="POST" enctype="multipart/form-data">
        @csrf
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

    @if ($errors->any())
        <div class="alert alert-danger mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (Session::get('status'))
        <div class="alert alert-info mb-4">
            {{ Session::get('status') }}
        </div>
    @endif

    @if($posts && count($posts) > 0)
    <div class="row">
        @foreach($posts as $post) 
        <div class="col-3 my-1">
            <div class="card">
                <div style="background-image: url({{ asset('storage/posts/'.$post->image) }}); background-size: cover; height: 220px;"></div>
                <div class="card-body d-flex justify-content-between">
                    <div class="likes">
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
                    </div>
                    <div class="comments">
                        <a href="{{ route('show-post', ['id' => $post->id]) }}">
                            <i class="bi bi-chat"></i> 
                            {{ $post->comments()->count() }}
                        </a>
                    </div>
                </div>
            </div> <!-- ./card -->
        </div> <!-- ./col -->
        @endforeach
    </div>
    @else
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <strong>Sorry!</strong> Zero posts.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
@endsection