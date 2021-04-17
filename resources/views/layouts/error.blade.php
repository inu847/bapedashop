<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dore jQuery</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" href="{{ asset('font/iconsmind-s/css/iconsminds.css')}}" />
    <link rel="stylesheet" href="{{ asset('font/simple-line-icons/css/simple-line-icons.css')}}" />

    <link rel="stylesheet" href="{{ asset('css/vendor/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('css/vendor/bootstrap.rtl.only.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('css/vendor/bootstrap-float-label.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('css/dore.light.blue.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/main.css')}}" />
</head>

<style>
    .error_role{
        margin: 60px;
    }
</style>
<body class="show-spinner">

    <div class="error_role">
        <div class="text-center">
            <a href="{{ url('/') }}">
                <img src="{{asset('img/LOGO 4.png')}}" alt="" style="height: 150px; margin-bottom: 10px;">
            </a>

            <h3 class="mb-0 text-muted mb-0">Error code</h3>
            <h2 class="mb-3">
                @yield('exceptions')
            </h2>
            
            <h1 class="display-1 font-weight-bold mb-3">
                @yield('status')
            </h1>
            <br>
            <a href="{{ url('/') }}" class="btn btn-primary btn-lg btn-shadow">GO BACK HOME</a>
        </div>
    </div>

    
    <script src="{{ asset('js/vendor/jquery-3.3.1.min.js')}}"></script>
    <script src="{{ asset('js/vendor/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('js/dore.script.js') }}"></script>
    <script src="{{ asset('js/scripts.single.theme.js') }}"></script>
</body>

</html>