<?php

namespace App\Http\Controllers\manager;

use App\Http\Controllers\Controller;
use App\Models\BankCurrency;
use App\Models\Process;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProcessController extends Controller
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

        
        // $processes = Process::where('bank_id' ,$bank_id)->join(
        $processes = Process::where('processes.bank_id', $bank_id)->join(
            'bank_currencies',
            'processes.bank_currency_id',
            '=',
            'bank_currencies.id'
        )->join('currencies', 'bank_currencies.currency_id', '=', 'currencies.id')->join(
            'employees',
            'processes.employee_id',
            '=',
            'employees.id'
        )
            ->get(['processes.*', 'bank_currencies.buy_price', 'currencies.currency_name', 'employees.employee_name']);
        // $employees = Process::join(
        //     'employees',
        //     'processes.employee_id',
        //     '=',
        //     'employees.id'
        // )
        //     ->get(['processes.*', 'employees.employee_name']);
        // $bank_currency_id = Process::get('bank_currency_id');
        // $bankcurrencies = BankCurrency::where('bank_id', $bank_id)->join('currencies', 'bank_currencies.currency_id', '=', 'currencies.id')
        //     ->get(['bank_currencies.*', 'currencies.currency_name']);
        // $tc = Transaction::join('bank_currencies', 'transaction.bank_currency_id', '=', 'bank_currencies.id')
        // ->get(['transaction.*', 'bank_currencies.currency_name']);
        // return $transactions;

        return view('manager.process', compact('processes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
