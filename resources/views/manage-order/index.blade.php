@extends('layouts.global')

@section('title')
    Manage Order
@endsection

@section('content')
    @if(session('status'))
        <div class="alert alert-warning rounded" role="alert">
            {{session('status')}}
        </div>
    @endif
<div class="container-fluid disable-text-selection">
    <div class="row">
        <div class="col-12">
            <div class="mb-3">
                <h1>Manage Order</h1>
                <div class="text-zero top-right-button-container">
                    <a href="{{ route('verivikasi.order') }}" class="btn btn-success btn-lg top-right-button mr-1"><i class="simple-icon-check"> Verivikasi</i></a>
                </div>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">Manage Order</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Verivikasi Order
                        </li>
                    </ol>
                </nav>
            </div>

            <div class="mb-2">
                <a class="btn pt-0 pl-0 d-inline-block d-md-none" data-toggle="collapse" href="#displayOptions"
                    role="button" aria-expanded="true" aria-controls="displayOptions">
                    Display Options
                    <i class="simple-icon-arrow-down align-middle"></i>
                </a>
                <div class="collapse d-md-block" id="displayOptions">
                    <span class="mr-3 mb-2 d-inline-block float-md-left">
                        <a href="#" class="mr-2 view-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 19 19">
                                <path class="view-icon-svg" d="M17.5,3H.5a.5.5,0,0,1,0-1h17a.5.5,0,0,1,0,1Z" />
                                <path class="view-icon-svg" d="M17.5,10H.5a.5.5,0,0,1,0-1h17a.5.5,0,0,1,0,1Z" />
                                <path class="view-icon-svg" d="M17.5,17H.5a.5.5,0,0,1,0-1h17a.5.5,0,0,1,0,1Z" />
                            </svg>
                        </a>
                        <a href="#" class="mr-2 view-icon active">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 19 19">
                                <path class="view-icon-svg" d="M17.5,3H6.5a.5.5,0,0,1,0-1h11a.5.5,0,0,1,0,1Z" />
                                <path class="view-icon-svg"
                                    d="M3,2V3H1V2H3m.12-1H.88A.87.87,0,0,0,0,1.88V3.12A.87.87,0,0,0,.88,4H3.12A.87.87,0,0,0,4,3.12V1.88A.87.87,0,0,0,3.12,1Z" />
                                <path class="view-icon-svg"
                                    d="M3,9v1H1V9H3m.12-1H.88A.87.87,0,0,0,0,8.88v1.24A.87.87,0,0,0,.88,11H3.12A.87.87,0,0,0,4,10.12V8.88A.87.87,0,0,0,3.12,8Z" />
                                <path class="view-icon-svg"
                                    d="M3,16v1H1V16H3m.12-1H.88a.87.87,0,0,0-.88.88v1.24A.87.87,0,0,0,.88,18H3.12A.87.87,0,0,0,4,17.12V15.88A.87.87,0,0,0,3.12,15Z" />
                                <path class="view-icon-svg"
                                    d="M17.5,10H6.5a.5.5,0,0,1,0-1h11a.5.5,0,0,1,0,1Z" />
                                <path class="view-icon-svg"
                                    d="M17.5,17H6.5a.5.5,0,0,1,0-1h11a.5.5,0,0,1,0,1Z" /></svg>
                        </a>
                        <a href="#" class="mr-2 view-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 19 19">
                                <path class="view-icon-svg"
                                    d="M7,2V8H1V2H7m.12-1H.88A.87.87,0,0,0,0,1.88V8.12A.87.87,0,0,0,.88,9H7.12A.87.87,0,0,0,8,8.12V1.88A.87.87,0,0,0,7.12,1Z" />
                                <path class="view-icon-svg"
                                    d="M17,2V8H11V2h6m.12-1H10.88a.87.87,0,0,0-.88.88V8.12a.87.87,0,0,0,.88.88h6.24A.87.87,0,0,0,18,8.12V1.88A.87.87,0,0,0,17.12,1Z" />
                                <path class="view-icon-svg"
                                    d="M7,12v6H1V12H7m.12-1H.88a.87.87,0,0,0-.88.88v6.24A.87.87,0,0,0,.88,19H7.12A.87.87,0,0,0,8,18.12V11.88A.87.87,0,0,0,7.12,11Z" />
                                <path class="view-icon-svg"
                                    d="M17,12v6H11V12h6m.12-1H10.88a.87.87,0,0,0-.88.88v6.24a.87.87,0,0,0,.88.88h6.24a.87.87,0,0,0,.88-.88V11.88a.87.87,0,0,0-.88-.88Z" />
                            </svg>
                        </a>
                    </span>
                    <div class="d-block d-md-inline-block">
                        <div class="btn-group float-md-left mr-1 mb-1">
                            <button class="btn btn-outline-dark btn-xs dropdown-toggle" type="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Order By
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                            </div>
                        </div>
                        <div class="search-sm d-inline-block float-md-left mr-1 mb-1 align-top">
                            <input placeholder="Search...">
                        </div>
                    </div>
                    <div class="float-md-right">
                        <span class="text-muted text-small">Displaying 1-10 of 210 items </span>
                        <button class="btn btn-outline-dark btn-xs dropdown-toggle" type="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            20
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#">10</a>
                            <a class="dropdown-item active" href="#">20</a>
                            <a class="dropdown-item" href="#">30</a>
                            <a class="dropdown-item" href="#">50</a>
                            <a class="dropdown-item" href="#">100</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="separator mb-5"></div>
        </div>
    </div>
    @foreach ($orders as $order)
        <input type="hidden" value="{{$get_order = Auth::user()->orderId->where('buyer_id', $order->id)->first()}}">
        <input type="hidden" value="{{$prod = \App\Models\Product::find($get_order->prod_id)}}">       
        <a href="{{ route('manage-order.show', [$order->id]) }}">
            <div class="card d-flex flex-row mb-3">
                <img src="{{productImages($prod->images)}}" alt="{{ $prod->product_name }}" class="list-thumbnail responsive border-0 card-img-left" style="width: 150px;"/>
                <div class="pl-2 d-flex flex-grow-1 min-width-zero">
                    <div class="card-body align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero align-items-lg-center">
                        <p class="list-item-heading mb-0 truncate w-15 w-sm-50">{{ Str::ucfirst($order->buyer) }}</p>
                        <p class="mb-0 text-muted text-small w-15 w-sm-50">{{$order->total_quantity}} Pcs</p>
                        <p class="mb-0 text-muted text-small w-15 w-sm-50">Rp.{{$order->subtotal}}</p>
                        <p class="mb-0 text-muted text-small w-15 w-sm-50">{{$order->created_at->diffForHumans()}}</p>
                        <div class="w-15 w-sm-50">
                            @if ( $order->status == 'process' )
                                <span class="badge badge-pill badge-primary">{{ Str::upper($order->status) }}</span>
                            @elseif ($order->status == 'success')
                                <span class="badge badge-pill badge-success">{{ Str::upper($order->status) }}</span>
                            @elseif ($order->status == 'on hold')
                                <span class="badge badge-pill badge-danger">{{ Str::upper($order->status) }}</span>
                            @endif
                        </div>
                        <form action="{{ route('tools.status', [$order->id])}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <button type="submit" class="btn btn-success"><i class="simple-icon-check"></i></button>
                        </form>
                    </div>
                </div>

            </div>
        </a>
    @endforeach

</div>

    <nav class="mt-4 mb-3">
        <ul class="pagination justify-content-center mb-0">
            <li class="page-item ">
                <a class="page-link first" href="#">
                    <i class="simple-icon-control-start"></i>
                </a>
            </li>
            <li class="page-item ">
                <a class="page-link prev" href="#">
                    <i class="simple-icon-arrow-left"></i>
                </a>
            </li>
            <li class="page-item active">
                <a class="page-link" href="#">1</a>
            </li>
            <li class="page-item ">
                <a class="page-link" href="#">2</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="#">3</a>
            </li>
            <li class="page-item ">
                <a class="page-link next" href="#" aria-label="Next">
                    <i class="simple-icon-arrow-right"></i>
                </a>
            </li>
            <li class="page-item ">
                <a class="page-link last" href="#">
                    <i class="simple-icon-control-end"></i>
                </a>
            </li>
        </ul>
    </nav>
@endsection