<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VFDController extends Controller
{
    public function createWallet(){


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://devesb.vfdbank.systems:8263/vfd-wallet/1.1/wallet2/onboarding?wallet-credentials=UHpRT0FhZmhzdnV2dVRnajFzWk0xenB1OXJNYTo1d0RYR3Q4THp5blBxejZfMGVyU0ZESWkwRUlh',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
    "username": "samji",
    "walletName": "samji",
    "webhookUrl": "Inward notifications Webhook",
    "shortName": "samy",
    "implementation": "1-1"
}',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer 1ea77120-e844-3b08-9557-1693f462ba45',
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;

    }

    public function bankList(){

        $auth=$this->auth_init();
        $token=$auth['access_token'];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('VFD_URL').'vfd-wallet/1.1/wallet2/bank',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_SSL_VERIFYPEER=>false,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$token,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
//        echo $response;
        $rep = json_decode($response, true);

        $rep1=$rep['data']['bank'];
//return $rep1;
        return view('transfer', compact( 'rep1'));

    }

    public function validateBankAccount(Request  $request){
return $request;
        $bankCode=$request->bankcode;
        $accountNumber=$request->number;

        $auth=$this->auth_init();
        $token=$auth['access_token'];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('VFD_URL').'vfd-wallet/1.1/wallet2/transfer/recipient?transfer_type=inter&accountNo='.$accountNumber.'&bank='.$bankCode.'&wallet-credentials='.env('VFD_AUTH'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_SSL_VERIFYPEER=>false,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$token,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
//        echo $response;
        return $response;
    }

    public function auth_init(){

        $auth=env('VFD_AUTH');

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('VFD_URL').'token',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'grant_type=client_credentials',
            CURLOPT_SSL_VERIFYPEER=>false,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic '.$auth,
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response, true);

    }
}
