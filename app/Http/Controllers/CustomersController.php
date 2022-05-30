<?php

namespace App\Http\Controllers;

use App\Models\CardRequest;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CustomersController extends Controller
{
    public function fetchCustomers()
    {
        $datas['users'] = Customer::where("created_by", Auth::id())->get();
        $datas['i'] = 1;

        return view('users', $datas);
    }

    public function createCustomer(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($request->all(), [
            'bvn' => 'required|max:200',
            'dob' => 'required|max:200',
            'phone' => 'required|max:11',
            'email' => 'required|email|max:200',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => env('VFDC_URL') . 'agency-bank/verify',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
    "bvn":"' . $input['bvn'] . '",
    "dateOfBirth":"' . Carbon::parse($input['dob'])->format('d-M-Y') . '",
    "phoneNo":"' . $input['phone'] . '"
    }',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Bearer ' . env('VFDC_TOKEN'),
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
//            return $response;

            $rep = json_decode($response, true);

            if ($rep['status'] != "success") {
                return back()->withInput()->with('error', 'An error occurred. ' . $rep['message']);
            }

        } catch (\Exception $e) {
            return back()->with('error', 'Fatai Error, kindly contact admin');
        }

        session(['input' => $input]);

        return redirect()->route('addCustomerOTP')->with('success', 'OTP has been sent to customer phone');

    }

    public function createCustomerOtp(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($request->all(), [
            'otp' => 'required|max:6',
            'avatar' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $oInput = session('input');

//        return base64_encode(file_get_contents($request->file('avatar')->path()));

//        try {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => env('VFD_URL') . 'agency-bank/otp-verify',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
    "bvn":"' . $oInput['bvn'] . '",
    "dateOfBirth":"' . Carbon::parse($oInput['dob'])->format('d-M-Y') . '",
    "phoneNo":"' . $oInput['phone'] . '",
    "otp":"' . $input['otp'] . '",
    "type":"signup"
    }',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Bearer ' . env('VFD_TOKEN'),
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
        echo $response;

            $rep = json_decode($response, true);

            if ($rep['status'] != "success") {
                return back()->withInput()->with('error', $rep['message']);
            }

            $input['avatarBase64'] = base64_encode(file_get_contents($request->file('avatar')->path()));


            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => env('VFD_URL') . 'agency-bank/create-account',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
    "bvn":"' . $oInput['bvn'] . '",
    "referralCode":"",
    "phoneNo":"' . $oInput['phone'] . '",
    "email":"' . $oInput['email'] . '",
    "agent":"' . env('VFD_AGENT') . '",
    "avatar": "' . $input['avatarBase64'] . '"
    }',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Bearer ' . env('VFD_TOKEN'),
                ),
            ));

            $response = curl_exec($curl);

        curl_close($curl);
        echo $response;

        $rep = json_decode($response, true);


        if ($rep['status'] != "success") {
            return redirect()->route('add-customer')->withInput()->with('error', $rep['message']);
        }

//        } catch (\Exception $e) {
//            return redirect()->route('add-customer')->with('error', 'Fatai Error, kindly contact admin');
//        }


        $data['bvn'] = $oInput['bvn'];
        $data['phone'] = $oInput['phone'];
        $data['email'] = $oInput['email'];
        $data['accountNo'] = $rep['data']['accountNo'];
        $data['accountName'] = $rep['data']['accountName'];
        $data['created_by'] = Auth::id();
        $data['creator_uuid'] = Auth::user()->uuid;

        Customer::create($data);

        return redirect()->route('customers')->with('success', 'Customer created successfully');

    }


    public function fetchDebitcard()
    {
        $datas['cards'] = CardRequest::where("created_by", Auth::id())->get();
        $datas['i'] = 1;

        return view('debit-card', $datas);
    }

    public function verifyDebitcard(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($request->all(), [
            'accountNumber' => 'required|max:200',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => env('VFD_URL') . 'agency-bank/validate-account',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
"accountNo":"' . $input['accountNumber'] . '",
"validationType": "card-request"
}',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Bearer ' . env('VFD_TOKEN'),
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
//            return $response;

            $rep = json_decode($response, true);

            if ($rep['status'] != "success") {
                return back()->withInput()->with('error', $rep['message']);
            }

        } catch (\Exception $e) {
            return back()->with('error', 'Fatai Error, kindly contact admin');
        }

        session(['input' => $input]);

        return redirect()->route('debit-card-OTP')->with('success', 'OTP has been sent to customer phone');

    }

    public function debitCardProceed(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($request->all(), [
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $oInput = session('input');

        try {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => env('VFD_URL') . 'agency-bank/card-request',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
    "accountNo":"' . $oInput['bvn'] . '",
    "address":"' . $input['address'] . '"
    }',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsIng1dCI6Ik5UZG1aak00WkRrM05qWTBZemM1TW1abU9EZ3dNVEUzTVdZd05ERTVNV1JsWkRnNE56YzRaQT09In0.eyJhdWQiOiJodHRwOlwvXC9vcmcud3NvMi5hcGltZ3RcL2dhdGV3YXkiLCJzdWIiOiJhZG1pbkBjYXJib24uc3VwZXIiLCJhcHBsaWNhdGlvbiI6eyJvd25lciI6ImFkbWluIiwidGllclF1b3RhVHlwZSI6InJlcXVlc3RDb3VudCIsInRpZXIiOiJVbmxpbWl0ZWQiLCJuYW1lIjoiYW1hbGlfYWdlbnQiLCJpZCI6MjksInV1aWQiOm51bGx9LCJzY29wZSI6ImFtX2FwcGxpY2F0aW9uX3Njb3BlIGRlZmF1bHQiLCJpc3MiOiJodHRwczpcL1wvcHVic3RvcmUtZGV2YXBwcy52ZmRiYW5rLnN5c3RlbXM6NDQzXC9vYXV0aDJcL3Rva2VuIiwidGllckluZm8iOnsiVW5saW1pdGVkIjp7InRpZXJRdW90YVR5cGUiOiJyZXF1ZXN0Q291bnQiLCJzdG9wT25RdW90YVJlYWNoIjp0cnVlLCJzcGlrZUFycmVzdExpbWl0IjowLCJzcGlrZUFycmVzdFVuaXQiOm51bGx9fSwia2V5dHlwZSI6IlNBTkRCT1giLCJzdWJzY3JpYmVkQVBJcyI6W3sic3Vic2NyaWJlclRlbmFudERvbWFpbiI6ImNhcmJvbi5zdXBlciIsIm5hbWUiOiJBZ2VuY3lCYW5raW5nIiwiY29udGV4dCI6Ilwvdi1hZ2VudFwvdjEiLCJwdWJsaXNoZXIiOiJhZG1pbiIsInZlcnNpb24iOiIxLjAuMCIsInN1YnNjcmlwdGlvblRpZXIiOiJVbmxpbWl0ZWQifV0sImNvbnN1bWVyS2V5IjoiU0xEdnU4bDUxZ0pEYjdCV3g5QW45ZGVjMjE4YSIsImV4cCI6Mzc4MTAxMDcxOSwiaWF0IjoxNjMzNTI3MDcyLCJqdGkiOiI2M2RkYmRjMi0zNTg5LTQ0OTMtOTc2OS1lYWM2OWRlN2U1MTEifQ.cNYqP0Ht6TUuS4xa-8D2LKjUZfp10NgNxsZ4IlUgU72wG9pNrpPh6zJL-Q7CCKl6lO2UrYRZy3mrvka6QjUEwyNQxslRHhCgvYGCMN4F22_8pWg70ZblLfqllIqC-F9cDACyac2bISeqXYDFjkUA_D336YrTP7NJ8zIMM01EIS38ty40PQkzsZ3e2N9U_47Cz_RIRJnsgDOF2DLDxREaRC2WNMIB10Uy_JJ4z-HugGyfaApRoebheDRPKM4EwmjFJBeFy_SaShr39A-Gvb2anx9iDwiNvHfSOTZ1P8miJL8p-U9MxjX0W0ISIp0JY3ZhZB4XEgbGhx876djVsc1u6Q',
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            //            echo $response

            $rep = json_decode($response, true);

            if ($rep['status'] != "success") {
                return back()->withInput()->with('error', $rep['message']);
            }

        } catch (\Exception $e) {
            return back()->with('error', 'Fatai Error, kindly contact admin');
        }


        $data['account_number'] = $oInput['bvn'];
        $data['address'] = $oInput['phone'];
        $data['account_name'] = $oInput['email'];
        $data['status'] = $rep['data']['accountNo'];
        $data['accountName'] = $rep['data']['accountName'];
        $data['created_by'] = Auth::id();
        $data['creator_uuid'] = Auth::user()->uuid;

        CardRequest::create($data);

        return redirect()->route('addCustomer')->with('success', $rep['message']);

    }


}
