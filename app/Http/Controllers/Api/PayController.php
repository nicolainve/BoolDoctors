<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Braintree\Gateway as Gateway;

class PayController extends Controller
{
    public function pay(Request $request) {

        $gateway = new Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);

        $nonceFromTheClient = $request->payment_method_nonce;

        $result = $gateway->transaction()->sale([
            'amount' => '10',
            'paymentMethodNonce' => $nonceFromTheClient,
            'options' => [
              'submitForSettlement' => true
            ]
        ]);

        return response()->json($result);
    }
}
