@extends('layouts.global')

@section('title')
    Verifikasi Order
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-warning rounded" role="alert">
            {{session('success')}}
        </div>
    @endif
    @if(session('fail'))
        <div class="alert alert-danger rounded" role="alert">
            {{session('fail')}}
        </div>
    @endif
    
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="mb-4">Verivikasi Order <span class="text-muted text-small">Input Manual</span></h5>
            <form action="{{ route('verivikasi.pesanan') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="no_pesanan">Nomor Pesanan</label>
                    <input type="text" class="form-control mb-2" id="no_pesanan" placeholder="Masukkan Nomor Pesanan" name="no_pesanan">
                </div>
                <button type="submit" class="btn btn-sm btn-outline-primary mb-2">Submit</button>
                <a href="{{route('verivikasi.qrcode')}}" class="btn btn-sm btn-outline-dark mb-2"><i class="iconsminds-qr-code">Scan Barcode</i></a>
            </form>
        </div>
    </div>

@endsection