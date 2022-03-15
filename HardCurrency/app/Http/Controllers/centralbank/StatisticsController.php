<?php

namespace App\Http\Controllers\centralbank;

use App\Http\Controllers\Controller;
use App\Http\Resources\CurrencyGrowth;
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

    public function currencies_growth()
    {
        $year = request()->year ?? now()->year;

        $processes = DB::table('processes')
            ->join('bank_currencies', 'bank_currencies.id', '=', 'processes.bank_currency_id')
            ->join('currencies', 'bank_currencies.currency_id', '=', 'currencies.id')
            ->select('currencies.currency_name', 'processes.amount', 'bank_currencies.id', 'currency_id', DB::raw('MONTHNAME(processes.created_at) as month, YEAR(processes.created_at) as year'))
            ->get()
            ->where('year', $year)
            ->groupBy('month');
        $data = [];

        foreach ($processes as $key => $values) {
            $growth = CurrencyGrowth::collection($values->groupBy('currency_name'));
            // return $growth->sortByDesc("processes");
            $data[] = [
                'month' => $key,
                'growth' => $growth->sortByDesc("processes")->take(3),
            ];
        };

        return collect($data);

    }
}
