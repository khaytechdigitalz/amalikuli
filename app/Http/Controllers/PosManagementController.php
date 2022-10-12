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

    public function terminalsTransaction($id)
    {
        $terminal=Terminal::find($id);

        if(!$terminal){
            return back()->withInput()->with('error', 'Invalid terminal');
        }

        $datas['terminal']=$terminal;
        $datas['i']=1;

//        $response='{"list":[{"reference":"WDL-9ea53114-fbdc-41a3-b892-9be7b450961e-CREDIT","amount":8.45,"transactionType":"CREDIT","balance":1793876.9,"timeCreated":"2022-07-19T08:35:22.518+0100"},{"reference":"WDL-21e0786b-5bc1-4d1b-9546-e2e57b16f795-CREDIT","amount":8.45,"transactionType":"CREDIT","balance":1793860,"timeCreated":"2022-07-18T01:09:06.368+0100"},{"reference":"WDL-f5944c2c-a6c0-4d79-9221-e21452b54e04-CREDIT","amount":8.45,"transactionType":"CREDIT","balance":1793860,"timeCreated":"2022-07-18T00:44:12.162+0100"},{"reference":"WDL-df81cda7-a4cf-4a39-af79-d6a3e951ccd4-CREDIT","amount":5450,"transactionType":"CREDIT","balance":1788410,"timeCreated":"2022-07-17T20:57:42.703+0100"},{"reference":"TRF-1b25243a-f4e3-4bc9-a7a0-524d2df640e9-DEBIT","amount":527,"transactionType":"DEBIT","balance":1788410,"timeCreated":"2022-07-13T12:28:20.812+0100"}],"page":1,"size":0,"total":91}';
//        $datas['transactions'] =json_decode($response);


        $auth=$this->login();

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('GRUPPTERMINAL_SAMJI_BASEURL').'grupp-terminal-transactions',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
    "terminal": "'.$auth['data']['terminalId'].'",
    "session": "'.$auth['data']['sessionId'].'"
}',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic cmVzdGRldmljZTo1TkRNMU5qY2tKVjRLSw==',
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

//        dd($response);

        $resp=json_decode($response);

        $datas['transactions'] =$resp->list;

        return view('terminals_transactions', $datas);
    }

    function login(){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('GRUPPTERMINAL_SAMJI_BASEURL').'grupp-login',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
    "serialNumber": "63201125995137",
    "stan": "123456",
    "onlyAccountInfo": false
}',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic cmVzdGRldmljZTo1TkRNMU5qY2tKVjRLSw==',
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response, true);
    }

}
