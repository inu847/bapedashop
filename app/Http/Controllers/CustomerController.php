<?php

namespace App\Http\Controllers;

use App\Models\AlamatCustomer;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Keranjang;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->middleware('customer');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $carts = \Auth::guard('customer')->user()->keranjang->where('status', null);
        $cek_alamat_utama = \Auth::guard('customer')->user()->alamatCustomer->where('status', 'alamat_utama')->count();
        if ($cek_alamat_utama > 0) {
            $alamats = \Auth::guard('customer')->user()->alamatCustomer->where('status', 'alamat_utama');
            return view('customer.keranjang', ['carts' => $carts, 'alamats' => $alamats]);
        }else{
            return redirect()->route('formalamatCustomer')->with('success', 'Tambahkan Alamat Utama');
        }
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
        $user = \Auth::guard('customer')->user();

        $user->name = $request->get('name');

        if($request->file('profil')){
            if($user->profil && file_exists(storage_path('app/public/' . $user->profil))){
                \Storage::delete('public/'.$user->profil);
                $file = $request->file('profil')->store('profil customer', 'public');
                $user->profil = $file;
            }else{
                if($request->file('profil')){
                    $file = $request->file('profil')->store('profil customer', 'public');
                    $user->profil = $file;
                }
            }
        }

        $user->tanggal_lahir = $request->get('tanggal_lahir');

        $user->save();
        return redirect()->back()->with('status', 'Update Account Success!!');
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

    public function addToKeranjang(Request $request)
    {
        $cart = new Keranjang();
        $cart->prod_id = $request->get('product_id');
        $status = \Auth::guard('customer')->user()->keranjang()->save($cart);

        if ($status) {
            $msg = "Add To cart Success";
        } else {
            $msg = "Add Product Failed";
        }
        $output = array(
            'message' => $msg
        );
        return  $output;
    }

    public function sellCustomer(Request $request)
    {
        
        foreach($request->get('quantity') as $key => $value){
            $prod_id = $request->get('prod_id')[$key];
            $new_order = Keranjang::findOrFail($prod_id);
            
            $quantity = $request->get('quantity')[$key];
            $new_order->quantity = $quantity;
            $new_order->row_total = $request->get('row_total')[$key];
            
            if ($quantity) {
                $new_order->total_quantity = $request->get('total_quantity');
                $new_order->alamat_id = $request->get('alamat_id');
                $rp = str_replace("Rp","" , $request->get('subtotal'));
                $koma = str_replace(".","" , $rp);
                $result = str_replace(",","" , $koma);
                $new_order->subtotal = $result;
                $new_order->status = "belum dibayar";
            }
            
            $new_order->save();
        }

        return redirect()->route('customer.index')->with('success', "order berhasil dibuat");
    }

    public function pesananSaya()
    {
        $pesanan_saya = \Auth::guard('customer')->user()->keranjang->where('status');
        
        return view('customer.pesanan', ['pesanan_saya' => $pesanan_saya]);
    }

    public function accountCustomer()
    {
        $user = \Auth::guard('customer')->user();

        return view('customer.account', ['user' => $user]);
    }

    public function formalamatCustomer()
    {
        $alamats = \Auth::guard('customer')->user()->alamatCustomer->sortByDesc('status');
        $alamat_utama = \Auth::guard('customer')->user()->alamatCustomer->where('status', 'alamat_utama')->count();
        $alamat_toko = \Auth::guard('customer')->user()->alamatCustomer->where('status', 'alamat_toko')->count();
        $alamat_pengembalian = \Auth::guard('customer')->user()->alamatCustomer->where('status', 'alamat_pengembalian')->count();
        
        return view('customer.alamat', ['alamats' => $alamats, 'alamat_utama' => $alamat_utama, 'alamat_toko' => $alamat_toko, 'alamat_pengembalian' => $alamat_pengembalian]);
    }

    public function alamatCustomer(Request $request)
    {
        \Validator::make($request->all(), [
            'provinsi' => 'required', 'string', 'min:3', 'max:50',
            'kabupaten' => 'required', 'string', 'min:3', 'max:50',
            'desa' => 'required', 'string', 'min:3', 'max:50',
            'kecamatan' => 'required', 'string', 'min:3', 'max:50',
            'rt' => 'required', 'string', 'min:1', 'max:5',
            'rw' => 'required', 'string', 'min:1', 'max:5',
            'kode_pos' => 'required', 'string', 'min:2', 'max:25',
            'alamat' => 'required', 'string', 'min:8',
            'status' => 'required'
        ])->validate();
        
        $user = \Auth::guard('customer')->user();
        $alamat = new AlamatCustomer();
        $alamat->provinsi = $request->get('provinsi');
        $alamat->kabupaten = $request->get('kabupaten');
        $alamat->desa = $request->get('desa');
        $alamat->kecamatan = $request->get('kecamatan');
        $alamat->rt = $request->get('rt');
        $alamat->rw = $request->get('rw');
        $alamat->kode_pos = $request->get('kode_pos');
        $alamat->alamat = $request->get('alamat');
        $alamat->status = $request->get('status');
        $user->alamatCustomer()->save($alamat);
        return redirect()->back()->with('status', 'Add new alamat success!!!');
    }

    public function hapusAlamatCustomer($id)
    {
        $alamat = AlamatCustomer::findOrFail($id);
        $alamat->delete();

        return redirect()->back()->with('status', 'Delete Alamat Success!!');
    }
}
