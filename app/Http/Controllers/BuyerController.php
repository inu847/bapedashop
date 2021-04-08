<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class BuyerController extends Controller
{
    public function rating(Request $request, $id)
    {
        $rating = User::findOrFail($id);
        $rating->nama_product = $request->get('rating');
        $rating->nama_product = $request->get('suggestion');
        $rating->rating()->save($rating);
        return redirect()->view('welcome')->with('status', 'Thanks To Order!!');
    }
}
