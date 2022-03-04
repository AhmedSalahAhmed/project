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
    {   $currencies = Currency::all();
        $bankcurrencies = BankCurrency::join('currencies', 'bank_currencies.currency_id', '=', 'currencies.id')
        ->get(['bank_currencies.*', 'currencies.currency_name']);
        // return $bankcurrencies;
        
		return view('bank.dashboard',compact('bankcurrencies'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $transactions = Transaction::all();

        return view('bank.dashboard' , compact('transactions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'client_name' => 'required',
            'client_phone' => 'required',
            
            'id_number' => 'required',
            'qte' => 'required',
            'type' => 'required',
            'currency' => 'required',
        ]);
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
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function edit(Currency $currency)
    {
        return view('bank.dashboard', compact('currencies'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Currency $currency)
    {
        $request->validate([
            'buy_price' => 'required',
            'sale_price' => 'required',

        ]);

        $currency->update($request->all());
        Alert::success('تهانينا !!', 'تم تعديل بيانات العملة بنجاح');
        return redirect()->route('bank.index');
    }

    
}
