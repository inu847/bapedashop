<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Rating;
use Illuminate\Support\Facades\Hash;

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
        $user = User::findOrFail($id);
        $products = User::findOrFail($id)->productId;

        return view('buyer.show', ['user' => $user, 'products' => $products]);
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

    public function verivikasiPassword(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $products = User::findOrFail($id)->productId;

        // if($user){
        //     // jika hasil hash dari password yang diinput user sama dengan password di database user maka
        //     if ($request->get('enkripsi') == $user->enkripsi) {
        //         // generate token
        //         $user->generateToken();
        //         return view('buyer.show', ['user' => $user, 'products' => $products]);
        //     }
        //     else{
        //         return redirect()->route('manage-product.index')->with('status', 'Password Salah!!');
        //     }
        // }
        // else{
        //     return redirect()->route('manage-product.index')->with('status', 'Password Salah!!');
        // }

        $verivikasi = $request->get('enkripsi');
        if($verivikasi){
            if($verivikasi == $user->enkripsi){
                $user->generateToken();
                return view('buyer.show', ['user' => $user, 'products' => $products]);
            }else{
                return redirect()->route('manage-product.index')->with('status', 'Password Salah!!');
            }
        }
    }
}
