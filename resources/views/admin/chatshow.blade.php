@extends('layouts.admin')

@section('title')
    Chat Seller
@endsection

@section('content')
    
    <div class="col-md-8">
        <div class="panel panel-widget chat-widget">
            <div class="panel-heading">
                <span class="panel-title pn"> Chat Seller</span>
            </div>

            <div class="panel-body bg-light dark scroller-block scroller-primary scroller-lg pl15 pt15">
                @foreach ($chats as $chat)
                    @if ($chat->message_seller)
                        <div class="media">
                            <div class="media-left">
                                <a href="#">
                                    <input type="hidden" value="{{ $user = App\Models\User::findOrFail($chat->user_id) }}">
                                    @if ( $user->profil )
                                        <img alt="Profile Picture" src="{{asset('storage/'. $user->profil)}}" class="media-object"/>
                                    @else 
                                        <img alt="Profile Picture" src="{{ asset('img/image-not-found.png')}}" class="media-object"/>
                                    @endif
                                </a>
                            </div>
                            <div class="media-body">
                                <span class="media-status online"></span>
                                <h5 class="media-heading">{{ $user->name }}
                                    <span>{{ $chat->created_at->diffForHumans() }}</span>
                                </h5>
                                {{ $chat->message_seller }}
                            </div>
                        </div>
                    @elseif($chat->message_admin)
                        <div class="media">
                            <div class="media-body">
                                <span class="media-status offline"></span>
                                <h5 class="media-heading">{{ Auth::guard('admin')->user()->name }}
                                    <span>{{ $chat->created_at->diffForHumans() }}</span>
                                </h5>
                                {{ $chat->message_admin }}
                            </div>
                            <div class="media-right">
                                <a href="#">
                                    @if (Auth::guard('admin')->user()->profil)
                                        <img alt="Profile Picture" src="{{asset('storage/'. Auth::guard('admin')->user()->profil)}}" class="media-object"/>
                                    @else 
                                        <img alt="Profile Picture" src="{{ asset('img/image-not-found.png')}}" class="media-object"/>
                                    @endif
                                </a>
                            </div>
                        </div>
                    @endif
                @endforeach
                <div id="send_message"></div>
            </div>
            
            <div class="panel-footer">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Enter your message here..." id="message">
                    <span class="input-group-btn">
                        <button class="btn btn-primary ml5 br3" type="button" id="btn-send-message">Send Message</button>
                    </span>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="{{ asset('js/vendor/jquery-3.3.1.min.js') }}"></script>
    <script>
        
        $(document).ready(function () {
            $("#btn-send-message").click(function (e) { 
                var message = $("#message").val();
                document.getElementById('message').value = ''
                send_message(message)
            })        
        })

        $(document).on('keypress',function(e) {
            if(e.which == 13) {
                var message = $("#message").val();
                document.getElementById('message').value = ''
                send_message(message)
            }
        });

        function send_message(message) {
            $.ajax({
                type: 'POST',
                url: '/admins/chat/post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    message : message,
                    seller_id : '{{$user->id}}',
                },
                async: false,
                dataType: 'json',
                success: function(response) {
                    // Untuk notifikasi response silahkan ubah sesuai kebutuhan
                    var send = `<div class="media">
                            <div class="media-body">
                                <span class="media-status offline"></span>
                                <h5 class="media-heading">{{ Auth::guard('admin')->user()->name }}
                                    <span>`+response.timestamp+`</span>
                                </h5>
                                `+response.message+`
                            </div>
                            <div class="media-right">
                                <a href="#">
                                    @if (Auth::guard('admin')->user()->profil)
                                        <img alt="Profile Picture" src="{{asset('storage/'. Auth::guard('admin')->user()->profil)}}" class="media-object"/>
                                    @else 
                                        <img alt="Profile Picture" src="{{ asset('img/image-not-found.png')}}" class="media-object"/>
                                    @endif
                                </a>
                            </div>
                        </div>`;
                    $('#send_message').append(send);
                },
            });
        }
    </script>