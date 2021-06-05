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
            <div class="form-group">
                <label for="">Service</label>
                <select name="courier" id="service_ongkir" class="form-control">
                    <option value="" selected disabled>Pilih Jasa Kirim</option>
                    
                </select>
            </div>
        </div>
    </div>
    
    <div id="view-ongkir">

    </div>

            <div class="card mt-5">
                <div class="card body">
                    <div id="view">
                        
                    </div>
                </div>
            </div>
            
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $(function() {
        $("#service_ongkir").change(function() { 
            var displaycourse = $("#service_ongkir option:selected").val();
            // $("#get_ongkir").val(displaycourse);
            var resultOngkir = '<p>Rp.{{ (int)$product->row_total + (int)'+displaycourse+'}} </p>'
            $("#view-ongkir").html(resultOngkir);
        })
    })

    $(function() {
        $("#ongkir").change(function() { 
            var displaycourse = $("#ongkir option:selected").val();
            $("#results").val(displaycourse);
            getOngkir(displaycourse)
        })
    })

    function getOngkir(courier) {
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
                // console.log(data)
                // console.log(data.name)
                var costs = data.costs
                var view = ""
                for(i = 0;i < costs.length;i++){
                    var limit = costs[i].cost[0]
                    var service = costs[i].service
                    var harga = limit.value
                    view += '<option value="'+harga+'">'+service +' '+ limit.etd+'</option>'
                }
                console.log(view)
                $("#service_ongkir").html('<option value="" selected disabled>Pilih Service</option>'+view);
            },
            error: function(response) {
                console.log(response)
            }
        });
    }
</script>