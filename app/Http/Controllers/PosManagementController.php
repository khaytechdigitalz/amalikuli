<?php

namespace App\Http\Controllers;

use App\Models\Terminal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PosManagementController extends Controller
{
    public function terminals()
    {
        $datas['datas'] = Terminal::where('agent_id', Auth::id())->get();
        $datas['subagent'] = User::where([['uuid', Auth::user()->uuid], ['sub_agent', 1]])->get();
        $datas['i'] = 1;

        return view('terminals', $datas);
    }
    public function assignterminals(Request $request)
    {
        $request->validate([
            'serialnumber'   => 'required',
            'agent'   => 'required'
        ]);

        $datas['agent'] = User::where([['uuid', Auth::user()->uuid], ['sub_agent', 1]])->whereId($request->agent)->first();
        
        if(!$datas['agent'])
        {
        return back()->withInput()->with('error', 'Invalid Sub Agent Account');
        }

        $terminal = Terminal::whereSerialNumber($request->serialnumber)->first();
        if(!isset($terminal))
        {
            return back()->withInput()->with('error', 'This terminal does not exist on the database. Try adding this Terminal first and try again');
        }
 
 
            $terminal->sub_agent_id = $request->agent;
            $terminal->status = 1;
            $terminal->save();
       

        if ($terminal) {
            return back()->withInput()->with('success', 'Terminal assigned to Subagent successfuly');
        } else {
            return back()->withInput()->with('error', 'Error while assigning terminal');
        } 
    }

}
