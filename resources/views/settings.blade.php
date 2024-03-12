@extends('layouts.social')


@section('title', 'Settings')

@section('content')
    @if (Session::get('status'))
        <div class="alert alert-info">
            {{ Session::get('status') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('save-settings') }}" method="POST" class="my-3">
        @csrf 
        <div class="form-group mb-3">
            <input type="checkbox" name="allow_friend_requests" id="allow_friend_requests" value="1" @if(isset($setting)) @if($setting->allow_friend_requests == 1) checked @endif @endif />
            <label for="allow_friend_requests">Allow friend requests</label>
        </div>
        <div class="form-group mb-3">
            <input type="number" name="nr_posts_in_homepage" class="w-25 form-control" id="nr_posts_in_homepage" @if(isset($setting)) @if($setting->nr_posts_in_homepage > 0) value="{{ $setting->nr_posts_in_homepage }}" @endif @endif />
        </div>
        <button type="submit" class="btn btn-sm btn-outline-primary">Save</button>
    </form>
@endsection