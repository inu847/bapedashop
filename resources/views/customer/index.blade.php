@extends('layouts.customer')

@section('title')
    CAPPS
@endsection

@section('content')
    <div class="container-fluid disable-text-selection">
        <div class="row list disable-text-selection" data-check-all="checkAll">
            @foreach ($products as $product)
            @if ($product->status == 'publish')
            <div class="col-xl-3 col-lg-4 col-12 col-sm-6 mb-4">
                <div class="card" style="height: 425px">
                    <div class="position-relative">
                        <a href="Pages.Product.Detail.html">
                            @if($product->images)
                            <div class="side_view">
                                <img src="{{productImages($product->images)}}" alt="Card image cap" class="card-img-top" style="height: 216px;" />
                            </div>
                            @else
                                No avatar
                            @endif
                        </a>
                        @if ($product->created_at->format('m') == date('m'))
                            <span class="badge badge-pill badge-theme-1 position-absolute badge-top-left">NEW</span>
                        {{-- @elseif ("a" == "a")
                            <span class="badge badge-pill badge-secondary position-absolute badge-top-left">TRENDING</span> --}}
                        @else

                        @endif


                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <a href="#">
                                    <p class="list-item-heading mb-4 pt-1" style="font-size: 20px;">{{ Str::limit($product->nama_product, 40) }}</p>
                                </a>
                                <div class="row">
                                    <div class="col-7 mb-3">
                                        <p class="price-per-pallet text-muted mb-0 font-weight-light" style="font-size: 15px;">Rp.{{ $product->price }}</p>
                                    </div>
                                </div>
                                <footer>
                                    <a class="btn btn-primary btn-block mb-1" href="javascript:void(0)" id="addtocartcustomer" data-id="{{ $product->id }}"><i class="iconsminds-add-cart"></i>Add To cart </a>
                                </footer>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>
    @endsection

    <!-- Di bawah ini Adalah basic dari javascript Ajax Silah Modifikasi sesuai dengan framework JS anda -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script>
    $(document).on('click', '#addtocartcustomer', function(e) {
    let getid = e.currentTarget.dataset.id;
    // let getcustomer = e.currentTarget.dataset.customer;

    $.ajax({
        type: 'POST',
        url: '/addtocartcustomer',
        data: {
            "_token": "{{ csrf_token() }}",
            product_id: getid,
            // customer_id: getcustomer,
        },
        async: false,
        dataType: 'json',
        success: function(response) {
            alert(response.message)
        },
        error: function(response) {
            console.log(response)
        }
    });
    })
    </script>