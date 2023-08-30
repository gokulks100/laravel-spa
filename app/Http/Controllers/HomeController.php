<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class HomeController extends Controller
{
    
    public function index()
    {
        // $user = User::with(['bank' => function($data){ran
        //     $data->select('amount');
        // }])->where('id',$this->user_id)->first();

        // dd($user);
       
        $user = Auth::guard('web')->user();

        $user = User::with(['banks'])->where('id',$user->id)->first();
        
        return Inertia::render('Dashboard',[
            'user'=> $user
        ]);
    }
}
