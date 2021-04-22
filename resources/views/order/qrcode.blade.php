@extends('layouts.global')

@section('title')
    Scan Qr Code
@endsection
<style>
    .row_center{
        margin-right: 75px;
        margin-left: 275px;
    }
</style>
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-5 mx-auto my-auto">
                <div class="card auth-card">
                    <div class="card-body text-center">
                        <h2><strong>Scan Qr Code</strong></h2>
                        <div>
                            <span class="btn btn-success mb-3">{{$enkripsi}}</span>
                        </div>
                        <div class="mb-3">
                            {{QrCode::format('svg')->size(300)->generate($enkripsi)}}
                        </div>
                        <div class="text-center">
                            <a href="{{ route('order.finish') }}" class="ml-5 mr-5"><i class="simple-icon-logout large-icon"></i></a>
                            <a href="{{ route('user.index') }}" class="mr-5"><i class="iconsminds-repeat-3 large-icon"></i></a>
                            <a href="#" class="mr-5"><i class="iconsminds-headset large-icon"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection