@extends('layouts.global')

@section('title')
    Member
@endsection

@section('content')
    <h1>LED 1</h1>
    <a href="https://api.thingspeak.com/update?api_key=RA2V0A9DIO0UPV4O&field1=0" class="btn btn-primary btn-sm">OFF</a>
    <a href="https://api.thingspeak.com/update?api_key=RA2V0A9DIO0UPV4O&field1=1" class="btn btn-danger btn-sm">ON</a>
    <br>
    <h1>LED 2</h1>
    <a href="https://api.thingspeak.com/update?api_key=RA2V0A9DIO0UPV4O&field2=0" class="btn btn-primary btn-sm">OFF</a>
    <a href="https://api.thingspeak.com/update?api_key=RA2V0A9DIO0UPV4O&field2=1" class="btn btn-danger btn-sm">ON</a>
@endsection