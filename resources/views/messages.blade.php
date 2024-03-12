@extends('layouts.social')


@section('title', 'Messages')

@section('content')
    <div class="row">
        <div class="col-3">
            <div class="messages">
                <button type="button" class="btn btn-sm btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#newMessageModal">
                    New message
                </button>
                @if($users && count($users) > 0)
                    @foreach($users as $user)
                        @if($user->id != auth()->id())
                        <a href="?sender={{$user->id}}">
                            <div class="card mb-2">
                                <div class="card-body">
                                    <p class="p-0 m-0" style="font-weight: bold">{{ $user->name }}</p>
                                    <small>{{ $user->email }}</small>
                                </div>
                            </div>
                        </a>
                        @endif
                    @endforeach
                @else 
                    <p>Inbox is empty</p>
                @endif
            </div>
        </div>
        <div class="col-9">
            @if(Request::input('sender') !== null)
            <div class="message">
                @php 
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
                @endphp
                @if($msgs && count($msgs) > 0)
                    <div class="d-flex mb-4 p-2 bg-primary-subtle justify-content-between align-items-center">
                        <p class="p-0 m-0">You are writing with: {{ App\Models\User::find($sender_id)->name }}</p>
                        <a 
                        href="{{ route('delete-message', ['sender_id' => $sender_id]) }}" 
                        onclick="return confirm('Are you sure?')"
                        class="btn btn-sm btn-danger">Delete message</a>
                    </div>
                    @foreach($msgs as $message)
                    <div class="card w-75 mb-3 p-2 @if($message['sender_id'] === auth()->id()) float-end bg-light @endif">
                        {{ $message['message'] }}
                    </div>
                    @endforeach
                @else 
                    <p>0 messages</p>
                @endif
            </div>
            <form action="{{ route('send-message') }}" method="post" class="d-flex align-items-center" style="clear: both !important">
                @csrf 
                <input type="hidden" name="sender_id" value="{{ Request::input('sender') }}">
                <textarea name="message" class="form-control" placeholder="Enter message here..."></textarea>
                <button type="submit" class="btn btn-sm btn-outline-primary ms-2">Send</button>
            </form>
            @endif
        </div>
    </div>

    <!-- New Message Modal -->
    <div class="modal fade" id="newMessageModal" tabindex="-1" aria-labelledby="newMessageModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('send-message') }}" method="post" class="d-flex align-items-center" style="clear: both !important">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="newMessageModalLabel">New message</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf 
                        <div class="form-group mb-3">
                            <select name="receiver_id" class="form-control">
                                <option value="">Select friend</option>
                                @if(count($friends))
                                    @foreach($friends as $friend)
                                        @if($friend->status === 1)
                                            @if($friend->user_id == auth()->id())
                                                <option value="{{ App\Models\User::find($friend->friend_id)->id }}">
                                                {{ App\Models\User::find($friend->friend_id)->name }}
                                                </option>
                                            @else 
                                                <option value="{{ App\Models\User::find($friend->user_id)->id }}">
                                                {{ App\Models\User::find($friend->user_id)->name }}
                                                </option>
                                            @endif
                                        @endif
                                    @endforeach
                                @endif
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
@endsection