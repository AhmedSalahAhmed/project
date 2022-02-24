<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Currency;
use App\Models\Account;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::all();
        return view('transactions', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $currencies = Currency::all();
        $transactions = Transaction::all();
        return view('exchange' , compact('transactions', 'currency'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $account = Account::find($request->input('account-id'));
        // if($account)
        // {
        //     return back()->withErrors(['account'=>'Account not found']);
        // }
        // $amm = $request->ammount;
        $request->validate([
            'client_name' => 'required',
            'client_phone' => 'required',
            'id_type' => 'required',
            'id_number' => 'required',
            'amount' => 'required',
            'transaction_type' => 'required',
            'currency' => 'required',
        ]);
        Transaction::create($request->all());
        // $account->balance = $amm;
        Alert::success('تهانينا !!', 'تمت العملية بنجاح');
     
        return redirect()->route('exchange.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
