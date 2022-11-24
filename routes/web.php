<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserDataController;
use App\Http\Controllers\SellerDataController;
use App\Http\Controllers\ClientDataController;
use App\Http\Controllers\CaseDataController;
use App\Http\Controllers\SettlementDataController;
use App\Http\Controllers\MarketplaceDataController;
use App\Http\Controllers\RepresentativeDataController;
use App\Http\Controllers\ExpenseDataController;
use App\Http\Controllers\IncomeDataController;
use App\Http\Controllers\LfReceivedDataController;
use App\Http\Controllers\LfSentDataController;
use App\Http\Controllers\FileHandler;
use App\Http\Controllers\ClientAccountingController;

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

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::middleware('auth:sanctum', 'check.account.status')->get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');

//marketplace
Route::middleware('auth:sanctum', 'check.account.status')->get('/getMarketplaces', [MarketplaceDataController::class, 'getMarketplaces']);

//representative
Route::middleware('auth:sanctum', 'check.account.status')->get('/getRepresentatives', [RepresentativeDataController::class, 'getRepresentatives']);

//user
Route::middleware('auth:sanctum', 'check.account.status')->get('/getUsers', [UserDataController::class, 'getUserList']);
Route::middleware('auth:sanctum', 'check.account.status')->post('/addUser', [UserDataController::class, 'addUser']);
Route::middleware('auth:sanctum', 'check.account.status')->post('/updateUser', [UserDataController::class, 'updateUser']);
Route::middleware('auth:sanctum', 'check.account.status')->post('/deleteUser', [UserDataController::class, 'deleteUser']);
Route::middleware('auth:sanctum', 'check.account.status')->get('/getLfList', [UserDataController::class, 'getLfList']);
Route::middleware('auth:sanctum', 'check.account.status')->get('/getAllowedUserList', [UserDataController::class, 'getAllowedUserList']);
Route::middleware('auth:sanctum', 'check.account.status')->get('/getClientList', [UserDataController::class, 'getClientList']);

// seller
Route::middleware('auth:sanctum', 'check.account.status')->get('/getSellers', [SellerDataController::class, 'get']);
Route::middleware('auth:sanctum', 'check.account.status')->get('/getSellerList', [SellerDataController::class, 'getList']);
Route::middleware('auth:sanctum', 'check.account.status')->post('/addSeller', [SellerDataController::class, 'create']);
Route::middleware('auth:sanctum', 'check.account.status')->post('/updateSeller', [SellerDataController::class, 'update']);
Route::middleware('auth:sanctum', 'check.account.status')->post('/deleteSeller', [SellerDataController::class, 'delete']);

// case
Route::middleware('auth:sanctum', 'check.account.status')->get('/getCases', [CaseDataController::class, 'get']);
Route::middleware('auth:sanctum', 'check.account.status')->get('/getCaseList', [CaseDataController::class, 'getList']);
Route::middleware('auth:sanctum', 'check.account.status')->post('/addCase', [CaseDataController::class, 'create']);
Route::middleware('auth:sanctum', 'check.account.status')->post('/updateCase', [CaseDataController::class, 'update']);
Route::middleware('auth:sanctum', 'check.account.status')->post('/deleteCase', [CaseDataController::class, 'delete']);

// settlement
Route::middleware('auth:sanctum', 'check.account.status')->get('/getSettlements', [SettlementDataController::class, 'get']);
Route::middleware('auth:sanctum', 'check.account.status')->get('/getSettlementList', [SettlementDataController::class, 'getSettlementList']);
Route::middleware('auth:sanctum', 'check.account.status')->post('/addSettlement', [SettlementDataController::class, 'create']);
Route::middleware('auth:sanctum', 'check.account.status')->post('/updateSettlement', [SettlementDataController::class, 'update']);
Route::middleware('auth:sanctum', 'check.account.status')->post('/deleteSettlement', [SettlementDataController::class, 'delete']);

// expense
Route::middleware('auth:sanctum', 'check.account.status')->get('/getExpenses', [ExpenseDataController::class, 'get']);
Route::middleware('auth:sanctum', 'check.account.status')->post('/addExpense', [ExpenseDataController::class, 'create']);
Route::middleware('auth:sanctum', 'check.account.status')->post('/updateExpense', [ExpenseDataController::class, 'update']);
Route::middleware('auth:sanctum', 'check.account.status')->post('/deleteExpense', [ExpenseDataController::class, 'delete']);

// income
Route::middleware('auth:sanctum', 'check.account.status')->get('/getIncomes', [IncomeDataController::class, 'get']);
Route::middleware('auth:sanctum', 'check.account.status')->post('/addIncome', [IncomeDataController::class, 'create']);
Route::middleware('auth:sanctum', 'check.account.status')->post('/updateIncome', [IncomeDataController::class, 'update']);
Route::middleware('auth:sanctum', 'check.account.status')->post('/deleteIncome', [IncomeDataController::class, 'delete']);

// lf received
Route::middleware('auth:sanctum', 'check.account.status')->get('/getLfReceived', [LfReceivedDataController::class, 'get']);
Route::middleware('auth:sanctum', 'check.account.status')->get('/getLfReceiveds', [LfReceivedDataController::class, 'get']);
Route::middleware('auth:sanctum', 'check.account.status')->post('/addLfReceived', [LfReceivedDataController::class, 'create']);
Route::middleware('auth:sanctum', 'check.account.status')->post('/updateLfReceived', [LfReceivedDataController::class, 'update']);
Route::middleware('auth:sanctum', 'check.account.status')->post('/deleteLfReceived', [LfReceivedDataController::class, 'delete']);

// lf sent
Route::middleware('auth:sanctum', 'check.account.status')->get('/getLfSent', [LfSentDataController::class, 'get']);
Route::middleware('auth:sanctum', 'check.account.status')->post('/addLfSent', [LfSentDataController::class, 'create']);
Route::middleware('auth:sanctum', 'check.account.status')->post('/updateLfSent', [LfSentDataController::class, 'update']);
Route::middleware('auth:sanctum', 'check.account.status')->post('/deleteLfSent', [LfSentDataController::class, 'delete']);

// file handler
Route::middleware('auth:sanctum', 'check.account.status')->get('/getAgreementFile', [FileHandler::class, 'getAgreementFile']);
Route::middleware('auth:sanctum', 'check.account.status')->get('/getExpenseFile', [FileHandler::class, 'getExpenseFile']);
Route::middleware('auth:sanctum', 'check.account.status')->get('/getLfSentFile', [FileHandler::class, 'getLfSentFile']);

// client accounting
Route::middleware('auth:sanctum', 'check.account.status')->get('/getClientAccountingAll', [ClientAccountingController::class, 'getClientAccountingAll']);
Route::middleware('auth:sanctum', 'check.account.status')->get('/getClientAccountingRange', [ClientAccountingController::class, 'getClientAccountingRange']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'doLogin']);

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
