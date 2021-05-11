<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Customer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.customer');
    }

    public function login(Request $request)
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
            dd("GAGAL");
        }
    }
    
    public function register(Request $request)
    {
        
    }

    public function logout()
    {
        $user = Auth::guard('customer');
        $user->logout();

        return redirect()->route('customer.index');
    }
}
