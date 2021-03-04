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
       
        $data = $request->all();

        // Check type of Sponsorship selected
        switch ($data['amount']) {
            case '2.99':
                $sponsor['sponsor_id'] = '1';
                $expire = date(('Y-m-d H:i:s'), strtotime("+1 day"));
                break;
            case '5.99':
                $sponsor['sponsor_id'] = '2';
                $expire = date(('Y-m-d H:i:s'), strtotime("+3 day"));
                break;
            case '9.99':
                $sponsor['sponsor_id'] = '3';
                $expire = date(('Y-m-d H:i:s'), strtotime("+6 day"));
                break;
        }
        
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

        if ($result){
            
            $info = Info::find($id);

            $info->sponsors()->attach($sponsor['sponsor_id'],  ['expired_at' => $expire]);
            
        }
        return redirect()->route('admin.payed');
    }
}
