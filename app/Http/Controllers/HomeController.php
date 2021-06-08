<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::paginate(50)->where('status', 'publish');
        
        return view('welcome', ['products' => $products]);
    }
    
    public function customer(Request $request)
    {
        $products = Product::paginate(50)->where('status', 'publish');
        $keywoard = $request->get('keywoard');
        if ($keywoard) {
            $products = Product::where('nama_product', 'LIKE', "%$keywoard%")->paginate(30);
        }

        return view('customer.index', ['products' => $products]);
    }

    public function apiIot(Request $request)
    {
        $api_key = $request->get('token');
        $field = $request->get('field');

        if ($api_key) {
            $api_key_user = User::where('enkripsi_token', $api_key);
            
        }
    }
}
