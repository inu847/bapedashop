<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\Product;
use App\Models\Transaksi;
use Exception;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class PembayaranController extends Controller
{
    public function ongkir($id)
    {
        $alamats = \Auth::guard('customer')->user()->alamatCustomer->where('status', 'alamat_utama')->first();
        $product = Keranjang::findOrFail($id);
        $expire_d = (int)$product->created_at->format('d')+1;
        $expire_my = $product->created_at->format('my');
        $expire = (int)$expire_d.(int)$expire_my;
        $start = (int)$product->created_at->format('d');
        $start_my = $product->created_at->format('my');
        $start = (int)$start.(int)$start_my;
        if($product->status == "pending" and (int)$start < (int)$expire){
            $transaksi = Transaksi::where('order_id', $id)->first();
            return view('customer.pembayaran', ['transaksi' => $transaksi]);
        };
        
        return view('customer.ongkir', ['alamats' => $alamats, 'product' => $product]);
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
            'token' => $snapToken
        );
        return $data;
    }

    public function updateStatusPesanan(Request $request)
    {   
        $transaksi = new Transaksi();
        $transaksi->status_message = $request->get('status_message');
        $transaksi->transaction_id = $request->get('transaction_id');
        $transaksi->gross_amount = $request->get('gross_amount');
        $transaksi->payment_type = $request->get('payment_type');
        $transaksi->transaction_status = $request->get('transaction_status');
        $transaksi->bank = $request->get('bank');
        $transaksi->va_number = $request->get('va_number');
        $transaksi->fraud_status = $request->get('fraud_status');
        $transaksi->pdf_url = $request->get('pdf_url');
        $transaksi->order_id = $request->get('order_id');
        $transaksi->customer_id = \Auth::guard('customer')->user()->id;
        $transaksi->save();

        $update_pesanan = Keranjang::findOrFail($request->get('order_id'));
        $update_pesanan->status = $request->get('transaction_status');
        $update_pesanan->save();

        $data = array(
            'redirect' => route('pesanan.saya')
        );
        return $data;
    }

    public function batalkanTransaksi($id)
    {
        $transaksi = Keranjang::findOrFail($id);
        $transaksi->status = 'cancel';
        $transaksi->save();

        return redirect()->route('pesanan.saya');
    }
}
