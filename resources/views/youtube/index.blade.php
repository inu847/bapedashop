@extends('layouts.buyer')

@section('title')
    Scrap Youtube
@endsection

@section('content')

    <div class="row">
        @foreach ($results as $result => $key)
            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="card-body text-center">
                        <iframe src="https://www.youtube.com/embed/{{$key}}" height="200" width="500" title="Iframe Example"></iframe>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
@endsection