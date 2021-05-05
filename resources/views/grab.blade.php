@extends('layouts.global')

@section('title')
    Scrap
@endsection

@section('content')
    Halaman Scrap
    @foreach ($hasil as $item)
        {{$item}}
    @endforeach
@endsection