<?php

namespace App\Http\Controllers;

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
        $user_id = $request->get('user_id');
        $carts = Cart::where('enkripsi_token', '=', $enkripsi)->get();

        return view('order.cart', ['carts' => $carts, 'user_id' => $user_id]);
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
        $id = $request->get('user_id');
        $user = User::find($id);

        $new_order = new Order();
        $new_order->buyer = json_encode($request->get('buyer'));
        $new_order->product_name = json_encode($request->get('product_name'));
        $new_order->deskripsi = json_encode($request->get('deskripsi'));
        $new_order->price = json_encode($request->get('price'));
        $new_order->images = json_encode($request->get('images'));
        $new_order->quantity = json_encode($request->get('quantity'));
        $new_order->total_quantity = $request->get('total_quantity');
        $new_order->subtotal = $request->get('subtotal');
        $user->order()->save($new_order);

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
            $msg = $buyer . ", Add Product with id " . $id . " succesfully, " . ' - ' . $enkripsi;
        } else {
            $msg = "Add Product Failed";
        }
        $output = array(
            'message' => $msg
        );
        return  $output;
    }
}
