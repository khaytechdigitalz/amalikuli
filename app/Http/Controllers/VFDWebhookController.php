<?php

namespace App\Http\Controllers;

use App\Models\transfer;
use Illuminate\Http\Request;
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
