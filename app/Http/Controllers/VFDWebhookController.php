<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Transaction;
use App\Models\transfer;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class VFDWebhookController extends Controller
{

//{
//"reference": "Vfd-weiuubui3b3n4",
//"amount": "1000",
//"account_number": "1010123498",
//"originator_account_number": "2910292882",
//"originator_account_name": "AZUBUIKE MUSA DELE",
//"originator_bank": "000004",
//"originator_narration": "test",
//"timestamp": "2021-01-11T09:34:55.879Z"
//}

    public function index(Request $request){
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'reference' => 'required',
            'amount' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => "Expected information not found"]);
        }

        $customer=Customer::where('accountNo', $input['originator_account_number'])->first();

        if(!$customer){
            return response()->json(['success' => false, 'message' => "Account does not exist"]);
        }

        $transaction=Transaction::where("reference", $input['reference'])->first();

        if($transaction){
            return response()->json(['success' => false, 'message' => "Account has been credited earlier"]);
        }

        $ref=$input['reference'];
        $message="Funds received from ".$input['originator_account_name']. " (".$input['originator_account_number'].")";
        $amount=$request->amount;

        $wallet=Wallet::where('user_id', $customer->created_by)->first();
        $newBal=$wallet->balance + $amount;


        Transaction::create([
            'user_id' => $customer->created_by,
            'uuid' =>$customer->creator_uuid,
            'reference' => $ref,
            'type' => 'credit',
            'remark' => $message,
            'amount' => $amount,
            'previous' => $wallet->balance,
            'balance' => $newBal,
        ]);

        WalletTransaction::create([
            'user_id' => $customer->created_by,
            'uuid' =>$customer->creator_uuid,
            'amount' => $amount,
            'description' => $message,
            'type' => 'credit',
            'prev_bal' => $wallet->balance,
            'cur_bal' => $newBal,
        ]);

        $wallet->balance=$newBal;
        $wallet->save();

        return response()->json(['success' => true, 'message' => "success"]);
    }

    public function transfer(Request $request){
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'reference' => 'required',
            'amount' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => "Expected information not found"]);
        }

        $t=transfer::where('refid', $input['reference'])->first();

        if($t){
            $t->status=1;
            $t->save();
        }else{
            return response()->json(['success' => false, 'message' => "Reference not found"]);
        }

        return response()->json(['success' => true, 'message' => "success"]);
    }
}
