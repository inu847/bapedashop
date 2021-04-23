<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Buyer;
use App\Models\Cart;

class ManageOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){

        $this->middleware('auth');

        // $this->middleware(function($request, $next){

        // if(Gate::allows('manage-order')) return $next($request);
        //     abort(403, 'Anda tidak memiliki cukup hak akses');
        // });
    }
    
    public function index()
    {
        $orders = \Auth::user()->buyer->where('status');
        // dd($orders);
        return view('manage-order.index', ['orders' => $orders]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $buyer = Buyer::findOrFail($id);
        $orders = Buyer::findOrFail($id)->order;
        
        return view('manage-order.show', ['orders' => $orders, 'buyer' => $buyer]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $buyer = Buyer::findOrFail($id);
        $orders = Buyer::findOrFail($id)->order;
        // dd($orders);
        return view('manage-order.edit', ['buyer' => $buyer, 'orders' => $orders]);
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
        $invoices = [];
        foreach ($request->input('product_name') as $key => $value) {
            $invoices["product_name.{$key}"] = 'required';
            $invoices["deskripsi.{$key}"] = 'required';
            $invoices["price.{$key}"] = 'required';
            $invoices["images.{$key}"] = 'required';
            $invoices["quantity.{$key}"] = 'required';
            $invoices["row_total.{$key}"] = 'required';
        }
        $validator = \Validator::make($request->all(), $invoices);

        $id = $request->get('buyer_id');
        $buyer = Buyer::findOrFail($id);
        $buyer->total_quantity = $request->get('total_quantity');
        $buyer->subtotal = $request->get('subtotal');
        $buyer->status = "process";
        $buyer->save();

        if ($validator->passes()) {
            foreach($request->get('product_name') as $key => $value){
                $new_order = new Order();
                $new_order->product_name = $request->get('product_name')[$key];
                $new_order->deskripsi = $request->get('deskripsi')[$key];
                $new_order->price = $request->get('price')[$key];
                $new_order->images = $request->get('images')[$key];
                $new_order->quantity = $request->get('quantity')[$key];
                $new_order->row_total = $request->get('row_total')[$key];
                $buyer->order()->save($new_order)[$key];
            }
        }

        return redirect()->route('user.index')->with('status', 'Pesanan Anda Berhasil Terkirim!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $buyer = Buyer::findOrFail($id);
        $order = Order::where('buyer_id', $id);
        $cart = Cart::where('buyer_id', $id);

        $buyer->delete();
        $order->delete();
        $cart->delete();
        return redirect()->route('manage-order.index')->with('statusdel', 'Data Berhasil Dihapus!!');
    }

    public function formVerivikasiOrder()
    {
        return view('manage-order.verivikasi');
    }

    public function verivikasiOrder(Request $request)
    {
        $no_pesanan = $request->get('no_pesanan');
        $buyers = Buyer::get()->where('enkripsi_token', $no_pesanan);
        foreach($buyers as $buyer){
            if($buyer->status){
                return redirect()->back()->with('fail', 'order '.$buyer->buyer.' telah disetujui dengan status '.$buyer->status);
            }else{
                $id = $buyer->id;
                $verivikasi = Buyer::findOrFail($id);
                $verivikasi->status = 'process';
                $verivikasi->save();

                return redirect()->back()->with('success', 'Verivikasi Sucess!!');
            }
        }
    }
    
    public function status($id)
    {
        $status = Buyer::findOrFail($id);
        $status->status = "success";
        $status->save();

        return redirect()->route('manage-order.index')->with('status', 'Update Order Success!!');
    }
}
