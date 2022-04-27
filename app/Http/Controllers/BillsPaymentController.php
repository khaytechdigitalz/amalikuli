<?php

namespace App\Http\Controllers;

use App\Models\bill_payment;
use App\Models\DataProvider;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BillsPaymentController extends Controller
{
    public function buyAirtime(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'network' => 'required|max:200',
            'amount' => 'required|max:200',
            'phone' => 'required|max:11'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = Auth::user();
        $wallet = wallet::where('user_id', $user->id)->first();

        $ref = Auth::id() . uniqid();
        $agentid = "plan";
        $amount = $request->amount;


        if ($amount < 100) {
            $mg = "Minimum amount is 100. Kindly increase amount and try again";
            return back()->withErrors($mg);
        }

        if ($wallet->balance < 1) {
            $mg = "Insufficient balance. Kindly topup and try again";
            return back()->withErrors($mg);
        }

        if ($wallet->balance < $amount) {
            $mg = "You Cant Make Purchase Above" . "NGN" . $amount . " from your wallet. Your wallet balance is NGN $wallet->balance. Please Fund Wallet.";
            return back()->withErrors($mg);
        }

        $bo = bill_payment::where('ref', $ref)->first();

        if ($bo) {
            $mg = "Suspected duplicate transaction";
            return back()->withErrors($mg);
        }

        $tf = $wallet->balance - $amount;

        $wallet->balance = $tf;
        $wallet->save();


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('BAXI_URL') . 'services/airtime/request',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_SSL_VERIFYPEER => 'false',
            CURLOPT_POSTFIELDS => '{
    "agentReference": "' . $ref . '",
    "agentId" : "' . $agentid . '",
    "plan" : "prepaid",
    "service_type": "' . $input['network'] . '",
    "amount": ' . $input['amount'] . ',
    "phone": "' . $input['phone'] . '"
}',
            CURLOPT_HTTPHEADER => array(
                'x-api-key: ' . env('BAXI_APIKEY'),
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        //    echo $response;

//        echo env('BAXI_URL') . 'services/airtime/request';
//        return $response;

        $rep = json_decode($response, true);

        if ($rep['status'] != 'success') {

            $zo = $wallet->balance + $amount;
            $wallet->balance = $zo;
            $wallet->save();

            $mg = $rep['message'];
            return back()->withErrors($mg);
        }

        $name = $request->network;
        $am = "NGN $request->amount Airtime Purchase Was Successful To";
        $ph = $request->phone;

        bill_payment::create([
            'user_id' => Auth::id(),
            'services' => 'airtime',
            'network' => $request->network,
            'amount' => $request->amount,
            'number' => $request->phone,
            'server_res' => $response,
            'ref' => $ref,
        ]);

        Transaction::create([
            'user_id' => Auth::id(),
            'uuid' => Auth::user()->uuid,
            'reference' => $ref,
            'type' => 'debit',
            'remark' => $am . " " . $ph,
            'amount' => $amount,
            'previous' => $wallet->balance,
            'balance' => $tf
        ]);

        return view('bills.bill', compact('user', 'name', 'am', 'ph', 'rep'));

    }

    public function data()
    {
        $data['providers'] = DataProvider::where('status', 1)->get();
        return view('bills.data', $data);
    }

    public function dataPlans(Request $request)
    {

        $input = $request->all();
        $network = $request->id;
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('BAXI_URL') . 'services/databundle/bundles',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_SSL_VERIFYPEER => 'false',
            CURLOPT_POSTFIELDS => '{
    "service_type": "' . $input['id'] . '"
}',
            CURLOPT_HTTPHEADER => array(
                'x-api-key: ' . env('BAXI_APIKEY'),
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $rep1 = json_decode($response, true);

//        echo env('BAXI_URL') . 'services/databundle/bundles';
//
//return $rep1;
        $rep = $rep1['data'];

        return view('bills.dataplans', compact('rep', 'network'));

    }

    public function buyDataPlans(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($request->all(), [
            'network' => 'required|max:200',
            'amount' => 'required|max:200',
            'datacode' => 'required|max:11',
            'phone' => 'required|max:11'
        ]);

        if ($validator->fails()) {
            return redirect()->route('bills.data')
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::find($request->user()->id);
        $wallet = wallet::where('user_id', $user->id)->first();

        $ref = Auth::id() . uniqid();
        $agentid = "plan";
        $amount = $request->amount;


        if ($amount < 100) {
            $mg = "Minimum amount is 100. Kindly increase amount and try again";
            return redirect()->route('bills.data')->withErrors($mg);
        }

        if ($wallet->balance < 1) {
            $mg = "Insufficient balance. Kindly topup and try again";
            return redirect()->route('bills.data')->withErrors($mg);
        }

        if ($amount < 1) {
            $mg = "error transaction";
            return redirect()->route('bills.data')->withErrors($mg);
        }

        if ($wallet->balance < $amount) {
            $mg = "You Cant Make Purchase Above" . "NGN" . $amount . " from your wallet. Your wallet balance is NGN $wallet->balance. Please Fund Wallet.";
            return redirect()->route('bills.data')->withErrors($mg);
        }

        $bo = bill_payment::where('ref', $ref)->first();

        if ($bo) {
            $mg = "Suspected duplicate transaction";
            return redirect()->route('bills.data')->withErrors($mg);
        }

        $gt = $wallet->balance - $amount;

        $wallet->balance = $gt;
        $wallet->save();

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('BAXI_URL') . 'services/databundle/request',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_SSL_VERIFYPEER => 'false',
            CURLOPT_POSTFIELDS => '{
    "agentReference": "' . $ref . '",
    "agentId" : "' . $agentid . '",
    "datacode" : ' . $input['datacode'] . ',
    "service_type": "' . $input['network'] . '",
    "amount":"' . $input['amount'] . '",
    "phone": "' . $input['phone'] . '"
}',
            CURLOPT_HTTPHEADER => array(
                'x-api-key: ' . env('BAXI_APIKEY'),
                'Baxi-date: ' . Carbon::now(),
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $rep = json_decode($response, true);

//        echo  env('BAXI_URL') . 'services/databundle/request';


//return $rep;
        if ($rep['status'] != 'success') {

            $zo = $wallet->balance + $amount;
            $wallet->balance = $zo;
            $wallet->save();

            $mg = $rep['message'];
            return redirect()->route('bills.data')->withErrors($mg);
        }

        bill_payment::create([
            'user_id' => Auth::id(),
            'services' => 'data',
            'network' => $request->network,
            'amount' => $request->amount,
            'number' => $request->phone,
            'server_res' => $response,
            'ref' => $ref,
        ]);

        Transaction::create([
            'user_id' => Auth::id(),
            'uuid' => Auth::user()->uuid,
            'reference' => $ref,
            'type' => 'debit',
            'remark' => $rep['data']['transactionMessage'],
            'amount' => $amount,
            'previous' => $wallet->balance,
            'balance' => $gt,
        ]);

        $name = $request->network;
        $am = "$request->name  Was Successful To";
        $ph = $request->phone;

        return view('bills.bill', compact('user', 'name', 'am', 'ph', 'rep'));
    }

    public function validateTV(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($request->all(), [
            'network' => 'required|max:200',
            'phone' => 'required|max:11'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('BAXI_URL') . 'services/namefinder/query',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_SSL_VERIFYPEER => 'false',
            CURLOPT_POSTFIELDS => '{
    "service_type": "' . $input['network'] . '",
    "account_number": "' . $input['phone'] . '"
}',
            CURLOPT_HTTPHEADER => array(
                'x-api-key: ' . env('BAXI_APIKEY'),
                'Baxi-date: ' . Carbon::now(),
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
//        echo $response;
//        echo env('BAXI_URL') . 'services/namefinder/query';

        $rep = json_decode($response, true);

        $rep1 = $rep['data']['user']['name'];

        if (isset($rep['data']['user']['currentBouquet'])) {
            $rep2 = $rep['data']['user']['currentBouquet'];
            $rep3 = $rep['data']['user']['currentBouquetRaw']['amount'];
            $rep4 = $rep['data']['user']['rawOutput']['dueDate'];
            $rep5 = $rep['data']['user']['rawOutput']['invoicePeriod'];

        } else {
            $rep2 = null;
            $rep3 = null;
            $rep4 = null;
            $rep5 = null;
        }

        return view('bills.tvlist', compact('rep1', 'rep2', 'rep3','rep4', 'rep5', 'input'));


    }

    public function renewTV(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($request->all(), [
            'network' => 'required|max:200',
            'amount' => 'required|max:200',
            'period' => 'required',
            'number' => 'required|max:11'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $ref = rand();
        $agentid = "plan";
        $user = User::find($request->user()->id);
        $wallet = wallet::where('user_id', $user->id)->first();
        $amount = $request->amount;


        if ($amount < 100) {
            $mg = "Minimum amount is 100. Kindly increase amount and try again";
            return redirect()->route('bills.tvlist')->withErrors($mg);
        }

        if ($wallet->balance < 1) {
            $mg = "Insufficient balance. Kindly topup and try again";
            return redirect()->route('bills.tvlist')->withErrors($mg);
        }

        if ($amount < 1) {
            $mg = "error transaction";
            return redirect()->route('bills.tvlist')->withErrors($mg);
        }

        if ($wallet->balance < $amount) {
            $mg = "You Cant Make Purchase Above" . "NGN" . $amount . " from your wallet. Your wallet balance is NGN $wallet->balance. Please Fund Wallet.";
            return redirect()->route('bills.tvlist')->withErrors($mg);
        }

        $bo = bill_payment::where('ref', $ref)->first();

        if ($bo) {
            $mg = "Suspected duplicate transaction";
            return redirect()->route('bills.data')->withErrors($mg);
        }

        $gt = $wallet->balance - $amount;

        $wallet->balance = $gt;
        $wallet->save();



        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('BAXI_URL') . 'services/multichoice/request',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
    "total_amount" : "' . $input['amount'] . '",
    "product_monthsPaidFor" : "' . $input['period'] . '",
    "product_code": "0",
    "service_type": "' . $input['network'] . '",
    "agentId": "' . $agentid . '",
    "agentReference": "' . $ref . '",
    "smartcard_number": "' . $input['number'] . '"
}',
            CURLOPT_HTTPHEADER => array(
                'x-api-key: ' . env('BAXI_APIKEY'),
                'Baxi-date: ' . Carbon::now(),
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
//        echo $response;

//        echo env('BAXI_URL') . 'services/multichoice/request';
//        return $response;

        $rep = json_decode($response, true);

        if ($rep['status'] != 'success') {

            $zo = $wallet->balance + $amount;
            $wallet->balance = $zo;
            $wallet->save();

            $mg = $rep['message'];
            return redirect()->route('bills.tvlist')->withErrors($mg);
        }

        bill_payment::create([
            'user_id' => Auth::id(),
            'services' => 'data',
            'network' => $request->network,
            'amount' => $request->amount,
            'number' => $input['number'],
            'server_res' => $response,
            'ref' => $ref,
        ]);

        Transaction::create([
            'user_id' => Auth::id(),
            'uuid' => Auth::user()->uuid,
            'reference' => $ref,
            'type' => 'debit',
            'remark' => $rep['data']['transactionMessage'],
            'amount' => $input['amount'],
            'previous' => $wallet->balance,
            'balance' => $gt
        ]);

        $name = $request->network;
        $am = "$request->name  Was Successful To";
        $ph = $request->phone;

        return view('bills.bill', compact('user', 'name', 'am', 'ph', 'rep'));

    }

    public function TVPlans(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($request->all(), [
            'network' => 'required|max:200'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('BAXI_URL') . 'services/multichoice/list',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_SSL_VERIFYPEER => 'false',
            CURLOPT_POSTFIELDS => '{
    "service_type": "' . $input['network'] . '"
}',
            CURLOPT_HTTPHEADER => array(
                'x-api-key: ' . env('BAXI_APIKEY'),
                'Baxi-date: ' . Carbon::now(),
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
//        echo $response;
//echo  env('BAXI_URL') . 'services/multichoice/list';
//        return $response;
        $rep = json_decode($response, true);

        $rep1 = $rep['data'];
        $code1 = $rep['data'][0]['code'];
        $name1 = $rep['data'][0]['name'];
//        foreach ($rep1 as $plan) {
//            $pa = $plan['monthsPaidFor'];
//            $pa1 = $plan['price'];

//        $rep2=$rep['data'][0]['availablePricingOptions'];

//        $rep1=json_decode($rep['data']['availablePricingOptions'], true);

//        }

        return view('bills.list', compact('input', 'rep1'));

    }

    public function changeTVSub(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($request->all(), [
            'network' => 'required|max:200',
            'amount' => 'required|max:200',
            'period' => 'required',
            'code' => 'required',
            'number' => 'required|max:11'
        ]);

        if ($validator->fails()) {
            return redirect()->route('bills.tv')
                ->withErrors($validator)
                ->withInput();
        }

        $ref = rand();
        $agentid = "plan";

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('BAXI_URL') . 'services/multichoice/request',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
    "total_amount" : "' . $input['amount'] . '",
    "product_monthsPaidFor" : "' . $input['period'] . '",
    "product_code": "' . $input['code'] . '",
    "service_type": "' . $input['network'] . '",
    "agentId": "' . $agentid . '",
    "agentReference": "' . $ref . '",
    "smartcard_number": "' . $input['number'] . '"
}',
            CURLOPT_HTTPHEADER => array(
                'x-api-key: ' . env('BAXI_APIKEY'),
                'Baxi-date: ' . Carbon::now(),
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;

    }

    public function electricityList()
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('BAXI_URL') . 'services/electricity/billers',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_SSL_VERIFYPEER => 'false',
            CURLOPT_HTTPHEADER => array(
                'x-api-key: ' . env('BAXI_APIKEY'),
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
//        echo $response;
//        echo   env('BAXI_URL') . 'services/electricity/billers';
//return $response;
        $rep = json_decode($response, true);

        $rep1 = $rep['data']['providers'];

        return view('bills.elect', compact('rep1'));
    }

    public function validateElectricity(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($request->all(), [
            'network' => 'required|max:200',
            'number' => 'required|max:11'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('BAXI_URL') . 'services/namefinder/query',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_SSL_VERIFYPEER => 'false',
            CURLOPT_POSTFIELDS => '{
    "service_type": "' . $input['network'] . '",
    "account_number": "' . $input['number'] . '"
}',
            CURLOPT_HTTPHEADER => array(
                'x-api-key: ' . env('BAXI_APIKEY'),
                'Baxi-date: ' . Carbon::now(),
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
//        echo $response;
        $rep = json_decode($response, true);
//echo  env('BAXI_URL') . 'services/namefinder/query';
//return $response;
        $rep1 = $rep['data']['user'];
//        return $rep1;

        return view('bills.payelect', compact('rep1', 'input'));

    }

    public function purchaseElectricity(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($request->all(), [
            'network' => 'required|max:200',
            'amount' => 'required|max:200',
            'phone' => 'required',
            'number' => 'required|max:11'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }



        $ref = rand();
        $agentid = "plan";


                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => env('BAXI_URL') . 'services/electricity/request',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_SSL_VERIFYPEER => 'false',
                    CURLOPT_POSTFIELDS => '{
    "phone" : "' . $input['phone'] . '",
    "amount" : "' . $input['amount'] . '",
    "account_number": "' . $input['number'] . '",
    "service_type": "' . $input['network'] . '",
    "agentReference": "' . $ref . '",
    "agentId": "' . $agentid . '"
}',
                    CURLOPT_HTTPHEADER => array(
                        'x-api-key: ' . env('BAXI_APIKEY'),
                        'Baxi-date: ' . Carbon::now(),
                        'Content-Type: application/json'
                    ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);
//                echo $response;
//        echo  env('BAXI_URL') . 'services/electricity/request';


                $rep1 = json_decode($response, true);

                $rep = $rep1['data'];
                $token = $rep['tokenCode'];
                $energy = $rep['amountOfPower'];

        if ($rep['transactionStatus'] != 'success') {

            $zo = $wallet->balance + $amount;
            $wallet->balance = $zo;
            $wallet->save();

            $mg = $rep['message'];
            return back()->withErrors($mg);
        }

        $name = $input['network'];
        $am = "$request->network Was Successful ";
        $ph = "Token: $token || Energy: $energy";

        bill_payment::create([
            'user_id' => Auth::id(),
            'services' => 'electricity',
            'network' => $request->network,
            'amount' => $request->amount,
            'number' => $request->phone,
            'server_res' => $response,
            'ref' => $ref,
        ]);

        Transaction::create([
            'user_id' => Auth::id(),
            'uuid' => Auth::user()->uuid,
            'reference' => $ref,
            'type' => 'debit',
            'remark' => $am . " " . $ph,
            'amount' => $amount,
            'previous' => $wallet->balance,
            'balance' => $tf
        ]);

        return view('bills.bill', compact('user', 'name', 'am', 'ph', 'rep'));
    }

}
