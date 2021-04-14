@extends('layouts.global')

@section('title')
    Setting Account
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row mb-5">
            <div class="col-12">

                <div class="row equal-height-container">
                    <div class="col-md-12 col-lg-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="card-header">
                                            <h3>Account Setting</h3>
                                        </div>
                                        <form action="{{ route('user.update', [$user->id])}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" value="PUT" name="_method">
                                            <div class="card-body">
                                                <div class="input-group mb-3">
                                                    <div class="col-12">
                                                        <label for="">Nama :</label>
                                                    </div>
                                                    <input type="text" class="form-control col-12" name="name" value="{{$user->name}}">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="col-12">
                                                        <label for="">Nama Toko :</label>
                                                    </div>
                                                    <input type="text" class="form-control col-12" name="nama_toko" value="{{$user->nama_toko}}">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="col-12">
                                                        <label for="">Email :</label>
                                                    </div>
                                                    <input type="text" class="form-control col-12" name="email" value="{{$user->email}}">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="col-12">
                                                        <label for="">No Handphone :</label>
                                                    </div>
                                                    <input type="text" class="form-control col-12" name="phone" value="{{$user->phone}}">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="col-12">
                                                        <label for="">Tanggal Lahir :</label>
                                                    </div>
                                                    <input type="date" class="form-control col-12" name="tanggal_lahir" value="{{$user->tanggal_lahir}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="card-body">
                                                <div class="d-flex flex-row m-5 p-5">
                                                    @if ($user->profil)
                                                        <img src="{{asset('storage/'. $user->profil)}}" alt="Foto Profile" class="rounded-circle" style="width: 100px; height: 100px;"/>
                                                    @else
                                                        <img src="{{ asset('img/image-not-found.png')}}" alt="Foto Profile" class="rounded-circle" style="width: 100px; height: 100px;"/>
                                                    @endif
                                                </div>
                                                <div class="ml-5 mr-5">
                                                    <input type="file" name="profil">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2 ml-auto">
                                        <button class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection