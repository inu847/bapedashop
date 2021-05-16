@extends('auth.admin')

@section('title')
    Login Admin
@endsection

@section('content')
    <div class="allcp-form theme-primary mw320" >
        <div class="bg-primary mw600 text-center mb20 br3 pt15 pb10">
            <img src="{{asset('img/LOGO 4.png')}}" alt="" style="height: 70px;"/>
        </div>
        <div class="panel mw320">

            <form method="POST" action="{{ route('do_login_admin') }}" enctype="multipart/form-data">
                @csrf
                <div class="panel-body pn mv10">

                    <div class="section">
                        <label for="username" class="field prepend-icon">
                            <input type="email" name="email" value="{{ old('email') }}" id="username" class="gui-input"
                                placeholder="Username">
                            <span class="field-icon">
                                <i class="fa fa-user"></i>
                            </span>
                        </label>
                    </div>

                    <div class="section">
                        <label for="password" class="field prepend-icon">
                            <input type="password" name="password" id="password" class="gui-input"
                                placeholder="Password">
                            <span class="field-icon">
                                <i class="fa fa-lock"></i>
                            </span>
                        </label>
                    </div>

                    <div>
                        <div class="bs-component pull-left pt5">
                            <div class="radio-custom radio-primary mb5 lh25">
                                <input type="radio" id="remember" name="remember">
                                <label for="remember">Remember me</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-bordered btn-primary pull-right">Log in</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection