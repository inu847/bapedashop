@extends('layouts.global')

@section('title')
Super Member Area
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
                            <a href="#">Super Member Area</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            list
                        </li>
                    </ol>
                </nav>
                <div class="separator mb-5"></div>
            </div>
            
            <div class="row equal-height-container" id="controller">
                <div id="loadingclick"></div>    
                            
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
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script>
    $(document).ready(function controller(){
        var field1 = "{{$member->field1}}"
        var field2 = "{{$member->field2}}"
        var field3 = "{{$member->field3}}"
        var field4 = "{{$member->field4}}"
        var field5 = "{{$member->field5}}"
        
        var view = []
        for (var i = 1; i < 7; i++) {
            var button_on = `<div class="col-md-12 col-lg-4 mb-4 col-item">
                            <div class="card">
                                <div class="card-body pt-5 pb-5 d-flex flex-lg-column flex-md-row flex-sm-row flex-column">
                                    <div class="price-top-part">
                                        <i class="iconsminds-power large-icon"></i>
                                        <h5 class="mb-0 font-weight-semibold color-theme-1 mb-4">LED `+i+`</h5>
                                    </div>
                                    <div class="pl-3 pr-3 pt-3 pb-0 d-flex price-feature-list flex-column flex-grow-1 text-center">
                                        <div class="row">
                                            <div class="col-6">
                                                <button href="javascript:void(0)" onclick="doclickled(this)" data-field="field`+i+`" data-value="0" class="btn btn-primary btn-sm p-4" disabled>OFF</button>
                                            </div>
                                            <div class="col-6">
                                                <button href="javascript:void(0)" onclick="doclickled(this)" data-field="field`+i+`" data-value="1" class="btn btn-danger btn-sm p-4" >ON</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>`;
            var button_off = `<div class="col-md-12 col-lg-4 mb-4 col-item">
                            <div class="card">
                                <div class="card-body pt-5 pb-5 d-flex flex-lg-column flex-md-row flex-sm-row flex-column">
                                    <div class="price-top-part">
                                        <i class="iconsminds-power large-icon"></i>
                                        <h5 class="mb-0 font-weight-semibold color-theme-1 mb-4">LED `+i+`</h5>
                                    </div>
                                    <div class="pl-3 pr-3 pt-3 pb-0 d-flex price-feature-list flex-column flex-grow-1 text-center">
                                        <div class="row">
                                            <div class="col-6">
                                                <button href="javascript:void(0)" onclick="doclickled(this)" data-field="field`+i+`" data-value="0" class="btn btn-primary btn-sm p-4" >OFF</button>
                                            </div>
                                            <div class="col-6">
                                                <button href="javascript:void(0)" onclick="doclickled(this)" data-field="field`+i+`" data-value="1" class="btn btn-danger btn-sm p-4" disabled>ON</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>`;

            if(i==1 && field1){
                if (field1 == 1){
                    view.push(button_off)
                }else{
                    view.push(button_on)
                }
            }else if (i==2 && field2){
                if (field2 == 1){
                    view.push(button_off)
                }else{
                    view.push(button_on)
                }
            }else if (i==3 && field3){
                if (field3 == 0){
                    view.push(button_off)
                }else{
                    view.push(button_on)
                }
            }
            else if (i==4 && field4){
                if (field4 == 0){
                    view.push(button_off)
                }else{
                    view.push(button_on)
                }
            }
            else if (i==5 && field5){
                if (field5 == 0){
                    view.push(button_off)
                }else{
                    view.push(button_on)
                }
            }
            
        }
        var controller = "";
        for (let x = 0; x < view.length; x++) {
            controller += view[x];
        }
        $('#controller').html(controller);
    });
</script>

@endsection