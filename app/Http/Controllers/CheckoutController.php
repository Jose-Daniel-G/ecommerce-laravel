<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use App\Models\Variant;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        Cart::instace('shopping');
        $content = Cart::content()->filter(function ($item) {
            return $item->qty <= $item->options['stock'];
        });

        $subtotal = $content->sum(function ($item) {
            return $item->subtotal;
        });

        $delivery = number_format(5, 2);
        $total = $subtotal + $delivery;
        $access_token = $this->generateAccessToken();
        $session_token = $this->generateSessionToken($access_token, $total);

        // dd(["JD ACCESS_TOKEN:" => $access_token,"SESSION TOKEN:"=>$session_token]);
        return view('checkout.index', compact('content', 'subtotal', 'delivery', 'total', 'session_token'));
    }
    public function generateAccessToken()
    {
        $url_api = config('services.niubiz.url_api') . '/api.security/v1/security';
        $user = config('services.niubiz.user');
        $password = config('services.niubiz.password');
        $auth = base64_encode($user . ':' . $password);
        return Http::withHeaders(['Authorization' => 'Basic ' . $auth])->get($url_api)->body();
    }
    public function generateSessionToken($access_token, $total)
    {
        $merchant_id = config('services.niubiz.merchant_id');
        $url_api = config('services.niubiz.url_api') . "/api.ecommerce/v2/ecommerce/token/session/{$merchant_id}";
        $response = Http::withHeaders([
            'Authorization' => $access_token,
            'Content-Type' => 'application/json'
        ])->post($url_api, [
            'channel' => 'web',
            'amount' => $total, // cambio de , a . y ya no genera error
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
        //---------------------------------
    }
    public function paid(Request $request)
    {
        $access_token = $this->generateAccessToken();
        $merchant_id = config('services.niubiz.merchant_id');
        $url_api = config('services.niubiz.url_api') . "/api.authorization/v3/authorization/ecommerce/{$merchant_id}";

        $response = Http::withHeaders(['Authorization' => $access_token, 'Content-Type' => 'application/json'])
            ->post($url_api, [
                "channel" => "web",
                "captureType" => "manual",
                "contable" => true,
                "order" => [
                    "tokenId" => $request->transactionToken,
                    "purchaseNumber" => $request->purchasenumber,
                    "amount" => $request->amount,
                    "currency" => "PEN",
                ]
            ])->json();
        //     \Log::info(['Niubiz Response: '=> $response]);
        // return $response;
        // return $request->all();
        // session()->flash('niubiz', ['response' => $response,"purchaseNumber" => $request->purchasenumber]);
        if (isset($response['dataMap']) && $response['dataMap']['ACTION_CODE'] == '000') {
            Cart::instace('shopping');
            $content = Cart::content()->filter(function ($item) {
                return $item->qty <= $item->options['stock'];
            });

            $address = Address::where('user_id', auth()->id())
                ->where('default', true)->first();

            Order::create([
                'user_id' => auth()->id(),
                'content' => $content,
                'address' => $address,
                'payment_id' => $response['dataMap']['TRANSACTION_ID'],
                'total' => $response['dataMap']['AMOUNT'],
            ]);

            foreach ($content as $item) {
                Variant::where('sku', $item->options['sku'])
                    ->decrement('stock', $item->qty);
                Cart::remove($item->rowId);
            }
            return redirect()->route('gracias');
        }
        return redirect()->route('checkout.index');
    }
}
