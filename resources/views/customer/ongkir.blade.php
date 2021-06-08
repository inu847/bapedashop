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
 
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-zuLignrNUoqy1d-0"></script>
<script>
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
                var token = response.token;                
                    snap.pay(token, {
                        onSuccess: function (result) {
                            alert("payment Success");
                            console.log(result);
                        },
                        onPending: function (result) {
                            // Muncul Setelah Pembayaran
                            // alert("payment Pending");
                            // console.log(result);
                            var status_message = result.status_message
                            var transaction_id = result.transaction_id
                            var gross_amount = result.gross_amount
                            var payment_type = result.payment_type
                            var transaction_status = result.transaction_status
                            var bank = result.va_numbers[0].bank
                            var va_number = result.va_numbers[0].va_number
                            var fraud_status = result.fraud_status
                            var pdf_url = result.pdf_url
                            var order_id = result.order_id

                            $.ajax({
                                type: 'POST',
                                url: '/customers/transaksi/create',
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    status_message : status_message,
                                    transaction_id : transaction_id,
                                    gross_amount : gross_amount,
                                    payment_type : payment_type,
                                    transaction_status : transaction_status,
                                    bank : bank,
                                    va_number : va_number,
                                    fraud_status : fraud_status,
                                    pdf_url : pdf_url,
                                    order_id : order_id
                                },
                                async: false,
                                dataType: 'json',
                                success: function(response) {
                                    var redirect = response.redirect
                                    window.location.href = redirect;
                                },
                                error: function(response) {
                                    console.log(response)
                                }
                            });
                        },
                        onError: function (result) {
                            alert("payment failed");
                            console.log(result);
                        },
                        onClose: function () {
                            console.log("payment cancel");
                        },
                    }); 
            },
            error: function(response) {
                console.log(response)
            }
        });
    })
</script>
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
        var btnBayar = '<button class="btn btn-danger" id="bayar">Bayar</button>'
        $("#btn-bayar").html(btnBayar);
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
                var costs = data.costs
                var view = ""
                for(i = 0;i < costs.length;i++){
                    var limit = costs[i].cost[0]
                    var service = costs[i].service
                    var harga = limit.value
                    view += '<option value="'+harga+'">'+service +' '+ limit.etd+'</option>'
                }
                $("#service_ongkir").html('<option value="" selected disabled>Pilih Service</option>'+view);
            },
            error: function(response) {
                console.log(response)
            }
        });
    }
</script>