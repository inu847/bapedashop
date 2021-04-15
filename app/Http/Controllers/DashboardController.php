<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(){

        $this->middleware('auth');

        // $this->middleware(function($request, $next){

        // if(Gate::allows('manage-order')) return $next($request);
        //     abort(403, 'Anda tidak memiliki cukup hak akses');
        // });
    }

    public function index()
    {
        return view('dashboard.index');
    }
}
