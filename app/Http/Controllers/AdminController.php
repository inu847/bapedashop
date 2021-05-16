<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Keranjang;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(\Auth::guard('admin')->user());
        $orders = Keranjang::where('status')->paginate(30);
        
        return view('admin.index', ['orders' => $orders]);
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

    // Custom
    public function userSeller()
    {
        $sellers = User::get()->where('status', 'inactive');
        // dd($sellers);
        return view('admin.seller', ['sellers' => $sellers]);
    }

    public function setujuiAkunSeller($id)
    {
        $verivikasi = User::findOrFail($id);
        $verivikasi->status = "active";
        $verivikasi->save();

        return redirect()->back()->with('status', "Akun ".$verivikasi->name." Berhasil Diaktifkan!!");
    }

    public function userCustomer()
    {
        $customers = Customer::get()->where('status', 'inactive');

        return view('admin.customer', ['customers' => $customers]);
    }

    public function setujuiAkunCustomer($id)
    {
        $verivikasi = Customer::findOrFail($id);
        $verivikasi->status = "active";
        $verivikasi->save();

        return redirect()->back()->with('status', "Akun ".$verivikasi->name." Berhasil Diaktifkan!!");
    }

    public function userAdmin()
    {
        $admins = Admin::get();
        // dd($admins);
        return view('admin.admin', ['admins' => $admins]);
    }

    public function formRegistrasi()
    {
        return view("admin.registrasi");
    }

    public function registrasi(Request $request)
    {
        $new_admin = new Admin;
        // $new_admin->name = $request->get('first_name') ." ". $request->get('last_name');
        $new_admin->name = $request->get('name');
        $new_admin->email = $request->get('email');
        $new_admin->phone = $request->get('phone');
        $new_admin->status = "active";
        $new_admin->password = \Hash::make($request->get('password'));
        $new_admin->save();

        return redirect()->route('admin.admin')->with('status', 'Registrasi Berhasil');
    }
}
