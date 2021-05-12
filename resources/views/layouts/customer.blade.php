<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
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

<body id="app-container" class="menu-hidden show-spinner">
    <nav class="navbar fixed-top">
        <div class="d-flex align-items-center navbar-left">
            <form action="{{ route('filter.toko')}}" class="ml-3">
                <div class="input-group">
                    <input placeholder="Search..." value="{{Request::get('keyword')}}" name="keyword" type="text" class="form-control">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit" value="Filter">Button</button>
                    </div>
                </div> 
            </form>
        </div>
        

        <a class="navbar-logo" href="{{ url('/customer') }}">
            <img src="{{asset('img/LOGO 4.png')}}" alt="" style="height: 50px;">
        </a>
        

        <div class="navbar-right">
            <div class="header-icons d-inline-block align-middle">

                <div class="position-relative d-inline-block">
                    @if (Auth::guard('customer')->user())
                    <a href="{{ route('customer.create') }}" class="header-icon btn btn-empty" id="notificationButton">
                        <i class="iconsminds-shopping-cart"></i>
                            <span class="count">{{keranjangCustomer()}}</span>
                    </a>
                    @endif
                </div>

                <button class="header-icon btn btn-empty d-none d-sm-inline-block" type="button" id="fullScreenButton">
                    <i class="simple-icon-size-fullscreen"></i>
                    <i class="simple-icon-size-actual"></i>
                </button>

            </div>
            @if (Auth::guard('customer')->user())
                
                <div class="user d-inline-block">
                    <button class="btn btn-empty p-0" type="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <span class="name">{{ Auth::guard('customer')->user()->name }}</span>
                        <span>
                            @if (Auth::guard('customer')->user()->profil)
                                <img alt="Profile Picture" src="{{asset('storage/'. Auth::guard('customer')->user()->profil)}}"/>
                            @else 
                                <img alt="Profile Picture" src="{{ asset('img/image-not-found.png')}}" />
                            @endif
                        </span>
                    </button>

                    <div class="dropdown-menu dropdown-menu-right mt-3">
                        <a class="dropdown-item" href="{{ route('accountCustomer') }}">Account</a>
                        <a class="dropdown-item" href="{{ route('pesanan.saya') }}">Pesanan Saya</a>
                        <a class="dropdown-item" href="#">History</a>
                        <a class="dropdown-item" href="{{ route('do_logout_customer') }}" 
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();" >Sign out</a>
                            <form id="logout-form" action="{{ route('do_logout_customer') }}" method="POST" class="d-none">
                                @csrf
                            </form>                            
                    </div>
                </div>
            @else
                <a href="{{ route('login_customer') }}" class="text-sm mr-1">Log in</a>
                <span>|</span>
                @if (Route::has('register'))
                    <a href="{{ route('formRegister.customer') }}" class="ml-1 text-sm mr-2">Register</a>
                @endif
            @endif
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="page-footer">
        <div class="footer-content">
            <div class="container-fluid">
                <p class="mb-0 text-muted text-center">© 2021 CAPPS</p>
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/vendor/jquery-3.3.1.min.js') }}"></script>
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
    <script src="{{ asset('js/vue.js')}}"></script>
</body>

</html>