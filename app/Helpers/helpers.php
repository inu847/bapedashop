<?php

use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Buyer;
use App\Models\Alamat;
use App\Models\City;
use App\Models\Product;

function orderId()
{
    $order = Order::get();
    return $order;
}

function qrcode($enkripsi)
{
    $buyer = Buyer::get()->where('enkripsi_token', $enkripsi)->first();
    return $buyer;
}

function alamatJob($id)
{
    $job = Alamat::findOrFail($id);
    return $job;
}

function h_apiShopeeUser($UsernameShopee)
{
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://shopee.co.id/api/v4/shop/get_shop_detail?username=' . $UsernameShopee,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
    ));
    $response = curl_exec($curl);
    curl_close($curl);

    return json_decode($response);
}

function h_apiShopee($url, $referer = "http://www.google.com/")
{
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

    return json_decode($hasil);
}

function detailProduct($itemId, $userId)
{
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://shopee.co.id/api/v2/item/get?itemid='.$itemId.'&shopid='.$userId,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    return json_decode($response);
}

function getProductDetail($userId, $itemId)
{
    $url = 'https://shopee.co.id/api/v2/item/get?itemid='.$itemId.'&shopid='.$userId;
    $hasilcurl = h_apiShopee($url);
    $loop = $hasilcurl;
    $results = array();
    // dd($loop->item);
    $results[] = $loop->item;
    return $results;
}

function keranjangCustomer()
{
    $keranjang = \Auth::guard('customer')->user()->keranjang->where('status', null)->count();

    return $keranjang;
}

function productImages($product)
{
    $img =  explode("/", $product);
    if($img[0] == "product_images"){
        $images = asset('storage/'. $product);
    }else{
        $images = 'https://cf.shopee.co.id/file/'. $product;
    }
    return $images;
}

function keranjang($id)
{
    $carts = Product::find($id);

    return $carts;
}

function province($id)
{
    $province = App\Models\Province::find($id)->province;
    return $province;
}

function city($id)
{
    $type = City::find($id)->type;
    $cities = City::find($id)->city;
    $city = $type . " " . $cities;
    return $city;
}