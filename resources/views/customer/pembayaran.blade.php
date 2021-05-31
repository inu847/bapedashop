@extends('layouts.customer')

@section('title')
    Pembayaran
@endsection

@section('content')
    Halaman Pembayaran

    <button id="pay-button">Pay!</button>
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-zuLignrNUoqy1d-0"></script>
    <script type="text/javascript">
      var payButton = document.getElementById('pay-button');
      var token = {!! json_encode($token) !!};
      // For example trigger on button clicked, or any time you need
      payButton.addEventListener('click', function () {
        snap.pay(token); 
        // Replace it with your transaction token
      });
    </script>
@endsection