<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        
        return view('tools.index', ['roles' => $roles]);
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
        //
    }

    public function member()
    {
        $member = \Auth::user()->roles;
        if($member->role == 'member'){
            return view('tools.member');
        }elseif($member->role == 'super member'){
            return view('tools.superMember');
        }else{
            return redirect()->back();
        } 
    }

    public function superMember()
    {
        $member = \Auth::user()->roles;
        if($member->role == 'super member'){
            return view('tools.superMember');
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
}
