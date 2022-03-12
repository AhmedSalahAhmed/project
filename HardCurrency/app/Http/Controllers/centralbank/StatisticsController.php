<?php

namespace App\Http\Controllers\centralbank;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\BankCurrency;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
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
    public function index(Request $request)
    {
        $currencies = Currency::all();

        $banks = DB::table('banks')->count();
        $sdgamount = DB::table('processes')->sum('sdgamount');
        $sdg = BankCurrency::get()->pluck('buy_price', 'currency_id');
        $currency_id = $request->currency_id;
        $balance = DB::table('accounts')->where('currency_id', $currency_id)->sum('balance');

        return view('centralbank.dashboard', compact('banks', 'balance', 'sdgamount', 'currencies'));
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
        ->join('currencies', 'accounts.currency_id', '=' , 'currencies.id')
        ->get('currencies.symbol');
        // dd($symbol);

        return view('centralbank.dashboard', compact('banks', 'balance', 'sdgamount', 'symbol', 'currencies'));
    }
}
