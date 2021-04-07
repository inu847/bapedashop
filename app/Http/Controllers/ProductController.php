<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$product = User::find(1)->productId;
        // return $product;
        return view('seller.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('seller.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $user = User::find($id);
        $product = new Product();
        $product->nama_product = $request->get('nama_product');
        $product->deskripsi = $request->get('deskripsi');
        $product->stok = $request->get('stok');
        $product->images = $request->get('images');
        $product->price = $request->get('price');
        $product->status = "publish";
        \Auth::user()->productId()->save($product);
        return redirect()->route('manage-product.index')->with('status', 'Create Product Success!!');
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
    public function addProduct($id)
    {
        $user = User::find($id);
        $product = new Product();
        $product->nama_product = 'data1';
        $product->deskripsi = 'data1';
        $product->stok = 'data1';
        $product->images = 'data1';
        $product->price = 'data1';
        $product->status = "publish";
        $user->productId()->save($product);
        return redirect()->route('seller.index')->with('status', 'Create Product Success!!');
    }
}
