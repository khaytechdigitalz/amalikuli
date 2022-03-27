<?php


use App\Http\Controllers\Admin\FeesController;
use App\Http\Controllers\Admin\IncentiveController;
use App\Http\Controllers\Admin\Role;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WalletController;
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


Route::get('admin/login', function () {
    return view('admin/login');
});
Route::get('admin/dashboard', function () {
    return view('admin/dashboard');
});
Route::get('admin/all-subagent', function () {
    return view('admin/all-subagent');
});


Route::prefix('admin')->group(function () {

//    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('dashboard', [UserController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('all-agents', [UserController::class, 'agents'])->name('admin.agents');
    Route::get('agent/{id}', [UserController::class, 'viewagent'])->name('admin.view.agent');
    Route::post('addterminal/{id}', [UserController::class, 'addterminal'])->name('admin.addterminal');
    Route::get('subagentTransactions/{id}', [UserController::class, 'subagentTransactions'])->name('admin.subagentTransactions');
    Route::get('all-sub-agents', [UserController::class, 'subagents'])->name('admin.all-sub-agents');
    Route::get('posmanagement', [UserController::class, 'posmanagement'])->name('admin.posmanagement');
    Route::post('posmanagement', [UserController::class, 'posmanagementcreate']);
    Route::get('unassigned-terminal', [UserController::class, 'posmanagementu'])->name('admin.posmanagementu');
    Route::get('assigned-terminal', [UserController::class, 'posmanagementa'])->name('admin.posmanagementa');
    Route::get('pos-terminal/{id}', [UserController::class, 'posterminal'])->name('admin.posterminal');
    Route::get('kycs', [UserController::class, 'kycs'])->name('admin.kycs');
    Route::get('kyc/{id}', [UserController::class, 'kyc'])->name('admin.viewkyc');

    Route::get('kycs-successful', [UserController::class, 'kycsSuccessful'])->name('admin.kycs.successful');

    Route::get('kycs-pending', [UserController::class, 'kycsrejected'])->name('admin.kycs.rejected');

    Route::get('kyc-details/{id}', [UserController::class, 'kyc'])->name('admin.kyc');

    Route::get('kyc-approve/{id}', [UserController::class, 'kycapprove'])->name('admin.kyc.approve');
    Route::get('kyc-reject/{id}', [UserController::class, 'kycreject'])->name('admin.kyc.reject');

    Route::get('kycapprove/{id}', [UserController::class, 'kycapprovenow'])->name('admin.kyc.approvenow');
    Route::get('kycreject/{id}', [UserController::class, 'kycrejectnow'])->name('admin.kyc.rejectnow');
    Route::post('managekyc', [UserController::class, 'managekyc'])->name('admin.kyc.manage');

    Route::get('/settings', [UserController::class, 'settings'])->name('admin.generalsettings');
    Route::post('/settings', [UserController::class, 'settingspost']);
    Route::get('/payment/settings', [UserController::class, 'paymentsettings'])->name('admin.paymentsettings');

    Route::get('users', [UserController::class, 'users'])->name('admin.users');

    Route::get('admins', [UserController::class, 'admins'])->name('admin.admins');

    Route::get('/create-admin', [UserController::class, 'createAdminI'])->name('admin.create');

    Route::post('/create-admin', [UserController::class, 'createAdmin'])->name('admin.createPost');

    Route::get('/edit-admin/{id}', [UserController::class, 'adminEdit'])->name('admin.adminEdit');

    Route::post('/update-admin', [UserController::class, 'adminUpdate'])->name('admin.adminUpdate');


    Route::get('/fee-transfer', [FeesController::class, 'transfer'])->name('admin.fee.transfer');
    Route::get('/fee-transfer/delete/{id}', [FeesController::class, 'deleteTransfer'])->name('admin.fee.transfer.delete');
    Route::get('/fee-transfer/{id}', [FeesController::class, 'transfer_modify'])->name('admin.fee.transfer.modify');
    Route::get('/fee-transfer-create', [FeesController::class, 'transfer_create'])->name('admin.fee.transfer.create');
    Route::post('/fee-transfer-create', [FeesController::class, 'transfer_create_post'])->name('admin.fee.transfer.create');
    Route::post('/fee-transfer-update', [FeesController::class, 'transfer_update'])->name('admin.fee.transfer.update');

    Route::get('/fee-cashout', [FeesController::class, 'cashout'])->name('admin.fee.cashout');
    Route::get('/fee-cashout/delete/{id}', [FeesController::class, 'deleteCashout'])->name('admin.fee.cashout.delete');
    Route::get('/fee-cashout/{id}', [FeesController::class, 'cashout_modify'])->name('admin.fee.cashout.modify');
    Route::get('/fee-cashout-create', [FeesController::class, 'cashout_create'])->name('admin.fee.cashout.create');
    Route::post('/fee-cashout-create', [FeesController::class, 'cashout_create_post'])->name('admin.fee.cashout.create');
    Route::post('/fee-cashout-update', [FeesController::class, 'cashout_update'])->name('admin.fee.cashout.update');

    Route::get('/fee-poswithdrawal', [FeesController::class, 'poswithdrawal'])->name('admin.fee.poswithdrawal');
    Route::get('/fee-poswithdrawal/delete/{id}', [FeesController::class, 'deletePoswithdrawal'])->name('admin.fee.poswithdrawal.delete');
    Route::get('/fee-poswithdrawal/{id}', [FeesController::class, 'poswithdrawal_modify'])->name('admin.fee.poswithdrawal.modify');
    Route::get('/fee-poswithdrawal_create', [FeesController::class, 'poswithdrawal_create'])->name('admin.fee.poswithdrawal.create');
    Route::post('/fee-poswithdrawal_create', [FeesController::class, 'poswithdrawal_create_post'])->name('admin.fee.poswithdrawal.create');
    Route::post('/fee-poswithdrawal_update', [FeesController::class, 'poswithdrawal_update'])->name('admin.fee.poswithdrawal.update');

    Route::get('/incentive-flat', [IncentiveController::class, 'flat'])->name('admin.incentive.flat');
    Route::get('/incentive-flat/delete/{id}', [IncentiveController::class, 'deleteFlat'])->name('admin.incentive.flat.delete');
    Route::get('/incentive-flat-create', [IncentiveController::class, 'createFlat'])->name('admin.incentive.flat.create');
    Route::post('/incentive-flat-create', [IncentiveController::class, 'create_Flat_post'])->name('admin.incentive.flat.create');

    Route::get('/incentive-percent', [IncentiveController::class, 'percent'])->name('admin.incentive.percent');
    Route::get('/incentive-percent/delete/{id}', [IncentiveController::class, 'deletePercent'])->name('admin.incentive.percent.delete');
    Route::get('/incentive-flat-create', [IncentiveController::class, 'createPercent'])->name('admin.incentive.percent.create');
    Route::post('/incentive-flat-create', [IncentiveController::class, 'create_Percent_post'])->name('admin.incentive.percent.create');


    Route::get('roles', [Role::class, 'roles'])->name('admin.roles');
    Route::get('role-edit/{id}', [Role::class, 'roleedit'])->name('admin.roleedit');
    Route::post('role-update', [Role::class, 'roleupdate'])->name('admin.roleupdate');
    Route::get('role-create', [Role::class, 'roleCreate'])->name('admin.roleCreateGet');
    Route::post('role-create', [Role::class, 'roleCreatePost'])->name('admin.roleCreatePost');


    Route::get('permissions', [Role::class, 'permissions'])->name('admin.permissions');
    Route::get('permission-edit/{id}', [Role::class, 'permissionedit'])->name('admin.permissionedit');
    Route::post('permission-update', [Role::class, 'permissionUpdate'])->name('admin.permissionupdate');

    Route::get('audits', [UserController::class, 'auditTrails'])->name('admin.auditTrails');

    Route::get('deposit_wallet', [WalletController::class, 'deposit'])->name('admin.deposit');
    Route::get('payout_wallet', [WalletController::class, 'payout'])->name('admin.payout');
    Route::get('profit_wallet', [WalletController::class, 'profit'])->name('admin.profit');

    Route::get('/admin/trans', function () {
        return view('admin/trans');
    });
});

Route::get('/admin/login', function () {
    return view('admin/login');
});
Route::get('/admin/pass', function () {
    return view('admin/pass');
});


Route::get('/kyc/{filename}', function ($filename) {
    $path = storage_path('app/kyc/' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }
    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
    return $response;
})->name('show.kyc');


