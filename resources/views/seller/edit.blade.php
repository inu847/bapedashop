@extends('layouts.global')

@section('title')
    Edit Product
@endsection

@section('content')
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="mb-4">Edit Product</h5>
            <form action="{{ route('manage-product.update', [$product->id])}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="PUT" name="_method">
                <h6>Nama Product</h6>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="nama_product" value="{{ $product->nama_product }}" placeholder="{{ $product->nama_product }}" aria-label="Nama Product" aria-describedby="basic-addon1">
                </div>

                <h6>Deskripsi</h6>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="deskripsi" value="{{ $product->deskripsi }}" placeholder="{{ $product->deskripsi }}" aria-describedby="basic-addon1">
                </div>

                <h6>Stock</h6>
                <div class="input-group mb-3">
                    <input type="number" class="form-control" name="stok" value="{{ $product->stok }}" placeholder="{{ $product->stok }}" aria-describedby="basic-addon1">
                </div>

                <div class="mb-2">
                    @if($product->images)
                        <div class="side_view"> 
                            <img src="{{asset('storage/'. $product->images)}}" alt="uploaded image" class="list-media-thumbnail responsive border-0" />
                        </div>
                    @else
                        No avatar
                    @endif
                </div>
                <small class="text-muted">Kosongkan jika tidak ingin mengubah avatar</small>
                <div class="input-group mb-3">
                    <input type="file" class="form-control" name="images" aria-describedby="basic-addon1">
                </div>

                <h6>Harga</h6>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp</span>
                    </div>
                    <input type="number" class="form-control" name="price" aria-label="Amount (to the nearest rupiah)" value="{{ $product->price }}" placeholder="{{ $product->price }}">
                </div>

                <h6>Status</h6>
                <div class="mb-4">
                    <div class="custom-control custom-radio">
                        <input type="radio" id="archive" name="status"  value="archive" class="custom-control-input {{$product->status == "archive" ? "checked" : ""}}">
                        <label class="custom-control-label" for="archive">Archive</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="publish" name="status"  value="publish" class="custom-control-input {{$product->status == "publish" ? "checked" : ""}}">
                        <label class="custom-control-label" for="publish">Publish</label>
                    </div>
                </div>
                
                <button class="btn btn-primary" type="submit">Submit</button>
            </form>
        </div>
    </div>
@endsection