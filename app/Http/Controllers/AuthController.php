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
        if(\Auth::guard('customer')->check() == true){
            return redirect()->route('customer.index');
        }else{
            return view('auth.customer');
        }
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
            if(Auth::guard('customer')->user()->status == 'active'){
                return redirect()->route('customer.index');
            }else{
                $user = Auth::guard('customer');
                $user->logout();

                return redirect()->route('login_customer')->with('status', 'Akun Anda Dinonaktikan');
            }
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
        if(\Auth::guard('admin')->check() == true){
            return redirect()->route('admin.index');
        }else{
            return view('admin.login');
        }
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
            if(Auth::guard('admin')->user()->status == 'active'){
                return redirect()->route('admin.index');
            }else{
                $user = Auth::guard('admin');
                $user->logout();

                return redirect()->route('login_admin')->with('status', 'Akun Anda Dinonaktikan');
            }
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
