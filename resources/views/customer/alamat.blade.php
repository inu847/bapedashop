@extends('layouts.customer')

@section('title')
    Setting Alamat
@endsection

@section('content')
    @if ($alamats)
        <div class="card mb-4">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-9">
                        <h5 class="pt-2 pl-2">Alamat Saya</h5>
                    </div>
                    <div class="col-3">
                        <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="simple-icon-plus"> Tambah Alamat Baru</i></button>
                    </div>
                </div>
                
                {{-- <div class="col-3 ml-auto mb-3">
                    <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="simple-icon-plus"> Tambah Alamat Baru</i></button>
                </div> --}}
                

                <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Tambah Alamat</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('alamatCustomer') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Provinsi</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputEmail3" placeholder="Masukkan Provinsi Anda" name="provinsi">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-2 col-form-label">Kabupaten</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputPassword3" placeholder="Masukkan Kabupaten Anda" name="kabupaten">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Desa</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputEmail3" placeholder="Masukkan Desa Anda" name="desa">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-2 col-form-label">Kecamatan</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="inputPassword3" placeholder="Masukkan Kecamatan Anda" name="kecamatan">
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-sm-3">
                                                <input type="text" class="form-control" id="inputEmail3" placeholder="RT" name="rt">
                                            </div>
                                            <div class="form-group col-sm-3">
                                                <input type="text" class="form-control" id="inputPassword3" placeholder="RW" name="rw">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-2 col-form-label">Kode Pos</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputPassword3" placeholder="Masukkan Kode Pos Anda" name="kode_pos">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-2 col-form-label">Alamat</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="" placeholder="Detail Lainnya (Cth: Jalan, Blok / Unit No., Patokan)" name="alamat">
                                        </div>
                                    </div>
                                    <fieldset class="form-group">
                                        <div class="row">
                                            <label class="col-form-label col-sm-2 pt-0">Jadikan Sebagai Alamat</label>
                                            <div class="col-sm-10">

                                                    @if ($alamat_utama == 1)
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" disabled>
                                                            <label class="form-check-label" for="gridRadios1"> Alamat Utama
                                                            </label>
                                                        </div>
                                                    @else
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="status" id="gridRadios1" value="alamat_utama">
                                                            <label class="form-check-label" for="gridRadios1"> Alamat Utama
                                                            </label>
                                                        </div>
                                                    @endif

                                                

                                                    @if ($alamat_toko == 1)
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" disabled>
                                                            <label class="form-check-label" for="gridRadios1"> Alamat Toko
                                                            </label>
                                                        </div>
                                                    @else
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="status" id="gridRadios2" value="alamat_toko">
                                                            <label class="form-check-label" for="gridRadios2"> Alamat Toko
                                                            </label>
                                                        </div>
                                                    @endif

                                                
                                                    @if ($alamat_pengembalian == 1)
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" disabled>
                                                            <label class="form-check-label" for="gridRadios1"> Alamat Pengembalian
                                                            </label>
                                                        </div>
                                                    @else
                                                        <div class="form-check disabled">
                                                            <input class="form-check-input" type="radio" name="status" id="gridRadios3" value="alamat_pengembalian">
                                                            <label class="form-check-label" for="gridRadios3"> Alamat Pengembalian
                                                            </label>
                                                        </div>
                                                    @endif

                                            </div>
                                        </div>
                                    </fieldset>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>       
                            </div>
                        </div>
                    </div>
                </div>
                
                
                <div class="separator mb-5"></div>
                @foreach ($alamats as $alamat)
                    <div class="row">
                        <div class="col-10">
                            <div class="pl-5 pr-2 mb-4">
                                <div class="row mb-4">
                                    <p class="col-sm-2"><strong>Nama Pemilik</strong></p>
                                    <span class="col-sm-2">{{\Auth::guard('customer')->user()->name}}</span>
                                    <div class="col-sm-3">
                                        @if ($alamat->status == 'alamat_utama')
                                            <span class="badge badge-success mb-1" style="line-height: 2;">Alamat Utama</span>
                                        @elseif ($alamat->status == 'alamat_toko')
                                            <span class="badge badge-primary mb-1" style="line-height: 2;">Alamat Toko</span>
                                        @elseif ($alamat->status == 'alamat_pengembalian')
                                            <span class="badge badge-warning mb-1" style="line-height: 2;">Alamat Pengembalian</span>
                                        @endif
                                    </div>
                                    
                                </div>
                                
                                <div class="row">
                                    <p class="text-muted col-sm-2">Provinsi </p>
                                    <span class="col-sm-3">{{$alamat->provinsi}}</span>
    
                                    <p class="text-muted col-sm-2">RT </p>
                                    <span class="col-sm-3">{{$alamat->rt}}</span>
                                </div>
                                <div class="row">
                                    <p class="text-muted col-sm-2">Kabupaten </p>
                                    <span class="col-sm-3">{{$alamat->kabupaten}}</span>
    
                                    <p class="text-muted col-sm-2">RW </p>
                                    <span class="col-sm-3">{{$alamat->rw}}</span>
                                </div>
                                <div class="row">
                                    <p class="text-muted col-sm-2">Desa </p>
                                    <span class="col-sm-3">{{$alamat->desa}}</span>
    
                                    <p class="text-muted col-sm-2">Kode Pos </p>
                                    <span class="col-sm-3">{{$alamat->kode_pos}}</span>
                                </div>
                                <div class="row">
                                    <p class="text-muted col-sm-2">Alamat </p>
                                    <span class="col-sm-3">{{$alamat->alamat}}</span>
    
                                    <p class="text-muted col-sm-2">Kecamatan </p>
                                    <span class="col-sm-3">{{$alamat->kecamatan}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="row mb-2">
                                <a href="">Atur Sebagai Alamat Utama</a>
                            </div>
                            <div class="row">
                                <form action="{{ route('hapusAlamatCustomer', [$alamat->id])}}" method="POST" enctype="multipart/form-data" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    <button class="btn btn-danger mr-2 mb-2" type="submit">Hapus</button>
                                </form>
                                
                                <button class="btn btn-info mr-2 mb-2">Edit</button>
                            </div>
                        </div>

                    </div>
                        
                        <div class="separator mb-5"></div>
                @endforeach
                
            </div>
        </div>
    @endif
@endsection