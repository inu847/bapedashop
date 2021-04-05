<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProductController extends Controller
{
    public function index()
    {
        $product = User::find(1)->productId;
        return $product;
    }
}
