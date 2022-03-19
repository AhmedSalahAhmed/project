<?php

namespace App\Http\Controllers\centralbank;

use App\Http\Controllers\Controller;
use App\Http\Controllers\StaticFunctionController;
use App\Http\Resources\States;
use App\Models\Account;
use App\Models\Bank;
use App\Models\BankCurrency;
use App\Models\CurrencyPrice;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $states = StaticFunctionController::states();
        $locales = StaticFunctionController::locales();
        $banks = Bank::latest()->paginate(10);
        if ($request->ajax()) {
            return view('centralbank.bank', compact('banks', 'states', 'locales'))->renderSections()['content'];
        }


        // foreach($locales as $locale){
        //     return $locale["1"];
        // };

        return view('centralbank.bank', compact('banks', 'states', 'locales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $banks = Bank::all();
        return view('centeralbank.bank', compact('banks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $states = StaticFunctionController::states();
        $locales = StaticFunctionController::locales();
        foreach ($states as $state) {
            // dd($state['value']);
            if($request->state == $state['value'])
            $storedState = $state['label'];
        }
        

        $request->validate([
            'bank_name' => 'required',
            'logo' => 'required',
            'state' => 'required',
            'district' => 'required',
            'url' => 'required',
        ]);

        // dd($request->all());

        // $request->logo = $request->file("logo")->store("images");
        $bank = Bank::create([
            "bank_name" => $request->bank_name,
            "state" => $storedState,
            "url" => $request->url,
            "district" => $request->district,
            "logo" => $request->file("logo")->store("images", "public"),
        ]);

        // $bank = Bank::create($request->all());

        // $bank = DB::getPdo()->lastInsertId();

        // dd($bank);

        $prices = CurrencyPrice::all();

        foreach ($prices as $price) {
            BankCurrency::create([
                "bank_id" => $bank->id,
                "currency_id" => $price->currency_id,
                "buy_price" => $price->buy_price,
                "sale_price" => $price->sale_price,
                "balance" => 0,
            ]);
            Account::create([
                "bank_id" => $bank->id,
                "currency_id" => $price->currency_id,
                "balance" => 0,
            ]);
        }

        Alert::success('تم ', 'تم اضافة  بنك جديد للنظام بنجاح');

        return redirect()->route('banks.index');
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
     * @param  \App\Models\Bank  $bank
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bank $bank)
    {
        $request->validate([
            'bank_name' => 'required',
            'state' => 'required',
            'district' => 'required',
        ]);

        $bank->update($request->all());
        Alert::success('تهانينا !!', 'تم تعديل بيانات البنك بنجاح');
        return redirect()->route('banks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param  \App\Models\Bank  $bank
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bank $bank)
    {

        $bank->delete();
        return redirect()->route('banks.index')
            ->withSuccess(__('Bank delete successfully.'));
    }
}
