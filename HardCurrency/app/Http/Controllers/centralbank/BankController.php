<?php

namespace App\Http\Controllers\centralbank;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bank;
class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $banks = Bank::oldest()->paginate(4);
		return view('centralbank.bank',compact('banks'))->with('i', (request()->input('page', 1) - 1) * 4);
        
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $banks = Bank::all();
        return view('centeralbank.bank' , compact('banks'));
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
            'bank_name' => 'required',
            'logo' => 'required',
            'address' => 'required',
        ]);
        Bank::create($request->all());
        // Alert::success('تم ', 'تم اضافة  بنك جديد للنظام بنجاح');
     
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
        $bank->update($request->all());
        // Alert::success('تهانينا !!', 'تم تعديل بيانات البنك بنجاح');
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
