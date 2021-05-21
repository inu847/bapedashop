<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LinkGrabCurlController extends Controller
{
    // Detail Product
    // https://shopee.co.id/api/v2/item/get?itemid=1170373182&shopid=33276518
    public function grabbingProduct(Request $request)
    {
        $page = $request->get('page');
        $UsernameShopee = $request->get('username');
        
        if ($UsernameShopee) {
            $user = h_apiShopeeUser($UsernameShopee)->data; // get Shop Detail
            if ($user) {
                $userId = $user->shopid;
                $url = 'https://shopee.co.id/api/v4/search/search_items?by=pop&limit=30&match_id=' . $userId . '&newest=' . $page . '&order=desc&page_type=shop&scenario=PAGE_OTHERS&version=2';
                $hasilcurl = h_apiShopee($url);
                $loop = $hasilcurl;
                $data = array();

                foreach ($loop->items as $i => $v) {
                    $data[] = $v->item_basic;
                }

                return view('grab', ["hasil" =>  $data, 'userId' => $userId]);
            }else{
                return view('grab');
            }
        }else{
            return view('grab');
        }
    }
}
