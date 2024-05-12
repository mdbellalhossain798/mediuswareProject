<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Transaction;
use DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $transaction_balance = User::with('transactions')->find(Auth::id());
        // $transaction_balances=$transaction_balance->transactions;
        // dd($transaction_balance);
        return view('home', ['transaction_balances' => $transaction_balance]);
    }
    public function diposit()
    {
        $transaction_balance = User::with(['transactions' => function ($query) {
            $query->where('transactions_type', 'DIPOSIT');
        }])->find(Auth::id());
        return view('diposit', ['transaction_balances' => $transaction_balance]);
    }
    public function withdrawal()
    {
        $transaction_balance = User::with(['transactions' => function ($query) {
            $query->where('transactions_type', 'WITHDRAWAL');
        }])->find(Auth::id());
        return view('withdrawal', ['transaction_balances' => $transaction_balance]);
    }
    public function userWithdrawal()
    {
        
        $transaction_balance = User::with(['transactions' => function ($query) {
            $currentMonth = Carbon::now()->month;
             $currentYear = Carbon::now()->year;
            $query->whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->where('transactions_type', 'WITHDRAWAL');
        }])->find(Auth::id());
        $transaction_balance_diposit = User::with(['transactions' => function ($query) {
            $query->where('transactions_type', 'DIPOSIT');
        }])->find(Auth::id());
             
        $sumDiposit = $transaction_balance_diposit->transactions->sum('amount');
        $sumWithdrawalFee = $transaction_balance->transactions->sum('fee');
        $sumWithdrawal = $transaction_balance->transactions->sum('amount');
        $currentBalance=($sumDiposit - $sumWithdrawalFee) +  $sumWithdrawal  ;
        return view('user_withdrawal', ['sumWithdrawal' => $sumWithdrawal,'currentBalance'=>$currentBalance]);
    }

  
}
