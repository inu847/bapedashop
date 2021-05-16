
<!DOCTYPE html>
<html>

<head>
    <!-- Meta and Title -->
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="keywords" content="HTML5, Bootstrap 3, Admin Template, UI Theme"/>
    <meta name="description" content="AdminK - A Responsive HTML5 Admin UI Framework">
    <meta name="author" content="ThemeREX">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- <link rel="shortcut icon" href="assets/img/favicon.png"> --}}
    <link rel="stylesheet" type="text/css" href="{{asset('admin/skin/css/angular-material.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/fonts/icomoon/icomoon.css')}}">    
    <link rel="stylesheet" type="text/css" href="{{asset('admin/fonts/animatedsvgicons/css/codropsicons.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/allcp/forms/css/forms.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/js/utility/malihu-custom-scrollbar-plugin-master/jquery.mCustomScrollbar.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/skin/default_skin/less/theme.css')}}">
    
    <!-- IE8 HTML5 support -->
    <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body class="utility-page sb-l-c sb-r-c">

<div id="main" class="animated fadeIn">

    <!-- Main Wrapper -->
    <section id="content_wrapper">

        <div id="canvas-wrapper">
            <canvas id="demo-canvas"></canvas>
        </div>
        
        <section id="content">
            @yield('content')
        </section>
    </section>
</div>


{{-- <script src="{{asset('admin/js/jquery/jquery-1.12.3.min.js')}}"></script> --}}
<script src="{{asset('admin/js/jquery/jquery_ui/jquery-ui.min.js')}}"></script>
<script src="{{asset('admin/fonts/animatedsvgicons/js/snap.svg-min.js')}}"></script>
<script src="{{asset('admin/fonts/animatedsvgicons/js/svgicons-config.js')}}"></script>
<script src="{{asset('admin/fonts/animatedsvgicons/js/svgicons.js')}}"></script>
<script src="{{asset('admin/fonts/animatedsvgicons/js/svgicons-init.js')}}"></script>
<script src="{{asset('admin/js/utility/malihu-custom-scrollbar-plugin-master/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<script src="{{asset('admin/js/plugins/highcharts/highcharts.js')}}"></script>
<script src="{{asset('admin/js/plugins/canvasbg/canvasbg.js')}}"></script>
<script src="{{asset('admin/js/utility/utility.js')}}"></script>
<script src="{{asset('admin/js/demo/demo.js')}}"></script>
<script src="{{asset('admin/js/main.js')}}"></script>
<script src="{{asset('admin/js/demo/widgets_sidebar.js')}}"></script>
<script src="{{asset('admin/js/pages/dashboard_init.js')}}"></script>

</body>

</html>
{{-- 


    <div class="container">
        <div class="row h-100">
            <div class="col-12 col-md-10 mx-auto my-auto">
                <div class="card auth-card">
                    <div class="position-relative image-side ">

                        <p class=" text-white h2">MAGIC IS IN THE DETAILS</p>

                        <p class="white mb-0">
                            Please use your credentials to login.
                            <br>If you are not a member, please
                            <a href="#" class="white">register</a>.
                        </p>
                    </div>
                    <div class="form-side">
                        <a class="navbar-logo" href="{{ url('/')}} ">
                            <img src="{{asset('img/LOGO 4.png')}}" alt="" style="height: 70px;" class="mb-5">
                        </a>
                        @if(session('status'))
                            <div class="alert alert-success">
                                {{session('status')}}
                            </div>
                        @endif
                        <h6 class="mb-4">Login Admin</h6>
                        <form method="POST" action="{{ route('do_login_admin') }}">
                            @csrf

                            <label class="form-group has-float-label mb-4">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus/>
                                
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <span>E-mail</span>
                            </label>

                            <label class="form-group has-float-label mb-0">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"/>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                
                                <span>Password</span>
                            </label>
                            <div class="mb-5">
                                <div class="float-right">
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}">Forget password?</a>
                                    @endif
                                </div> 
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="pt-2">
                                        <div class="custom-control custom-checkbox pl-1">
                                            <label class="custom-control custom-checkbox mb-0">
                                                <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <span class="custom-control-label"></span>
                                                <p class="pt-1" style="font-size: 12px;">{{ __('Remember Me') }}</p>
                                            </label>
                                        </div>
                                </div>   
                                <a href="{{ route('register') }}" class="btn btn-danger btn-lg btn-shadow">Register</a>
                                <button class="btn btn-primary btn-lg btn-shadow" type="submit">LOGIN</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection --}}