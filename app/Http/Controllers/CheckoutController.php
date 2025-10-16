<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Support\Facades\Http;

class CheckoutController extends Controller
{
    public function index()
    {
        $access_token = $this->generateAccessToken();
        $session_token = $this->generateSessionToken();
        // return $access_token;
        // return $session_token;
        return view('checkout.index', compact('session_token'));
    }
    public function generateAccessToken()
    {
        $url_api = config('services.niubiz.url_api') . '/api.security/v1/security';
        $user = config('services.niubiz.user');
        $password = config('services.niubiz.password');
        $auth = base64_encode($user . ':' . $password);
        return Http::withHeaders(['Authorization' => 'Basic' . $auth])->get($url_api)->body();
        return $url_api;
    }
    public function generateSessionToken($access_token)
    {
        $merchant_id = config('services.niubiz.merchant_id');
        $url_api = config('services.niubiz.url_api') . "/api.ecommerce/v2/ecommerce/token/session/{$merchant_id} ";
        $response = Http::withHeaders([
            'Authorization' => $access_token,
            'content_Type' => 'application/json'
        ])->post($url_api, [
            'channel' => 'web',
            'amount' => Cart::instanceof('shopping')->subtotal(),
              'antifraud' => [
                    'clientIp'=>request()->ip(),
                    'mechantDefineData'=>[
                        'MDD4'=>'integraciones@niubiz.com.pe',
                        'MDD32'=>'JD1892639123',
                        'MDD75'=>'Registrado',
                        'MDD77'=> 458
                    ]
                ],
        ])->json();
        // dd($response);
        return $response['sessioKey'];
    }
}
