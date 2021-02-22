<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Braintree\Gateway as Gateway;
use App\Info;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PayController extends Controller
{
    public function pay(Request $request) {
        dd($request->all());
        $gateway = new Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);

        $nonceFromTheClient = $request->payment_method_nonce;
        $amount = (float)$request->amount;
        $id = (int)$request->info_id;
        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonceFromTheClient,
            'options' => [
                'submitForSettlement' => true
                ]
                ]);

        //TODO Da sistemare il many to many dello sponsor
        // if ($result){
            
        //     $info = Info::find($id);
        //     // dd($info);
        //     $info->sponsors()->attach($amount);
        // }
        return response()->json($result);
    }
}
