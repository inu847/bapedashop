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
                                        <div class="card-body">
                                            <form action="">
                                                <div class="input-group mb-3">
                                                    <div class="col-12">
                                                        <label for="">Nama :</label>
                                                    </div>
                                                    <input type="text" class="form-control col-12" value="{{$user->name}}">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="col-12">
                                                        <label for="">Nama Toko :</label>
                                                    </div>
                                                    <input type="text" class="form-control col-12" value="{{$user->nama_toko}}">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="col-12">
                                                        <label for="">Email :</label>
                                                    </div>
                                                    <input type="text" class="form-control col-12" value="{{$user->email}}">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="col-12">
                                                        <label for="">No Handphone :</label>
                                                    </div>
                                                    <input type="text" class="form-control col-12" value="{{$user->phone}}">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="col-12">
                                                        <label for="">Tanggal Lahir :</label>
                                                    </div>
                                                    <input type="date" class="form-control col-12" value="{{$user->phone}}">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="card-body">
                                            <div class="d-flex flex-row m-5 p-5">
                                                @if ($user->profile)
                                                
                                                @else
                                                    <img src="{{ asset('img/image-not-found.png')}}" alt="Foto Profile" class="rounded-circle" style="width: 100px; height: 100px;"/>
                                                @endif
                                            </div>
                                            <div class="ml-5 mr-5">
                                                <input type="file" name="images">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection