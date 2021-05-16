<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Customer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function customer()
    {
        return view('auth.customer');
    }

    public function loginCustomer(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
           ]);
        
        $input = $request->all();
        unset($input['_token']);
        
        if (Auth::guard('customer')->attempt($input)) {
            return redirect()->route('customer.index');
        }else{
            return redirect()->back()->with('status', 'GAGAL LOGIN!!');
        }
    }

    public function logout()
    {
        $user = Auth::guard('customer');
        $user->logout();

        return redirect()->route('customer.index');
    }


    public function admin()
    {
        return view('admin.login');
    }

    public function loginAdmin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
           ]);
        
        $input = $request->all();
        unset($input['_token']);
        
        // dd($input);
        if (Auth::guard('admin')->attempt($input)) {
            return redirect()->route('admin.index');
        }else{
            return redirect()->back()->with('status', 'GAGAL LOGIN!!');
        }
    }

    public function logoutAdmin()
    {
        $user = Auth::guard('admin');
        $user->logout();

        return redirect()->route('admin.index');
    }


}
