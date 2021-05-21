<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StreamController extends Controller
{
    public function formYoutube()
    {
        return view('youtube.form');
    }

    public function idVidio(Request $request)
    {
        $link = $request->get('link');
        $resultsLink = str_replace('https://www.youtube.com/watch?v=', '', $link);
        // dd($resultsLink);
        return view('youtube.index', ['results' => $resultsLink]);
    }
}
