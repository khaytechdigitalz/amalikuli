<?php

namespace App\Http\Controllers\Admin;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Setting;
use App\Models\Terminal;
use App\Models\Kyc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    ######ADMIN OPERATIONS FROM ADMIN ROUTE############
    


    public function dashboard()
    {
        $datas['balance'] = Wallet::sum('balance');
        $datas['agent'] = User::whereSubAgent(null)->count();
        $datas['trx'] = Transaction::count();
        $datas['trans'] = Transaction::latest()->limit(10)->get();

        return view('admin.dashboard', $datas);
    }

    public function agents()
    {
        $datas['agents'] = User::whereSubAgent(null)->whereSuperadmin(0)->get();

        return view('admin.all-agent', $datas);
    }


    public function viewagent($id)
    {
        $datas['agent'] = User::whereSubAgent(null)->whereId($id)->first();
        
        if(!$datas['agent'])
        {
        return back()->withInput()->with('error', 'Invalid Agent Account');
        }

        $datas['subagent'] = User::whereUuid($datas['agent']->uuid)->whereSubAgent(1)->count();
        $datas['subagents'] = User::whereUuid($datas['agent']->uuid)->whereSubAgent(1)->get();
        $datas['terminals'] = Terminal::whereAgentId($id)->get();
        return view('admin.view-agent', $datas);
    }

    public function addterminal(Request $request, $id)
    {
        $request->validate([
            'serialnumber'   => 'required'
        ]);

        $datas['agent'] = User::whereSubAgent(null)->whereId($id)->first();
        
        if(!$datas['agent'])
        {
        return back()->withInput()->with('error', 'Invalid Agent Account');
        }

        $terminal = Terminal::whereSerialNumber($request->serialnumber)->first();
        if(!isset($terminal))
        {
            return back()->withInput()->with('error', 'This terminal does not exist on the database. Try adding this Terminal first and try again');
        }

        if($terminal->agent_id != Null)
        {
            return back()->withInput()->with('error', 'This terminal has already been assigned to an agent');
        }
 
            $terminal->terminal_id = $terminal->terminal_id;
            $terminal->agent_id = $id;
            $terminal->sub_agent_id = null;
            $terminal->serial_number = $terminal->serial_number;
            $terminal->status = 1;
            $terminal->save();
       

        if ($terminal) {
            return back()->withInput()->with('success', 'Terminal added to Agent successfuly');
        } else {
            return back()->withInput()->with('error', 'Error while adding terminal');
        } 
    }

    public function subagentTransactions($id)
    {

        $datas['datas'] = Transaction::where('user_id', $id)->get();
        $datas['tran_count'] = Transaction::where([['user_id', $id], ['created_at', 'LIKE', '%' . Carbon::now()->format('Y-m-d') . '%']])->count();
        $datas['tran_sum'] = Transaction::where([['user_id', $id], ['created_at', 'LIKE', '%' . Carbon::now()->format('Y-m-d') . '%']])->sum('amount');
        $datas['wallet'] = Wallet::where('user_id', $id)->first();

        return view('admin.transactions_per_agent', $datas);
    }

    public function subagents()
    {
        $datas['users'] = User::where('sub_agent', 1)->latest()->get();
        return view('admin.all-subagent', $datas);
    }


    public function posmanagement()
    {
        $datas['terminals'] = Terminal::get();
        $datas['title'] = "All POS Terminals";
        $datas['total'] = Terminal::count();
        $datas['assigned'] = Terminal::whereSubAgentId(!null)->count();
        $datas['unassigned'] = Terminal::whereSubAgentId(null)->count();

        return view('admin.terminals', $datas);
    }


    public function posmanagementcreate(Request $request)
    {
        $terminal = Terminal::whereSerialNumber($request->serialnumber)->first();
        if(isset($terminal))
        {
            return back()->withInput()->with('error', 'This terminal already exist on the database');
        }
        $terminal = new Terminal();
        $terminal->terminal_id = $request->terminalid;
        $terminal->serial_number = $request->serialnumber;
        $terminal->save();

        
        if ($terminal) {
            return back()->withInput()->with('success', 'Terminal created successfuly');
        } else {
            return back()->withInput()->with('error', 'Error while creating terminal');
        } 
    }



    public function posmanagementu()
    {
        $datas['terminals'] = Terminal::whereSubAgentId(null)->get();
        $datas['title'] = "Unassigned POS Terminals";
        $datas['total'] = Terminal::count();
        $datas['assigned'] = Terminal::whereSubAgentId(!null)->count();
        $datas['unassigned'] = Terminal::whereSubAgentId(null)->count();

        return view('admin.terminals', $datas);
    }



    public function posmanagementa()
    {
        $datas['terminals'] = Terminal::whereSubAgentId(!null)->get();
        $datas['title'] = "Assigned POS Terminals";
        $datas['total'] = Terminal::count();
        $datas['assigned'] = Terminal::whereSubAgentId(!null)->count();
        $datas['unassigned'] = Terminal::whereSubAgentId(null)->count();

        return view('admin.terminals', $datas);
    }



    public function posterminal($id)
    {
        $terminal= Terminal::whereId($id)->first();
         if($terminal->status == 1)
         {
             $terminal->status = 0;
         }
         else
         {
            $terminal->status = 1;
        }
        $terminal->save();
        return back()->withInput()->with('success', 'POS Terminal Status updated successfully');

    }


    public function kycs()
    {
        $datas['title'] = "KYC Verification";
        $datas['verified'] = Kyc::whereStatus(1)->count();
        $datas['unverified'] = Kyc::whereStatus(0)->count();
        $datas['all'] = Kyc::all();

        return view('admin.kyc', $datas);
    }



    public function kycsSuccessful()
    {
        $datas['title'] = "Approved KYC Verification";
        $datas['verified'] = Kyc::whereStatus(1)->count();
        $datas['unverified'] = Kyc::whereStatus(0)->count();
        $datas['all'] = Kyc::whereStatus(1)->get();

        return view('admin.kyc', $datas);
    }



    public function kycsrejected()
    {
        $datas['title'] = "Pnding KYC Verification";
        $datas['verified'] = Kyc::whereStatus(1)->count();
        $datas['unverified'] = Kyc::whereStatus(0)->count();
        $datas['all'] = Kyc::whereStatus(0)->get();

        return view('admin.kyc', $datas);
    }


    public function kyc($id)
    {
        $datas['title'] = "View KYC Verification";
        $datas['kyc'] = Kyc::whereId($id)->first();

        return view('admin.view-kyc', $datas);
    }


    public function kycapprove($id)
    {
        $datas['title'] = "View KYC Verification";
        $kyc = Kyc::whereId($id)->first();
        $kyc->status = 1;
        $kyc->save();
        return back()->withInput()->with('success', 'KYC Approved successfully');

    }
    public function kycreject($id)
    {
        $datas['title'] = "View KYC Verification";
        $kyc = Kyc::whereId($id)->first();
        $kyc->status = 2;
        $kyc->save();
        return back()->withInput()->with('success', 'KYC Rejected successfully');

    }


    public function settings()
    {
        $datas['title'] = "System Settings";
        $datas['general'] = Setting::first(); 

        return view('admin.settings', $datas);
    }


    public function settingspost(Request $request)
    {
        $datas['title'] = "System Settings";
        $general = Setting::first(); 
        $general->sitename = $request->sitename;
        $general->cur_text = $request->cur_text;
        $general->float_min_trx = $request->float_min_trx;
        $general->float_min_count = $request->float_min_count;
        $general->float_min_month = $request->float_min_month;


        $general->float_min_amount = $request->float_min;
        $general->float_max_amount = $request->float_max;
        $general->float_min_tenure = $request->float_min_tenure;
        $general->float_max_tenure = $request->float_max_tenure;
        $general->float_int_flat = $request->float_int_flat;
        $general->float_int_percent = $request->float_int_percent;
        $general->float_fee = $request->float_fee; 
        $general->save();
        return back()->withInput()->with('success', 'General Settings Updated successfully');
    }

    public function paymentsettings()
    {
        $datas['title'] = "Payment Settings";
        $datas['general'] = Setting::first(); 

        return view('admin.settings', $datas);
    }

   


    ######ADMIN OPERATIONS FROM ADMIN ROUTE############






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
