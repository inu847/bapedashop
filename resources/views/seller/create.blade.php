@extends('layouts.global')

@section('title')
    Create New Product
@endsection

@section('content')
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="mb-4">Basic</h5>
            <form action="{{ route('manage-product.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="nama_product" placeholder="Nama Product" aria-label="Nama Product" aria-describedby="basic-addon1">
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="deskripsi" placeholder="Deskripsi" aria-label="Username" aria-describedby="basic-addon1">
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="stok" placeholder="Stok" aria-label="Username" aria-describedby="basic-addon1">
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="images" placeholder="images" aria-label="Username" aria-describedby="basic-addon1">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp</span>
                    </div>
                    <input type="text" class="form-control" name="price" aria-label="Amount (to the nearest rupiah)">
                </div>
                
                <button class="btn btn-danger" type="submit">Publish</button>
            </form>
        </div>
    </div>
@endsection