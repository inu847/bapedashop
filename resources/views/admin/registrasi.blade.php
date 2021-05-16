@extends('auth.admin')

@section('title')
    Tambahkan Admin
@endsection

@section('content')

            <div class="allcp-form theme-primary mw600" id="register">
                <div class="bg-primary mw600 text-center mb20 br3 pt15 pb10">
                    <img src="{{asset('img/LOGO 4.png')}}" alt="" style="height: 70px;"/>
                </div>
                <div class="panel panel-primary">
                    <div class="panel-heading pn">
                                    <span class="panel-title">
                                      Registration form
                                    </span>
                    </div>

                    <form method="POST" action="{{ route('registrasi.admin') }}" id="form-register" enctype="multipart/form-data">
                        @csrf
                        <div class="panel-body pn">
                            {{-- <div class="section row mh10m">
                                <div class="col-md-6 ph10">
                                    <label for="firstname" class="field prepend-icon">
                                        <input type="text" name="first_name" id="firstname"
                                               class="gui-input"
                                               placeholder="First name...">
                                        <span class="field-icon">
                                            <i class="fa fa-user"></i>
                                        </span>
                                    </label>
                                </div>

                                <div class="col-md-6 ph10">
                                    <label for="lastname" class="field prepend-icon">
                                        <input type="text" name="last_name" id="lastname" class="gui-input"
                                               placeholder="Last name...">
                                        <span class="field-icon">
                                            <i class="fa fa-user"></i>
                                        </span>
                                    </label>
                                </div>

                            </div> --}}
                            <div class="section">
                                <label for="name" class="field prepend-icon">
                                    <input type="text" name="name" id="name" class="gui-input"
                                           placeholder="Nickname">
                                    <span class="field-icon">
                                        <i class="fa fa-user"></i>
                                    </span>
                                </label>
                            </div>

                            <div class="section">
                                <label for="email" class="field prepend-icon">
                                    <input type="email" name="email" id="email" class="gui-input"
                                           placeholder="Email address">
                                    <span class="field-icon">
                                        <i class="fa fa-envelope"></i>
                                    </span>
                                </label>
                            </div>

                            <div class="section">
                                <label for="phone" class="field prepend-icon">
                                    <input type="number" name="phone" id="phone" class="gui-input"
                                           placeholder="Phone">
                                    <span class="field-icon">
                                        <i class="fa fa-user"></i>
                                    </span>
                                </label>
                            </div>

                            <div class="section">
                                <label for="password" class="field prepend-icon">
                                    <input type="password" name="password" id="password" class="gui-input"
                                           placeholder="Create a password">
                                    <span class="field-icon">
                                        <i class="fa fa-lock"></i>
                                    </span>
                                </label>
                            </div>

                            <div class="section">
                                <label for="password" class="field prepend-icon">
                                    <input type="password" name="password" id="password"
                                           class="gui-input"
                                           placeholder="Retype your password">
                                    <span class="field-icon">
                                        <i class="fa fa-unlock-alt"></i>
                                    </span>
                                </label>
                            </div>

                            <div class="section">
                                <div class="bs-component pull-left mt10 mb10">
                                    <div class="checkbox-custom checkbox-primary mb5">
                                        <input type="checkbox" id="agree" required>
                                        <label for="agree">I agree to the
                                            <a href="#"> terms of use. </a></label>
                                    </div>
                                </div>
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-bordered btn-primary">I Accept - Create Account
                                    </button>
                                </div>
                            </div>

                        </div>

                        <div class="panel-footer">

                        </div>

                    </form>
                </div>
            </div>
@endsection