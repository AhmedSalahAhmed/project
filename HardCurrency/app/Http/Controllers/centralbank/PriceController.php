<?php

namespace App\Http\Controllers\centralbank;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CurrencyPrice;
use App\Models\Currency;
use App\Models\BankCurrency;
use App\Models\Bank;
use RealRashid\SweetAlert\Facades\Alert;

class PriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $prices = CurrencyPrice::join('currencies', 'currency_prices.currency_id', '=', 
        // 'currencies.id')->latest("currency_date")
        // ->groupBy("currency_id")->get(['currencies.*', 'currency_prices.*']);

        // $prices = CurrencyPrice::join('currencies', 'currency_prices.currency_id', '=', 
        // 'currencies.id')
        // ->latest('currency_date')->get(['currencies.*', 'currency_prices.*'])->unique("curency_id");

     
        // return $prices; 

        $prices = CurrencyPrice::select("*")->latest("currency_date")->get()->unique("currency_id");
        $collected = [];
        foreach($prices as $price){
            $currency = Currency::find($price->currency_id);
            $price->currency_date = substr($price->currency_date, 11,10);
            $price->currency = $currency;
            array_push($collected, $price);
        }
        
        // return $collected;



		return view('centralbank.price',compact('prices'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $prices = CurrencyPrice::all();
        return view('centralbank.price' , compact('prices'));
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
            'buy_price' => 'required',
            'sale_price' => 'required',
            'currency_id' => 'required',

        ]);
        // print_r($request->all());
        CurrencyPrice::create($request->all());
        // dd($request->all());   

        Alert::success('تهانينا !!', 'تم اضافة  عملة جديدة بنجاح');
     
        return redirect()->route('price.index');
    }

  
}
