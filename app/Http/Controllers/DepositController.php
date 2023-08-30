<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\BankStatement;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class DepositController extends Controller
{

    public function index()  {

        return Inertia::render('Deposit',[
            'title'=> "Deposit Money",
            'route'=> 'deposit.add',
            'btn' => 'Deposit'
        ]);
    }

    public function deposit(Request $request)
    {
        Validator::make($request->all(), [
            'amount' => 'required'

        ])->validate();

        $user  = Auth::guard('web')->user();

        $bank = Bank::where('user_id',$user->id)->first();

        $amount = $bank->amount + $request->amount;

        $bank->amount = $amount;

        $bank->save();

        BankStatement::create([
            'user_id' => $user->id,
            'bank_id' => $bank->id,
            'description' => 'Deposit',
            'amount' => $request->amount,
            'balance' => $amount,
            'status' => 'credit',
        ]);

        // return to_route('deposit.index');

        return redirect()->route('deposit.index')->with('success', 'Successfully Added');



    }

    public function withdraw(Request $request)
    {
        Validator::make($request->all(), [
            'amount' => 'required'

        ])->validate();

        $user  = Auth::guard('web')->user();

        $bank = Bank::where('user_id',$user->id)->first();

        $bank->amount = $bank->amount - $request->amount;

        $bank->save();

        BankStatement::create([
            'user_id' => $user->id,
            'bank_id' => $bank->id,
            'description' => 'Withdraw',
            'amount' => $request->amount,
            'status' => 'Debit',
        ]);

        // return to_route('deposit.index');

        return redirect()->route('deposit.index')->with('success', 'Successfully Added');

        return Inertia::render('Deposit',[
            'success' => true
        ]);

    }

}
