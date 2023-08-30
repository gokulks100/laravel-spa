<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\BankStatement;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class TransferController extends Controller
{

    public function index()
    {
            return Inertia::render('Deposit',[
                'title'=> "Transfer Money",
                'route'=> 'transfer.add',
                'input' => true,
                'btn' => 'Transfer'
            ]);
    }

    public function transfer(Request $request)
    {
        Validator::make($request->all(), [
            'email' => 'required',
            'amount' => 'required',

        ])->validate();


        DB::beginTransaction();
        try{
            $user  = Auth::guard('web')->user();

            $transfer_account = User::where('email',$request->email)->first();

            if(!isset($transfer_account))
            {
                return redirect()->route('transfer.index')->with('error', 'Account not found, Try again in another account!');
            }

            $bank = Bank::where('user_id',$user->id)->first();

            $amount = $bank->amount - $request->amount;

            $bank->amount = $amount;

            $bank->save();

            $transfer_bank = Bank::where('id',$transfer_account->id)->first();

            $transfer_bank->amount = $transfer_account->balance + $request->amount;

            $transfer_bank->save();

            BankStatement::create([
                'user_id' => $user->id,
                'bank_id' => $bank->id,
                'description' => "Transfer to $request->email",
                'amount' => $request->amount,
                'balance' => $request->amount,
                'status' => 'Transfer',
            ]);

            BankStatement::create([
                'user_id' => $user->id,
                'bank_id' => $bank->id,
                'description' => "Transfered from $user->email",
                'amount' => $request->amount,
                'balance' => $request->amount,
                'status' => 'Transfer',
            ]);

            // return to_route('deposit.index');
            DB::commit();

            return redirect()->route('deposit.index')->with('success', 'Transfer successfully');

        }
        catch(Exception $e)
        {
            DB::rollback();
            return ['success'=>false ,'errorMsg'=> $e->getMessage()];
        }



    }

}
