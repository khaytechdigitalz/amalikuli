<?php

namespace App\Http\Controllers;

use App\Models\bill_payment;
use App\Models\Transaction;
use App\Models\transfer;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class VFDController extends Controller
{
    public function createWallet()
    {


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

    public function bankList()
    {

        $auth = $this->auth_init();

        $token = $auth['access_token'];

        if (env('VFD_MODE') == 0) {
            $baseurl = env('VFD_URL_TEST');
        } else {
            $baseurl = env('VFD_URL');
        }


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $baseurl . 'vtech-wallet/api/v1/wallet2/bank',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token,
                'Content-Type: application/json'
            ),
        ));

        try{
            $response = curl_exec($curl);

            curl_close($curl);
        }catch (\Exception $e){
            return redirect()->route('dashboard')->with('error', 'Currently not available');
        }
//        echo $response;
//        echo env('VFD_URL').'vfd-wallet/1.1/wallet2/bank';
//        return $response;
        $rep = json_decode($response, true);

        $rep1 = $rep['data']['bank'];
//return $rep1;
        return view('transfer', compact('rep1'));

    }

    public function validateBankAccount(Request $request)
    {

        $input = $request->all();
        Validator::make($input, [
            'bankcode' => ['required', 'string', 'max:13'],
            'number' => ['required', 'string', 'max:13']
        ])->validate();

        $bankCode = $request->bankcode;
        $accountNumber = $request->number;

        $transferType = "inter";

        if ($bankCode == "999999") {
            $transferType = "intra";
        }

        $auth = $this->auth_init();
        $token = $auth['access_token'];

        if (env('VFD_MODE') == 0) {
            $auth = env('VFD_AUTH_TEST');
            $baseurl = env('VFD_URL_TEST');
            $bankCode="999058";
            $accountNumber="0001744830";
        } else {
            $auth = env('VFD_AUTH');
            $baseurl = env('VFD_URL');
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $baseurl . 'vtech-wallet/api/v1/wallet2/transfer/recipient?transfer_type=' . $transferType . '&accountNo=' . $accountNumber . '&bank=' . $bankCode . '&wallet-credentials=' . $auth,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
//        echo $response;
//        echo  env('VFD_URL').'vfd-wallet/1.1/wallet2/transfer/recipient?transfer_type=inter&accountNo='.$accountNumber.'&bank='.$bankCode.'&wallet-credentials='.env('VFD_AUTH');
//        return $response;

        $rep = json_decode($response, true);

        if($rep['status'] != "00"){
            return redirect()->route('transfer')->with('error', $rep['message']);
        }

        $bvn = $rep['data']['bvn'];
        $idc = $rep['data']['account']['id'];
        $rep1 = $rep['data']['name'];
        $clientId = $rep['data']['clientId'] ?? "";
        return view('verify', compact('rep1', 'request', 'bvn', 'idc', 'clientId'));

    }

    public function accountEnquiry(Request $request)
    {
//return $request;
//        $bankCode=$request->bankcode;
//        $accountNumber=$request->number;

        $bankCode = "999058";
        $accountNumber = "0001744830";

        $auth = $this->auth_init();
        $token = $auth['access_token'];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('VFD_URL') . 'vtech-wallet/api/v1/wallet2/transfer/recipient?transfer_type=inter&accountNo=' . $accountNumber . '&bank=' . $bankCode . '&wallet-credentials=' . env('VFD_AUTH'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
//        echo $response;
        return $response;
    }

    public function accountTransfer12(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bankcode' => ['required', 'string', 'max:13'],
            'number' => ['required', 'string', 'max:13'],
            'accountbvn' => ['required', 'string'],
            'accountname' => ['required', 'string'],
            'amount' => ['required', 'string', 'max:13'],
            'narration' => ['required', 'string'],
            'sessionID' => ['required', 'string']
        ]);

        if ($validator->fails()) {
            return redirect()->route('transfer')
                ->withErrors($validator)
                ->withInput();
        }

//return $request;
        $bankCode = $request->bankcode;
        $accountNumber = $request->number;
        $accountBVN = $request->accountbvn;
        $accountName = $request->accountname;
        $amount = $request->amount;
        $narration = $request->narration;
        $sessionID = $request->sessionID;
        $clientId = $request->clientId;


        $auth = $this->auth_init();
        $token = $auth['access_token'];


        if (env('VFD_MODE') == 0) {
            $auth = env('VFD_AUTH_TEST');
            $baseurl = env('VFD_URL_TEST');
            $fromAccount = env("VFD_TRANSFER_ACCOUNTNO_TEST");
            $fromSavingsId=env("VFD_TRANSFER_ACCOUNTID_TEST");
            $fromClientId=env("VFD_TRANSFER_CLIENTID_TEST");
            $fromClient=env("VFD_TRANSFER_CLIENT_TEST");

            $bankCode="999058";
            $accountNumber="0001744830";
            $accountBVN="22222222223";
            $accountName="OGBA, CHRISTOPHER CHINONYE";
            $narration="test trf";
        } else {
            $auth = env('VFD_AUTH');
            $baseurl = env('VFD_URL');
            $fromAccount = env("VFD_TRANSFER_ACCOUNTNO");
            $fromSavingsId=env("VFD_TRANSFER_ACCOUNTID");
            $fromClientId=env("VFD_TRANSFER_CLIENTID");
            $fromClient=env("VFD_TRANSFER_CLIENT");
        }



        $reference = "amali-inclusion-" . uniqid();

        $signature = hash('sha512', $fromAccount . $accountNumber);

        if ($bankCode == "999999") {
            $payload = '{
  "fromSavingsId": "' . $fromSavingsId . '",
  "amount": "' . $amount . '",
  "toAccount": "' . $accountNumber . '",
  "fromBvn": "1000000000",
  "signature": "' . $signature . '",
  "fromAccount": "' . $fromAccount . '",
  "toBvn": "' . $accountBVN . '",
  "remark": "' . $narration . '",
  "fromClientId": "' . $fromClientId. '",
  "fromClient": "' . $fromClient . '",
  "toKyc": "99",
  "reference": "' . $reference . '",
  "toClientId": "' . $clientId . '",
  "toClient": "' . $accountName . '",
  "toSession": "",
  "transferType": "intra",
  "toBank": "' . $bankCode . '",
  "toSavingsId": "' . $sessionID . '"
}';
        } else {

            $payload = '{
  "fromSavingsId": "' . $fromSavingsId . '",
  "amount": "' . $amount . '",
  "toAccount": "' . $accountNumber . '",
  "fromBvn": "1000000000",
  "signature": "' . $signature . '",
  "fromAccount": "' . $fromAccount . '",
  "toBvn": "' . $accountBVN . '",
  "remark": "' . $narration . '",
  "fromClientId": "' . $fromClientId . '",
  "fromClient": "' . $fromClient . '",
  "toKyc": "99",
  "reference": "' . $reference . '",
  "toClientId": "",
  "toClient": "' . $accountName . '",
  "toSession": "' . $sessionID . '",
  "transferType": "inter",
  "toBank": "' . $bankCode . '",
  "toSavingsId": ""
}';
        }


//        return $payload;
        $wallet = wallet::where('user_id', Auth::id())->first();

        if ($amount < 100) {
            $mg = "Minimum amount is 100. Kindly increase amount and try again";
            return redirect()->route('transfer')->withErrors($mg);
        }

        if ($wallet->balance < 1) {
            $mg = "Insufficient balance. Kindly topup and try again";
            return redirect()->route('transfer')->withErrors($mg);
        }

        if ($amount < 1) {
            $mg = "Error transaction";
            return redirect()->route('transfer')->withErrors($mg);
        }

        if ($wallet->balance < $amount) {
            $mg = "You Cant Make Purchase Above NGN" . $amount . " from your wallet. Your wallet balance is NGN $wallet->balance. Please Fund Wallet.";
            return redirect()->route('transfer')->withErrors($mg);
        }

        $bo = transfer::where('refid', $request->refe)->first();

        if ($bo) {
            $mg = "Suspected duplicate transaction";
            return redirect()->route('transfer')->withErrors($mg);
        }

        $gt = $wallet->balance - $request->amount;
        $wallet->balance = $gt;
        $wallet->save();


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $baseurl . 'vtech-wallet/api/v1/wallet2/transfer?source=pool&wallet-credentials=' . $auth,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $payload,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

//        return $response;
        $rep = json_decode($response, true);

        if ($rep['status'] != "00") {

            $gt = $wallet->balance + $request->amount;
            $wallet->balance = $gt;
            $wallet->save();

            return redirect()->route('transfer')->withErrors("Transfer not successful. Try again later");
        }


        transfer::create([
            'userid' => Auth::id(),
            'bankcode' => $request->bankcode,
            'amount' => $request->amount,
            'account_no' => $request->number,
            'narration' => $request->narration,
            'refid' => $reference,
        ]);

        Transaction::create([
            'user_id' => Auth::id(),
            'uuid' => Auth::user()->uuid,
            'reference' => $request->refe,
            'type' => 'debit',
            'remark' => "Successful Transfer to " . $accountName . " (" .$accountNumber."). Reference: $reference",
            'amount' => $request->amount,
            'previous' => $wallet->balance,
            'balance' => $gt,
        ]);



        $am = "NGN $amount was successfully transferred to $accountNumber";
        $rep="success";

        return view('bills.bill', compact('am', 'rep'));

    }

    public function auth_init()
    {


        if (env('VFD_MODE') == 0) {
            $auth = env('VFD_AUTH_TEST');
            $baseurl = env('VFD_URL_TEST');
        } else {
            $auth = env('VFD_AUTH');
            $baseurl = env('VFD_URL')."v-token/v1/oauth2/";
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $baseurl . 'token',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'grant_type=client_credentials',
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic ' . $auth,
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response, true);

    }
}
