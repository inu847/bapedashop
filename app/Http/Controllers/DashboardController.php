<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buyer;
use App\Models\Order;
use App\Models\Suggestion;

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
        $total_penjualan = \Auth::user()->buyer->where('status', 'success')->sum('subtotal');
        $total_order = \Auth::user()->buyer->where('status')->count();
        $order_pending = \Auth::user()->buyer->where('status', 'process')->count();
        $order_success = \Auth::user()->buyer->where('status', 'success')->count();
        $order_onhold = \Auth::user()->buyer->where('status', 'on hold')->count();
        $recent_order = \Auth::user()->buyer->where('status');
        // Rating Toko
        $banyak_rating = \Auth::user()->suggestion->count('rating');
        $jumlah_rating = \Auth::user()->suggestion->sum('rating');
        if($banyak_rating && $jumlah_rating){
            $total_rating = $jumlah_rating / $banyak_rating;
            $pembulatan_rating = round($total_rating);
        }else{
            $total_rating = 0;
            $pembulatan_rating = 0;
        }
        $suggestion = \Auth::user()->suggestion->where('suggestion')->count();
        // Quantity Order
        $progress_order = $order_pending + $order_onhold;
        $all_order = $order_pending + $order_success + $order_onhold;
        $results_order = $all_order - $progress_order;
        
        return view('dashboard.index', ['total_penjualan' => $total_penjualan,
                                        'total_order' => $total_order,
                                        'order_pending' => $order_pending,
                                        'order_success' => $order_success,
                                        'order_onhold' => $order_onhold,
                                        'recent_order' => $recent_order,
                                        'total_rating' => $total_rating,
                                        'pembulatan_rating' => $pembulatan_rating,
                                        'progress_order' => $progress_order,
                                        'all_order' => $all_order,
                                        'results_order' => $results_order,
                                        'suggestion' => $suggestion]);
    }
}
