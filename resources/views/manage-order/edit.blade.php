@extends('layouts.global')

@section('title')
    Edit Order
@endsection

@section('content')
    <div class="col-lg-12 col-md-12 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Form Order</h5>
                <form action="{{ route('manage-order.update', [$buyer->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="PUT" name="_method">
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
                            <input type="hidden" name="buyer_id" value="{{$buyer}}">
                            @foreach ($orders as $product)
                            <input type="hidden" value="{{$products = \App\Models\Product::get()->where('id', $product->prod_id)}}">
                                <tr class="odd">
                                    <input type="hidden" name="prod_id[]" value="{{$product->prod_id}}">
                                    @foreach ($products as $prod)
                                        <td class="product-title">{{$prod->nama_product}}</td>
                                        <td class="num-pallets"><input type="number" class="num-pallets-input form-control" id="sparkle-num-pallets" name="quantity[]" value="{{$product->quantity}}"></td>
                                        <td class="price-per-pallet">Rp.<span>{{$prod->price}}</span></td>
                                    @endforeach
                                    <td class="equals">=</td>
                                    <td class="row-total"><input type="text" class="row-total-input" id="sparkle-row-total" name="row_total[]" value="{{$product->row_total}}"></td>
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
                                            <td id="total-pallets"><input id="total-pallets-input" value="0" type="text" name="total_quantity"></td>
                                        </tr>
                                        <tr>
                                            <td>Product Subtotal <span>:</span></td>
                                            <td><input type="text" class="total-box" value="Rp.0" id="product-subtotal" name="subtotal"></td>
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