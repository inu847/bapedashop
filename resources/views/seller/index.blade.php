@extends('layouts.global')

@section('title')
    Manage Product
@endsection

@section('content')

@if(session('status'))
    <div class="alert alert-success">
        {{session('status')}}
    </div>
@endif

@if(session('statusdel'))
    <div class="alert alert-danger">
        {{session('statusdel')}}
    </div>
@endif

<div class="container-fluid library-app">
    <div class="row">
        <div class="col-12">
            <div class="mb-3">
                <h1>Manage Product</h1>
                <div class="text-zero top-right-button-container">
                    <a href="{{ route('manage-product.create')}}" class="btn btn-primary btn-lg top-right-button mr-1"><i class="simple-icon-plus"> Create New Product</i></a>
                </div>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">Library</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Data</li>
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
                            <form action="{{ route('manage-product.index')}}">
                                <input placeholder="Search..." name="keywoard" value="{{Request::get('keyword')}}" type="text">
                            </form>
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

            <div class="row">
                @foreach ($products as $product)
                    <div class="col-xxl-4 col-xl-6 col-12">
                        <div class="card d-flex flex-row mb-4 media-thumb-container">
                            <a class="d-flex align-self-center" href="Apps.MediaLibrary.ViewImage.html">
                                @if($product->images)
                                    <div class="side_view">
                                        <img src="{{asset('storage/'. $product->images)}}" alt="uploaded image" class="list-media-thumbnail responsive border-0" />
                                    {{-- <img src="{{asset('storage/'. $baju->avatar)}}" width="128px" id="myImg" alt="Baju : {{$baju->kategori}} {{$baju->title}}"/> --}}
                                    </div>
                                @else
                                    No avatar
                                @endif
                            </a>
                            <div class="d-flex flex-grow-1 min-width-zero">
                                <div class="card-body align-self-center d-flex flex-column justify-content-between min-width-zero align-items-lg-center">
                                    <a href="Apps.MediaLibrary.ViewImage.html" class="w-100">
                                        <p class="list-item-heading mb-2 truncate">{{$product->nama_product}}</p>
                                        @if ($product->status == "publish")
                                            <span class="badge badge-pill badge-primary mb-1">Publish</span>
                                        @else
                                            <span class="badge badge-pill badge-danger mb-1">Archived</span>
                                        @endif
                                    </a>
                                    
                                    <p class="mb-1 text-muted text-small w-100 truncate">Rp.{{$product->price}}</p>
                                </div>
                                <div class="pl-1 align-self-center">
                                    <form
                                        onsubmit="return confirm('Delete this product permanently?')"
                                        class="d-inline"
                                        action="{{route('manage-product.destroy', [$product->id])}}"
                                        method="POST">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <a href="{{route('manage-product.show', [$product->id])}}"
                                            class="btn btn-primary btn-sm"><i class="simple-icon-list mb-2"></i></a>
                                        <a href="{{route('manage-product.edit', [$product->id])}}"
                                            class="btn btn-info btn-sm"><i class="simple-icon-pencil"></i></a>

                                    <button type="submit" value="Delete" class="btn btn-danger btn-sm"><i class="simple-icon-trash"></i>
                                    </button>
                        
                            
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

    <div class="row">
        <div class="col-12 col-xl-12">
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

        </div>
    </div>
</div>
@endsection