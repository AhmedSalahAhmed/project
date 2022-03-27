<?php

namespace App\Http\Controllers\bank;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Bank;
use App\Models\BankCurrency;
use App\Models\Branch;
use App\Models\Currency;
use App\Models\Process;
use App\Models\Transaction;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EmployeeDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $bank_id = Auth::user()->bank_id;
        $branch_id = Auth::user()->branch_id;
        $banks = Bank::where('id', $bank_id)->get();
        $branches = Branch::where('id', $branch_id)->get();
        $last_process = Process::orderBy('id', 'DESC')->where("bank_id", $bank_id)->first();

        $last_currency= null;
        if($last_process){
            $bankCurr = BankCurrency::find($last_process->bank_currency_id);
            $last_currency= $bankCurr->currency;
        }
// return($last_currency_id->currency_name);
      
        // dd($bank_id);

        $currencies = Currency::all();
        $bankcurrencies = BankCurrency::where('bank_id', $bank_id)->join('currencies', 'bank_currencies.currency_id', '=', 'currencies.id')
            ->get(['bank_currencies.*', 'currencies.currency_name']);
        // $tc = Transaction::join('bank_currencies', 'transaction.bank_currency_id', '=', 'bank_currencies.id')
        // ->get(['transaction.*', 'bank_currencies.currency_name']);
        // return $transactions;
        if ($request->ajax()) {
            return view('bank.dashboard', compact('bankcurrencies', 'currencies', 'banks', 'branches' , 'last_process' ,'last_currency'))->renderSections()['content'];
        }
        return view('bank.dashboard', compact('bankcurrencies', 'currencies', 'banks', 'branches' , 'last_process' ,'last_currency'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $bank_id = Auth::user()->bank_id;



        $amount = $request->amount;
        $request->validate([
            'client_name' => 'required',
            'client_phone' => 'required',
            'amount' => 'required',
            'bank_currency_id' => 'required',
            // 'sdgamount' => 'required',
        ]);
        Process::create([
            'bank_currency_id' => $request->bank_currency_id,
            'client_name' => $request->client_name,
            'client_phone' => $request->client_phone,
            'id_number' => $request->id_number,
            'amount' => $request->amount,
            'sdgamount' => $request->buy_price,
            'employee_id' => $request->user()->id,
            'bank_id' => $bank_id,
        ]);

        $currency = BankCurrency::where('bank_id', $bank_id)
            ->where('bank_currencies.id', $request->bank_currency_id)
            ->join('currencies', 'bank_currencies.currency_id', '=', 'currencies.id')
            ->get(['bank_currencies.currency_id'])
            ->pluck('currency_id');
        $bank_account = Account::where('bank_id', $bank_id)
            ->where('currency_id', $currency)->get();
        // dd($bank_account);


        if ($bank_account) {
            foreach ($bank_account as $b_account) {
                $b_account->balance = $b_account->balance + $amount;
                $b_account->save();
            }
        }
        Alert::success('تهانينا !!', 'تمت العملية بنجاح');


        return back();
          
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
     * @param  \App\Models\BankCurrency  $bank_Currency
     * @return \Illuminate\Http\Response
     */
    public function edit(BankCurrency $bank_currency)
    {
        return view('bank.dashboard', compact('currencies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BankCurrency  $bank
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BankCurrency $bank)
    {
        $request->validate([
            'buy_price' => 'required',
            'sale_price' => 'required',

        ]);

        $bank->update($request->all());
        Alert::success('تهانينا !!', 'تم تعديل بيانات العملة بنجاح');
        return redirect()->route('bank.index');
    }

    public function getTotal(Request $request)
    {
        $bank_id = Auth::user()->bank_id;
        $record = BankCurrency::where("id", $request->currency_id)->where("bank_id", $bank_id)->get();

        // $total = $record->buy_price * $request->amount;
        // dd($record);
        return $record[0]->buy_price * $request->total;

        Alert::success('تهانينا !!', 'تم تعديل بيانات العملة بنجاح');
        return redirect()->route('bank.index');
    }
}
