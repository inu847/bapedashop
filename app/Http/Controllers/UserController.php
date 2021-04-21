<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Buyer;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\User as UserResource;
use App\Models\Alamat;
use App\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {        
        $user = User::where('status', 'active')->paginate(10);

        $filterKeyword = $request->get('keyword');
        if($filterKeyword){
            $user = User::where('nama_toko', 'LIKE', "%$filterKeyword%")->paginate(10);
        }
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
        $user = User::findOrFail($id);

        return view('seller.setting', ['user' => $user]);
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
        $user = User::findOrFail($id);

        $user->name = $request->get('name');

        if($request->file('profil')){
            if($user->profil && file_exists(storage_path('app/public/' . $user->profil))){
                \Storage::delete('public/'.$user->profil);
                $file = $request->file('profil')->store('profiles', 'public');
                $user->profil = $file;
            }else{
                if($request->file('profil')){
                    $file = $request->file('profil')->store('profiles', 'public');
                    $user->profil = $file;
                }
            }
        }

        $user->tanggal_lahir = $request->get('tanggal_lahir');

        $user->save();
        return redirect()->back()->with('status', 'Update Product Success!!');
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
        $new_buyer = new Buyer;

        $buyer = $request->get('buyer');
        $_token = $request->get('_token');
        $verivikasi = $request->get('enkripsi');
        if($verivikasi == $user->enkripsi){
            $user->generateToken();
            $new_buyer->buyer = $buyer;
            $user->buyer()->save($new_buyer);
            return view('buyer.show', ['user' => $user, 'products' => $products, 'verivikasi' => $verivikasi, 'new_buyer' => $new_buyer, '_token' => $_token]);
        }else{
            return redirect()->route('user.index')->with('status', 'Password Salah!!');
        }
    }

    public function showAlamat()
    {
        $alamats = \Auth::user()->alamatId->sortByDesc('status');
        $alamat_utama = \Auth::user()->alamatId->where('status', 'alamat_utama')->count();
        $alamat_toko = \Auth::user()->alamatId->where('status', 'alamat_toko')->count();
        $alamat_pengembalian = \Auth::user()->alamatId->where('status', 'alamat_pengembalian')->count();
        
        return view('seller.alamat', ['alamats' => $alamats, 'alamat_utama' => $alamat_utama, 'alamat_toko' => $alamat_toko, 'alamat_pengembalian' => $alamat_pengembalian]);
    }
    
    public function alamat(Request $request)
    {
        \Validator::make($request->all(), [
            'provinsi' => 'required', 'string', 'min:3', 'max:50',
            'kabupaten' => 'required', 'string', 'min:3', 'max:50',
            'desa' => 'required', 'string', 'min:3', 'max:50',
            'kecamatan' => 'required', 'string', 'min:3', 'max:50',
            'rt' => 'required', 'string', 'min:1', 'max:5',
            'rw' => 'required', 'string', 'min:1', 'max:5',
            'kode_pos' => 'required', 'string', 'min:2', 'max:25',
            'alamat' => 'required', 'string', 'min:8',
            'status' => 'required'
        ])->validate();
        
        $user = \Auth::user();
        $alamat = new Alamat();
        $alamat->provinsi = $request->get('provinsi');
        $alamat->kabupaten = $request->get('kabupaten');
        $alamat->desa = $request->get('desa');
        $alamat->kecamatan = $request->get('kecamatan');
        $alamat->rt = $request->get('rt');
        $alamat->rw = $request->get('rw');
        $alamat->kode_pos = $request->get('kode_pos');
        $alamat->alamat = $request->get('alamat');
        $alamat->status = $request->get('status');
        $user->alamatId()->save($alamat);
        return redirect()->back()->with('status', 'Add new alamat success!!!');
    }

    public function hapusAlamat($id)
    {
        $alamat = Alamat::findOrFail($id);

        $alamat->delete();
        return redirect()->back()->with('status', 'Delete Alamat Success!!');
    }

    // Api
    public function getToko(Request $request)
    {
        $user = new UserResource(User::get());
        $filterKeyword = $request->get('keyword');
        $status = $request->get('status');
        $user = User::where('nama_toko', 'LIKE', "%$filterKeyword%")->paginate(10);
        return $user;
    }
}
