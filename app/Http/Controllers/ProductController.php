<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use Excel;
use App\Imports\ProductImport;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){

        $this->middleware('auth');

        // $this->middleware(function($request, $next){

        // if(Gate::allows('manage-order')) return $next($request);
        //     abort(403, 'Anda tidak memiliki cukup hak akses');
        // });
    }

    public function index(Request $request)
    {
        $products = \Auth::user()->productId;
        $keywoard = $request->get('keywoard');
        if($keywoard) {
            $products = Product::where('nama_product', 'LIKE', "%$keywoard%")->paginate(10);
        }
        return view('seller.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = \Auth::user()->roles;
        $product = \Auth::user()->productId->count();
        if(\Auth::user()->status == 'inactive'){
            return redirect()->back()->with('statusdel', 'Akun Anda Sedang Dalam Tahap Pemeriksaan!!');
        }else if(\Auth::user()->status == 'active'){
            if($roles->role == 'trial'){
                if ($product <= 20) {
                    return view('seller.create');
                }else{
                    return view('tools.index', ['roles' => $roles]);
                }
            }else if($roles->role == 'member'){
                if ($product <= 40) {
                    return view('seller.create');
                }else{
                    return view('tools.index', ['roles' => $roles]);
                }
            }else if($roles->role == 'super member'){
                if ($product <= 200) {
                    return view('seller.create');
                }else{
                    return view('tools.index', ['roles' => $roles]);
                }
            }
        } 
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
            'nama_product' => 'required', 'string', 'max:255', 'min:2',
            'deskripsi' => 'required', 'string', 'max:255', 'min:8',
            'stok' => 'required', 'max:1000',
            'images' => 'file|image|mimes:jpeg,png,jpg',
            'price' => 'required', 'max:20',
        ])->validate();
        
        $new_product = new Product();
        $new_product->nama_product = $request->get('nama_product');
        $new_product->deskripsi = $request->get('deskripsi');
        $new_product->stok = $request->get('stok');
        if($request->file('images')){
            $file = $request->file('images')->store('product_images', 'public');
            $new_product->images = $file;
        }
        $new_product->price = $request->get('price');
        $new_product->status = "publish";
        \Auth::user()->productId()->save($new_product);
        return redirect()->route('manage-product.index')->with('status', 'Create Product Success!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('seller.show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('seller.edit', ['product' => $product]);
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
        
        if($request->get('status')){
            $edit_product->status = $request->get('status');
        }else{
            $edit_product->status = "publish";
        }

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
        $delete_product = Product::findOrFail($id);

        $delete_product->delete();
        return redirect()->route('manage-product.index')->with('statusdel', 'Data Berhasil Dihapus!!');
    }


    public function botMigrasiUpload(Request $request)
    {
        // $user = User::findOrFail($request->get('user_id'));
        $new_product = new Product();
        $new_product->nama_product = $request->get('nama_product');
        $new_product->deskripsi = $request->get('deskripsi');
        $new_product->stok = $request->get('stok');
        $new_product->images = $request->get('images');
        $new_product->price = $request->get('price');
        $new_product->status = "publish";
        \Auth::user()->productId()->save($new_product);
        // return redirect()->route('manage-product.index');
    }
    
    public function importform()
    {
        return view('seller.import');
    }

    public function importProduct(Request $request)
    {
        Excel::import(new ProductImport, $request->file('files'));

        return "import success";
    }
}
