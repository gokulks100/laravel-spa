<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\BankStatement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class WithdrawController extends Controller
{
    public function index()
    {
            return Inertia::render('Deposit',[
                'title'=> "Withdraw Money",
                'route'=> 'withdraw.add',
                'btn' => 'Withdraw'
            ]);
    }

    public function withdraw(Request $request)
    {
        Validator::make($request->all(), [
            'amount' => 'required'

        ])->validate();

        $user  = Auth::guard('web')->user();

        $bank = Bank::where('user_id',$user->id)->first();

        $amount = $bank->amount - $request->amount;

        $bank->amount = $amount;

        $bank->save();

        BankStatement::create([
            'user_id' => $user->id,
            'bank_id' => $bank->id,
            'description' => 'Withdraw',
            'amount' => $request->amount,
            'balance' => $amount,
            'status' => 'Debit',
        ]);

        // return to_route('deposit.index');po

        return redirect()->route('withdraw.index')->with('success', 'Withdraw  successfully');

    }
}
