@extends('layouts.global')

@section('title')
    Purchase
@endsection

@section('content')
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="mb-4">Form Grid</h5>

            <form action="{{ route('tools.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="">Nama Penerima</label>
                        <input type="text" class="form-control" id="" placeholder="Nama Penerima" name="nama_pembeli">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Nama Toko</label>
                        <input type="text" class="form-control" id="" value="{{$user->nama_toko}}" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Address</label>
                    <input type="text" class="form-control" id="" value="{{ json_decode($user->alamat)[0]}}" disabled>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputCity">Kota</label>
                        <input type="text" class="form-control" id="" value="{{ json_decode($user->alamat)[1]}}" disabled>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">Kabupaten</label>
                        <input type="text" class="form-control" value="{{ json_decode($user->alamat)[2]}}" disabled>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputZip">Kelurahan</label>
                        <input type="text" class="form-control" id="" value="{{ json_decode($user->alamat)[3]}}" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Address 2</label>
                    <input type="text" class="form-control" id="" placeholder="Street, Apartment, studio, or floor" name="alamat_lain">
                </div>
                <div class="form-group">
                    <label for="">No Hp</label>
                    <input type="text" class="form-control" id="" value="{{ $user->phone }}" disabled>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="">SSID</label>
                        <input type="text" class="form-control" id="" placeholder="Email" name="ssid">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Password</label>
                        <input type="text" class="form-control" id="" placeholder="Password" name="password">
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Catatan Pembeli</label>
                    <textarea name="keterangan" class="form-control" id="" cols="30" rows="3" placeholder="Masukkan keterangan untuk catatan admin"></textarea>
                </div>
                

                <div class="col-2 ml-auto">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" required>
                        <label class="form-check-label" for="inlineCheckbox1">Check me out !</label>
                    </div>
    
                    <button type="submit" class="btn btn-primary d-block mt-3">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection