<?php

namespace App\Http\Controllers;

use App\Mail\NewSubAccountMail;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Setting;
use App\Models\Loan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AgentController extends Controller
{

    public function subAgents()
    {
        $datas['users'] = User::where([["uuid", Auth::user()->uuid], ['sub_agent', 1]])->latest()->get();
        return view('agents', $datas);
    }


    public function float()
    {
        $trxcount = Transaction::where('uuid', Auth::id())->count();
        $trxsum = Transaction::where('uuid', Auth::id())->latest()->sum('amount');
        $general = Setting::first(); 
        return view('request-float',compact('general'));
        if($trxsum < $general->float_min_trx )
        {
           return redirect()->route('dashboard')->with("error", 'You are not eligible for this float at the moment. Please increase your transaction performance');
           //return redirect()->route('dashboard')->with("error", 'You need to have transacted '.$general->cur_sym.$general->float_min_trx.' before you can be eligible for loan. <br> You have transacted a total sum of '.$general->cur_sym.$trxsum);

        }
        if($trxcount < $general->float_min_count )
        {
            return redirect()->route('dashboard')->with("error", 'You are not eligible for this float at the moment. Please increase your transaction count');

            //return redirect()->route('dashboard')->with("error", 'You need to have a minimum '.$general->float_min_count.' transactions before you can be eligible for loan<br> You currenctly have a total count of '.$trxcount.' transactions');

        }
        return view('request-float',compact('general'));
    }

    public function floatpost(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($request->all(), [
            'amount' => 'required',
            'duration' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $general = Setting::first(); 
        if($request->amount < $general->float_min_amount )
        {
            return back()->withInput()->with('error', 'Invalid minimum amount entered');

        }
        if($request->amount > $general->float_max_amount )
        {
            return back()->withInput()->with('error', 'Invalid maximum amount entered');

        }
        $interest = $general->float_int_flat + ($request->amount * $general->float_int_percent / 100);
        $total = $request->amount + $interest;
        $now = Carbon::now();
        $expire = Carbon::parse($now)->addDays($request->duration);


        $loan = new Loan();
        $loan->user_id = Auth::id();
        $loan->amount = $request->amount;
        $loan->interest = $interest;
        $loan->total = $total;
        $loan->status = 0;
        $loan->reference = rand();
        $loan->expire = $expire;
        $loan->duration = $request->duration;
        $loan->save();
        return back()->withInput()->with('success', 'Loan requested successfuly');
       
    }


    public function searchSubAgents(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($request->all(), [
            'search' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $search = $input['search'];

        $datas['users'] = User::where(function ($query) use ($search) {
            $query->orwhere('lastname', 'like', '%' . $search . '%')
                ->orWhere('firstname', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orWhere('phone', 'like', '%' . $search . '%')
                ->Where('uuid', Auth::user()->uuid)
                ->Where('sub_agent', 1);
        })->get();

        return view('agents', $datas);
    }

    public function createSubAgent(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($request->all(), [
            'firstName' => 'required|max:200',
            'lastName' => 'required|max:200',
            'email' => 'required|max:200|email|unique:users',
            'dob' => 'required|max:200',
            'gender' => 'required|max:200',
            'phone' => 'required|max:11',
            'limit' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $password = uniqid();

        $u = User::create([
            'firstname' => $input['firstName'],
            'lastname' => $input['lastName'],
            'dob' => $input['dob'],
            'gender' => $input['gender'],
            'phone' => $input['phone'],
            'email' => $input['email'],
            'transaction_limit' => $input['limit'],
            'password' => Hash::make($password),
            'uuid' => Auth::user()->uuid,
            'sub_agent' => 1,
        ]);


        Wallet::create([
            'user_id' => $u->id,
            'name' => 'deposit'
        ]);


        $datas['businessName'] = Auth::user()->name;
        $datas['name'] = $input['lastName'];
        $datas['email'] = $input['email'];
        $datas['phone'] = $input['phone'];
        $datas['password'] = $password;

        try {
            Mail::to($input['email'])->send(new NewSubAccountMail($datas));
        } catch (\Exception $e) {
            echo "Mail error";
        }


        return redirect()->route('addSubAgent')->with("success", "Subagent created successfully. Login credentials has been sent to the email provided.");

    }


    public function performance()
    {
        $datas['date'] = Carbon::now()->format('y-m');
        $datas['users'] = User::where([["uuid", Auth::user()->uuid], ['sub_agent', 1]])->latest()->get();
        return view('settings.performance', $datas);
    }

    public function performanceSearch()
    {
        $datas['users'] = User::where([["uuid", Auth::user()->uuid], ['sub_agent', 1]])->latest()->get();
        return view('settings.performance', $datas);
    }

    public function agentTransactions($id)
    {

        $datas['datas'] = Transaction::where('user_id', $id)->get();
        $datas['tran_count'] = Transaction::where([['user_id', $id], ['created_at', 'LIKE', '%' . Carbon::now()->format('Y-m-d') . '%']])->count();
        $datas['tran_sum'] = Transaction::where([['user_id', $id], ['created_at', 'LIKE', '%' . Carbon::now()->format('Y-m-d') . '%']])->sum('amount');
        $datas['wallet'] = Wallet::where('user_id', $id)->first();

        return view('transactions_per_agent', $datas);
    }

    public function transactions()
    {
        $datas['datas'] = Transaction::where('uuid', Auth::user()->uuid)->get();

        return view('transactions', $datas);
    }


}
