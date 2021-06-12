@extends('layouts.buyer')

@section('title')
    Cart
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama Product</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 1; $i < 4; $i++)    
                            <tr>
                                <td><h4 class="" id="product_name">Buku Program KOTLIN</h4></td>
                                <td><p class="text-muted" id="harga{{$i}}">50000</p></td>
                                <td>
                                    <div class="btn-group btn-group-toggle">
                                        <button class="btn btn-info" id="decreaseValue" data-id="{{$i}}">-</button>
                                        <input type="number" value="0" id="number{{$i}}" class="form-control">
                                        <button class="btn btn-info" id="increaseValue" data-id="{{$i}}">+</button>
                                    </div>
                                </td>
                                <td class="text-muted" id="total-row{{$i}}">
                                    Rp.0
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                    <tfoot>
                        <tr>
                            <th id="row_total">Rp.0</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    
@endsection
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script>
    $(document).on('click', "#decreaseValue", function (e) {
        let getid = e.currentTarget.dataset.id;
        decreaseValue(getid)
    })

    $(document).on('click', "#increaseValue", function (e) {
        let getid = e.currentTarget.dataset.id;
        increaseValue(getid)
    })

    function increaseValue(getid) {
        var value = parseInt(document.getElementById('number'+getid).value, 10);
        value = isNaN(value) ? 0 : value;
        value++;
        document.getElementById('number'+getid).value = value;
        row_total(value, getid);
    }

    function decreaseValue(getid) {
        var value = parseInt(document.getElementById('number'+getid).value, 10);
        value = isNaN(value) ? 0 : value;
        value < 1 ? value = 1 : '';
        value--;
        document.getElementById('number'+getid).value = value;
        row_total(value, getid);
    }

    function row_total(value, getid) {
        var harga = $("#harga"+getid).text();
        var total = parseInt(harga) * value;
        // console.log(total);
        $("#total-row"+getid).html("Rp."+total)
        sub_total()
    }

    function sub_total() {
        var row = $("#total-row1").text();
        console.log(row)
        // $("#row_total").html()
    }
</script>