@extends('layouts.error')

@section('title')
    401
@endsection

@section('exceptions')
    {{$exception->getMessage()}}
@endsection

@section('status')
    401
@endsection