@extends('layouts.error')

@section('title')
    403
@endsection

@section('exceptions')
    <h4>{{$exception->getMessage()}}</h4>
@endsection

@section('status')
    <h1>403</h1>
@endsection