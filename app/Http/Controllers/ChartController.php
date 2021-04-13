<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;

class ChartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carts = Cart::latest()->get()->where('enkripsi_token');

        return view('order.cart', ['carts' => $carts]);
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
        $id = $request->get('id');
        $buyer = $request->get('buyer');
        $enkripsi = $request->get('enkripsi_token');

        $product = Product::find($id);
        $cart = new Cart();
        $cart->buyer = $buyer;
        $cart->enkripsi_token = $enkripsi;
        $product->cartProduct()->save($cart);

        return redirect()->route('cart.index');
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
