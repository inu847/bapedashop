@extends('layouts.customer')

@section('title')
    Pembayaran
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <label for="">Provinsi</label>
                <p class="form-control">{{province($alamats->province_id)}}</p>
            </div>
            <div class="form-group">
                <label for="">Kota/Kabupaten</label>
                <p class="form-control">{{city($alamats->city_id)}}</p>
            </div>
            <div class="form-group">
                <label for="">Jasa Kirim</label>
                <select name="courier" id="ongkir" class="form-control">
                    <option value="" selected disabled>Pilih Jasa Kirim</option>
                    <option value="jne">JNE</option>
                    <option value="tiki">TIKI</option>
                    <option value="pos">POS</option>
                </select>
            </div>
        </div>
    </div>
    
    <div class="row mt-3">
        <div class="col-md-12">
            <div id="view-ongkir">

            </div>
        </div>
    </div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $(function() {
        $("#ongkir").change(function() { 
            var displaycourse = $("#ongkir option:selected").val();
            $("#results").val(displaycourse);
            getOngkir(displaycourse)
        })
    })

    function getOngkir(courier) {
    //kabupaten
     $.ajax({
            type: 'POST',
            url: '/customers/cekOngkir',
            data: {
                "_token": "{{ csrf_token() }}",
                courier: courier
            },
            async: false,
            dataType: 'json',
            success: function(response) {
                var i, x, data = response[0]
                console.log(data)
                // console.log(data.name)
                // console.log(data.costs)
                var costs = data.costs
                var view
                for(i = 0;i < costs.length;i++){
                    var limit = costs[i].cost[0]
                    console.log(limit.value)
                    console.log(limit.etd)
                    // var templateString = '<div class="card d-none"><div class="card-body"><ul><li>'+limit.value+'</li><li></li><li></li></ul><form action="" method="POST" enctype="multipart/form-data">@csrf<input type="hidden" name="courier" value=""><input type="hidden" name="etd"><input type="hidden" name="ongkos_kirim"></form></div></div>';
                    // view += templateString
                }
                console.log(view)
                $("#view-ongkir").html(view);
            },
            error: function(response) {
                console.log(response)
            }
        });
    }

</script>