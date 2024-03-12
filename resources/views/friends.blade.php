@extends('layouts.social')


@section('title', 'Friends')

@section('content')


    @if($friends && count($friends) > 0)
        @php $counter = 0; @endphp
        <h3>Friend requests</h3>
        <div class="row">
            @foreach($friends as $friend)
                @if($friend->status === 0)
                @php $counter += 1; @endphp
                <div class="col-3">
                    <div class="border border-success-subtle p-2 d-flex justify-content-between">
                        <div>
                            <h4><i class="bi bi-person"></i> {{ App\Models\User::find($friend->user_id)->name }}</h4>
                            <p>{{ App\Models\Friend::where('friend_id', $friend->friend_id)->orWhere('user_id', $friend->friend_id)->where('status', 1)->count() }} friends</p>
                        </div>
                        <div>
                            <a href="{{ route('accept', ['id' => $friend->user_id]) }}" class="btn btn-sm btn-primary">
                                Accept
                            </a>
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
        </div>

        @if($counter === 0) <p>0 friend requests</p> @endif

        <br><br><br>
    @endif

    @if($friends && count($friends) > 0)
        <h3>Friends</h3>
        <div class="row">
            @foreach($friends as $friend)
                @if($friend->status === 1)
                <div class="col-3">
                    <div class="border border-success-subtle p-2 d-flex justify-content-between">
                        <div>
                            <h4>
                                <i class="bi bi-person"></i> 
                                @if($friend->user_id == auth()->id())
                                    {{ App\Models\User::find($friend->friend_id)->name }}
                                @else 
                                    {{ App\Models\User::find($friend->user_id)->name }}
                                @endif
                            </h4>
                            <p>{{ 0 }} friends</p>
                        </div>
                        <div>
                            <a href="{{ route('unfriend', ['id' => $friend->friend_id]) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                Unfriend
                            </a>
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
        </div>

        <br><br><br>
    @endif

    @if($users && count($users) > 0)
        <h3>Users</h3>
        <div class="row">
            @foreach($users as $user)
                <div class="col-3">
                    <div class="border border-danger-subtle p-2 d-flex justify-content-between">
                        <div>
                            <h4><i class="bi bi-person"></i> {{ $user->name }}</h4>
                        </div>
                        <div>
                            <a href="{{ route('send-friend-request', ['id' => $user->id]) }}" class="btn btn-sm btn-outline-primary">
                                Add friend
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif


@endsection