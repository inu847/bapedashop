<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LinkGrabCurlController extends Controller
{

    public function grabbingProduct(Request $request, $referer = "http://www.google.com/")
    {
        $url = $request->get('url');
        $ua = ['Mozilla/5.0 (Linux; Android 11) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Mobile Safari/537.36', 'Mozilla/5.0 (Linux; Android 11; SM-A205U) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Mobile Safari/537.36', 'Mozilla/5.0 (Linux; Android 11; SM-A102U) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Mobile Safari/537.36', 'Mozilla/5.0 (Linux; Android 11; SM-G960U) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Mobile Safari/537.36', 'Mozilla/5.0 (Linux; Android 11; SM-N960U) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Mobile Safari/537.36', 'Mozilla/5.0 (Linux; Android 11; LM-Q720) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Mobile Safari/537.36', 'Mozilla/5.0 (Linux; Android 11; LM-X420) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Mobile Safari/537.36', 'Mozilla/5.0 (Linux; Android 11; LM-Q710(FGN)) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Mobile Safari/537.36'];
        shuffle($ua);
        $ua = $ua[0];
        $url = "https://images1-focus-opensocial.googleusercontent.com/gadgets/proxy?container=focus&refresh=3600&url=" . urlencode($url);
        $data = curl_init();
        $header[0] = "Accept: text/xml,application/xml,application/xhtml+xml,";
        $header[0] .= "text/html;q=0.9,text/plain;q=0.8,image/png,/;q=0.5";
        $header[] = "Cache-Control: max-age=0";
        $header[] = "Connection: keep-alive";
        $header[] = "Keep-Alive: 300";
        $header[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
        $header[] = "Accept-Language: en-us,en;q=0.5";
        $header[] = "Pragma: ";
        curl_setopt($data, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($data, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($data, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($data, CURLOPT_URL, $url);
        curl_setopt($data, CURLOPT_USERAGENT, $ua);
        curl_setopt($data, CURLOPT_HTTPHEADER, $header);
        curl_setopt($data, CURLOPT_REFERER, $referer);
        curl_setopt($data, CURLOPT_ENCODING, "gzip,deflate");
        curl_setopt($data, CURLOPT_AUTOREFERER, true);
        curl_setopt($data, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($data, CURLOPT_CONNECTTIMEOUT, 60);
        curl_setopt($data, CURLOPT_TIMEOUT, 60);
        curl_setopt($data, CURLOPT_MAXREDIRS, 7);
        curl_setopt($data, CURLOPT_FOLLOWLOCATION, true);
        $hasil = curl_exec($data);
        curl_close($data);
        return $hasil;
    }

    // Detail Product
    // https://shopee.co.id/api/v2/item/get?itemid=1170373182&shopid=33276518
    public function grabbingProduct2(Request $request)
    {
        $page = $request->get('page');
        $UsernameShopee = $request->get('username');
        if ($page && $UsernameShopee) {
            $user = h_apiShopeeUser($UsernameShopee)->data; // get Shop Detail
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
    }
}