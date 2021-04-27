@extends('layouts.global')

@section('title')
    Purchase
@endsection

@section('content')
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="mb-4">Purchase</h5>

            <form action="{{ route('tools.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="roles" value="{{$roles}}">

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

                <div id="accordion" class="form-group">
                    <div class="border">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"
                            aria-expanded="false" aria-controls="collapseOne">
                            -> Alamat Utama
                        </button>

                        <div id="collapseOne" class="collapse " data-parent="#accordion">
                            <div class="p-4">
                                @foreach ($alamats as $alamat)
                                    <input type="hidden" value="{{ $alamat->id }}" name="alamat_id">
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