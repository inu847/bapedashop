<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\Product;
use Exception;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class PembayaranController extends Controller
{
    public function bayar(Request $request)
    {
        $order = Keranjang::findOrFail($request->get('id'));
        \Midtrans\Config::$serverKey = 'SB-Mid-server-1gMTDRgG6CVPjAKkhH9wPvqy';
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;
        $params = array(
            'transaction_details' => array(
                'order_id' => $order->id,
                'gross_amount' => $request->get('harga_total'),
            ),
            // 'item_details' => array(
            //     "id" => $order->id,
            //     "price" => $order->row_total,
            //     "quantity" => $order->quantity,
            //     "name" => "Orange"
            // ),
            'customer_details' => array(
                'first_name' => \Auth::guard('customer')->user()->name,
                // 'last_name' => 'pratama',
                'email' => \Auth::guard('customer')->user()->email,
                'phone' => \Auth::guard('customer')->user()->phone,
            ),
        );
        // try {
        //     // Get Snap Payment Page URL
        //     $paymentUrl = \Midtrans\Snap::createTransaction($params)->redirect_url;
            
        //     // Redirect to Snap Payment Page
        //     header('Location: ' . $paymentUrl);
        //   }
        //   catch (\Exception $e) {
        //     echo $e->getMessage();
        //   }
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $data = array(
            'link' => "https://app.sandbox.midtrans.com/snap/v2/vtweb/".$snapToken
        );
        return $data;
    }

    public function ongkir($id)
    {
        $alamats = \Auth::guard('customer')->user()->alamatCustomer->where('status', 'alamat_utama')->first();
        $product = Keranjang::findOrFail($id);

        $order = Keranjang::findOrFail($product->id);
        \Midtrans\Config::$serverKey = 'SB-Mid-server-1gMTDRgG6CVPjAKkhH9wPvqy';
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;
        $params = array(
            'transaction_details' => array(
                'order_id' => $order->id,
                'gross_amount' => "50000",
            ),
            'customer_details' => array(
                'first_name' => \Auth::guard('customer')->user()->name,
                // 'last_name' => 'pratama',
                'email' => \Auth::guard('customer')->user()->email,
                'phone' => \Auth::guard('customer')->user()->phone,
            ),
        );

        try{
            $snapToken = \Midtrans\Snap::getSnapToken($params);
        }catch(Exception $e){
            $message = $e->getMessage();
        }

        
        return view('customer.ongkir', ['alamats' => $alamats, 'product' => $product, 'token' => $snapToken]);
    }

    // API KEY RAJA ONGKIR = 32acfec0aa49b3c9121d6bb185b8b59b
    public function cekOngkir(Request $request)
    {
        // dd($request->all());
        $daftarProvinsi = RajaOngkir::ongkosKirim([
            'origin'        => 75,     // ID kota/kabupaten asal Blitar
            'destination'   => \Auth::guard('customer')->user()->alamatCustomer->where('status', 'alamat_utama')->first()->city_id,      // ID kota/kabupaten tujuan
            'weight'        => 1300,    // berat barang dalam gram
            'courier'       => $request->post('courier')    // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
        ])->get();
        // dd(json($daftarProvinsi));
        return response()->json($daftarProvinsi);
    }
}
