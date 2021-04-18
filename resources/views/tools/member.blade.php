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

<div class="row">
    <div class="col-lg-12">
        <div id="loadingclick"></div>
        <h4>Javascript</h4>
        <h1>LED 1</h1>
        <a href="javascript:void(0)" data-id="0" onclick="doclickled(this)" data-field="field1" data-type="OFF" class="btn btn-primary btn-sm">OFF</a>
        <a href="javascript:void(0)" data-id="1" onclick="doclickled(this)" data-field="field1" data-type="ON" class="btn btn-danger btn-sm">ON</a>
        <br>

        <h1>LED 2</h1>
        <a href="javascript:void(0)" data-id="0" onclick="doclickled(this)" data-field="field2" data-type="OFF" class="btn btn-primary btn-sm">OFF</a>
        <a href="javascript:void(0)" data-id="1" onclick="doclickled(this)" data-field="field2" data-type="ON" class="btn btn-danger btn-sm">ON</a>
    </div>
</div>
<!--
    Link ke API target
    https://api.thingspeak.com/update?api_key=RA2V0A9DIO0UPV4O&field1=0 
    https://api.thingspeak.com/update?api_key=RA2V0A9DIO0UPV4O&field1=1 

    https://api.thingspeak.com/update?api_key=RA2V0A9DIO0UPV4O&field2=0 
    https://api.thingspeak.com/update?api_key=RA2V0A9DIO0UPV4O&field2=1 
 -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
    function doclickled(e) {
        let id = e.dataset.id
        let type = e.dataset.type
        let field = e.dataset.field

        $.ajax({
            type: 'POST',
            url: '/actionled',
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
</script>

@endsection