<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tools;
use App\Models\Role;
use Illuminate\Support\Str;

class ToolsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {

        $this->middleware('auth');

        // $this->middleware(function($request, $next){

        // if(Gate::allows('manage-order')) return $next($request);
        //     abort(403, 'Anda tidak memiliki cukup hak akses');
        // });
    }

    public function index()
    {
        $roles = \Auth::user()->roles;

        $tools = \Auth::user()->tools;
        if($tools){
            if($tools->status == "process"){
                $limit_date = $tools->finished_at;
                $date_now = date('Y-m-d m:i:s');
                
                if($date_now <= $limit_date){
                    // Menentukan Harga
                    $member = \Auth::user()->roles->where('roles', 'member');
                    $super_member = \Auth::user()->roles->where('roles', 'super member');

                    if($member){
                        $pricing = "50.000";
                    }elseif($super_member){
                        $pricing = "100.000";
                    }

                    return view('tools.pricing', ['tools' => $tools, 'pricing' => $pricing]);            
                }else{
                    if($tools->status == "process"){
                        $tools->delete();
                    }else{
                        return view('tools.index', ['roles' => $roles]);
                    }
                }
            }
        }

        return view('tools.index', ['roles' => $roles, 'tools' => $tools]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = \Auth::user();
        $alamats = \Auth::user()->alamatId->where('status', 'alamat_utama');
        $roles = $request->get('roles');
        $user_verivied = \Auth::user()->roles;
        if($user_verivied->role == $roles){
            return redirect()->back()->with('fail', 'Anda Tidak Dapat Melakukan purchase!!');
        }

        return view('tools.create', ['user' => $user, 'alamats' => $alamats, 'roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $roles = $request->get('roles');
        $user_verivied = \Auth::user()->roles;
        if($user_verivied->role == $roles){
            return redirect()->route('tools.index')->with('fail', 'Anda Tidak Dapat Melakukan purchase!!');
        }else{
            $user = \Auth::user();
            $purchase = new Tools();
            $purchase->nama_pembeli = $request->get('nama_pembeli');
            $purchase->ssid = $request->get('ssid');
            $purchase->password_wifi = $request->get('password');
            $purchase->keterangan = $request->get('keterangan');
            $purchase->alamat_id = $request->get('alamat_id');
            $purchase->status = "process";
            $purchase->roles = $request->get('roles');
            $date = date('d') + 3;
            $purchase->finished_at = date('Y-m-'.$date.' m:i:s');
            $user->tools()->save($purchase);
            return redirect()->route('tools.index')->with('success', 'Purchase success, Silahkan Melakukan Pembayaran!!');
        }
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
        //
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
        // 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pricing = Tools::findOrFail($id);

        $pricing->delete();
        return redirect()->route('tools.index');
    }

    public function member()
    {
        $member = \Auth::user()->roles;

        if($member->role == 'member' or $member->role == 'super member'){
            return view('tools.member', ['member' => $member]);
        }else{
            return redirect()->back();
        }
    }

    public function superMember()
    {
        $member = \Auth::user()->roles;

        if($member->role == 'super member'){
            return view('tools.superMember', ['member' => $member]);
        }else{
            return redirect()->back();
        }
    }

    public function actionled(Request $request)
    {
        $keys = 'RA2V0A9DIO0UPV4O';
        $data = 'api_key=' . $keys . '&' . $request->post('field') . '=' . $request->post('id');
        $url = 'https://api.thingspeak.com/update?' . $data;

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,    
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $rescurl = curl_exec($curl);
        curl_close($curl);

        $output = array(
            'status' => 1,
            'message' => $request->post('type') . ' Led Success...' . ' ==> Status ' . $rescurl
        );

        header('Content-Type:application/json');
        echo json_encode($output);
    }

    public function whatsapp()
    {
        return view('seller.whatsapp');
    }

    public function whatsappPusher(Request $request)
    {
        $json = [
        "token" => "f66ef8c2ee5b95b9d45d63e67b6492ae",
        "source" => +6283102821945,
        "destination" => +6289513873873,
        "type" => "text",
        "channel" => "whatsapp",
        "body" => [
            "text" => "Coba"
            ]
        ];

        // return json_encode($json);
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', 'http://waping.es/api/send', 
                                    ["headers" => ["Content-Type"=>"application/json"],
                                    'json'=>$json
                                    ]
                                );
        echo $response->getStatusCode();
        echo $response->getBody();
    }

    public function generateApiKey($id)
    {
        $tools = Role::findOrFail($id);
        $tools->api_key = Str::random(60);
        $tools->save();

        return redirect()->back();
    }
}
