<?php

namespace App\Http\Controllers\manager;

use App\Http\Controllers\Controller;
use App\Models\BankCurrency;
use App\Models\Currency;
use App\Models\Transaction;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;



class ManagerDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        $except_ids = BankCurrency::whereBankId(request()->user()->bank_id)->pluck('currency_id');

        $currencies = Currency::all();
        $bankcurrencies = BankCurrency::join('currencies', 'bank_currencies.currency_id', '=', 'currencies.id')
        ->get(['bank_currencies.*', 'currencies.currency_name','currencies.symbol']);
        // return $bankcurrencies;
        
		return view('manager.dashboard',compact('bankcurrencies'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $transactions = Transaction::all();

        return view('manager.dashboard' , compact('transactions'));
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
     
        return redirect()->route('manager.index');
    
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
        return view('manager.dashboard', compact('currency'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BankCurrency  $manager
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BankCurrency $manager)
    {
        $request->validate([
            'buy_price' => 'required',
            'sale_price' => 'required',

        ]);

        $manager->update($request->all());
        Alert::success('تهانينا !!', 'تم تعديل بيانات العملة بنجاح');
        return redirect()->route('manager.index');
    }

    
}
