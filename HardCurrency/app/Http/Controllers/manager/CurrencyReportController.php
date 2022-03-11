<?php

namespace App\Http\Controllers\manager;

use App\Models\BankCurrency;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bank;
use Illuminate\Support\Facades\Auth;

class CurrencyReportController extends Controller

{
    public function searchcurrency(Request $request)
    {

        $rdio = $request->rdio;
        $bank_id = Auth::user()->bank_id;

        $banks = Bank::where('id', $bank_id)->get();


        //  في حالة البحث بنوع الفاتورة

        if ($rdio == 1) {

            $start_at = date($request->start_at);
            $end_at = date($request->end_at);

            $currencies = BankCurrency::whereBetween('created_at', [$start_at, $end_at])->get();
            return view('manager.reports.currencyreport', compact('start_at', 'end_at', 'currencies'))->withDetails($currencies);
        }

        //====================================================================

        // في البحث برقم الفاتورة
        else {

            $currencies = BankCurrency::where('bank_id', $bank_id)
                ->where('currencies.abbreviation', 'like', '%' . $request->currency_name . '%')

                ->join('currencies', 'bank_currencies.currency_id', '=', 'currencies.id')
                ->get(['bank_currencies.*', 'currencies.currency_name', 'currencies.abbreviation', 'currencies.symbol']);
            // $currencies = BankCurrency::select('*')->where('id','like',$request->id)->get();
            return view('manager.reports.currencyreport', compact('currencies', 'banks'))->withDetails($currencies);
        }
    }
}
