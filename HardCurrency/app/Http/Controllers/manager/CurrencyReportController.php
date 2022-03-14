<?php

namespace App\Http\Controllers\manager;

use App\Models\BankCurrency;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Process;
use Illuminate\Support\Facades\Auth;

class CurrencyReportController extends Controller

{
    public function searchcurrency(Request $request)
    {

        $rdio = $request->rdio;
        $bank_id = Auth::user()->bank_id;

        $banks = Bank::where('id', $bank_id)->get();




        if ($request->start_at == '' && $request->end_at == '') {
            $currencies = BankCurrency::where('bank_id', $bank_id)
                ->where('currencies.abbreviation', 'like', '%' . $request->currency_name . '%')
                ->orwhere('currencies.currency_name', 'like', '%' . $request->currency_name . '%')
                ->where('bank_id', $bank_id)
                ->join('currencies', 'bank_currencies.currency_id', '=', 'currencies.id')
                ->get(['bank_currencies.*', 'currencies.currency_name', 'currencies.abbreviation', 'currencies.symbol']);
            return view('manager.reports.currencyreport', compact('currencies', 'banks'))->withDetails($currencies);
        } 
        
        
        
        else {


            $start_at = date($request->start_at);
            $end_at = date($request->end_at);
            $currencies = BankCurrency::where('bank_id', $bank_id)
                ->where('currencies.abbreviation', 'like', '%' . $request->currency_name . '%')

                ->orwhere('currencies.currency_name', 'like', '%' . $request->currency_name . '%')
                ->where('bank_id', $bank_id)
                ->join('currencies', 'bank_currencies.currency_id', '=', 'currencies.id')
                ->get(['bank_currencies.*', 'currencies.currency_name', 'currencies.abbreviation', 'currencies.symbol'])
                ->whereBetween('created_at', [$start_at, $end_at]);
            return view('manager.reports.currencyreport', compact('currencies', 'banks', 'start_at', 'end_at'))->withDetails($currencies);
        }
    }

    public function searchprocess(Request $request)
    {

        $rdio = $request->rdio;
        $bank_id = Auth::user()->bank_id;

        $banks = Bank::where('id', $bank_id)->get();





        $start_at = date($request->start_at);
        $end_at = date($request->end_at);

        // return view('manager.reports.currencyreport', compact('start_at', 'end_at', 'currencies'))->withDetails($currencies);

        $processes = Process::where('bank_id', $bank_id)
            ->where('processes.abbreviation', 'like', '%' . $request->currency_name . '%')

            ->orwhere('processes.currency_name', 'like', '%' . $request->currency_name . '%')
            ->where('bank_id', $bank_id)
            ->join('processes', 'bank_processes.currency_id', '=', 'processes.id')
            ->get(['bank_processes.*', 'processes.currency_name', 'processes.abbreviation', 'processes.symbol'])
            ->whereBetween('created_at', [$start_at, $end_at]);
        // $processes = BankCurrency::select('*')->where('id','like',$request->id)->get();
        return view('manager.reports.currencyreport', compact('processes', 'banks', 'start_at', 'end_at'))->withDetails($processes);
    }
}
