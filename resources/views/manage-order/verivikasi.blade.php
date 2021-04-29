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
            <h5 class="mb-4">Verivikasi Order <span class="text-muted text-small">Support Scan Qr-Code</span></h5>
            <form action="{{ route('verivikasi.order') }}" method="GET">             
                {{-- <h4 class="text-center mb-3">Preview Camera</h4> --}}
                <!-- SCAN VIDIO -->
                {{-- <video id="preview" width="300" height="300" class="mb-3 text-center"></video> --}}
                <!-- INPUT -->
                <div class="form-group">
                    <label for="">Nomor Pesanan</label>
                    <input type="text" id="qrcode" class="form-control" name="no_pesanan">                  
                </div>
                <button type="submit" class="btn btn-sm btn-outline-primary mb-2">Search</button>
                <a class="btn btn-sm btn-outline-primary mb-2" href="javascript:void(0)" id="search"></i>Submit</a>
            </form>
        </div>
    </div>

    @if ($buyer)
        <div class="card">
            <div class="card-body">
                <h4 class="mb-4">Detail Order</h4>
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th>Buyer <span>:</span></th>
                            <td>{{$buyer->buyer}}</td>
                        </tr>
                        <tr>
                            <th>Meja <span>:</span></th>
                            <td>{{$buyer->meja}}</td>
                        </tr>
                        <tr>
                            <th>Enkripsi <span>:</span></th>
                            <td>{{$buyer->enkripsi_token}}</td>
                        </tr>
                        <tr>
                            <th>Status <span>:</span></th>
                            <td>
                                @if ( $buyer->status == 'process' )
                                    <span class="badge badge-pill badge-primary">{{ Str::upper($buyer->status) }}</span>
                                @elseif ($buyer->status == 'success')
                                    <span class="badge badge-pill badge-success">{{ Str::upper($buyer->status) }}</span>
                                @elseif ($buyer->status == 'on hold')
                                    <span class="badge badge-pill badge-danger">{{ Str::upper($buyer->status) }}</span>
                                @else
                                    <span class="badge badge-pill badge-info">Belum Verivikasi</span>
                                @endif
                            </td>
                        </tr>
                    </thead>
                </table>
                {{-- Table 2 --}}
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nama Product</th>
                            <th>Quantity</th>
                            <th>Row Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <input type="hidden" value="{{$product = \App\Models\Product::get()->where('id', $order->prod_id)}}">
                                @foreach ($product as $prod)
                                    <td>{{$prod->nama_product}}</td>
                                @endforeach
                                <td>{{$order->quantity}} Pcs</td>
                                <td>Rp.{{$order->row_total}}</td>
                                <td>
                                    <form action="{{ route('verivikasi.delete', [$order->id]) }}" 
                                        method="POST"
                                        enctype="multipart/form-data"
                                        onsubmit="return confirm('Delete This Order??')">
                                        @csrf
                                    {{-- <input type="hidden" name="_method" value="DELETE"> --}}
                                    <button class="btn btn-danger btn-sm" type="submit"><i class="simple-icon-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <table class="table table-borderless">
                    <tr>
                        <td colspan="2" style=" width: 100%; padding-bottom:15px;">
                            <p href="#"
                                style="font-size: 13px; text-decoration: none; line-height: 1.6; color:#909090; margin-top:0px; margin-bottom:0; text-align: right;">
                                Total Quantity : 
                            </p>
                        </td>
                        <td>{{$buyer->total_quantity}} Pcs</td>
                    </tr>
                    <tr>
                        <td colspan="2" style=" width: 100%; padding-bottom:15px;">
                            <p href="#"
                                style="font-size: 13px; text-decoration: none; line-height: 1.6; color:#909090; margin-top:0px; margin-bottom:0; text-align: right;">
                                Total Pembelian : 
                            </p>
                        </td>
                        <td>Rp.{{$buyer->subtotal}}</td>
                    </tr>
                    <tr>
                        <td colspan="3" style=" width: 100%; padding-bottom:15px;">
                            <form action="{{ route('verivikasi.byGet') }}" method="POST" enctype="multipart/form-data" style="font-size: 13px; text-decoration: none; line-height: 1.6; color:#909090; margin-top:0px; margin-bottom:0; text-align: right;">
                                @csrf             
                                <input type="hidden" class="form-control" name="no_pesanan" value="{{$buyer->enkripsi_token}}">                  
                                <button class="btn btn-sm btn-primary mb-2" type="submit"></i>Verivikasi Sekarang</button>
                            </form> 
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    @endif
    

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script>
        $(document).on('click', '#search', function(e) {
            let getid = document.getElementById("qrcode").value;
    
            $.ajax({
                type: 'POST',
                url: '/manage-order/verivikasipesanan',
                data: {
                    "_token": "{{ csrf_token() }}",
                    no_pesanan: getid,
                },
                async: false,
                dataType: 'json',
                success: function(response) {
                    alert(response.message)
                },
                error: function(response) {
                    console.log(response)
                }
            });
        })
    </script>
@endsection