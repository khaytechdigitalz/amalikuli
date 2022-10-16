<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Terminal;
use App\Models\Customer;
use App\Models\Loan;
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

    public function dashboard(Request $request)
    {
        $user = auth()->user();
        if($user->superadmin > 0)
            {

             return redirect()->route('admin.dashboard')->with('success', 'Welcome');

            }

            $input = $request->all();
            if($input)
           {
               $datas['trans'] = Transaction::where('user_id', Auth::id())->whereBetween('created_at',[$request->from,$request->to])->Orwhere('type',$request->type)->latest()->get();
           }
           else
           {
               $datas['trans'] = Transaction::where('user_id', Auth::id())->latest()->get();
           }

           $year = date('Y');
           $month = date('m');
           $day = date('d');

           $jan = '01';
           $feb = '02';
           $mar = '03';
           $apr = '04';
           $may = '05';
           $jun = '06';
           $jul = '07';
           $aug = '08';
           $sep = '09';
           $oct = '10';
           $nov = '11';
           $dec = '12';

           $datas['cjan'] = Transaction::where('user_id', Auth::id())->whereYear('created_at', $year)->whereMonth('created_at', $jan)->whereType('Credit')->sum('amount');
           $datas['cfeb'] = Transaction::where('user_id', Auth::id())->whereYear('created_at', $year)->whereMonth('created_at', $feb)->whereType('Credit')->sum('amount');
           $datas['cmar'] = Transaction::where('user_id', Auth::id())->whereYear('created_at', $year)->whereMonth('created_at', $mar)->whereType('Credit')->sum('amount');
           $datas['capr'] = Transaction::where('user_id', Auth::id())->whereYear('created_at', $year)->whereMonth('created_at', $apr)->whereType('Credit')->sum('amount');
           $datas['cmay'] = Transaction::where('user_id', Auth::id())->whereYear('created_at', $year)->whereMonth('created_at', $may)->whereType('Credit')->sum('amount');
           $datas['cjun'] = Transaction::where('user_id', Auth::id())->whereYear('created_at', $year)->whereMonth('created_at', $jun)->whereType('Credit')->sum('amount');
           $datas['cjul'] = Transaction::where('user_id', Auth::id())->whereYear('created_at', $year)->whereMonth('created_at', $jul)->whereType('Credit')->sum('amount');
           $datas['caug'] = Transaction::where('user_id', Auth::id())->whereYear('created_at', $year)->whereMonth('created_at', $aug)->whereType('Credit')->sum('amount');
           $datas['csep'] = Transaction::where('user_id', Auth::id())->whereYear('created_at', $year)->whereMonth('created_at', $sep)->whereType('Credit')->sum('amount');
           $datas['coct'] = Transaction::where('user_id', Auth::id())->whereYear('created_at', $year)->whereMonth('created_at', $oct)->whereType('Credit')->sum('amount');
           $datas['cnov'] = Transaction::where('user_id', Auth::id())->whereYear('created_at', $year)->whereMonth('created_at', $nov)->whereType('Credit')->sum('amount');
           $datas['cdec'] = Transaction::where('user_id', Auth::id())->whereYear('created_at', $year)->whereMonth('created_at', $dec)->whereType('Credit')->sum('amount');

           $datas['djan'] = Transaction::where('user_id', Auth::id())->whereYear('created_at', $year)->whereMonth('created_at', $jan)->whereType('Debit')->sum('amount');
           $datas['dfeb'] = Transaction::where('user_id', Auth::id())->whereYear('created_at', $year)->whereMonth('created_at', $feb)->whereType('Debit')->sum('amount');
           $datas['dmar'] = Transaction::where('user_id', Auth::id())->whereYear('created_at', $year)->whereMonth('created_at', $mar)->whereType('Debit')->sum('amount');
           $datas['dapr'] = Transaction::where('user_id', Auth::id())->whereYear('created_at', $year)->whereMonth('created_at', $apr)->whereType('Debit')->sum('amount');
           $datas['dmay'] = Transaction::where('user_id', Auth::id())->whereYear('created_at', $year)->whereMonth('created_at', $may)->whereType('Debit')->sum('amount');
           $datas['djun'] = Transaction::where('user_id', Auth::id())->whereYear('created_at', $year)->whereMonth('created_at', $jun)->whereType('Debit')->sum('amount');
           $datas['djul'] = Transaction::where('user_id', Auth::id())->whereYear('created_at', $year)->whereMonth('created_at', $jul)->whereType('Debit')->sum('amount');
           $datas['daug'] = Transaction::where('user_id', Auth::id())->whereYear('created_at', $year)->whereMonth('created_at', $aug)->whereType('Debit')->sum('amount');
           $datas['dsep'] = Transaction::where('user_id', Auth::id())->whereYear('created_at', $year)->whereMonth('created_at', $sep)->whereType('Debit')->sum('amount');
           $datas['doct'] = Transaction::where('user_id', Auth::id())->whereYear('created_at', $year)->whereMonth('created_at', $oct)->whereType('Debit')->sum('amount');
           $datas['dnov'] = Transaction::where('user_id', Auth::id())->whereYear('created_at', $year)->whereMonth('created_at', $nov)->whereType('Debit')->sum('amount');
           $datas['ddec'] = Transaction::where('user_id', Auth::id())->whereYear('created_at', $year)->whereMonth('created_at', $dec)->whereType('Debit')->sum('amount');



        $datas['wallet'] = Wallet::where('user_id', Auth::id())->first()->balance;
        $datas['agent'] = User::where([['uuid', Auth::user()->uuid], ['sub_agent', 1]])->count();
        $datas['trans_count'] = Transaction::where('user_id', Auth::id())->count();
        //$datas['trans'] = Transaction::where('user_id', Auth::id())->latest()->limit(10)->get();
        $datas['customer'] = Customer::where('creator_uuid', $user->uuid)->latest()->count();
        $datas['terminals'] = Terminal::where('agent_id', $user->id)->latest()->count();
        $datas['float'] = Loan::where('user_id', $user->id)->where('status','>',0)->count();
        $datas['agentfloat'] = Loan::where('agent', $user->uuid)->where('status','>',0)->count();

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
