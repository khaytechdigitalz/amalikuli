<?php

namespace App\Actions\Fortify;

use App\Models\BankAccounts;
use App\Models\Business;
use App\Models\Kyc;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Fortify\Rules\Password;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'dob' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'max:255'],
//            'type' => ['required', 'string', 'max:255'],
//            'phone' => ['required', 'string', 'max:12'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', new Password,],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
            'businessName' => ['required', 'string', 'max:255'],
            'businessAddress' => ['required', 'string', 'max:255'],
            'businessPhoneno' => ['required', 'string', 'max:255'],
            'lga' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'businessType' => ['required', 'string', 'max:255'],
            'accountNumber' => ['required', 'string', 'max:255'],
            'bankName' => ['required', 'string', 'max:255'],
            'accountName' => ['required', 'string', 'max:255'],
            'bvn' => ['required', 'string', 'max:255'],
            'utilityBill' => ['required'],
            'guarantorForm' => ['required'],
            'idCard' => ['required'],
            'passportPhotograph' => ['required'],
        ])->validate();


        $u=User::create([
            'firstname' => $input['firstName'],
            'lastname' => $input['lastName'],
            'dob' => $input['dob'],
            'gender' => $input['gender'],
            'phone' => $input['businessPhoneno'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'uuid' => hexdec(uniqid() . rand(0, 100)),
        ]);

        Business::create([
            'user_id'=>$u->id,
            'name'=>$input['businessName'],
            'address'=>$input['businessAddress'],
            'phoneno'=>$input['businessPhoneno'],
            'lga'=>$input['lga'],
            'state'=>$input['state'],
            'type'=>$input['businessType'],
        ]);


        BankAccounts::create([
            'user_id' => $u->id,
            'account_name' => $input['accountName'],
            'account_number' => $input['accountNumber'],
            'bank_name' => $input['bankName'],
            'bank_code' => "",
            'bvn' => $input['bvn'],
        ]);


        // Automatically generate a unique ID for filename...
        $utilityBill = Storage::put('kyc', $input['utilityBill']);
        $guarantor = Storage::put('kyc', $input['guarantorForm']);
        $idcard = Storage::put('kyc', $input['idCard']);
        $passport = Storage::put('kyc', $input['passportPhotograph']);

        Kyc::create([
            'user_id' => $u->id,
            'utility' => $utilityBill,
            'idcard' => $idcard,
            'guarantorform' => $guarantor,
            'passport' => $passport
        ]);

        Wallet::create([
            'user_id' => $u->id,
            'name' => 'deposit'
        ]);


        return $u;
    }
}
