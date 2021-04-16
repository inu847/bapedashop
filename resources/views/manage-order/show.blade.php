@extends('layouts.global')

@section('title')
    Detail Order
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Invoice</h1>
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
                <div class="separator mb-5"></div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="col-md-12 col-lg-12 mb-4">
                    <div class="card dashboard-sq-banner justify-content-end">
                        <div class="card-body justify-content-end d-flex flex-column">
                            <span class="badge badge-pill badge-theme-3 align-self-start mb-3">CAPPS</span>
                            <p class="lead text-white">Customer Applications</p>
                            <p class="text-white">Cetak Struk Belanja <span><a onclick="window.print(); return false;" class="btn btn-info" href="#">PRINT</a></span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
            
        
        <div class="row invoice">
            <div class="col-12">
                <div class="invoice-contents" leftmargin="0" marginwidth="0" topmargin="0" marginheight="0"
                    offset="0"
                    style="background-color:#ffffff; height:1200px; font-family: Helvetica,Arial,sans-serif !important; position: relative;">
                    <table bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0"
                        style="width:100%; background-color:#ffffff;border-collapse:separate !important; border-spacing:0;color:#242128; margin:0;padding:30px;"
                        heigth="auto">

                        <tbody>
                            <tr>
                                <td align="left" valign="center"
                                    style="padding-bottom:35px; padding-top:15px; border-top:0;width:100% !important;">
                                    {{-- <a class="navbar-logo" href="{{ url('/')}} "> --}}
                                        <img src="{{asset('img/LOGO 4.png')}}" alt="" style="height: 50px;">
                                    {{-- </a> --}}
                                </td>
                                <td align="right" valign="center"
                                    style="padding-bottom:35px; padding-top:15px; border-top:0;width:100% !important;">
                                    <p
                                        style="color: #8f8f8f; font-weight: normal; line-height: 1.2; font-size: 12px; white-space: nowrap; ">
                                        CAPPS
                                        <br> 
                                        Alamat lengkap TOKO
                                        <br>
                                        STATUS TOKO
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="padding-top:30px; border-top:1px solid #f1f0f0">
                                    <table style="width: 100%;">
                                        <tbody>
                                            <tr>
                                                <td
                                                    style="vertical-align:middle; border-radius: 3px; padding:30px; background-color: #f9f9f9; border-right: 5px solid white;">
                                                    <p
                                                        style="color:#303030; font-size: 14px;  line-height: 1.6; margin:0; padding:0;">
                                                        {{$buyer->buyer}}
                                                        <br>
                                                        {{\Auth::user()->nama_toko}}
                                                        <br>
                                                        Alamat TOKO,beserta kota kabupaten
                                                    </p>
                                                </td>

                                                <td
                                                    style="text-align: right; padding-top:0px; padding-bottom:0; vertical-align:middle; padding:30px; background-color: #f9f9f9; border-radius: 3px; border-left: 5px solid white;">
                                                    <p
                                                        style="color:#8f8f8f; font-size: 14px; padding: 0; line-height: 1.6; margin:0; ">
                                                        Invoice #: 0{{$buyer->id}}<br>
                                                        {{$orders->created_at->format('d-m-Y')}}
                                                    </p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table style="width: 100%; margin-top:40px;">
                                        <thead>
                                            <tr>
                                                <th
                                                    style="text-align:left; font-size: 10px; color:#8f8f8f; padding-bottom: 15px;">
                                                    ITEM NAME
                                                </th>
                                                <th
                                                    style="text-align:left; font-size: 10px; color:#8f8f8f; padding-bottom: 15px;">
                                                    COUNT
                                                </th>
                                                <th
                                                    style="text-align:right; font-size: 10px; color:#8f8f8f; padding-bottom: 15px;">
                                                    PRICE
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- @foreach ($orders as $order) --}}
                                            <tr>
                                                <td style="padding-top:0px; padding-bottom:5px;">
                                                    <h4 style="font-size: 16px; line-height: 1; margin-bottom:0; color:#303030; font-weight:500; margin-top: 10px;">
                                                        {{$orders->product_name}}
                                                    </h4>
                                                </td>
                                                <td>
                                                    <p href="#"
                                                        style="font-size: 13px; text-decoration: none; line-height: 1; color:#909090; margin-top:0px; margin-bottom:0;">
                                                        {{$orders->quantity}}
                                                        pcs</p>
                                                </td>
                                                <td style="padding-top:0px; padding-bottom:0; text-align: right;">
                                                    <p style="font-size: 13px; line-height: 1; color:#303030; margin-bottom:0; margin-top:0; vertical-align:top; white-space:nowrap;">
                                                        Rp.{{$orders->row_total}}
                                                        </p>
                                                </td>
                                            </tr>
                                           
                                            {{-- @endforeach --}}
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <table bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0"
                        style="position:absolute; bottom:0; width:100%; background-color:#ffffff;border-collapse:separate !important; border-spacing:0;color:#242128; margin:0;padding:30px; padding-top: 20px;"
                        heigth="auto">
                        <tr>
                            <td colspan="3" style="border-top:1px solid #f1f0f0">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="2" style="width: 100%">
                                <p href="#"
                                    style="font-size: 13px; text-decoration: none; line-height: 1.6; color:#909090; margin-top:0px; margin-bottom:0; text-align: right;">
                                    Quantity : </p>
                            </td>
                            <td style="padding-top:0px; text-align: right;">
                                <p
                                    style="font-size: 13px; text-decoration: none; line-height: 1; color:#909090; margin-top:0px; margin-bottom:0;">
                                    {{ $buyer->total_quantity }} Pcs
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style=" width: 100%; padding-bottom:15px;">
                                <p href="#"
                                    style="font-size: 13px; text-decoration: none; line-height: 1.6; color:#909090; margin-top:0px; margin-bottom:0; text-align: right;">
                                    <strong>Total : </strong></p>
                            </td>
                            <td style="padding-top:0px; text-align: right; padding-bottom:15px;">
                                <p
                                    style="font-size: 13px; line-height: 1.6; color:#303030; margin-bottom:0; margin-top:0; vertical-align:top; white-space:nowrap; margin-left:15px">
                                    <strong>{{ $buyer->subtotal }}</strong>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" style="border-top:1px solid #f1f0f0">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align:center;">
                                <p style="color: #909090; font-size:11px; text-align:center;">Thank you for shopping at {{\Auth::user()->nama_toko}}</p>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection