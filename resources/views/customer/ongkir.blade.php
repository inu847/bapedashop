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
                <select name="courier" id="service_ongkir" class="form-control" required>
                    <option value="" selected disabled>Pilih Jasa Kirim</option>
                </select>
            </div>
        </div>
        <hr class="ml-3 mr-3">
        <div class="card-body">
            <div class="col-md-3 ml-auto">
                <p class="text-muted">Harga Barang : Rp.<span>{{ $product->row_total }}</span></p>
                <p class="text-muted">Ongkos Kirim : Rp.<span id="harga-ongkir"></span></p>
                <hr>
                <p class="text-muted">Harga Total : Rp.<span id="harga-total"></span></p>
            </div>
            <div class="col-md-2 ml-auto" id="btn-bayar">
                <button class="btn btn-danger" disabled>Bayar</button>
                {{-- <button class="btn btn-danger" id="pay-button">Pay!</button> --}}
            </div>
        </div>
    </div>    
@endsection    
    
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-zuLignrNUoqy1d-0"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
{{-- <script>
    $(document).on('click', '#bayar', function(e) {
        var resultOngkir = $("#harga-total").text();
        var id = '{{ $product->id }}'
        $.ajax({
            type: 'POST',
            url: '/customers/pembayaran',
            data: {
                "_token": "{{ csrf_token() }}",
                id : id,
                harga_total : resultOngkir,
            },
            async: false,
            dataType: 'json',
            success: function(response) {
                console.log(response.link)
            },
            error: function(response) {
                console.log(response)
            }
        });
    })
</script> --}}

<script>
    $(function() {
        $("#service_ongkir").change(function() { 
            var harga_ongkir = $("#service_ongkir option:selected").val();
            var harga_barang = '{{ $product->row_total }}'
            var resultOngkir = parseInt(harga_barang) + parseInt(harga_ongkir)
            $("#harga-ongkir").html(harga_ongkir);
            $("#harga-total").html(resultOngkir);
            bayar()
        })
    })
    
    function bayar() {
        // '<form action="{{ route("pesanan.saya") }}" method="GET"><input type="submit" value="Pay with Snap Redirect"></form>'
        var btnBayar = '<button class="btn btn-danger" id="pay-button">Bayar</button>'
        $("#btn-bayar").html(btnBayar);

        var payButton = document.getElementById('pay-button');
        var token = {!! json_encode($token) !!};
        payButton.addEventListener('click', function () {
            snap.pay(token); 
        });
    }

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
                $("#service_ongkir").html(view);
            },
            error: function(response) {
                console.log(response)
            }
        });
    }
</script>