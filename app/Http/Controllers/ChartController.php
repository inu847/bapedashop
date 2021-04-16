<?php

namespace App\Http\Controllers;

use App\Models\Buyer;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;

class ChartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $enkripsi = $request->get('enkripsi');
        $buyer_id = $request->get('buyer_id');
        $carts = Cart::where('enkripsi_token', '=', $enkripsi)->get();

        return view('order.cart', ['carts' => $carts, 'buyer_id' => $buyer_id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = $request->get('buyer_id');
        $buyer = Buyer::findOrFail($id);
        $buyer->total_quantity = $request->get('total_quantity');
        $buyer->subtotal = $request->get('subtotal');
        $buyer->status = "process";
        $buyer->save();

        $new_order = new Order();
        $new_order->product_name = $request->get('product_name');
        $new_order->deskripsi = $request->get('deskripsi');
        $new_order->price = $request->get('price');
        $new_order->images = $request->get('images');
        $new_order->quantity = $request->get('quantity');
        $new_order->row_total = $request->get('row_total');
        $buyer->order()->save($new_order);

        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    // insert to database with return modified text 
    public function ajaxaddtocart(Request $request)
    {
        $id = $request->post('id');
        $buyer = $request->post('buyer');
        $enkripsi = $request->post('enskripsi');

        $product = Product::find($id);
        $cart = new Cart();
        $cart->buyer = $buyer;
        $cart->enkripsi_token = $enkripsi;
        $status = $product->cartProduct()->save($cart);

        if ($status) {
            $msg = "Are You Sure Add to cart " . $product->nama_product . "??";
        } else {
            $msg = "Add Product Failed";
        }
        $output = array(
            'message' => $msg
        );
        return  $output;
    }
}
