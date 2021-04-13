<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Rating;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\User as UserResource;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = User::where('status', 'active')->paginate(20);

        $filterKeyword = $request->get('keyword');
        $status = $request->get('status');
        $user = User::where('nama_toko', 'LIKE', "%$filterKeyword%")->paginate(10);
        // if($filterKeyword){
        //     $user = User::where('nama_toko', 'LIKE', "%$filterKeyword%")->paginate(10);
        //     if($status){
        //         $user = User::where('nama_toko', 'LIKE', "%$filterKeyword%")->where('status', $status)->paginate(10);
        //     } else {
        //         $user = User::where('nama_toko', 'LIKE', "%$filterKeyword%")->paginate(10);
        //         }
        //    }

        return view('buyer.index', ['user' => $user]);
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
        \Validator::make($request->all(), [
            'name' => 'required', 'string', 'max:255',
            'email' => 'required', 'string', 'email', 'max:255', 'unique:users',
            'nama_toko' => 'required', 'string', 'min:4', 'max:255',
            'phone' => 'required', 'string', 'min:6', 'max:255',
            'file_penunjang' => 'file|image|mimes:jpeg,png,jpg,pdf,docx',
            'ktp' => 'file|image|mimes:jpeg,jpg',
            'password' => 'required', 'string', 'min:8', 'confirmed',
        ])->validate();

        $new_user = new User;
        $new_user->name = $request->get('name');
        $new_user->email = $request->get('email');
        $new_user->nama_toko = $request->get('nama_toko');
        $new_user->phone = "+62".$request->get('phone');
        $new_user->status = "inactive";
        // $new_user->file_penunjang = $request->get('file_penunjang');
        // $new_user->ktp = $request->get('ktp');
        if($request->file('file_penunjang')){
            $file = $request->file('file_penunjang')->store('file_penunjangs', 'public');
            $new_user->file_penunjang = $file;
        }
        if($request->file('ktp')){
            $file = $request->file('ktp')->store('ktps', 'public');
            $new_user->ktp = $file;
        }
        $new_user->password = \Hash::make($request->get('password'));
        
        $new_user->save();
        return redirect()->route('login')->with('status', 'Create Akun Success!! Prosess memakan waktu paling lama 2x24, cek secara berkala email kamu!');
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
        $user = User::findOrFail($id);

        return view('seller.setting', ['user' => $user]);
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
        \Validator::make($request->all(), [
            'nama_product' => 'required', 'string', 'max:255', 'min:2',
            'deskripsi' => 'required', 'string', 'max:255', 'min:8',
            'stok' => 'required', 'max:1000',
            'images' => 'file|image|mimes:jpeg,png,jpg',
            'price' => 'required', 'max:20',
        ])->validate();
        
        $edit_product = Product::findOrFail($id);
        $edit_product->nama_product = $request->get('nama_product');
        $edit_product->deskripsi = $request->get('deskripsi');
        $edit_product->stok = $request->get('stok');
        if($request->file('images')){
            if($edit_product->images && file_exists(storage_path('app/public/' . $edit_product->images))){
                Storage::delete('public/'.$edit_product->images);
                $file = $request->file('images')->store('product_images', 'public');
                $edit_product->images = $file;
            }else{
                if($request->file('images')){
                    $file = $request->file('images')->store('product_images', 'public');
                    $edit_product->images = $file;
                }
            }
        }
        $edit_product->price = $request->get('price');

        \Auth::user()->productId()->save($edit_product);

        return redirect()->route('manage-product.index')->with('status', 'Update Product Success!!');
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

    public function verivikasiPassword(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $products = User::findOrFail($id)->productId;
        
        $buyer = $request->get('buyer');
        $_token = $request->get('_token');
        $verivikasi = $request->get('enkripsi');
        if($verivikasi == $user->enkripsi){
            $user->generateToken();
            return view('buyer.show', ['user' => $user, 'products' => $products, 'verivikasi' => $verivikasi, 'buyer' => $buyer, '_token' => $_token]);
        }else{
            return redirect()->route('user.index')->with('status', 'Password Salah!!');
        }
    }

    // Api
    public function getToko(Request $request)
    {
        $user = new UserResource(User::get());
        $filterKeyword = $request->get('keyword');
        $status = $request->get('status');
        $user = User::where('nama_toko', 'LIKE', "%$filterKeyword%")->paginate(10);
        return $user;
    }
}
