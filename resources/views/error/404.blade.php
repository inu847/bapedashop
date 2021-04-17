@extends('layouts.error')

@section('title')
    404
@endsection

@section('exceptions')
    <h4>{{$exception->getMessage()}}</h4>
@endsection

@section('status')
    <h1>404</h1>
@endsection