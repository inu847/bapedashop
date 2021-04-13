@extends('layouts.global')

@section('title')
    Keranjang Belanja
@endsection

@section('content')
    @foreach ($carts as $cart)
        <div>
            <p>{{$cart->buyer}} <span>{{$cart->enkripsi_token}}</span></p>
            <p>{{$cart->created_at->diffForHumans()}}</p>
        </div>
    @endforeach
@endsection