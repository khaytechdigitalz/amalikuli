<?php

namespace App\Http\Controllers;

use App\Models\bill_payment;
use App\Models\DataProvider;
use App\Models\User;
use App\Models\Wallet;
use Carbon\Carbon;
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
        if (Auth::check()) {
            $user = User::find($request->user()->id);
            $wallet = wallet::where('user_id', $user->id)->first();
            $ref = rand();
            $agentid = "plan";


            if ($wallet->balance < $request->amount) {
                $mg = "You Cant Make Purchase Above" . "NGN" . $request->amount . " from your wallet. Your wallet balance is NGN $wallet->balance. Please Fund Wallet And Retry or Pay Online Using Our Alternative Payment Methods.";

                return view('bills.bill', compact('user', 'mg'));

            }
            if ($request->amount < 0) {

                $mg = "error transaction";
                return view('bills.bill', compact('user', 'mg'));

            }
            $bo = bill_payment::where('ref', $ref)->first();
            if (isset($bo)) {
                $mg = "duplicate transaction";
                return view('bills.bill', compact('user', 'mg'));

            } else {
                $user = User::find($request->user()->id);
                $wallet = wallet::where('user_id', $user->id)->first();


                $gt = $wallet->balance - $request->amount;


                $wallet->balance = $gt;
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
//                echo $response;
//return $response;
                $rep = json_decode($response, true);

                if ($rep['status'] != 'success') {
//                    return back()->with([
//                        'error' => $rep['message']
//                    ]);
                    $zo=$wallet->balance+$request->amount;
                    $wallet->balance = $zo;
                    $wallet->save();

                    $name= $request->network;
                    $am= "NGN $request->amount Was Refunded To Your Wallet";
                    $ph=", Transaction fail";

                    return view('bills.bill', compact('user', 'name', 'am', 'ph', 'rep'));

                } elseif ($rep['status'] = 'success') {


//                return back()->with([
//                    'success' => $rep['data']['transactionMessage']
                    $bo = bill_payment::create([
                        'user_id' => $user->id,
                        'services' => 'airtime',
                        'network' => $request->network,
                        'amount' => $request->amount,
                        'number' => $request->phone,
                        'server_res' => 'null',
                        'ref' => $ref,
                    ]);
                    $name = $request->network;
                    $am = "NGN $request->amount  Airtime Purchase Was Successful To";
                    $ph = $request->phone;

                    return view('bills.bill', compact('user', 'name', 'am', 'ph', 'rep'));

//                ]);
                }
            }
        }
    }

    public function data(){
        $data['providers']=DataProvider::where('status', 1)->get();
        return view('bills.data', $data);
    }

    public function dataPlans(Request $request){

        $input = $request->all();
        $network= $request->id;
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('BAXI_URL').'services/databundle/bundles',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
    "service_type": "' . $input['id'] . '"
}',
            CURLOPT_HTTPHEADER => array(
                'x-api-key: '.env('BAXI_APIKEY'),
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
//        echo $response;
        $rep1 = json_decode($response, true);

        $rep=$rep1['data'];

//        return $rep;

        return view('bills.dataplans', compact('rep', 'network' ));


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
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        if (Auth::check()) {
            $user = User::find($request->user()->id);
            $wallet = wallet::where('user_id', $user->id)->first();

            $ref = rand();
            $agentid = "plan";

            if ($wallet->balance < $request->amount) {
                $mg = "You Cant Make Purchase Above" . "NGN" . $request->amount . " from your wallet. Your wallet balance is NGN $wallet->balance. Please Fund Wallet And Retry or Pay Online Using Our Alternative Payment Methods.";

                return view('bills.bill', compact('user', 'mg'));

            }
            if ($request->amount < 0) {

                $mg = "error transaction";
                return view('bills.bill', compact('user', 'mg'));

            }
            $bo = bill_payment::where('ref', $ref)->first();
            if (isset($bo)) {
                $mg = "duplicate transaction";
                return view('bills.bill', compact('user', 'mg'));

            } else {
                $user = User::find($request->user()->id);
                $wallet = wallet::where('user_id', $user->id)->first();


                $gt = $wallet->balance - $request->amount;


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
//                echo $response;
//return $response;
                $rep = json_decode($response, true);

                if ($rep['status'] != 'success') {
//                    return back()->with([
//                        'error' => $rep['message']
//                    ]);
                    $zo=$wallet->balance+$request->amount;
                    $wallet->balance = $zo;
                    $wallet->save();

                    $name= $request->network;
                    $am= "NGN $request->amount Was Refunded To Your Wallet";
                    $ph=", Transaction fail";

                    return view('bills.bill', compact('user', 'name', 'am', 'ph', 'rep'));

                } elseif ($rep['status'] = 'success') {


//                return back()->with([
//                    'success' => $rep['data']['transactionMessage']
                    $bo = bill_payment::create([
                        'user_id' => $user->id,
                        'services' => $request->network.'Data',
                        'network' => $request->name,
                        'amount' => $request->amount,
                        'number' => $request->phone,
                        'server_res' => 'null',
                        'ref' => $ref,
                    ]);
                    $name = $request->network;
                    $am = "$request->name   Was Successful To";
                    $ph = $request->phone;

                    return view('bills.bill', compact('user', 'name', 'am', 'ph', 'rep'));
                }

                }
        }
    }

    public function validateTV(Request $request){
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
            CURLOPT_URL => env('BAXI_URL').'services/namefinder/query',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
    "service_type": "'.$input['network'].'",
    "account_number": "'.$input['phone'].'"
}',
            CURLOPT_HTTPHEADER => array(
                'x-api-key: '.env('BAXI_APIKEY'),
                'Baxi-date: '.Carbon::now(),
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
//        echo $response;
//        return $response;

        $rep = json_decode($response, true);

        $rep1=$rep['data']['user']['name'];

        if(isset($rep['data']['user']['currentBouquet'])){
            $rep2 = $rep['data']['user']['currentBouquet'];

        }else{
            $rep2=null;
        }

        return view('bills.tvlist', compact('rep1', 'rep2', 'input'));


    }

    public function renewTV(Request $request){
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

        $ref=rand();
        $agentid="plan";

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('BAXI_URL').'services/multichoice/request',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
    "total_amount" : "'.$input['amount'].'",
    "product_monthsPaidFor" : "'.$input['period'].'",
    "product_code": "0",
    "service_type": "'.$input['network'].'",
    "agentId": "'.$agentid.'",
    "agentReference": "'.$ref.'",
    "smartcard_number": "'.$input['number'].'"
}',
            CURLOPT_HTTPHEADER => array(
                'x-api-key: '.env('BAXI_APIKEY'),
                'Baxi-date: '.Carbon::now(),
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;

    }

    public function TVPlans(Request $request){
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
            CURLOPT_URL => env('BAXI_URL').'services/multichoice/list',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
    "service_type": "'.$input['network'].'"
}',
            CURLOPT_HTTPHEADER => array(
                'x-api-key: '.env('BAXI_APIKEY'),
                'Baxi-date: '.Carbon::now(),
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
//        echo $response;
        $rep = json_decode($response, true);

        $rep1=$rep['data'];
        $code1=$rep['data'][0]['code'];
        $name1=$rep['data'][0]['name'];
//        foreach ($rep1 as $plan) {
//            $pa = $plan['monthsPaidFor'];
//            $pa1 = $plan['price'];

//        $rep2=$rep['data'][0]['availablePricingOptions'];

//        $rep1=json_decode($rep['data']['availablePricingOptions'], true);

//        }

        return view('bills.list', compact( 'input', 'rep1'));

    }

    public function changeTVSub(Request $request){
        $input = $request->all();

        $validator = Validator::make($request->all(), [
            'network' => 'required|max:200',
            'amount' => 'required|max:200',
            'period' => 'required',
            'code' => 'required',
            'number' => 'required|max:11'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $ref=rand();
        $agentid="plan";

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('BAXI_URL').'services/multichoice/request',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
    "total_amount" : "'.$input['amount'].'",
    "product_monthsPaidFor" : "'.$input['period'].'",
    "product_code": "'.$input['code'].'",
    "service_type": "'.$input['network'].'",
    "agentId": "'.$agentid.'",
    "agentReference": "'.$ref.'",
    "smartcard_number": "'.$input['number'].'"
}',
            CURLOPT_HTTPHEADER => array(
                'x-api-key: '.env('BAXI_APIKEY'),
                'Baxi-date: '.Carbon::now(),
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;

    }

    public function electricityList(){

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('BAXI_URL').'services/electricity/billers',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'x-api-key: '.env('BAXI_APIKEY'),
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }

    public function validateElectricity(Request $request){
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
            CURLOPT_URL => env('BAXI_URL').'services/namefinder/query',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
    "service_type": "'.$input['network'].'",
    "account_number": "'.$input['number'].'"
}',
            CURLOPT_HTTPHEADER => array(
                'x-api-key: '.env('BAXI_APIKEY'),
                'Baxi-date: '.Carbon::now(),
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;

    }

    public function purchaseElectricity(Request $request){
        $input = $request->all();

        $validator = Validator::make($request->all(), [
            'network' => 'required|max:200',
            'amount' => 'required|max:200',
            'period' => 'required',
            'code' => 'required',
            'number' => 'required|max:11'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $ref=rand();
        $agentid="plan";

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('BAXI_URL').'services/electricity/request',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
    "phone" : "'.$input['phone'].'",
    "amount" : "'.$input['amount'].'",
    "account_number": "'.$input['number'].'",
    "service_type": "'.$input['network'].'",
    "agentReference": "'.$ref.'",
    "agentId": "'.$agentid.'"
}',
            CURLOPT_HTTPHEADER => array(
                'x-api-key: '.env('BAXI_APIKEY'),
                'Baxi-date: '.Carbon::now(),
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;

    }

}
