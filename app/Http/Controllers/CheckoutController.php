<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CheckoutController extends Controller
{
    public function index()
    {
        $access_token = $this->generateAccessToken();
        $session_token = $this->generateSessionToken($access_token);
        // dump($access_token);
        // dump($session_token);
        // dd(["JD ACCESS_TOKEN:" => $access_token,"SESSION TOKEN:"=>$session_token]);
        return view('checkout.index', compact('session_token'));
    }
    public function generateAccessToken()
    {
        $url_api = config('services.niubiz.url_api') . '/api.security/v1/security';
        $user = config('services.niubiz.user');
        $password = config('services.niubiz.password');
        $auth = base64_encode($user . ':' . $password);
        return Http::withHeaders(['Authorization' => 'Basic ' . $auth])->get($url_api)->body();
        return $url_api;
    }
    public function generateSessionToken($access_token)
    {
        $merchant_id = config('services.niubiz.merchant_id');
        $url_api = config('services.niubiz.url_api') . "/api.ecommerce/v2/ecommerce/token/session/{$merchant_id} ";
        $response = Http::withHeaders([
            'Authorization' => $access_token,
            'Content-Type' => 'application/json'
        ])->post($url_api, [
            'channel' => 'web',
            'amount' => floatval(str_replace('.', '', Cart::instance('shopping')->subtotal())), // cambio de , a . y ya no genera error
            'antifraud' => [
                'clientIp' => request()->ip(),
                'merchantDefineData' => [
                    'MDD4' => 'integraciones@niubiz.com.pe',
                    'MDD32' => 'JD1892639123',
                    'MDD75' => 'Registrado',
                    'MDD77' => 458
                ]
            ],
        ])->json();
        // dd($response);
        return $response['sessionKey'];
    }
    public function paid(Request $request)
    {
        $access_token = $this->generateAccessToken();
        $merchant_id = config('services.niubiz.merchant_id');

        $url_api = config('services.niubiz.url_api') . "/api.ecommerce/v2/ecommerce/token/session/{$merchant_id}";
        Http::withHeaders(['Authorization' => $access_token, 'Content-Type' => 'application/json'])
            ->post($url_api, [
                "chanel" => "web",
                "capture_type" => "manual",
                "contable" => true,
                "order" => [
                    "tokenId" => $request->transactionToken,
                    "purchaseNumber" => $request->purchasenumber,
                    "amount" => $request->amount,
                    "currency" =>"PEN",
                    // "currency" => $request->currency,
                ]
            ])->json();
        // return $request->all();
    }
}
