@extends('layouts.buyer')

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
    <input type="hidden" value="{{$buyer = qrcode($enkripsi)}}">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-5 mx-auto my-auto">
                <div class="card auth-card mt-5">
                    <div class="card-body text-center">
                        <h2><strong>Scan Qr Code/Barcode</strong></h2>
                        <div>
                            <span class="btn btn-success mb-3">{{$enkripsi}}</span>
                        </div>
                        <div class="mb-2">
                            {{QrCode::format('svg')->size(300)->generate($enkripsi)}}
                        </div>
                        <div class="mt-4">
                            <img src="data:image/png;base64,{{DNS1D::getBarcodePNG($enkripsi, 'C39',1,33)}}" alt="barcode" />
                            <p class="text-small"><strong>{{$enkripsi}}</strong></p>
                        </div>
                        <div class="text-center">
                            <a data-toggle="modal" data-target="#detailOrder" class="mr-5"><i class="iconsminds-repeat-3 large-icon"></i></a>
                            <a data-toggle="modal" data-target="#suggestion" class="mr-5"><i class="iconsminds-repeat-3 large-icon"></i></a>
                            <a href="#" class="mr-5"><i class="iconsminds-headset large-icon"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    {{-- Modal Fade Suggestion --}}
    <div class="modal fade" id="suggestion" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <img src="{{asset('img/LOGO 4.png')}}" alt="" style="height: 50px;">
                    <h5 class="mt-3">Masukkan Data Pemesan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('create.suggestion', [$buyer->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="user_id" value="{{$buyer->user_id}}">
                        <div class="form-group">
                            <label for="ulasan" class="col-md-12">Ulasan</label>
                            <textarea name="suggestion" id="ulasan" class="col-12" rows="2"></textarea>
                        </div>
                        <div class="col-12 col-xs-12">
                            <div class="form-group mb-1">
                                <label class="d-block">Rating</label>
                                <select class="rating" data-current-rating="-1" name="rating">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal Fade Rincian Pesanan --}}
    <div class="modal fade" id="detailOrder" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="mt-3">Detail Order</h5>
                </div>
                <div class="modal-body">
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
                            <input type="hidden" value="{{$orders = orderId()->where('buyer_id', $buyer->id)}}">
                            @foreach ($orders as $order)
                                <tr>
                                    <input type="hidden" value="{{$product = \App\Models\Product::get()->where('id', $order->prod_id)}}">
                                    @foreach ($product as $prod)
                                        <td>{{$prod->nama_product}}</td>
                                    @endforeach
                                    <td>{{$order->quantity}} Pcs</td>
                                    <td>Rp.{{$order->row_total}}</td>
                                    <td>
                                        <a class="btn btn-danger btn-sm" href="javascript:void(0)" id="deleteOrder" data-id="{{ $order->id }}"><i class="simple-icon-trash"></i></a>
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
                    </table>   
                </div> 
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script>
        $(document).on('click', '#deleteOrder', function(e) {
            let getid = e.currentTarget.dataset.id;

            $.ajax({
                type: 'POST',
                url: '/deleteOrder',
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: getid,
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