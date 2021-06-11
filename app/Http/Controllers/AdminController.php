<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Keranjang;
use App\Models\User;
use App\Models\Customer;
use App\Models\ChatSeller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('admin');
    }

    public function index()
    {
        // dd(\Auth::guard('admin')->user());
        $orders = Keranjang::where('status')->paginate(30);
        
        return view('admin.index', ['orders' => $orders]);
    }

    // Custom
    public function userSeller()
    {
        $sellers = User::get()->where('status', 'inactive');
        // dd($sellers);
        return view('admin.seller', ['sellers' => $sellers]);
    }

    public function setujuiAkunSeller($id)
    {
        $verivikasi = User::findOrFail($id);
        $verivikasi->status = "active";
        $verivikasi->save();

        return redirect()->back()->with('status', "Akun ".$verivikasi->name." Berhasil Diaktifkan!!");
    }

    public function userCustomer()
    {
        $customers = Customer::get()->where('status', 'inactive');

        return view('admin.customer', ['customers' => $customers]);
    }

    public function setujuiAkunCustomer($id)
    {
        $verivikasi = Customer::findOrFail($id);
        $verivikasi->status = "active";
        $verivikasi->save();

        return redirect()->back()->with('status', "Akun ".$verivikasi->name." Berhasil Diaktifkan!!");
    }

    public function userAdmin()
    {
        $admins = Admin::get();
        // dd($admins);
        return view('admin.admin', ['admins' => $admins]);
    }

    public function formRegistrasi()
    {
        return view("admin.registrasi");
    }

    public function registrasi(Request $request)
    {
        $new_admin = new Admin;
        // $new_admin->name = $request->get('first_name') ." ". $request->get('last_name');
        $new_admin->name = $request->get('name');
        $new_admin->email = $request->get('email');
        $new_admin->phone = $request->get('phone');
        $new_admin->status = "active";
        $new_admin->password = \Hash::make($request->get('password'));
        $new_admin->save();

        return redirect()->route('admin.admin')->with('status', 'Registrasi Berhasil');
    }
    
    public function chat()
    {
        $get_ids = ChatSeller::select('user_id')->groupBy('user_id')->where('admin_id', \Auth::guard('admin')->user()->id)->get();
        // dd($get_ids);
        $chats = array();
        foreach($get_ids as $get_id){
            $chats[] = ChatSeller::latest()->where('admin_id', \Auth::guard('admin')->user()->id)->where('user_id', $get_id->user_id)->first();
        }

        // dd($chats);
        return view('admin.chat', ['chats' => $chats]);
    }

    public function showChat(Request $request)
    {
        $chats = ChatSeller::where('user_id', $request->get('user_id'))->get();
        
        return view('admin.chatshow', ['chats' => $chats]);
    }

    public function postChatAdmin(Request $request)
    {
        $seller = new ChatSeller();
        $seller->message_admin = $request->get('message');
        $seller->user_id = $request->get('seller_id');
        $seller->admin_id = \Auth::guard('admin')->user()->id;
        $seller->save();
        $output = array(
            'message' => $seller->message_admin,
            'seller_id' => $seller->admin_id,
            'timestamp' => $seller->created_at->diffForHumans(),
        );

        return $output;
    }
}
