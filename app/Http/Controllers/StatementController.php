<?php

namespace App\Http\Controllers;

use App\Models\BankStatement;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class StatementController extends Controller
{
    public function index()
    {
        $user_id = Auth::guard('web')->user()->id;
        $data = BankStatement::select([
            'status',
            'amount',
            'description',
            'created_at',
            'balance'
        ])->where('user_id',$user_id)->orderBy('id','desc')->paginate(5);

        $data->map(function($data){
            $data->createdAt = Carbon::parse($data->created_at)->format("Y-m-d H:i:s");
        });

        return Inertia::render('Statement',[
            'items'=> $data
        ]);
    }
}
