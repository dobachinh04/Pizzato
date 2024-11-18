@extends('admin.layouts.master')

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="section-header">
                                <h1>Chat Box</h1>
                                {{-- <div class="section-header-breadcrumb">
                                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                                    <div class="breadcrumb-item"><a href="#">Components</a></div>
                                    <div class="breadcrumb-item">Chat Box</div>
                                </div> --}}
                            </div>
                            <div class="card-header">
                                <h4>Who's Online?</h4>
                            </div>
                            <div class="card-body">
                                {{-- <ul class="list-unstyled list-unstyled-border">
                            @foreach ($senders as $sender)
                            @php
                                $chatUser = \App\Models\User::find($sender->sender_id);
                                $unseenMessages = \App\Models\Chat::where(['sender_id' => $chatUser->id, 'receiver_id' => auth()->user()->id, 'seen' => 0])->count();

                            @endphp
                            <li class="media fp_chat_user" data-name="{{ $chatUser->name }}" data-user="{{ $chatUser->id }}" style="cursor: pointer">
                                <img alt="image" class="mr-3 rounded-circle " width="50"
                                    src="{{ asset($chatUser->avatar) }}" style="width: 50px;height: 50px; object-fit: cover;">
                                <div class="media-body">
                                    <div class="mt-0 mb-1 font-weight-bold">{{ $chatUser->name }}</div>
                                    <div class="text-warning text-small font-600-bold got_new_message">
                                        @if ($unseenMessages > 0)
                                        <i class="beep"></i>new message
                                        @endif
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-9">
                        <div class="card chat-box" id="mychatbox" data-inbox="" style="height: 70vh">
                            <div class="card-header">
                                <h4 id="chat_header"></h4>
                            </div>
                            <div class="card-body chat-content">

                            </div>

                            <div class="card-footer chat-form">
                                <form id="chat-form">
                                    @csrf
                                    <input type="text" class="form-control fp_send_message" placeholder="Type a message"
                                        name="message">
                                    <input type="hidden" name="receiver_id" id="receiver_id" value="">
                                    <input type="hidden" name="msg_temp_id" class="msg_temp_id" value="">


                                    <button class="btn btn-primary">
                                        <i class="far fa-paper-plane"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </section>
@endsection
