<?php

namespace App\Http\Controllers\bank;

use App\Http\Controllers\Controller;
use App\Models\BankCurrency;
use App\Models\Currency;
use App\Models\Process;
use App\Models\Transaction;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;



class EmployeeDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bank_id = Auth::user()->bank_id;

        // dd($bank_id);

        $currencies = Currency::all();
        $bankcurrencies = BankCurrency::where('bank_id', $bank_id)->join('currencies', 'bank_currencies.currency_id', '=', 'currencies.id')
            ->get(['bank_currencies.*', 'currencies.currency_name']);
        // $tc = Transaction::join('bank_currencies', 'transaction.bank_currency_id', '=', 'bank_currencies.id')
        // ->get(['transaction.*', 'bank_currencies.currency_name']);
        // return $transactions;

        return view('bank.dashboard', compact('bankcurrencies', 'currencies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bank_id = Auth::user()->bank_id;
        // dd($bank_id);
        // return $request->all();
        $bankcurrency = BankCurrency::find($request->bank_currency_id);
        if (!$bankcurrency) {
            return back()->withErrors(['bankcurrency' => ' يجب إختيار العملة المطلوبة ']);
        }

        $am = $request->amount;
        $request->validate([
            'client_name' => 'required',
            'client_phone' => 'required',
            'amount' => 'required',
            'bank_currency_id' => 'required',
            // 'sdgamount' => 'required',
        ]);
        Process::create([
            'bank_currency_id' => $request->bank_currency_id,
            'client_name' => $request->client_name,
            'client_phone' => $request->client_phone,
            'id_number' => $request->id_number,
            'amount' => $request->amount,
            'sdgamount' => $request->buy_price * $request->amount,
            'employee_id' => $request->user()->id,
            'bank_id' => $bank_id,
        ]);
        $bankcurrency->balance = $bankcurrency->balance + $am;
        $bankcurrency->save();
        Alert::success('تهانينا !!', 'تمت العملية بنجاح');
        return redirect()->route('bank.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function show(Currency $currency)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BankCurrency  $bank_Currency
     * @return \Illuminate\Http\Response
     */
    public function edit(BankCurrency $bank_currency)
    {
        return view('bank.dashboard', compact('currencies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BankCurrency  $bank
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BankCurrency $bank)
    {
        $request->validate([
            'buy_price' => 'required',
            'sale_price' => 'required',

        ]);

        $bank->update($request->all());
        Alert::success('تهانينا !!', 'تم تعديل بيانات العملة بنجاح');
        return redirect()->route('bank.index');
    }

    public function getTotal(Request $request)
    {
        $bank_id = Auth::user()->bank_id;
        $record = BankCurrency::where("id", $request->currency_id)->where("bank_id", $bank_id)->get();

        // $total = $record->buy_price * $request->amount;
        // dd($record);
        return $record[0]->buy_price * $request->total;

        Alert::success('تهانينا !!', 'تم تعديل بيانات العملة بنجاح');
        return redirect()->route('bank.index');
    }
}
