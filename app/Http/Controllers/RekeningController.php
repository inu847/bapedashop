<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RekeningController extends Controller
{
    public function index()
    {
        $rekening = User::find(1)->rekeningId;
        dd($rekening);
    }
}
