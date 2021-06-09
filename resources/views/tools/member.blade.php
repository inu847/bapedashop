@extends('layouts.global')

@section('title')
Member Area
@endsection

@section('content')
<div class="container-fluid disable-text-selection">
    <div class="row">
        <div class="col-12">
            <div class="mb-3">
                <h1>Controller</h1>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">Member Area</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            list
                        </li>
                    </ol>
                </nav>
                <div class="separator mb-5"></div>
            </div>
            <div class="row equal-height-container">
                <div id="loadingclick"></div>
                @for ($i = 1; $i < 4; $i++)
                    <div class="col-md-12 col-lg-4 mb-4 col-item">
                        <div class="card">
                            <div class="card-body pt-5 pb-5 d-flex flex-lg-column flex-md-row flex-sm-row flex-column">
                                <div class="price-top-part">
                                    <i class="iconsminds-power large-icon"></i>
                                    <h5 class="mb-0 font-weight-semibold color-theme-1 mb-4">LED {{$i}}</h5>
                                </div>
                                <div class="pl-3 pr-3 pt-3 pb-0 d-flex price-feature-list flex-column flex-grow-1 text-center">
                                    <div class="row">
                                        <div class="col-6">
                                            <a href="javascript:void(0)" data-id="0" onclick="doclickled(this)" data-field="field{{$i}}" data-value="0" class="btn btn-primary btn-sm p-4">OFF</a>
                                        </div>
                                        <div class="col-6">
                                            <a href="javascript:void(0)" data-id="1" onclick="doclickled(this)" data-field="field{{$i}}" data-value="1" class="btn btn-danger btn-sm p-4">ON</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor    

            </div>
            <div class="mb-5">
                <form action="{{ route('generateApiKey.tools', [$member->id]) }}" method="POST" enctype="multipart/form-data">
                <div class="row">
                    @csrf
                    <div class="col-md-9">
                        <input type="text" class="form-control " value="{{ $member->api_key }}" disabled>
                    </div>
                    <button type="submit" class="btn btn-info col-md-2">Generate</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>

{{-- THINKSPEAK --}}
{{-- <script>
    function doclickled(e) {
        let id = e.dataset.id
        let type = e.dataset.type
        let field = e.dataset.field

        $.ajax({
            type: 'POST',
            url: '/seller/actionled',
            data: {
                "_token": "{{ csrf_token() }}",
                id: id,
                type: type,
                field: field,
            },
            async: false,
            dataType: 'json',
            beforeSend: function() {
                $ld = `<div class="text-center">
                        <div class="spinner-border" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>`;
                $('#loadingclick').html($ld);
            },
            success: function(response) {
                // Untuk notifikasi response silahkan ubah sesuai kebutuhan
                $('#loadingclick').html("");
                alert(response.message)
            }
        });
    }
</script> --}}

{{-- API WEB CAPSS --}}
<script>
    function doclickled(e) {
        let api = '{{ $member->api_key }}'
        let value = e.dataset.value
        let field = e.dataset.field

        $.ajax({
            type: 'POST',
            url: '/api/capps/iot/update',
            data: {
                "_token": "{{ csrf_token() }}",
                api_key: api,
                field: field,
                value: value,
            },
            async: false,
            dataType: 'json',
            beforeSend: function() {
                $ld =  `<div class="text-center">
                            <div class="spinner-border" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>`;
                $('#loadingclick').html($ld);
            },
            success: function(response) {
                // Untuk notifikasi response silahkan ubah sesuai kebutuhan
                $('#loadingclick').html("");
                alert(response.message)
            }
        });
    }
</script>
@endsection