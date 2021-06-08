@extends('layouts.auth')

@section('title')
    Pricing
@endsection

@section('content')
<div class="container">
    <div class="row h-100">
        <div class="col-12 col-sm-8 col-md-10 mx-auto my-auto">
            <div class="card index-card">
                <div class="card-body text-center form-side">
                    <a href="{{ url('/')}}">
                        <img src="{{asset('img/LOGO 4.png')}}" alt="" style="height: 70px;" class="mb-5">
                    </a>
                    <p class="lead mb-5">Selesaikan Pembayaran Sebelum!</p>
                    <div class="mb-5">
                        <span class="timer-column">
                            <p class="lead text-center">{{ $transaksi->created_at->format('d')+01 }}</p>
                            <p>Date</p>
                        </span>
                        <span class="timer-column">
                            <p class="lead text-center">{{ $transaksi->created_at->format('m') }}</p>
                            <p>Mounth</p>
                        </span>
                        <span class="timer-column">
                            <p class="lead text-center">{{ $transaksi->created_at->format('h') }}</p>
                            <p>Hours</p>
                        </span>
                        <span class="timer-column">
                            <p class="lead text-center">{{ $transaksi->created_at->format('i') }}</p>
                            <p>Minute</p>
                        </span>
                    </div>
                    <div class="row">
                        <div class="col-12 offset-0 col-md-8 offset-md-2 mb-2">
                            <p>selesaikan pembayaran sebelum mencabai batas waktu yang telah kami tentukan
                                klik tombol bayar sekarang di bawah untuk melanjutkan proses pembayaran.
                            </p>
                        </div>
                        <div class="col-12 offset-0 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
                                <div class="text-center">
                                    <form
                                        onsubmit="return confirm('Are you sure?')"
                                        class="d-inline"
                                        action="{{route('transaksi.cancel', [(int)$transaksi->order_id])}}"
                                        method="POST">
                                        @csrf
                                        <input type="hidden" value="PUT" name="_method">
                                        <button class="btn btn-danger mb-1" type="submit">
                                            <i class="iconsminds-credit-card-3">Batalkan Pembayaran</i> 
                                         </button>
                                    </form>
                                    
                                    <button class="btn btn-primary mb-1" type="button" data-toggle="collapse" data-target=".multi-collapse" aria-expanded="false" aria-controls="multiCollapseExample1 multiCollapseExample2">
                                       <i class="iconsminds-credit-card-3">Bayar Sekarang</i> 
                                    </button>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="collapse multi-collapse" id="multiCollapseExample1">
                                                <div class="mt-4">
                                                    <p>Selesaikan pembayaran dengan transfer ke rekening virtual account</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="collapse multi-collapse" id="multiCollapseExample1">
                                                <div class="mt-4">
                                                    <strong id="ammount"></strong>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="collapse multi-collapse" id="multiCollapseExample1">
                                                <div class="mt-2">
                                                    <p>Silahkan melakukan transfer dengan Virtual Account dibawah</p>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($transaksi->bank == "bca")
                                          <div class="col-sm-12">
                                              <div class="collapse multi-collapse" id="multiCollapseExample1">
                                                  <div class="mt-3">
                                                      <img src="{{ asset('img/bca.png')}}" alt="" width="50px" height="20px"><span> : {{ $transaksi->va_number }}</span>
                                                  </div>
                                              </div>
                                          </div>
                                        @elseif ($transaksi->bank == "bni")
                                          <div class="col-sm-12">
                                            <div class="collapse multi-collapse" id="multiCollapseExample2">
                                                <div class="mt-4">
                                                    <img src="{{ asset('img/bni.png')}}" alt="" width="50px" height="20px"><span> : {{ $transaksi->va_number }}</span>
                                                </div>
                                              </div>
                                          </div>
                                        @elseif ($transaksi->bank == "mandiri")
                                          <div class="col-sm-12">
                                            <div class="collapse multi-collapse" id="multiCollapseExample2">
                                                <div class="mt-4">
                                                    <img src="{{ asset('img/mandiri.png')}}" alt="" width="50px" height="20px"><span> : {{ $transaksi->va_number }}</span>
                                                </div>
                                            </div>
                                          </div>
                                        @endif                                        
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script>
  $(function () {
    var data = '{{$transaksi->gross_amount}}';
    var ammount = parseInt(data).toLocaleString("en");
    $("#ammount").html('<h1>Rp.'+ammount+'</h1>');
  })
</script>