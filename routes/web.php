<?php

use App\Http\Controllers\DepositController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StatementController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\WithdrawController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Auth/Login', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/home', [HomeController::class,'index'])->name('home');
    Route::get('/deposit', [DepositController::class,'index'])->name('deposit.index');
    Route::post('/deposit-add', [DepositController::class,'deposit'])->name('deposit.add');

    Route::get('withdraw',[WithdrawController::class,'index'])->name('withdraw.index');
    Route::post('withdraw-add',[WithdrawController::class,'withdraw'])->name('withdraw.add');

    Route::get('transfer',[TransferController::class,'index'])->name('transfer.index');
    Route::post('transfer-add',[TransferController::class,'transfer'])->name('transfer.add');


    
    Route::get('statement',[StatementController::class,'index'])->name('statement.index');
    // Route::post('transfer-add',[TransferController::class,'transfer'])->name('transfer.add');

});
