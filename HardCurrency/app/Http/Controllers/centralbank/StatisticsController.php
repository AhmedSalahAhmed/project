<?php

namespace App\Http\Controllers\centralbank;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\BankCurrency;
use App\Models\Currency;
use App\Models\Process;
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
     * 
     */
    public function index(Request $request)
    {

        // $currencys = Currency::all();

        // $processes = Process::all();
        // // $processes = DB::table('processes')->get();

        // foreach ($processes as $process) {
        //     $process->bank_currency_id = BankCurrency::find($process->bank_currency_id);
        // }
        // // $processes = (array) $processes;
        // $counted = [];
        // foreach ($currencys as $currency) {
        //     $counted = $processes->filter->bank_currency_id===1;
        // }
        // return ($counted);

        // return ($processes);
        // //////////////////

        $currencies = Currency::all();

        $banks = DB::table('banks')->count();
        $sdgamount = DB::table('processes')->sum('sdgamount');
        $sdg = BankCurrency::get()->pluck('buy_price', 'currency_id');
        $currency_id = $request->currency_id;
        $balance = DB::table('accounts')->where('currency_id', $currency_id)->sum('balance');
        if ($request->ajax()) {

            return view('centralbank.dashboard', compact('banks', 'balance', 'sdgamount', 'currencies'))
            ->with('success','تمت تســجيل مدير بنك بنجاح')
            ->renderSections()['content'];
            }
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
            ->join('currencies', 'accounts.currency_id', '=', 'currencies.id')
            ->get('currencies.symbol');
        // dd($symbol);

        return view('centralbank.dashboard', compact('banks', 'balance', 'sdgamount', 'symbol', 'currencies'));
    }

    public function getCurrenciesStatistics()
    {
        $process = Process::all();

        return ($process);
        // $banks = DB::table('banks')->count();
        // $sdgamount = DB::table('processes')->sum('sdgamount');
        // $sdg = BankCurrency::get()->pluck('buy_price', 'currency_id');
    }
}
