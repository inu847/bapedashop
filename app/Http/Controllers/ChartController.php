<?php

namespace App\Http\Controllers;

use App\Models\Buyer;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use App\Models\Suggestion;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ChartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index(Request $request)
    // {
    //     $buyer_id = $request->get('buyer_id');
    //     $user = $request->get('user_id');
    //     $get_cart = Cart::where('buyer_id', '=', $buyer_id)->get();

    //     if($get_cart){
    //         $enkripsi = $request->get('enkripsi');
    //         $carts = Cart::where('enkripsi_token', '=', $enkripsi)->get();
    //     }

    //     return view('order.cart', ['carts' => $carts, 'buyer_id' => $buyer_id, 'user' => $user]);
    // }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request)
    // {
    //     $invoices = [];
    //     foreach ($request->input('product_name') as $key => $value) {
    //         $invoices["product_name.{$key}"] = 'required';
    //         $invoices["deskripsi.{$key}"] = 'required';
    //         $invoices["price.{$key}"] = 'required';
    //         $invoices["images.{$key}"] = 'required';
    //         $invoices["quantity.{$key}"] = 'required';
    //         $invoices["row_total.{$key}"] = 'required';
    //     }
    //     $validator = \Validator::make($request->all(), $invoices);

    //     $buyer_id = $request->get('buyer_id');
    //     $buyer = Buyer::findOrFail($buyer_id);
    //     $buyer->total_quantity = $request->get('total_quantity');
    //     $rp = str_replace("Rp","" , $request->get('subtotal'));
    //     $koma = str_replace(".","" , $rp);
    //     $result = str_replace(",","" , $koma);
    //     $buyer->subtotal = $result;
    //     $buyer->save();

    //     if ($validator->passes()) {
    //         foreach($request->get('product_name') as $key => $value){
    //             $new_order = new Order();
    //             $new_order->product_name = $request->get('product_name')[$key];
    //             $new_order->deskripsi = $request->get('deskripsi')[$key];
    //             $new_order->price = $request->get('price')[$key];
    //             $new_order->images = $request->get('images')[$key];
    //             $new_order->quantity = $request->get('quantity')[$key];
    //             $new_order->row_total = $request->get('row_total')[$key];
    //             $new_order->user_id = $request->get('user_id')[$key];
    //             $buyer->order()->save($new_order)[$key];
    //         }
    //     }
    //     $enkripsi = $buyer->enkripsi_token;

    //     return view('order.qrcode', ['enkripsi' => $enkripsi, 'buyer' => $buyer]);
    // }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */

    // public function finishOrder()
    // {
    //     return redirect()->route('user.index')->with('status', 'Order Berhasil');
    // }

    // public function showSuggestion($id)
    // {
    //     $buyer = Buyer::findOrFail($id);
        
    //     return view('order.suggestion', ['buyer' => $buyer]);
    // }

    // public function suggestion(Request $request, $id)
    // {
    //     $buyer = Buyer::findOrFail($id);
    //     $suggestion = new Suggestion;
    //     $suggestion->suggestion = $request->get('suggestion');
    //     $suggestion->rating = $request->get('rating');
    //     $buyer->suggestion()->save($suggestion);

    //     return redirect()->route('user.index')->with('status', 'Order Berhasil'); 
    // }

    // public function show($id)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit($id)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, $id)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy($id)
    // {
    //     //
    // }

    // public function scanIot(Request $request, $id)
    // {
    //     // http://localhost:8000/api/scanIotBarcodeGenerate/scan/withSuperAdmin12?enkripsi_token=3421813
    //     $data = $request->get('enkripsi_token');
    //     $buyer = Buyer::findOrFail($id);
    //     if($buyer->enkripsi_token == $data){
    //         if($buyer->status == 'process' or $buyer->status == 'success' or $buyer->status == 'on hold'){
    //             return 'sudah updated dengan status '. $buyer->status;
    //         }else{
    //             $buyer->status = "process";
    //             $buyer->save();
    //             return 'success updated!!';
    //         }
    //     }else{
    //         return 'Not Found!!';
    //     }

    // }

    // // insert to database with return modified text 
    // public function ajaxaddtocart(Request $request)
    // {
    //     $id = $request->post('id');
    //     $buyer = $request->post('buyer');
    //     $enkripsi = $request->post('enskripsi');

    //     $product = Product::find($id);
    //     $cart = new Cart();
    //     $cart->buyer_id = $buyer;
    //     $cart->enkripsi_token = $enkripsi;
    //     $status = $product->cartProduct()->save($cart);

    //     if ($status) {
    //         $msg = "Are You Sure Add to cart " . $product->nama_product . "??";
    //     } else {
    //         $msg = "Add Product Failed";
    //     }
    //     $output = array(
    //         'message' => $msg
    //     );
    //     return  $output;
    // }
}
