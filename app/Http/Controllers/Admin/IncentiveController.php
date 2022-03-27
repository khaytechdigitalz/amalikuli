<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\IncentiveFlat;
use App\Models\IncentivePercent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IncentiveController extends Controller
{
    public function flat(){
        $datas['datas'] = IncentiveFlat::get();
        $datas['i'] = 1;

        return view('admin.incentive.flat', $datas);
    }


    public function deleteFlat($id){
        $dt=IncentiveFlat::find($id);
        if(!$dt){
            return redirect()->route('admin.incentive.flat')->with([
                "danger" => "Incentive not found"
            ]);
        }
        $dt->delete();

        return redirect()->route('admin.incentive.flat')->with([
            "success" => "Incentive deleted successfully"
        ]);
    }


    public function createFlat(){
        $datas['datas'] = IncentiveFlat::get();
        $datas['i'] = 1;

        return view('admin.incentive.incentive_flat_create', $datas);
    }

    public function create_Flat_post(Request $request){
        $input = $request->all();

        $validator = Validator::make($request->all(), [
            'fee' => 'required|max:200',
            'range' => 'required|max:200',
            'threshold' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        IncentiveFlat::create([
            "fee" => $input['fee'],
            "range_set" => $input['range'],
            "threshold" => $input['threshold'],
            "description" => $input['description'],
        ]);

        return redirect()->route('admin.incentive.flat')->with([
            "success" => "Incentive created successfully"
        ]);
    }




    public function percent(){
        $datas['datas'] = IncentivePercent::get();
        $datas['i'] = 1;

        return view('admin.incentive.percent', $datas);
    }


    public function deletePercent($id){
        $dt=IncentivePercent::find($id);
        if(!$dt){
            return redirect()->route('admin.incentive.percent')->with([
                "danger" => "Incentive not found"
            ]);
        }
        $dt->delete();

        return redirect()->route('admin.incentive.percent')->with([
            "success" => "Incentive deleted successfully"
        ]);
    }


    public function createPercent(){
        $datas['datas'] = IncentivePercent::get();
        $datas['i'] = 1;

        return view('admin.incentive.incentive_percent_create', $datas);
    }

    public function create_Percent_post(Request $request){
        $input = $request->all();

        $validator = Validator::make($request->all(), [
            'fee' => 'required|max:200',
            'range' => 'required|max:200',
            'threshold' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        IncentivePercent::create([
            "fee" => $input['fee'],
            "range_set" => $input['range'],
            "threshold" => $input['threshold'],
            "description" => $input['description'],
        ]);

        return redirect()->route('admin.incentive.percent')->with([
            "success" => "Incentive created successfully"
        ]);
    }



}
