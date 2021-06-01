<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\Product;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class PembayaranController extends Controller
{
    public function bayar($id)
    {
        $order = Keranjang::findOrFail($id);
        // dd($order);
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-1gMTDRgG6CVPjAKkhH9wPvqy';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
        // dd($order->row_total + $order->row_total);
        $params = array(
            'transaction_details' => array(
                'order_id' => $order->id,
                'gross_amount' => $order->row_total,
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
        
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        // dd($snapToken);
        return view('customer.pembayaran', ['token' => $snapToken]);
    }

    public function pembayaranApi()
    {
        $order = Keranjang::findOrFail($id);

        if($error==0){
            DB::commit();
            $status = 'success';
            $message = 'Transaction success';
            $data = [
            'order_id' => $order->id,
            'total_bill' => $total_bill,
            'invoice_number' => $order->invoice_number,
            ];
        }

        if($error==0){
            DB::commit();
            $status = 'success';
            $message = 'Transaction success';
            /* MULAI MIDTRANS */
            \Veritrans_Config::$serverKey = "SERVER KEY MIDTRANS";
            \Veritrans_Config::$isProduction = false;
            \Veritrans_Config::$isSanitized = true;
            \Veritrans_Config::$is3ds = true;
            $transaction_data = [
            'transaction_details' => [
            'order_id' => $order->invoice_number,
            'gross_amount' => $total_bill,
            ]
            ];
            $payment_link = \Veritrans_Snap::createTransaction($transaction_data)->redirect_url;
            $data = [
            'payment_link' => $payment_link,
            ];
            /* SELESAI MIDTRANS */
           }
           
    }

    public function ongkir()
    {
        $alamats = \Auth::guard('customer')->user()->alamatCustomer->where('status', 'alamat_utama')->first();
        // dd($alamats);
        return view('customer.ongkir', ['alamats' => $alamats]);
    }
    // API KEY RAJA ONGKIR = 32acfec0aa49b3c9121d6bb185b8b59b
    public function cekOngkir(Request $request)
    {
        $daftarProvinsi = RajaOngkir::ongkosKirim([
            'origin'        => 75,     // ID kota/kabupaten asal Blitar
            'destination'   => \Auth::guard('customer')->user()->alamatCustomer->where('status', 'alamat_utama')->first()->city_id,      // ID kota/kabupaten tujuan
            'weight'        => 1300,    // berat barang dalam gram
            'courier'       => $request->post('courier')    // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
        ])->get();

        return response()->json($daftarProvinsi);
    }
}
