@extends('layouts.customer')

@section('title')
    Keranjang Belanja
@endsection

@section('content')
    <div class="col-lg-12 col-md-12 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Form Order</h5>
                <div id="accordion" class="form-group">
                    <div class="border">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"
                            aria-expanded="false" aria-controls="collapseOne">
                            -> Alamat Utama
                        </button>

                        <div id="collapseOne" class="collapse " data-parent="#accordion">
                            <div class="p-4">
                                @foreach ($alamats as $alamat)
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="">Provinsi</label>
                                            <input type="text" class="form-control" id="" value="{{ $alamat->provinsi }}" disabled>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputCity">Kota/Kabupaten</label>
                                            <input type="text" class="form-control" id="" value="{{ $alamat->kabupaten }}" disabled>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputCity">Desa</label>
                                            <input type="text" class="form-control" id="" value="{{ $alamat->desa }}" disabled>
                                        </div>
                                    </div>
                                    
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="">Kode Pos</label>
                                            <input type="text" class="form-control" value="{{ $alamat->kode_pos }}" disabled>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="">Kecamatan</label>
                                            <input type="text" class="form-control" value="{{ $alamat->kecamatan }}" disabled>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="inputZip">RT</label>
                                            <input type="text" class="form-control" id="" value="{{ $alamat->rt }}" disabled>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="inputZip">RW</label>
                                            <input type="text" class="form-control" id="" value="{{ $alamat->rt }}" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Alamat</label>
                                        <input type="text" class="form-control" id="" value="{{ $alamat->alamat }}" disabled>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <form action="{{ route('sellCustomer') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="PUT" name="_method">
                    <input type="hidden" value="{{ $alamat->id }}" name="alamat_id">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Product Image</th> 
                                <th scope="col">Product Name</th> 
                                <th scope="col">Quantity</th>
                                <th scope="col">Unit Price</th>
                                <th scope="col">=</th>
                                <th scope="col">Totals</th> 
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($carts as $cart)
                            <input type="hidden" value="{{ $product = keranjang($cart->prod_id) }}">
                                    <tr class="odd">
                                        <input type="hidden" name="prod_id[]" value="{{$cart->id}}">
                                        <td class="images">
                                            @if ($product->images)
                                                <img src="{{productImages($product->images)}}" alt="" width="80" height="80">
                                            @else
                                                Not Found
                                            @endif
                                        </td>
                                        <td class="product-title">{{ Str::limit($product->nama_product, 20) }}</td>
                                        <td class="num-pallets"><input type="number" class="num-pallets-input form-control" id="sparkle-num-pallets" name="quantity[]"></td>
                                        <td class="price-per-pallet">Rp.<span>{{$product->price}}</span></td>
                                        <td class="equals">=</td>
                                        <td class="row-total"><input type="text" class="row-total-input" id="sparkle-row-total" name="row_total[]" readonly></td>
                                    </tr>
                            @endforeach
                        </tbody>
                    </table>

                        <div class="row">
                            <div class="col-md-5 ml-auto">
                                <table id="shipping-table" class="table">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Total :</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Total Quantity <span>:</span></td>
                                            <td id="total-pallets"><input id="total-pallets-input" value="0" type="text" name="total_quantity" readonly></td>
                                        </tr>
                                        <tr>
                                            <td>Product Subtotal <span>:</span></td>
                                            <td><input type="text" class="total-box" value="Rp.0" id="product-subtotal" name="subtotal" readonly></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <div class="col-md-2 ml-auto">
                            <button class="btn btn-info" type="submit">Submit</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection