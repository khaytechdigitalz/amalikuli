<?php

namespace App\Providers;

use App\Actions\Jetstream\DeleteUser;
use App\Models\BankAccounts;
use App\Models\Business;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Laravel\Jetstream\Jetstream;

class JetstreamServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->configurePermissions();

        Jetstream::deleteUsersUsing(DeleteUser::class);

//        Fortify::loginView(function () {
//            return view('login');
//        });

        Fortify::authenticateUsing(function (Request $request) {
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

        });

    }

    /**
     * Configure the permissions that are available within the application.
     *
     * @return void
     */
    protected function configurePermissions()
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::permissions([
            'create',
            'read',
            'update',
            'delete',
        ]);
    }
}
