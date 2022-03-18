<?php

namespace App\Http\Controllers\manager;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Bank;
use App\Models\BankCurrency;
use App\Models\Currency;
use App\Models\Process;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $bank_id = Auth::user()->bank_id;
        $banks = Bank::where('id', $bank_id)->get();
        // $sdgamount = DB::table('processes')->sum('sdgamount');
        $sdgamount = Process::where('bank_id', $bank_id)->sum('sdgamount');
        $currencies = Currency::all();
        $branches = DB::table('branches')->count();
        $balance = Account::where('bank_id', $bank_id)->sum('balance');
        $proccesses = Process::where('bank_id', $bank_id)->count();
        if ($request->ajax()) {

            return view('manager.statistics', compact('branches' ,'banks' , 'balance' , 'sdgamount' ,'currencies' , 'proccesses'))->renderSections()['content'];
            }
        // dd($balance);
        return view('manager.statistics', compact('branches', 'banks', 'balance', 'sdgamount', 'currencies' , 'proccesses'));
    }
    public function store(Request $request)
    {
        $currencies = Currency::all();

        $banks = DB::table('banks')->count();
        $sdgamount = DB::table('processes')->sum('sdgamount');
        $sdg = BankCurrency::get()->pluck('buy_price', 'currency_id');
        $currency_id = $request->currency_id;
        $balance = Account::where('currency_id', $currency_id)
            ->sum('balance');

        $symbol = Account::where('currency_id', $currency_id)
            ->join('currencies', 'accounts.currency_id', '=', 'currencies.id')
            ->get('currencies.symbol');
        // dd($symbol);

        return view('centralbank.dashboard', compact('banks', 'balance', 'sdgamount', 'symbol', 'currencies'));
    }
}
