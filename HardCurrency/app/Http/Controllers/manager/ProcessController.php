<?php

namespace App\Http\Controllers\manager;

use App\Http\Controllers\Controller;
use App\Models\Bank;
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
        $banks = Bank::where('id', $bank_id)->get();

        // dd($bank_id);


        // $processes = Process::where('bank_id' ,$bank_id)->join(
        $processes = Process::where('processes.bank_id', $bank_id)
            ->join(
                'bank_currencies',
                'processes.bank_currency_id',
                '=',
                'bank_currencies.id'
            )->join('currencies', 'bank_currencies.currency_id', '=', 'currencies.id')
            ->join(
                'employees',
                'processes.employee_id',
                '=',
                'employees.id'
            )->join('branches', 'employees.branch_id', '=', 'branches.id')
            
            ->orderBy('id' ,'desc')->get(['processes.*', 'bank_currencies.buy_price', 'currencies.currency_name', 'currencies.symbol', 'employees.employee_name' ,'branches.branch_name'])
            ;
    
        return view('manager.process', compact('processes' , 'banks'));
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
