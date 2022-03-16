<?php

namespace App\Http\Controllers\manager;

use App\Models\BankCurrency;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Bank;
use App\Models\Branch;
use App\Models\Currency;
use App\Models\Employee;
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
        } else {


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

       
        $bank_id = Auth::user()->bank_id;
        $banks = Bank::where('id', $bank_id)->get();
        $currencies = Currency::all();
        $branches = Branch::all();
        $employees = Employee::all();
        $start_at = date($request->start_at);
        $end_at = date($request->end_at);
        if($request->currency_id !='' && $request->branch_id !='' && $request->employee_id =='')
        {
            // dd('Ahmed');
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
            ->orderBy('id', 'desc')
            ->where('currencies.id', '=',  $request->currency_id)
            ->where('branches.id', '=',  $request->branch_id)
            ->get(['processes.*', 'bank_currencies.buy_price', 'currencies.currency_name', 'currencies.symbol', 'employees.employee_name', 'branches.branch_name']);
            }
            elseif($request->currency_id =='' && $request->branch_id !='' && $request->employee_id !='')
            {
                // dd('Ahmed');
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
                ->orderBy('id', 'desc')
                ->where('employees.id', '=',  $request->employee_id)
                ->where('branches.id', '=',  $request->branch_id)
                ->get(['processes.*', 'bank_currencies.buy_price', 'currencies.currency_name', 'currencies.symbol', 'employees.employee_name', 'branches.branch_name']);
                }
                elseif($request->currency_id !='' && $request->branch_id =='' && $request->employee_id !='')
            {
                // dd('Ahmed');
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
                ->orderBy('id', 'desc')
                ->where('employees.id', '=',  $request->employee_id)
                ->where('currencies.id', '=',  $request->currency_id)
                ->get(['processes.*', 'bank_currencies.buy_price', 'currencies.currency_name', 'currencies.symbol', 'employees.employee_name', 'branches.branch_name']);
                }
                elseif($request->currency_id !='' && $request->branch_id !='' && $request->employee_id !='')
                {
                    // dd('Ahmed');
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
                    ->orderBy('id', 'desc')
                    ->where('employees.id', '=',  $request->employee_id)
                    ->where('currencies.id', '=',  $request->currency_id)
                    ->where('branches.id', '=',  $request->branch_id)
                    ->get(['processes.*', 'bank_currencies.buy_price', 'currencies.currency_name', 'currencies.symbol', 'employees.employee_name', 'branches.branch_name']);
                    }
        elseif($request->currency_id !='' or $request->employee_id !='' or $request->branch_id !='')
        {
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
            ->orderBy('id', 'desc')
            ->where('currencies.id', '=',  $request->currency_id)
            ->orwhere('employees.id', '=',  $request->employee_id)
            ->orwhere('branches.id', '=',  $request->branch_id)
            ->get(['processes.*', 'bank_currencies.buy_price', 'currencies.currency_name', 'currencies.symbol', 'employees.employee_name', 'branches.branch_name']);
        }
        
            else
        {
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
            ->orderBy('id', 'desc')
            ->get(['processes.*', 'bank_currencies.buy_price', 'currencies.currency_name', 'currencies.symbol', 'employees.employee_name', 'branches.branch_name']);
            }
        return view('manager.reports.processes', compact('processes', 'employees', 'currencies', 'branches', 'banks', 'start_at', 'end_at'))->withDetails($processes);
    }
    public function bankaccountreport(Request $request)
    {  
        $bank_id = Auth::user()->bank_id;
            $banks = Bank::where('id', $bank_id)->get();
            $currencies = Currency::all();
            $start_at = date($request->start_at);
            $end_at = date($request->end_at);
        if($request->currency !='')
        {
            
            $accounts = Account::where('bank_id' , $bank_id)
            ->where('currencies.id', $request->currency_id)
            ->join('currencies', 'accounts.currency_id', '=' , 'currencies.id')
            ->get(['accounts.*', 'currencies.*']);
        }
        else{
            $accounts = Account::where('bank_id' , $bank_id)
            ->join('currencies', 'accounts.currency_id', '=' , 'currencies.id')
            ->get(['accounts.*', 'currencies.*']);

        }
      
        return view('manager.reports.accounts', compact('accounts','banks',  'currencies', 'start_at', 'end_at'))->withDetails($accounts);
    }
}
