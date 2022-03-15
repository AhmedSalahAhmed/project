<?php

namespace App\Http\Controllers\manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\Bank;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;



class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $bank_id = request()->user()->bank_id;
        $banks = Bank::where('id', $bank_id)->get();

   
        $branches = Branch::where('bank_id',$bank_id)->get();
        if ($request->ajax()) {
        return view('manager.branch', compact('branches' ,'banks'))->renderSections()['content'];

        }
        return view('manager.branch', compact('branches' ,'banks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branches = Branch::all();
        return view('manager.branch' , compact('branches'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bank_id = request()->user()->bank_id;  
  
        // dd($bank_id);
        $request->validate([
            'branch_name' => 'required|string',
            'state' => 'required|string',
            'city' => 'required|string',
            'phone_number' => 'required|string',
        ]);
        Branch::create([
            'bank_id' => $bank_id,
            'branch_name' => $request->branch_name,
            'state' => $request->state,
            'city' => $request->city,
            'phone_number' => $request->phone_number,
        ]);
        return redirect()->route('branch.index')
        ->with('success','تمت تســجيل فرع البنك بنجاح');

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
     * @param  \App\Models\Branch  $branch
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Branch $branch)
    {
        $request->validate([
            'branch_name' => 'required|string',
            'city' => 'required|string',
            'phone_number' => 'required|string',
        ]);
       
        $branch->update($request->all());
        return redirect()->route('branch.index')
        ->with('success','تمت تعديل بيانات المدير  بنجاح');
        

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @param  \App\Models\Branch  $branch
     * 
     */
    public function destroy(Branch $branch)
    {
        $branch->delete();
        return redirect()->route('branch.index')
        ->with('success','تم حذف الســـجل');
        
    }
}
