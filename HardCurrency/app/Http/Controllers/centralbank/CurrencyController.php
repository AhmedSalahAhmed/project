<?php

namespace App\Http\Controllers\centralbank;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Currency;
use App\Models\BankCurrency;
use App\Models\Bank;
use Alert;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currencies = Currency::oldest()->paginate(7);
		return view('centralbank.currency',compact('currencies'))->with('i', (request()->input('page', 1) - 1) * 7);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $currencies = Currency::all();
        return view('centralbank.currency' , compact('currencies'));
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
            'currency_name' => 'required',
            'abbreviation' => 'required',

        ]);
        
        Currency::create($request->all());
        // $stored = Currency::create($request->all());
        // $banks = Bank::all();

        // foreach( $banks as $bank){
        //     BankCurrency::create([
        //         "bank_id" => $bank->id, 
        //         "currency_id" => $stored->id,
        //         "buy_price" => $stored->buy_price, 
        //         "sale_price" => $stored->sale_price 
        //     ]);
        // }

        Alert::success('تهانينا !!', 'تم اضافة  عملة جديدة بنجاح');
     
        return redirect()->route('currency.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
            'abbreviation' => 'required',
            'symbol' => 'required',


        ]);

        $currency->update($request->all());
        Alert::success('تهانينا !!', 'تم تعديل بيانات العملة بنجاح');
        return redirect()->route('currency.index');
    }

    /**
     * Remove the specified resource from storage.
     *
  * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Currency $currency)
    {
        $currency->delete();

        return redirect()->route('currency.index')
            ->withSuccess(__('تم حذف العملة بنجاح'));
    }  
}
