<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Chat</title>
    <link rel="stylesheet" href="{{ asset('font/iconsmind-s/css/iconsminds.css') }}" />
    <link rel="stylesheet" href="{{ asset('font/simple-line-icons/css/simple-line-icons.css') }}" />

    <link rel="stylesheet" href="{{ asset('css/vendor/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/vendor/bootstrap.rtl.only.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/vendor/fullcalendar.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/vendor/dataTables.bootstrap4.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/vendor/datatables.responsive.bootstrap4.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/vendor/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/vendor/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/vendor/glide.core.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/vendor/bootstrap-stars.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/vendor/nouislider.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/vendor/bootstrap-datepicker3.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/vendor/component-custom-switch.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/dore.light.blue.css') }}" />
</head>

<body id="app-container" class="menu-sub-hidden show-spinner">
    <nav class="navbar fixed-top">
        <div class="d-flex align-items-center navbar-left">
            <a href="#" class="menu-button d-none d-md-block">
                <svg class="main" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 9 17">
                    <rect x="0.48" y="0.5" width="7" height="1" />
                    <rect x="0.48" y="7.5" width="7" height="1" />
                    <rect x="0.48" y="15.5" width="7" height="1" />
                </svg>
                <svg class="sub" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17">
                    <rect x="1.56" y="0.5" width="16" height="1" />
                    <rect x="1.56" y="7.5" width="16" height="1" />
                    <rect x="1.56" y="15.5" width="16" height="1" />
                </svg>
            </a>

            <a href="#" class="menu-button-mobile d-xs-block d-sm-block d-md-none">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 17">
                    <rect x="0.5" y="0.5" width="25" height="1" />
                    <rect x="0.5" y="7.5" width="25" height="1" />
                    <rect x="0.5" y="15.5" width="25" height="1" />
                </svg>
            </a>
            
            <form action="{{ route('filter.toko')}}" class="ml-2">
                <div class="input-group">
                    <input placeholder="Search..." value="{{Request::get('keyword')}}" name="keyword" type="text" class="form-control">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit" value="Filter">Button</button>
                    </div>
                </div> 
            </form>
   
        </div>

        <a class="navbar-logo" href="{{ ('/') }}">
            <img src="{{asset('img/LOGO 4.png')}}" alt="" style="height: 50px;">
        </a>
        

        <div class="navbar-right">
            <div class="header-icons d-inline-block align-middle">

                <div class="position-relative d-inline-block">
                    <button class="header-icon btn btn-empty" type="button" id="notificationButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="simple-icon-bell"></i>
                        <span class="count">3</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right mt-3 position-absolute" id="notificationDropdown">
                        <div class="scroll">
                            <div class="d-flex flex-row mb-3 pb-3 border-bottom">
                                <a href="#">
                                    <img src="img/profile-pic-l-2.jpg" alt="Notification Image"
                                        class="img-thumbnail list-thumbnail xsmall border-0 rounded-circle" />
                                </a>
                                <div class="pl-3">
                                    <a href="#">
                                        <p class="font-weight-medium mb-1">Joisse Kaycee just sent a new comment!</p>
                                        <p class="text-muted mb-0 text-small">09.04.2018 - 12:45</p>
                                    </a>
                                </div>
                            </div>
                            <div class="d-flex flex-row mb-3 pb-3 border-bottom">
                                <a href="#">
                                    <img src="img/notification-thumb.jpg" alt="Notification Image"
                                        class="img-thumbnail list-thumbnail xsmall border-0 rounded-circle" />
                                </a>
                                <div class="pl-3">
                                    <a href="#">
                                        <p class="font-weight-medium mb-1">1 item is out of stock!</p>
                                        <p class="text-muted mb-0 text-small">09.04.2018 - 12:45</p>
                                    </a>
                                </div>
                            </div>
                            <div class="d-flex flex-row mb-3 pb-3 border-bottom">
                                <a href="#">
                                    <img src="img/notification-thumb-2.jpg" alt="Notification Image"
                                        class="img-thumbnail list-thumbnail xsmall border-0 rounded-circle" />
                                </a>
                                <div class="pl-3">
                                    <a href="#">
                                        <p class="font-weight-medium mb-1">New order received! It is total $147,20.</p>
                                        <p class="text-muted mb-0 text-small">09.04.2018 - 12:45</p>
                                    </a>
                                </div>
                            </div>
                            <div class="d-flex flex-row mb-3 pb-3 ">
                                <a href="#">
                                    <img src="{{ asset('img/notification-thumb-3.jpg')}}" alt="Notification Image"
                                        class="img-thumbnail list-thumbnail xsmall border-0 rounded-circle" />
                                </a>
                                <div class="pl-3">
                                    <a href="#">
                                        <p class="font-weight-medium mb-1">3 items just added to wish list by a user!
                                        </p>
                                        <p class="text-muted mb-0 text-small">09.04.2018 - 12:45</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <button class="header-icon btn btn-empty d-none d-sm-inline-block" type="button" id="fullScreenButton">
                    <i class="simple-icon-size-fullscreen"></i>
                    <i class="simple-icon-size-actual"></i>
                </button>

            </div>

            @if (Route::has('login'))
                @auth
                <div class="user d-inline-block">
                    <button class="btn btn-empty p-0" type="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <span class="name">{{ Auth::user()->name }}</span>
                        <span>
                            @if (Auth::user()->profil)
                                <img alt="Profile Picture" src="{{asset('storage/'. Auth::user()->profil)}}"/>
                            @else 
                                <img alt="Profile Picture" src="{{ asset('img/image-not-found.png')}}" />
                            @endif
                        </span>
                    </button>

                    <div class="dropdown-menu dropdown-menu-right mt-3">
                        <a class="dropdown-item" href="#">Account</a>
                        <a class="dropdown-item" href="#">Features</a>
                        <a class="dropdown-item" href="#">History</a>
                        <a class="dropdown-item" href="#">Support</a>
                        <a class="dropdown-item" href="{{ route('logout') }}" 
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();" >Sign out</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>                            
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="text-sm mr-1">Log in</a>
                <span>|</span>
                @if (Route::has('register'))
                    <a href="{{ route('formRegister.user') }}" class="ml-1 text-sm mr-2">Register</a>
                @endif
                @endauth
            @endif
        </div>
    </nav>
    
    <div class="menu">
        <div class="main-menu">
            <div class="scroll">
                <ul class="list-unstyled" data-link="dashboard">
                    <li>
                        <a href="{{url('/')}}">
                            <i class="iconsminds-shop-4"></i>
                            <span>Home Page</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard.index') }}">
                            <i class="simple-icon-pie-chart"></i>
                            <span>Dasboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('manage-order.index') }}">
                            <i class="iconsminds-shopping-cart"></i> 
                            <span>Manage Order</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('manage-product.index')}}">
                            <i class="iconsminds-air-balloon-1"></i>
                            <span>Manage Product</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('seller.chat') }}">
                            <i class="simple-icon-bubbles"></i> 
                            <span>Chat</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('manage-job.index') }}">
                            <i class="simple-icon-grid"></i> 
                            <span>Jobs</span>
                        </a>
                    </li>
                    <li>
                        @if (\Auth::user())
                            <a href="{{ route('user.edit', [\Auth::user()])}}">
                        @else
                            <a href="#">
                        @endif
                            <i class="simple-icon-settings"></i><span>Account Setting</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('tools.index') }}">
                            <i class="simple-icon-diamond"></i> 
                            <span>Tools</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    {{-- CONTENT --}}
    <main>
        <div class="container-fluid">
            <div class="row app-row">
                <div class="col-12 chat-app invisible">
                    <div class="d-flex flex-row justify-content-between mb-3 chat-heading-container">
                        <div class="d-flex flex-row chat-heading">
                            <a class="d-flex" href="#">
                                <img alt="Profile Picture" src="{{ asset('img/LOGO 4.png') }}"
                                    class="img-thumbnail border-0 ml-0 mr-4 list-thumbnail align-self-center small">
                            </a>
                            <div class=" d-flex min-width-zero">
                                <div
                                    class="card-body pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
                                    <div class="min-width-zero">
                                        <a href="#">
                                            <p class="list-item-heading mb-1 truncate">CAPPS</p>
                                        </a>
                                        <p class="mb-0 text-warning text-small">online</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <div class="separator mb-5"></div>
    
                    <div class="scroll">
                        <div class="scroll-content">

                            @foreach ($chats as $chat)
                                @if ($chat->message_seller)
                                    <div class="clearfix"></div>
                                    <div class="card d-inline-block mb-3 float-right mr-2">
                                        <div class="position-absolute pt-1 pr-2 r-0">
                                            <span class="text-extra-small text-muted">{{ $chat->created_at->format('H:i')}}</span>
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex flex-row pb-2">
                                                <a class="d-flex" href="#">
                                                    @if (Auth::user()->profil)
                                                        <img alt="Profile Picture" src="{{asset('storage/'. Auth::user()->profil)}}" class="img-thumbnail border-0 rounded-circle mr-3 list-thumbnail align-self-center xsmall"/>
                                                    @else 
                                                        <img alt="Profile Picture" src="{{ asset('img/image-not-found.png')}}" class="img-thumbnail border-0 rounded-circle mr-3 list-thumbnail align-self-center xsmall"/>
                                                    @endif
                                                </a>
                                                <div class=" d-flex flex-grow-1 min-width-zero">
                                                    <div
                                                        class="m-2 pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
                                                        <div class="min-width-zero">
                                                            <p class="mb-0 truncate list-item-heading">{{ \Auth::user()->name }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
            
                                            <div class="chat-text-left">
                                                <p class="mb-0 text-semi-muted">
                                                    {{ $chat->message_seller }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @elseif($chat->message_admin)
                                    <div class="clearfix"></div>
                                    <div class="card d-inline-block mb-3 float-left mr-2">
                                        <div class="position-absolute pt-1 pr-2 r-0">
                                            <span class="text-extra-small text-muted">{{ $chat->created_at->diffForHumans()}}</span>
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex flex-row pb-2">
                                                <a class="d-flex" href="#">
                                                    <img alt="Profile Picture" src="{{ asset('img/LOGO 1.png')}}"
                                                        class="img-thumbnail border-0 rounded-circle mr-3 list-thumbnail align-self-center xsmall">
                                                </a>
                                                <div class=" d-flex flex-grow-1 min-width-zero">
                                                    <div
                                                        class="m-2 pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
                                                        <div class="min-width-zero">
                                                            <p class="mb-0 truncate list-item-heading">CAPPS</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
            
                                            <div class="chat-text-left">
                                                <p class="mb-0 text-semi-muted">
                                                    {{ $chat->message_admin }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                
                            @endforeach

                            <div id="send_message"></div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="app-menu">
            <ul class="nav nav-tabs card-header-tabs ml-0 mr-0 mb-1" role="tablist">
                <li class="nav-item w-100 text-center">
                    <a class="nav-link active" id="first-tab" data-toggle="tab" role="tab" aria-selected="true">Messages</a>
                </li>
            </ul>
    
            <div class="p-4 h-100">
                <div class="form-group">
                    <input type="text" class="form-control rounded" placeholder="Search">
                </div>

                <div class="tab-content h-100" id="message-group">
                    <div class="tab-pane fade show active  h-100" id="firstFull" role="tabpanel" aria-labelledby="first-tab">
                        <div class="scroll">   

                            @foreach ($messages as $message)
                                @if ($message->admin_id)
                                <a class="d-flex" id="show-message" data-message_id="{{$message->admin_id}}">
                                    <div class="d-flex flex-row mb-1 border-bottom pb-3 mb-3">
                                        <img alt="Profile Picture" src="{{ asset('img/LOGO 1.png') }}"
                                            class="img-thumbnail border-0 rounded-circle mr-3 list-thumbnail align-self-center xsmall">
                                        <div class="d-flex flex-grow-1 min-width-zero">
                                            <div
                                                class="pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
                                                <div class="min-width-zero">
                                                    <p class=" mb-0 truncate">CAPPS</p>
                                                    <p class="mb-1 text-muted text-small">09:25</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                @else
                                    <div class="d-flex flex-row mb-1 border-bottom pb-3 mb-3">
                                        message empty
                                    </div>
                                @endif
                            @endforeach
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="chat-input-container d-flex justify-content-between align-items-center">
            <input class="form-control flex-grow-1" type="text" placeholder="Say something..." id="message">
            <div>
                <button type="button" class="btn btn-outline-primary icon-button large">
                    <i class="simple-icon-paper-clip"></i>
                </button>
                <button type="submit" id="btn-send-message" class="btn btn-primary icon-button large">
                    <i class="simple-icon-arrow-right"></i>
                </button>
            </div>
        </div>
    </main>
    {{-- END CONTENT --}}

    <script src="{{ asset('js/vendor/jquery-3.3.1.min.js') }}"></script>
    <script>
        $(document).ready(function (){
            $("#btn-send-message").click(function() { 
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
                url: '/seller/chat/post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    message : message,

                },
                async: false,
                dataType: 'json',
                success: function(response) {
                    // Untuk notifikasi response silahkan ubah sesuai kebutuhan
                    var send = `<div class="clearfix"></div>
                            <div class="card d-inline-block mb-3 float-right mr-2">
                                <div class="position-absolute pt-1 pr-2 r-0">
                                    <span class="text-extra-small text-muted">`+response.timestamp+`</span>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex flex-row pb-2">
                                        <a class="d-flex" href="#">
                                            @if (Auth::user()->profil)
                                                <img alt="Profile Picture" src="{{asset('storage/'. Auth::user()->profil)}}" class="img-thumbnail border-0 rounded-circle mr-3 list-thumbnail align-self-center xsmall"/>
                                            @else 
                                                <img alt="Profile Picture" src="{{ asset('img/image-not-found.png')}}" class="img-thumbnail border-0 rounded-circle mr-3 list-thumbnail align-self-center xsmall"/>
                                            @endif
                                        </a>
                                        <div class=" d-flex flex-grow-1 min-width-zero">
                                            <div
                                                class="m-2 pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
                                                <div class="min-width-zero">
                                                    <p class="mb-0 truncate list-item-heading">{{ \Auth::user()->name }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="chat-text-left">
                                        <p class="mb-0 text-semi-muted">
                                            `+response.message+`
                                        </p>
                                    </div>
                                </div>
                            </div>`;
                    $('#send_message').append(send);
                },
            });
        }
    </script>
    
    <script src="{{ asset('js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/vendor/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('js/vendor/chartjs-plugin-datalabels.js') }}"></script>
    <script src="{{ asset('js/vendor/moment.min.js') }}"></script>
    <script src="{{ asset('js/vendor/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('js/vendor/datatables.min.js') }}"></script>
    <script src="{{ asset('js/vendor/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('js/vendor/progressbar.min.js') }}"></script>
    <script src="{{ asset('js/vendor/jquery.barrating.min.js') }}"></script>
    <script src="{{ asset('js/vendor/select2.full.js') }}"></script>
    <script src="{{ asset('js/vendor/nouislider.min.js') }}"></script>
    <script src="{{ asset('js/vendor/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('js/vendor/Sortable.js') }}"></script>
    <script src="{{ asset('js/vendor/mousetrap.min.js') }}"></script>
    <script src="{{ asset('js/vendor/glide.min.js') }}"></script>
    <script src="{{ asset('js/vendor/order.js') }}"></script>
    <script src="{{ asset('js/dore.script.js') }}"></script>
    <script src="{{ asset('js/scripts.single.theme.js') }}"></script>
    <script src="https://css-tricks.foxycart.com/files/foxycart_includes.js" type="text/javascript" charset="utf-8"></script>
</body>

</html>