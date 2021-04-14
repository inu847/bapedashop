@extends('layouts.global')

@section('title')
    Keranjang Belanja
@endsection

@section('content')
    <div class="col-lg-12 col-md-12 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Form Order</h5>
                <form action="">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Product Name</th> 
                                <th scope="col">Quantity</th>
                                <th scope="col">Unit Price</th>
                                <th scope="col">=</th>
                                <th scope="col">Totals</th> 
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($carts as $cart)
                                <input type="hidden" value="{{ $product = \App\Models\Product::find($cart->product_id)}}">
                                    <tr class="odd">
                                        <td class="product-title">{{$product->nama_product}}</td>
                                        <td class="num-pallets"><input type="number" class="num-pallets-input form-control" id="sparkle-num-pallets"></td>
                                        <td class="price-per-pallet">Rp.<span>{{$product->price}}</span></td>
                                        <td class="equals">=</td>
                                        <td class="row-total"><input type="text" class="row-total-input" id="sparkle-row-total" disabled></td>
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
                                            <td id="total-pallets"><input id="total-pallets-input" value="0" type="text" disabled="disabled"></td>
                                        </tr>
                                        <tr>
                                            <td>Product Subtotal <span>:</span></td>
                                            <td><input type="text" class="total-box" name="price" value="Rp.0" id="product-subtotal" disabled="disabled"></td>
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