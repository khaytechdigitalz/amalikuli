<?php

namespace App\Http\Controllers;

use App\Models\bill_payment;
use App\Models\Transaction;
use App\Models\transfer;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
//        echo env('VFD_URL').'vfd-wallet/1.1/wallet2/bank';
//        return $response;
        $rep = json_decode($response, true);

        $rep1=$rep['data']['bank'];
//return $rep1;
        return view('transfer', compact( 'rep1'));

    }

    public function validateBankAccount(Request  $request){
//return $request;
//        $bankCode=$request->bankcode;
//        $accountNumber=$request->number;

        $bankCode="999058";
        $accountNumber="0001744830";

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
//        echo  env('VFD_URL').'vfd-wallet/1.1/wallet2/transfer/recipient?transfer_type=inter&accountNo='.$accountNumber.'&bank='.$bankCode.'&wallet-credentials='.env('VFD_AUTH');
//        return $response;

        $rep = json_decode($response, true);
        $bvn=$rep['data']['bvn'];
        $idc=$rep['data']['account']['id'];
        $rep1=$rep['data']['name'];
        return view('verify', compact( 'rep1', 'request', 'bvn', 'idc'));

    }

    public function accountEnquiry(Request  $request){
//return $request;
//        $bankCode=$request->bankcode;
//        $accountNumber=$request->number;

        $bankCode="999058";
        $accountNumber="0001744830";

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

    public function accountTransfer12(Request  $request){
//return $request;
//        $bankCode=$request->bankcode;
//        $accountNumber=$request->number;
//        $accountBVN=$request->accountbvn;
//        $accountName=$request->accountname;
//        $amount=$request->amount;
//        $narration=$request->narration;
//        $sessionID=$request->sessionID;

        //for test
        $bankCode="999058";
        $accountNumber="0001744830";
        $accountBVN="22222222223";
        $accountName="OGBA, CHRISTOPHER CHINONYE";
        $amount="100";
        $narration="test trf";
        $sessionID="999116190411110815131298994293";


        $auth=$this->auth_init();
        $token=$auth['access_token'];

        $fromAccount=env("VFD_TRANSFER_ACCOUNTNO");
        $reference=env('VFD_TRANSFER_CLIENT')."-".uniqid();

        $signature=hash('sha512', $fromAccount.$accountNumber);

        $payload='{
  "fromSavingsId": "'.env("VFD_TRANSFER_ACCOUNTID").'",
  "amount": "'.$amount.'",
  "toAccount": "'.$accountNumber.'",
  "fromBvn": "1000000000",
  "signature": "'.$signature.'",
  "fromAccount": "'.$fromAccount.'",
  "toBvn": "'.$accountBVN.'",
  "remark": "'.$narration.'",
  "fromClientId": "'.env("VFD_TRANSFER_CLIENTID").'",
  "fromClient": "'.env("VFD_TRANSFER_CLIENT").'",
  "toKyc": "99",
  "reference": "'.$reference.'",
  "toClientId": "",
  "toClient": "'.$accountName.'",
  "toSession": "'.$sessionID.'",
  "transferType": "inter",
  "toBank": "'.$bankCode.'",
  "toSavingsId": ""
}';

//        echo $payload;
//        return $request;
        $user = User::find($request->user()->id);
        $wallet = wallet::where('user_id', $user->id)->first();

//        $ref = Auth::id() . uniqid();
        $agentid = "plan";
        $amount = $request->amount;


        if ($amount < 100) {
            $mg = "Minimum amount is 100. Kindly increase amount and try again";
            return redirect()->route('verify')->withErrors($mg);
        }

        if ($wallet->balance < 1) {
            $mg = "Insufficient balance. Kindly topup and try again";
            return redirect()->route('verify')->withErrors($mg);
        }

        if ($amount < 1) {
            $mg = "error transaction";
            return redirect()->route('verify')->withErrors($mg);
        }

        if ($wallet->balance < $amount) {
            $mg = "You Cant Make Purchase Above" . "NGN" . $amount . " from your wallet. Your wallet balance is NGN $wallet->balance. Please Fund Wallet.";
            return redirect()->route('verify')->withErrors($mg);
        }

        $bo = transfer::where('refid', $request->refe)->first();

        if ($bo) {
            $mg = "Suspected duplicate transaction";
            return redirect()->route('verify')->withErrors($mg);
        }

        $gt = $wallet->balance - $request->amount;

        $wallet->balance = $gt;
        $wallet->save();


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('VFD_URL').'vfd-wallet/1.1/wallet2/transfer?source=pool&wallet-credentials='.env('VFD_AUTH'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $payload,
            CURLOPT_SSL_VERIFYPEER=>false,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$token,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
//        echo  env('VFD_URL').'vfd-wallet/1.1/wallet2/transfer?source=pool&wallet-credentials='.env('VFD_AUTH');
//        return $response;
        $rep = json_decode($response, true);

        $pa=$rep['data'];


        transfer::create([
            'userid' => Auth::id(),
            'bankcode' => $request->bankcode,
            'amount' => $request->amount,
            'account_no' => $request->number,
            'narration' => $request->narration,
            'refid' => $reference,
        ]);

//        Transaction::create([
//            'user_id' => Auth::id(),
//            'uuid' => Auth::user()->uuid,
//            'reference' => $request->refe,
//            'type' => 'debit',
//            'remark' => $rep['data'],
//            'amount' => $request->amount,
//            'previous' => $wallet->balance,
//            'balance' => $gt,
//        ]);
        $name = 'Transfer';
        $am = "$request->amount  Was Successful Transfer To";
        $ph = $request->number;

        return view('bills.bill', compact('user', 'name', 'am', 'ph', 'rep'));

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
