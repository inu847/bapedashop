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
                            <a href="{{ route('order.finish') }}" class="ml-5 mr-5"><i class="simple-icon-logout large-icon"></i></a>
                            <a data-toggle="modal" data-target="#exampleModalContent" class="mr-5"><i class="iconsminds-repeat-3 large-icon"></i></a>
                            <a href="#" class="mr-5"><i class="iconsminds-headset large-icon"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalContent" tabindex="-1" role="dialog" aria-hidden="true">
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
                        <input type="hidden" name="user_id" value="{{$user_id[0]}}">
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
@endsection