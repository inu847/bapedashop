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
            <h5 class="mb-4">Verivikasi Order <span class="text-muted text-small">Scan Qr-Code</span></h5>
            <form action="{{ route('verivikasi.pesanan') }}" method="POST" enctype="multipart/form-data">
                @csrf                
                {{-- <h4 class="text-center mb-3">Preview Camera</h4> --}}
                <!-- SCAN VIDIO -->
                {{-- <video id="preview" width="300" height="300" class="mb-3 text-center"></video> --}}
                <!-- INPUT -->
                <div class="form-group">
                    <label for="">Nomor Pesanan</label>
                    <input type="text" id="qrcode" class="form-control" name="no_pesanan">
                </div>
                <button type="submit" class="btn btn-sm btn-outline-primary mb-2">Submit</button>
            </form>
        </div>
    </div>

    <script src="{{ asset('js/instascan.min.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript">
    let scanner = new Instascan.Scanner({video: document.getElementById('preview')});
    scanner.addListener('scan',  function(content){
        alert(content);
        $('#qrcode').val(content);
    });
    Instascan.Camera.getCameras().then(function (cameras){
        if(cameras.length > 0){
            scanner.start(cameras[0]);
        }else{
            console.error('Camera Not Found');
        }
    }).catch(function (e){
        console.error(e);
    });
    </script>
@endsection