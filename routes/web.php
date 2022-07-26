<?php

use App\Http\Controllers\AgentController;
use App\Http\Controllers\BillsPaymentController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\PosManagementController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VFDController;
use App\Http\Controllers\WalletController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/bankList', [\App\Http\Controllers\VFDController::class, 'bankList'])->name('bankList');

Route::get('/testgterminal', [\App\Http\Controllers\GruppTerminalController::class, 'sessionid'])->name('sessionid');
Route::get('grupp-transactions', [\App\Http\Controllers\GruppTerminalController::class, 'transaction'])->name('admin.grupp.terminal');

Route::get('/', function () {
//    return view('welcome');
    return redirect()->route('login');
});

Route::get('/kyc/{filename}', function ($filename) {
    $path = storage_path('app/public/kyc/' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }
    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
    return $response;
})->name('show.kyc');

Route::get('/logout', function () {
    \Illuminate\Support\Facades\Auth::logout();
    return redirect()->route('login')->with('success', 'Account logout successfully');
})->name('logout');

Route::middleware(['auth:sanctum', 'verified', 'AdminCheck'])->group(function () {

    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');

    Route::post('vpay', [VFDController::class, 'accountTransfer'])->name('vpay');

    Route::post('pay', [VFDController::class, 'accountTransfer12'])->name('pay');

    Route::get('add-sub-agent', function () {
        return view('add-agent');
    })->name('addSubAgent');

    Route::post('/create-sub-agent', [AgentController::class, 'createSubAgent'])->name('createSubAgent');

    Route::get('/agents', [AgentController::class, 'subAgents'])->name('agents');

    Route::post('/agents', [AgentController::class, 'searchSubAgents'])->name('searchSubAgents');

    Route::get('/float', [AgentController::class, 'float'])->name('float');
    Route::get('/float/loangit', [AgentController::class, 'float'])->name('floatloan');

    Route::post('/float', [AgentController::class, 'floatpost'])->name('floatrequest');

    Route::get('add-customer', function () {
        return view('add-user');
    })->name('add-customer');

    Route::get('add-customer-otp', function () {
        return view('add-user-otp');
    })->name('addCustomerOTP');

    Route::get('/customers', [CustomersController::class, 'fetchCustomers'])->name('customers');
    Route::post('/create-customer', [CustomersController::class, 'createCustomer'])->name('createCustomer');
    Route::post('/create-customer-otp', [CustomersController::class, 'createCustomerOtp'])->name('createCustomerOTP');

    Route::get('/debit-card', [CustomersController::class, 'fetchDebitcard'])->name('debit-card');

    Route::get('debit-card-otp', function () {
        return view('debit-card-otp');
    })->name('debit-card-OTP');

    Route::post('/debit-card-verify', [CustomersController::class, 'verifyDebitcard'])->name('verifyDebitcard');
    Route::post('/debit-card-proceed', [CustomersController::class, 'debitCardProceed'])->name('debit-card-proceed');


    Route::post('/update-profile', [UserController::class, 'updateProfile'])->name('update-profile');

    Route::get('/terminals', [PosManagementController::class, 'terminals'])->name('terminals');
    Route::get('/terminals/{id}', [PosManagementController::class, 'terminalsTransaction'])->name('terminalsTransaction');
    Route::post('/terminals', [PosManagementController::class, 'assignterminals']);
    Route::get('/transactions/{id}/subagent', [AgentController::class, 'agentTransactions'])->name('agentTransactions');
    Route::get('/wallet/history', [WalletController::class, 'history'])->name('walletHistory');
    Route::get('/wallet/withdraw', [WalletController::class, 'withdraw'])->name('walletWithdraw');
    Route::get('/transactions', [AgentController::class, 'transactions'])->name('transactions');


    Route::get('/profile', function () {
        return view('settings/pro');
    })->name('profile');

    Route::get('/settings', function () {
        return view('profile');
    })->name('settings');


    Route::get('settings/performance', [AgentController::class, 'performance'])->name('agent.performance');
    Route::post('settings/performance', [AgentController::class, 'performanceSearch'])->name('agent.performanceSearch');

    Route::get('/posmanagement', function () {
        return view('posmanagement');
    });

    Route::get('/bill-payment', function (){
        return view('bill-payment');
    });




    Route::get('transfer', [VFDController::class, 'bankList'])->name('transfer');


    Route::get('/bills/airtime', function () {
        return view('bills/airtime');
    })->name('bills.airtime');
    Route::post('buyAirtime', [BillsPaymentController::class, 'buyAirtime'])->name('buyAirtime');

    Route::get('bills/data', [BillsPaymentController::class, 'data'])->name('bills.data');
    Route::post('bills/dataplans', [BillsPaymentController::class, 'dataPlans'])->name('bills.dataplans');
    Route::post('bills/buydata', [BillsPaymentController::class, 'buyDataPlans'])->name('bills.buydata');

    Route::get('/bills/tv', function () {
        return view('bills/tv');
    })->name('bills.tv');
    Route::post('bills/list', [BillsPaymentController::class, 'TVPlans'])->name('bills.list');
    Route::get('bills/renewtv', [BillsPaymentController::class, 'renewTV'])->name('bills.renewtv');
    Route::post('bills/tvlist', [BillsPaymentController::class, 'validateTV'])->name('bills.tvlist');
    Route::post('bills/changeTVSub', [BillsPaymentController::class, 'changeTVSub'])->name('bills.changeTVSub');

    Route::get('bills/elect', [BillsPaymentController::class, 'electricityList'])->name('bills.elect');
    Route::post('biils/verifyelect', [BillsPaymentController::class, 'validateElectricity'])->name('bills.verifyelect');
    Route::post('bills/pay', [BillsPaymentController::class, 'purchaseElectricity'])->name('bills.pay');

    Route::post('verify', [VFDController::class, 'validateBankAccount'])->name('verify');


    Route::get('/wallet/transfer', function () {
        return view('wallet_transfer');
    })->name('walletTransfer');

    Route::get('/bills/receipt', function () {
        return view('bills/receipt');
    });

    Route::get('/settings/preferences', function () {
        return view('settings/preferences');
    });

    Route::get('/settings/noti', function () {
        return view('settings/noti');
    });
    Route::get('/settings/pass', function () {
        return view('settings/pass');
    });
    Route::get('/settings/delete', function (){
        return view('settings/delete');
    });
    Route::post('bills.bill', [BillsPaymentController::class, 'buyAirtime'])->name('bills.bill');

});

require __DIR__ . '/admin.php';
