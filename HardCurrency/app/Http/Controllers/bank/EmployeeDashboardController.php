<?php

namespace App\Http\Controllers\bank;

use App\Http\Controllers\Controller;
use App\Models\BankCurrency;
use App\Models\Currency;
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
        $currencies = Currency::all();
        $transactions = Transaction::all();
        $bankcurrencies = BankCurrency::join('currencies', 'bank_currencies.currency_id', '=', 'currencies.id')
        ->get(['bank_currencies.*', 'currencies.currency_name']);
            // $tc = Transaction::join('bank_currencies', 'transaction.bank_currency_id', '=', 'bank_currencies.id')
            // ->get(['transaction.*', 'bank_currencies.currency_name']);
        // return $transactions;
        
		return view('bank.dashboard',compact('bankcurrencies', 'currencies'));
        
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
        // $request->validate([
        //     'client_name' => 'required',
        //     'client_phone' => 'required',
        //     'amount' => 'required',
        //     'bank_currency_id' => 'required',
            
        // ]);
        // dd($request->all());   
        

        Transaction::create($request->all());

        // $account->balance = $amm;
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

    
}
