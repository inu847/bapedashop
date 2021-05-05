@extends('layouts.global')

@section('title')
    Scrap
@endsection

@section('content')
    Halaman Scrap </p>

    <div class="container">
        <div class="row">
            @foreach ($hasil as $data)
                <div class="col-lg-4 mb-2">
                    <div class="card">
                        <div class="card-body">
                            <ul>
                                <li> Id Item <b>{{ $data->itemid }}</b></li>
                                <li> Nama barang <b>{{ $data->name }}</b></li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
