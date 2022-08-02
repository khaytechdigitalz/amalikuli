<?php

namespace App\Actions\Fortify;

use App\Models\BankAccounts;
use App\Models\Business;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginUser
{

    public function login(Request $request)
    {
        $user = User::where('phone', $request->phone)->first();

        if ($user &&
            Hash::check($request->password, $user->password)) {
            return $user;
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('VELOX_URL') . 'users/login',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
  "user": {
    "password": "' . $request->password . '",
    "phone": "' . $request->phone . '"
  },
  "type": "agent"
}',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'X-Requested-With: XMLHttpRequest'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
//            echo $response

        $rep = json_decode($response, true);

        if ($rep['status'] == "success") {
            $u = User::create([
                'firstname' => $rep['data']['agent']['first_name'],
                'lastname' => $rep['data']['agent']['last_name'],
                'dob' => $rep['data']['agent']['date_of_birth'],
                'gender' => " ",
                'phone' => $rep['data']['agent']['business_phone'],
                'email' => $rep['data']['agent']['email'],
                'password' => Hash::make($request->password),
                'uuid' => hexdec(uniqid() . rand(0, 100)),
            ]);

            Business::create([
                'user_id' => $u->id,
                'name' => $rep['data']['agent']['business_name'],
                'address' => $rep['data']['agent']['business_address'],
                'phoneno' => $rep['data']['agent']['business_phone'],
                'lga' => " ",
                'state' => " ",
                'type' => $rep['data']['agent']['business_type'],
            ]);


            BankAccounts::create([
                'user_id' => $u->id,
                'account_name' => $rep['data']['agent']['account_name'],
                'account_number' => $rep['data']['agent']['account_number'],
                'bank_name' => " ",
                'bank_code' => $rep['data']['agent']['bank_code'],
                'bvn' => $rep['data']['agent']['bvn'],
            ]);


            Wallet::create([
                'user_id' => $u->id,
                'name' => 'deposit',
                'balance' => $rep['data']['wallet']['current_bal']
            ]);

            return $u;
        }
    }

    public function loginNew(Request $request)
    {
        $input=$request->all();
        Validator::make($input, [
            'phone' => ['required', 'string', 'max:13'],
            'password' => ['required', 'string', 'max:255']
        ])->validate();


        $user = User::where('phone', $request->phone)->first();

        if ($user &&
            Hash::check($request->password, $user->password)) {
            return $user;
        }

        $hashv = env('GRUPPLOGIN_SECRETKEY') . '|' . $request->phone . '|' . $request->password;
        $hash= \hash("SHA512",$hashv);
//        dd($hash);
        $payload='{
    "password": "'.$request->password.'",
    "identifier": "'.$request->phone.'",
    "hash": "'.$hash.'"
}';

//        echo "=====BASE URL=====";
//        echo env('GRUPPLOGIN_BASEURL'). '/extension/auth';
//        echo "=====Payload=====";
//        echo $payload;
//
//        echo "=====Response=====";

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('GRUPPLOGIN_BASEURL'). '/extension/auth',
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
                'bankerId: '.env('GRUPPLOGIN_BANKERID'),
                'Authorization: Basic '.base64_encode(env('GRUPPLOGIN_USERNAME'). ":".env('GRUPPLOGIN_PASSWORD')),
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $resp=json_decode($response, true);

//        echo $response;

//        dd($response);

        if(isset($resp['status'])){
            if($resp['status']) {
                $userCheck=User::where('phone', $input['phone'])->exists();
                if(!$userCheck){
                    $u = User::create([
                        'firstname' => "",
                        'lastname' => "",
                        'dob' => "",
                        'gender' => "",
                        'phone' => $input['phone'],
                        'email' => "",
                        'password' => Hash::make($input['password']),
                        'uuid' => hexdec(uniqid() . rand(0, 100)),
                    ]);


                    Business::create([
                        'user_id' => $u->id,
                        'name' => $input['phone'],
                        'address' => " ",
                        'phoneno' => $input['phone'],
                        'lga' => " ",
                        'state' => " ",
                        'type' => " ",
                    ]);


                    Wallet::create([
                        'user_id' => $u->id,
                        'name' => 'deposit',
                        'balance' => "0"
                    ]);


                    return $u;
                }
            }
        }

    }
}
