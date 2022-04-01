<?php

namespace App\Http\Controllers;

use App\Models\DataProvider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BillsPaymentController extends Controller
{
    public function buyAirtime(Request $request){

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

        $ref=rand();
        $agentid="plan";

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('BAXI_URL').'services/airtime/request',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
    "agentReference": "'.$ref.'",
    "agentId" : "'.$agentid.'",
    "plan" : "prepaid",
    "service_type": "'.$input['network'].'",
    "amount": '.$input['amount'].',
    "phone": "'.$input['phone'].'"
}',
            CURLOPT_HTTPHEADER => array(
                'x-api-key: '.env('BAXI_APIKEY'),
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;

        $rep=json_decode($response, true);

        if($rep['status'] != "success"){
            return back()->with([
                'error' => $rep['message']
            ]);
        }


        return back()->with([
            'success' => $rep['data']['transactionMessage']
        ]);
    }

    public function data(){
        $data['providers']=DataProvider::where('status', 1)->get();
        return view('bills.data', $data);
    }

    public function dataPlans($servicetype){

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
    "service_type": "'.$servicetype.'",
}',
            CURLOPT_HTTPHEADER => array(
                'x-api-key: '.env('BAXI_APIKEY'),
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }

    public function buyDataPlans(Request $request){
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

        $ref=rand();
        $agentid="plan";

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('BAXI_URL').'services/databundle/request',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
    "agentReference": "'.$ref.'",
    "agentId" : "'.$agentid.'",
    "datacode" : '.$input['datacode'].',
    "service_type": "'.$input['network'].'",
    "amount": 200,
    "phone": "'.$input['phone'].'"
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
        echo $response;

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
    "service_type": "mtn"
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

    public function electricityList($servicetype){

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
