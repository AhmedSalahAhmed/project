<?php

namespace App\Http\Controllers\centralbank;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Bank;

use App\Models\Currency;

use App\Models\Process;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CentralReportController extends Controller
{
    public function accountsreport(Request $request)
    {
        $bank_id = Auth::user()->bank_id;
        $banks = Bank::all();
        $currencies = Currency::all();
        $start_at = date($request->start_at);
        $end_at = date($request->end_at);
        // $processes = Process::with('currencies:id,currency_name,abbreviation')->get();
        // return $processes;
        if ($request->start_at == '' && $request->end_at == '') {
            if ($request->bank_id == '' && $request->currency_id == '') {
                $accounts = Account::join('currencies', 'accounts.currency_id', '=', 'currencies.id')
                    ->join('banks', 'accounts.bank_id', '=', 'banks.id')
                    ->get(['accounts.*', 'currencies.*', 'banks.bank_name']);
            } elseif ($request->bank_id == '' or $request->currency_id == '') {
                $accounts = Account::where('bank_id', $request->bank_id)
                    ->orwhere('currency_id', $request->currency_id)

                    ->join('currencies', 'accounts.currency_id', '=', 'currencies.id')
                    ->join('banks', 'accounts.bank_id', '=', 'banks.id')


                    ->get(['accounts.*', 'currencies.*', 'banks.bank_name']);
            } elseif ($request->bank_id != '' and $request->currency_id != '') {
                $accounts = Account::where('bank_id', $request->bank_id)
                    ->where('currency_id', $request->currency_id)
                    ->join('currencies', 'accounts.currency_id', '=', 'currencies.id')
                    ->join('banks', 'accounts.bank_id', '=', 'banks.id')

                    ->get(['accounts.*', 'currencies.*', 'banks.bank_name']);
            }
        } else {
            if ($request->bank_id == '' && $request->currency_id == '') {
                $accounts = Account::join('currencies', 'accounts.currency_id', '=', 'currencies.id')
                    ->join('banks', 'accounts.bank_id', '=', 'banks.id')
                    ->get(['accounts.*', 'currencies.*', 'banks.bank_name'])
                    ->whereBetween('created_at', [$start_at, $end_at])
                    ;
            } elseif ($request->bank_id == '' or $request->currency_id == '') {
                $accounts = Account::where('bank_id', $request->bank_id)
                    ->orwhere('currency_id', $request->currency_id)

                    ->join('currencies', 'accounts.currency_id', '=', 'currencies.id')
                    ->join('banks', 'accounts.bank_id', '=', 'banks.id')


                    ->get(['accounts.*', 'currencies.*', 'banks.bank_name'])
                    ->whereBetween('created_at', [$start_at, $end_at]);
            } elseif ($request->bank_id != '' and $request->currency_id != '') {
                $accounts = Account::where('bank_id', $request->bank_id)
                    ->where('currency_id', $request->currency_id)
                    ->join('currencies', 'accounts.currency_id', '=', 'currencies.id')
                    ->join('banks', 'accounts.bank_id', '=', 'banks.id')

                    ->get(['accounts.*', 'currencies.*', 'banks.bank_name'])
                    ->whereBetween('created_at', [$start_at, $end_at]);
            }
        }

        return view('centralbank.reports.centralaccountreport', compact('accounts', 'currencies', 'banks'));
    }
}
