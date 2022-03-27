<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CashoutFee;
use App\Models\PoswithdrawalFee;
use App\Models\TransferFee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FeesController extends Controller
{
    public function transfer(){
        $datas['datas'] = TransferFee::get();
        $datas['i'] = 1;

        return view('admin.fees.transfer', $datas);
    }

    public function deleteTransfer($id){
        $dt=TransferFee::find($id);
        if(!$dt){
            return redirect()->route('admin.fee.transfer')->with([
                "danger" => "Fee not found"
            ]);
        }
        $dt->delete();

        return redirect()->route('admin.fee.transfer')->with([
            "success" => "Fee deleted successfully"
        ]);
    }

    public function transfer_create(){
        $datas['datas']=User::where([["agent", 1], ["sub_agent", NULL]])->get();
        return view('admin.fees.transfer_create', $datas);
    }

    public function transfer_create_post(Request $request){
        $input = $request->all();

        $validator = Validator::make($request->all(), [
            'fee' => 'required|max:200',
            'range' => 'required|max:200',
            'agent_uuid' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        TransferFee::create([
            "fee" => $input['fee'],
            "range_set" => $input['range'],
            "agent_uuid" => $input['agent_uuid'],
        ]);

        return redirect()->route('admin.fee.transfer')->with([
            "success" => "Fee created successfully"
        ]);
    }

    public function transfer_modify($id){
        $datas['data']=TransferFee::find($id);
        if(! $datas['data']){
            return redirect()->route('admin.fee.transfer')->with([
                "danger" => "Fee not found"
            ]);
        }

        return view('admin.fees.transfer_modify', $datas);
    }

    public function transfer_update(Request $request){
        $input = $request->all();

        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'fee' => 'required|max:200',
            'range' => 'required|max:200',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $t=TransferFee::find($input['id']);

        $t->fee=$input['fee'];
        $t->range_set=$input['range'];
        $t->save();

        return redirect()->route('admin.fee.transfer')->with([
            "success" => "Fee updated successfully"
        ]);
    }



    public function cashout(){
        $datas['datas'] = CashoutFee::get();
        $datas['i'] = 1;

        return view('admin.fees.cashout', $datas);
    }

    public function cashout_create(){
        $datas['datas']=User::where([["agent", 1], ["sub_agent", NULL]])->get();
        return view('admin.fees.cashout_create', $datas);
    }

    public function cashout_create_post(Request $request){
        $input = $request->all();

        $validator = Validator::make($request->all(), [
            'fee' => 'required|max:200',
            'range' => 'required|max:200',
            'description' => 'required',
            'agent_uuid' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        CashoutFee::create([
            "fee" => $input['fee'],
            "range_set" => $input['range'],
            "description" => $input['description'],
            "agent_uuid" => $input['agent_uuid'],
        ]);

        return redirect()->route('admin.fee.cashout')->with([
            "success" => "Fee created successfully"
        ]);
    }

    public function deleteCashout($id){
        $dt=CashoutFee::find($id);
        if(!$dt){
            return redirect()->route('admin.fee.cashout')->with([
                "danger" => "Fee not found"
            ]);
        }
        $dt->delete();

        return redirect()->route('admin.fee.cashout')->with([
            "success" => "Fee deleted successfully"
        ]);
    }

    public function cashout_modify($id){
        $datas['data']=CashoutFee::find($id);
        if(! $datas['data']){
            return redirect()->route('admin.fee.cashout')->with([
                "danger" => "Fee not found"
            ]);
        }

        return view('admin.fees.cashout_modify', $datas);
    }

    public function cashout_update(Request $request){
        $input = $request->all();

        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'fee' => 'required|max:200',
            'range' => 'required|max:200',
            'description' => 'required|max:200'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $t=CashoutFee::find($input['id']);

        $t->fee=$input['fee'];
        $t->range_set=$input['range'];
        $t->description=$input['description'];
        $t->save();

        return redirect()->route('admin.fee.cashout')->with([
            "success" => "Fee updated successfully"
        ]);
    }





    public function poswithdrawal(){
        $datas['datas'] = PoswithdrawalFee::get();
        $datas['i'] = 1;

        return view('admin.fees.poswithdrawal', $datas);
    }



    public function deletePoswithdrawal($id){
        $dt=PoswithdrawalFee::find($id);
        if(!$dt){
            return redirect()->route('admin.fee.poswithdrawal')->with([
                "danger" => "Fee not found"
            ]);
        }
        $dt->delete();

        return redirect()->route('admin.fee.poswithdrawal')->with([
            "success" => "Fee deleted successfully"
        ]);
    }


    public function poswithdrawal_create(){
        return view('admin.fees.poswithdrawal_create');
    }

    public function poswithdrawal_create_post(Request $request){
        $input = $request->all();

        $validator = Validator::make($request->all(), [
            'fee' => 'required|max:200',
            'range' => 'required|max:200',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        PoswithdrawalFee::create([
            "fee" => $input['fee'],
            "fee_percent" => $input['fee_percent'],
            "range_set" => $input['range'],
            "minimum_fee" => $input['minimum_fee'],
            "capped_fee" => $input['capped_fee'],
            "description" => $input['description'],
        ]);

        return redirect()->route('admin.fee.poswithdrawal')->with([
            "success" => "Fee created successfully"
        ]);
    }

    public function poswithdrawal_modify($id){
        $datas['data']=PoswithdrawalFee::find($id);
        if(! $datas['data']){
            return redirect()->route('admin.fee.cashout')->with([
                "danger" => "Fee not found"
            ]);
        }

        return view('admin.fees.poswithdrawal_modify', $datas);
    }


    public function poswithdrawal_update(Request $request){
        $input = $request->all();

        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'fee' => 'required|max:200',
            'range_set' => 'required|max:200',
            'description' => 'required|max:200',
            'fee_percent' => 'required|max:200',
            'capped_fee' => 'required|max:200',
            'minimum_fee' => 'required|max:200'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $t=PoswithdrawalFee::find($input['id']);

        $t->fee=$input['fee'];
        $t->range_set=$input['range_set'];
        $t->description=$input['description'];
        $t->fee_percent=$input['fee_percent'];
        $t->capped_fee=$input['capped_fee'];
        $t->minimum_fee=$input['minimum_fee'];
        $t->save();

        return redirect()->route('admin.fee.poswithdrawal')->with([
            "success" => "Fee updated successfully"
        ]);
    }

}
