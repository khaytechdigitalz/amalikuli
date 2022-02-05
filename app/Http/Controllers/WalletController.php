<?php

namespace App\Http\Controllers;

use App\Models\WalletTransaction;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    public function history()
    {
        $datas['datas'] = WalletTransaction::where('uuid', Auth::user()->uuid)->get();
        return view('wallet_history', $datas);
    }

    public function withdraw()
    {
        return view('wallet_withdraw');
    }
}
