@extends('layouts.global')

@section('title')
    Scrap
@endsection


@section('content')
    Halaman Scrap </p>

    <div class="container">
        <div class="row">
            @if (isset($hasil))
                @foreach ($hasil as $data)
                    <div class="col-lg-4 mb-2">
                        <div class="card">
                            <div class="card-body">
                                <ul>
                                    <li class="nama_product">{{ $data->name }}</li>
                                    <li class="description">{{ getProductDetail($userId, $data->itemid) }}</li>
                                    <li class="image">
                                        {{-- <img src="{{asset('https://cf.shopee.co.id/file/'.$data->image)}}" width="150px" height="150px" alt=""> --}}
                                        {{ $data->image }}
                                    </li>
                                    <li class="stock">{{ $data->stock }}</li>
                                    <li class="price">{{ $data->price }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div>
                    <p class="not-found"></p> Not Found
                </div>
            @endif
        </div>
    </div>
@endsection
