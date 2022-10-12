<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GruppTerminalController extends Controller
{

    function sessionid(){

        $payload = '{
            "serialNumber": "63201125995137",
    "stan": "123456",
    "onlyAccountInfo": false
}';

        echo "=====BASE URL=====";
        echo env('GRUPPTERMINAL_BASEURL'). '/resd/network-mgt';
        echo "=====Payload=====";
        echo $payload;

        echo "=====Response=====";


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('GRUPPTERMINAL_BASEURL'). '/resd/network-mgt',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $payload,
            CURLOPT_SSL_VERIFYPEER =>false,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic '.base64_encode(env('GRUPPTERMINAL_USERNAME'). ":".env('GRUPPTERMINAL_PASSWORD')),
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $resp=json_decode($response, true);

        dd($response);

    }


    function transaction(){

        echo "=====BASE URL=====";
        echo env('GRUPPTERMINAL_BASEURL'). '/resd/network-mgt';

        echo "=====Response=====";


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('GRUPPTERMINAL_BASEURL'). '/resd/wallet',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_SSL_VERIFYPEER =>false,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic '.base64_encode(env('GRUPPTERMINAL_USERNAME'). ":".env('GRUPPTERMINAL_PASSWORD')),
                'Content-Type: application/json',
                'terminalId: 2033HQOQ'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $resp=json_decode($response, true);

        dd($response);

        echo $response;

//        dd($resp['data']);

        dd($this->decrypt($resp['data']));


    }

    function login(){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('GRUPPTERMINAL_SAMJI_BASEURL').'grupp-login',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
    "serialNumber": "63201125995137",
    "stan": "123456",
    "onlyAccountInfo": false
}',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic cmVzdGRldmljZTo1TkRNMU5qY2tKVjRLSw==',
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response, true);
    }

    function encrypt($input)
    {
        $key = env('FLUTTERWAVE_ENCRYPTION_KEY');
        return base64_encode(openssl_encrypt($input, 'DES-EDE3', $key, OPENSSL_RAW_DATA));
    }

    function decrypt($input)
    {
        $key = '2033HQOQ-871d8068-6b9e-47e8-b2cb-36ccfa933673';
        return openssl_decrypt(base64_decode($input), 'DES-EDE3', md5($key), OPENSSL_RAW_DATA);
    }

}
