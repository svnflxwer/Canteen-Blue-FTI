<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\PaymentHistory;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        $payment_history = PaymentHistory::where('user_id',Auth::user()->id)->get();
        $order = Order::where('user_id',Auth::user()->id)->get();
        return view('user.transaction_history', [
            'title' => 'Transaction History',
            'active' =>'user',
            'payment_history' => $payment_history,
            'user' => Auth::user()->id,
        ]);
    }

    public function edit_profile(){

    }
}