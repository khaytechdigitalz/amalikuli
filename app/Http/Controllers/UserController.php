<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function kycs()
    {
        $datas['wallet'] = Wallet::where('user_id', Auth::id())->first()->balance;
        $datas['agent'] = User::where([['uuid', Auth::user()->uuid], ['sub_agent', 1]])->count();
        $datas['trans_count'] = Transaction::where('user_id', Auth::id())->count();
        $datas['trans'] = Transaction::where('user_id', Auth::id())->latest()->limit(10)->get();
        return view('dashboard', $datas);
    }
   
    public function dashboard()
    {
        $datas['wallet'] = Wallet::where('user_id', Auth::id())->first()->balance;
        $datas['agent'] = User::where([['uuid', Auth::user()->uuid], ['sub_agent', 1]])->count();
        $datas['trans_count'] = Transaction::where('user_id', Auth::id())->count();
        $datas['trans'] = Transaction::where('user_id', Auth::id())->latest()->limit(10)->get();
        return view('dashboard', $datas);
    }

//    public function dashboard()
//    {
//        $datas['wallet'] = Wallet::where('user_id', Auth::id())->first()->balance;
//        $datas['trans_count'] = Transaction::where('user_id', Auth::id())->count();
//        $datas['trans'] = Transaction::where('user_id', Auth::id())->latest()->limit(10)->get();
//
//        $datas['wallet_number']="3725534863";
//
//        return view('dashboard_subagent', $datas);
//    }

    public function updateProfile(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($request->all(), [
            'firstname' => 'required|max:200',
            'lastname' => 'required|max:200',
            'email' => 'required|email|max:200',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $u = User::find(Auth::id());

        if (!$u) {
            return back()->withInput()->with('error', 'Unable to find account');
        }

        $u->firstname = $input['firstname'];
        $u->lastname = $input['lastname'];
        $u->email = $input['email'];
        $u->save();

        return back()->withInput()->with('success', 'Profile updated successfully');
    }
}
