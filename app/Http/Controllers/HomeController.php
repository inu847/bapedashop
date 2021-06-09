<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Role;

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

    // API IOT
    public function apiKey(Request $request)
    {
        $api_key = $request->get('api_key');
        $field = "field".$request->get('field');
        $tools = Role::where('api_key', $api_key)->first();
        return $tools->$field;
    }

    public function updateIot(Request $request)
    {
        $api_key = $request->get('api_key');
        $update_field = Role::where('api_key', $api_key)->first();
        $field = $request->get('field');
        $value = $request->get('value');
        if ($field) {
            $update_field->$field = $value;
        }
        $update_field->save();

        $output = array(
            'status' => 1,
            'message' => "success updated ".$field." => ".$value,
        );
        return $output;
    }
}
