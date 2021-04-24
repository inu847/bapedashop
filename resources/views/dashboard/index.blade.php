@extends('layouts.global')

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="alert alert-warning">
                    Selamat Datang {{\Auth::user()->name}}
                </div>
            </div>
            
            
            <div class="col-md-6 col-lg-12 col-xl-12">
                <div class="row">
                    <div class="col-xl-4 col-lg-4">
                        <div class="card mb-4 progress-banner">
                            <div class="card-body justify-content-between d-flex flex-row align-items-center">
                                <div>
                                    <i class="iconsminds-billing mr-2 text-white align-text-bottom d-inline-block"></i>
                                    <div>
                                        <p class="lead text-white">Total Penjualan</p>
                                        <p class="text-small text-white">Rp.{{ $total_penjualan }}</p>
                                    </div>
                                </div>

                                <div>
                                    <div role="progressbar"
                                        class="progress-bar-circle progress-bar-banner position-relative"
                                        data-color="white" data-trail-color="rgba(255,255,255,0.2)"
                                        aria-valuenow="{{$results_order}}" aria-valuemax="{{$all_order}}" data-show-percent="false">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4">
                        <div class="card mb-4 progress-banner">
                            <div class="card-body justify-content-between d-flex flex-row align-items-center">
                                <div>
                                    <i class="iconsminds-male mr-2 text-white align-text-bottom d-inline-block"></i>
                                    <div>
                                        <p class="lead text-white">{{ $total_order }} Order</p>
                                        <p class="text-small text-white">total order masuk</p>
                                    </div>
                                </div>
                                <div>
                                    <div role="progressbar"
                                        class="progress-bar-circle progress-bar-banner position-relative"
                                        data-color="white" data-trail-color="rgba(255,255,255,0.2)"
                                        aria-valuenow="{{$results_order}}" aria-valuemax="{{$all_order}}" data-show-percent="false">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-4">
                        <div class="card mb-4 progress-banner">
                            <a href="#"
                                class="card-body justify-content-between d-flex flex-row align-items-center">
                                <div>
                                    <i class="iconsminds-bell mr-2 text-white align-text-bottom d-inline-block"></i>
                                    <div>
                                        <p class="lead text-white">{{$total_rating}} Rating</p>
                                        <p class="text-small text-white">Rating Pembelian</p>
                                    </div>
                                </div>
                                <div>
                                    <div role="progressbar"
                                        class="progress-bar-circle progress-bar-banner position-relative"
                                        data-color="white" data-trail-color="rgba(255,255,255,0.2)"
                                        aria-valuenow="{{$pembulatan_rating}}" aria-valuemax="5" data-show-percent="false">
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-12 col-xl-6">
                <div class="icon-cards-row">
                    <div class="glide dashboard-numbers">
                        <div class="glide__track" data-glide-el="track">
                            <ul class="glide__slides">
                                <li class="glide__slide">
                                    <a href="#" class="card">
                                        <div class="card-body text-center">
                                            <i class="iconsminds-clock"></i>
                                            <p class="card-text mb-0">Pending Orders</p>
                                            <p class="lead text-center">{{ $order_pending }}</p>
                                        </div>
                                    </a>
                                </li>
                                <li class="glide__slide">
                                    <a href="#" class="card">
                                        <div class="card-body text-center">
                                            <i class="iconsminds-basket-coins"></i>
                                            <p class="card-text mb-0">Completed Orders</p>
                                            <p class="lead text-center">{{ $order_success }}</p>
                                        </div>
                                    </a>
                                </li>
                                <li class="glide__slide">
                                    <a href="#" class="card">
                                        <div class="card-body text-center">
                                            <i class="iconsminds-arrow-refresh"></i>
                                            <p class="card-text mb-0">On Hold Orders</p>
                                            <p class="lead text-center">{{ $order_onhold }}</p>
                                        </div>
                                    </a>
                                </li>
                                <li class="glide__slide">
                                    <a href="#" class="card">
                                        <div class="card-body text-center">
                                            <i class="iconsminds-mail-read"></i>
                                            <p class="card-text mb-0">New Comments</p>
                                            <p class="lead text-center">25</p>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-4">
                        <div class="card">
                            <div class="position-absolute card-top-buttons">

                                <button class="btn btn-header-light icon-button" type="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="simple-icon-refresh"></i>
                                </button>

                                <div class="dropdown-menu dropdown-menu-right mt-3">
                                    <a class="dropdown-item" href="#">Sales</a>
                                    <a class="dropdown-item" href="#">Orders</a>
                                    <a class="dropdown-item" href="#">Refunds</a>
                                </div>

                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Sales</h5>
                                <div class="dashboard-line-chart chart">
                                    <canvas id="salesChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-lg-12 mb-4">
                <div class="card">
                    
                    <div class="card-body">
                        <h5 class="card-title">Recent Orders</h5>
                        
                        <div class="scroll dashboard-list-with-thumbs">
                            @foreach ($recent_order as $order)
                                <div class="d-flex flex-row mb-3">
                                    <a class="d-block position-relative" href="#">
                                        <img src="{{ asset('storage/'. $order->images) }}" alt="Marble Cake" class="list-thumbnail border-0" />
                                        @if ( $order->buyer->status == 'process' )
                                            <span class="badge badge-pill badge-theme-1 position-absolute badge-top-right">{{ Str::upper($order->buyer->status) }}</span>
                                        @elseif ($order->buyer->status == 'success')
                                            <span class="badge badge-pill badge-theme-3 position-absolute badge-top-right">{{ Str::upper($order->buyer->status) }}</span>
                                        @elseif ($order->buyer->status == 'on hold')
                                            <span class="badge badge-pill badge-theme-2 position-absolute badge-top-right">{{ Str::upper($order->buyer->status) }}</span>
                                        @endif
                                    </a>
                                    <div class="pl-3 pt-2 pr-2 pb-2">
                                        <a href="#">
                                            <p class="list-item-heading">{{ $order->product_name }}</p>
                                            <div class="pr-4 d-none d-sm-block">
                                                <p class="text-muted mb-1 text-small">{{ $order->buyer->buyer }}</p>
                                            </div>
                                            <div class="text-primary text-small font-weight-medium d-none d-sm-block"> {{$order->created_at->diffForHumans()}}</div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="card dashboard-top-rated mb-5">
        
                    <div class="card-body">
                        <h5 class="card-title">Top Rated Items</h5>
                        <div class="glide best-rated-items">
                            <div class="glide__track" data-glide-el="track">
                                <div class="glide__slides">
                                    <div class="glide__slide">
                                        <img src="img/carousel-1.jpg" alt="Cheesecake" class="mb-4">
                                        <h6 class="mb-1"><span class="mr-2">1.</span>Cheesecake</h6>
                                        <select class="rating" data-current-rating="5" data-readonly="true">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                        <p class="text-small text-muted mb-0  d-inline-block">(48)</p>
                                    </div>
                                    <div class="glide__slide">
                                        <img src="img/carousel-1.jpg" alt="Cheesecake" class="mb-4">
                                        <h6 class="mb-1"><span class="mr-2">1.</span>Cheesecake</h6>
                                        <select class="rating" data-current-rating="5" data-readonly="true">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                        <p class="text-small text-muted mb-0  d-inline-block">(48)</p>
                                    </div>
                                    <div class="glide__slide">
                                        <img src="img/carousel-2.jpg" alt="Chocolate Cake" class="mb-4">
                                        <h6 class="mb-1"><span class="mr-2">2.</span>Chocolate Cake</h6>
                                        <select class="rating" data-current-rating="5" data-readonly="true">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                        <p class="text-small text-muted mb-0  d-inline-block">(48)</p>
                                    </div>
                                    <div class="glide__slide">
                                        <img src="img/carousel-3.jpg" alt="Cremeschnitte" class="mb-4">
                                        <h6 class="mb-1"><span class="mr-2">3.</span>Cremeschnitte</h6>
                                        <select class="rating" data-current-rating="5" data-readonly="true">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                        <p class="text-small text-muted mb-0  d-inline-block">(48)</p>
                                    </div>
        
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Suggestion</h5>
            
                        <div class="scroll dashboard-list-with-user">
                            <div class="d-flex flex-row mb-3 pb-3 border-bottom">
                                <a href="#">
                                    <img src="{{ asset('img/image-not-found.png') }}" alt="Mayra Sibley"
                                        class="img-thumbnail border-0 rounded-circle list-thumbnail align-self-center xsmall" />
                                </a>
                                <div class="pl-3">
                                    <a href="#">
                                        <p class="font-weight-medium mb-0 ">Mayra Sibley</p>
                                        <p class="text-muted mb-0 text-small">09.08.2018 - 12:45</p>
                                    </a>
                                </div>
                            </div>
            
                            <div class="d-flex flex-row mb-3 pb-3 border-bottom">
                                <a href="#">
                                    <img src="{{ asset('img/image-not-found.png') }}" alt="Mimi Carreira"
                                        class="img-thumbnail border-0 rounded-circle list-thumbnail align-self-center xsmall" />
                                </a>
                                <div class="pl-3">
                                    <a href="#">
                                        <p class="font-weight-medium mb-0 ">Mimi Carreira</p>
                                        <p class="text-muted mb-0 text-small">05.08.2018 - 10:20</p>
                                    </a>
                                </div>
                            </div>
            
                            <div class="d-flex flex-row mb-3 pb-3 border-bottom">
                                <a href="#">
                                    <img src="{{ asset('img/image-not-found.png') }}" alt="Philip Nelms"
                                        class="img-thumbnail border-0 rounded-circle list-thumbnail align-self-center xsmall" />
                                </a>
                                <div class="pl-3">
                                    <a href="#">
                                        <p class="font-weight-medium mb-0 ">Philip Nelms</p>
                                        <p class="text-muted mb-0 text-small">05.08.2018 - 09:12</p>
                                    </a>
                                </div>
                            </div>
            
                            <div class="d-flex flex-row mb-3 pb-3 border-bottom">
                                <a href="#">
                                    <img src="{{ asset('img/image-not-found.png') }}" alt="Terese Threadgill"
                                        class="img-thumbnail border-0 rounded-circle list-thumbnail align-self-center xsmall" />
                                </a>
                                <div class="pl-3">
                                    <a href="#">
                                        <p class="font-weight-medium mb-0 ">Terese Threadgill</p>
                                        <p class="text-muted mb-0 text-small">01.08.2018 - 18:20</p>
                                    </a>
                                </div>
                            </div>
            
                            <div class="d-flex flex-row mb-3 pb-3 border-bottom">
                                <a href="#">
                                    <img src="{{ asset('img/image-not-found.png') }}" alt="Kathryn Mengel"
                                        class="img-thumbnail border-0 rounded-circle list-thumbnail align-self-center xsmall" />
                                </a>
                                <div class="pl-3">
                                    <a href="#">
                                        <p class="font-weight-medium mb-0 ">Kathryn Mengel</p>
                                        <p class="text-muted mb-0 text-small">27.07.2018 - 11:45</p>
                                    </a>
                                </div>
                            </div>
            
                            <div class="d-flex flex-row mb-3 pb-3 border-bottom">
                                <a href="#">
                                    <img src="{{ asset('img/image-not-found.png') }}" alt="Esperanza Lodge"
                                        class="img-thumbnail border-0 rounded-circle list-thumbnail align-self-center xsmall" />
                                </a>
                                <div class="pl-3">
                                    <a href="#">
                                        <p class="font-weight-medium mb-0 ">Esperanza Lodge</p>
                                        <p class="text-muted mb-0 text-small">24.07.2018 - 15:00</p>
                                    </a>
                                </div>
                            </div>
                        </div>
            
                    </div>
                </div>
            </div>
        </div>
        
        {{-- Calendar --}}
        <div class="col-xl-12 col-lg-12 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Calendar</h5>
                    <div class="calendar"></div>
                </div>
            </div>
        </div>
@endsection