@extends('layouts.auth')

@section('title')
    Regitration
@endsection

@section('content')
    <div class="container">
        <div class="row h-100">
            <div class="col-12 col-md-10 mx-auto my-auto">
                <div class="card auth-card">
                    <div class="position-relative image-side ">
                        <p class=" text-white h2">MAGIC IS IN THE DETAILS</p>
                        <p class="white mb-0">
                            Please use this form to register.
                            <br>If you are a member, please
                            <a href="#" class="white">login</a>.
                        </p>
                    </div>
                    <div class="form-side">
                        <a class="navbar-logo" href="{{ url('/')}} ">
                            <img src="{{asset('img/LOGO 4.png')}}" alt="" style="height: 70px;" class="mb-5">
                        </a>
                        <h6 class="mb-4">Register</h6>

                        <form method="POST" action="{{route('user.store')}}" enctype="multipart/form-data">
                            @csrf

                            <label class="form-group has-float-label mb-4">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus/>
                                <span>Username</span>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </label>
                            <label class="form-group has-float-label mb-4">
                                <input id="nama_toko" type="text" class="form-control @error('nama_toko') is-invalid @enderror" name="nama_toko" value="{{ old('nama_toko') }}" required autocomplete="nama_toko" autofocus/>
                                <span>Nama Toko</span>
                                @error('nama_toko')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </label>
                            <label class="form-group has-float-label mb-4">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus/>
                                <span>Email</span>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </label>
                            <label class="form-group has-float-label mb-3">
                                <input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus/>
                                <span>Nomor Hp/Wa</span>
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </label>
                            <i><small class="text-muted">//* berisi data toko yang didaftarkan, seperti:surat izin usaha, foto tempat usaha </small></i>
                            <label class="form-group has-float-label mb-4 mt-1">
                                <input id="file_penunjang" type="file" class="form-control @error('file_penunjang') is-invalid @enderror" name="file_penunjang" value="{{ old('file_penunjang') }}" required autocomplete="file_penunjang" autofocus/>
                                <span>File Penunjang</span>
                                @error('file_penunjang')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </label>
                            <label class="form-group has-float-label mb-4">
                                <input id="ktp" type="file" class="form-control @error('ktp') is-invalid @enderror" name="ktp" value="{{ old('ktp') }}" required autocomplete="ktp" autofocus/>
                                <span>Ktp</span>
                                @error('ktp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </label>
                            <label class="form-group has-float-label mb-4">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required autocomplete="password" autofocus/>
                                <span>Password</span>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </label>
                            <label class="form-group has-float-label mb-4">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password"/>
                                <span>Konfirmasi Password</span>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </label>
                            <div class="d-flex justify-content-end align-items-center">
                                <button class="btn btn-primary btn-lg btn-shadow" type="submit">REGISTER</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> 
@endsection