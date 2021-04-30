<?php

use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Buyer;
use App\Models\Alamat;

    function orderId()
    {
        $order = Order::get();
        return $order;
    }

    function qrcode($enkripsi)
    {
        $buyer = Buyer::get()->where('enkripsi_token', $enkripsi)->first();
        return $buyer;
    }

    function alamatJob($id)
    {
        $job = Alamat::findOrFail($id);
        return $job;
    }

?>