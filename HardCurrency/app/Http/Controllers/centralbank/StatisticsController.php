<?php

namespace App\Http\Controllers\centralbank;

use App\Http\Controllers\Controller;
use App\Http\Resources\CurrencyGrowth;
use App\Http\Resources\TobBankUsed;
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
        $currencies = Currency::all();

        $banks = DB::table('banks')->count();
        $sdgamount = DB::table('processes')->sum('sdgamount');
        $sdg = BankCurrency::get()->pluck('buy_price', 'currency_id');
        $currency_id = $request->currency_id;
        $balance = DB::table('accounts')->where('currency_id', $currency_id)->sum('balance');
        if ($request->ajax()) {

            return view('centralbank.dashboard', compact('banks', 'balance', 'sdgamount', 'currencies'))
                ->with('success', 'تمت تســجيل مدير بنك بنجاح')
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

    public function currencies_growth()
    {
        $year = request()->year ?? now()->year;

        $processes = DB::table('processes')
            ->join('bank_currencies', 'bank_currencies.id', '=', 'processes.bank_currency_id')
            ->join('currencies', 'bank_currencies.currency_id', '=', 'currencies.id')
            ->select('currencies.currency_name', 'bank_currencies.id', 'currency_id', 'processes.*', DB::raw('MONTHNAME(processes.created_at) as month, YEAR(processes.created_at) as year, MONTH(processes.created_at) as numMonth'))
            ->get()
            ->where('year', $year)
            ->groupBy('month');

        $data = [];

        // return $processes;
        $currencies = [];

        foreach ($processes as $key => $values) {
            foreach ($values as $value) {
                if (!in_array($value->currency_id, $currencies)) {
                    array_push($currencies, $value->currency_id);
                }
            }
            $data[] = [
                'month' => $key,
                'growth' => CurrencyGrowth::collection($values->groupBy('currency_name'))->take(3),
            ];
        };
        $months = [];
        $currency = [];

        return collect([
            "data" => $data,
            "currencies" => $currencies
        ]);
    }

    public function top_banks()
    {
        $data = Process::select('id', 'bank_id', 'bank_currency_id')->orderBy('bank_id')->get()->groupBy('bank_id');
        $records = TobBankUsed::collection($data);

        return $records;
    }

}
