<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Buyer;
use Illuminate\Support\Facades\Hash;
use App\Models\Alamat;
use App\Models\ChatSeller;
use App\Models\City;
use App\Models\Province;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 
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

        if ($request->file('profil')) {
            if ($user->profil && file_exists(storage_path('app/public/' . $user->profil))) {
                \Storage::delete('public/' . $user->profil);
                $file = $request->file('profil')->store('profiles', 'public');
                $user->profil = $file;
            } else {
                if ($request->file('profil')) {
                    $file = $request->file('profil')->store('profiles', 'public');
                    $user->profil = $file;
                }
            }
        }

        $user->tanggal_lahir = $request->get('tanggal_lahir');

        $user->save();
        return redirect()->back()->with('status', 'Update Account Success!!');
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

    public function showAlamat()
    {
        $alamats = \Auth::user()->alamatId->sortByDesc('status');
        $alamat_utama = \Auth::user()->alamatId->where('status', 'alamat_utama')->count();
        $alamat_toko = \Auth::user()->alamatId->where('status', 'alamat_toko')->count();
        $alamat_pengembalian = \Auth::user()->alamatId->where('status', 'alamat_pengembalian')->count();
        $provinces = Province::get();
        return view('seller.alamat', ['alamats' => $alamats, 'alamat_utama' => $alamat_utama, 'alamat_toko' => $alamat_toko, 'alamat_pengembalian' => $alamat_pengembalian, 'provinces' => $provinces]);
    }

    public function alamat(Request $request)
    {
        \Validator::make($request->all(), [
            'provinsi' => 'required',
            'kabupaten' => 'required',
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
        $alamat->province_id = $request->get('provinsi');
        $alamat->city_id = $request->get('kabupaten');
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

    public function getkabupaten(Request $request)
    {
        $id = $request->post('idprov');
        $city = City::where('province_id', '=', $id)->get();
        $msg = "";
        $msg = "200OK";
        $output = array(
            'message' => $msg,
            'data' => $city
        );
        return  $output;
    }

    public function chat(Request $request)
    {
        $get_ids = ChatSeller::select('admin_id')->groupBy('admin_id')->where('user_id', \Auth::user()->id)->get();
        
        $messages = array();
        foreach($get_ids as $get_id){
            $messages[] = ChatSeller::latest()->where('admin_id', $get_id->admin_id)->where('user_id', \Auth::user()->id)->first();
        }
        
        $chat_id = $request->get('message_id');
        if ($chat_id) {
            $chats = \Auth::user()->chat->where('admin_id', $chat_id);
            return $chats;
        }
        return view('seller.chat', ['messages' => $messages]);
    }

    public function postChatSeller(Request $request)
    {
        $seller = new ChatSeller();
        $seller->message_seller = $request->get('message');
        $seller->user_id = \Auth::user()->id;
        $seller->admin_id = $request->get('admin_id');
        $seller->save();
        $output = array(
            'message' => $seller->message_seller,
            'seller_id' => $seller->seller_id,
            'timestamp' => $seller->created_at->format('H:i'),
        );

        return $output;
    }
}
