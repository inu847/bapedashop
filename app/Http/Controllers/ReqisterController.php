<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class ReqisterController extends Controller
{
    public function formRegisterUser()
    {
        return view('auth.registerUser');
    }

    public function registerUser(Request $request)
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
        $new_user->password = \Hash::make($request->get('password'));
        $new_user->save();

        $new_roles = new Role();
        if($request->file('file_penunjang')){
            $file = $request->file('file_penunjang')->store('file_penunjangs', 'public');
            $new_roles->file_penunjang = $file;
        }
        if($request->file('ktp')){
            $file = $request->file('ktp')->store('ktps', 'public');
            $new_roles->ktp = $file;
        }
        
        $new_roles->role = "trial";
        $new_user->roles()->save($new_roles);
        
        return redirect()->route('login')->with('status', 'Create Akun Success!! Prosess memakan waktu paling lama 2x24, cek secara berkala email kamu!');
    }

    public function formRegisterCustomer()
    {
        return view('auth.reigisterCustomer');
    }

    public function registerCustomer(Request $request)
    {
        
    }
}
