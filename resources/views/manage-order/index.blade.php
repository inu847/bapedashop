@extends('layouts.global')

@section('title')
    Manage Order
@endsection

@section('content')
    @foreach ($orders as $order)
        <div class="card mb-3">
            <div class="card-body">
                {{ $order->buyer }}
            </div>
        </div>
    @endforeach
@endsection