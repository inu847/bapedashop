<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
           ]);
           
        $user = User::where('email', '=', $request->email)->firstOrFail();
        $status = "error";
        $message = "";
        $data = null;
        $code = 401;
        
        if($user){
            if (Hash::check($request->password, $user->password)) {
                $user->generateToken();
                $status = 'success';
                $message = 'Login sukses';
                // tampilkan data user menggunakan method toArray
                $data = $user->toArray();
                $code = 200;
            }
            else{
                $message = "Login gagal, password salah";
            }
        }
        else{
            $message = "Login gagal, username salah";
        }
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data, 
            'status_code' => $code
            ]);
    }
    
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:20',
            'address' => 'required|min:4|max:25',
            'phone' => 'required|min:8|max:15',
            'email' => 'required|min:7|max:25',
            'password' => 'required|min:8|max:20'
        ]);
        $status = "error";
        $message = "";
        $data = null;
        $code = 400;
        if ($validator->fails()) {
            $errors = $validator->errors();
            $message = $errors;
           }
           else{
                $new_user = new User;
                $new_user->name = $request->name;
                $new_user->email = $request->email;
                $new_user->password = Hash::make($request->password);
                $new_user->roles = $request->roles;
                $new_user->phone = $request->phone;
                $new_user->address = $request->address;
                
                if($new_user){
                    // Auth::login($user);
                    $new_user->generateToken();
                    $status = "success";
                    $message = "register successfully";
                    $data = $new_user->toArray();
                    $code = 200;
                }else{
                    $message = 'register failed';
                }
            }
            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' => $data
            ], $code);
    }
    public function logout(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $user->api_token = null;
            $user->save();
        }
        return response()->json([
            'status' => 'success',
            'message' => 'logout berhasil',
            'data' => null
        ], 200);
    }
}
