<?php

namespace App\Http\Controllers\centralbank;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Manager;
use App\Models\Bank;
use Illuminate\Support\Facades\Hash;



class ManagersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banks = Bank::all();
        
        $managers = Manager::join('banks', 'managers.bank_id', '=', 'banks.id')
               ->get(['managers.*', 'banks.bank_name']);
            //    return $managers;
        return view('centralbank.manager', compact('managers','banks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $managers = Manager::all();
        return view('centeralbank.manager' , compact('managers'));
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
            'manager_name' => 'required|string',
            'bank_id' => 'required|exists:banks,id',
            'email' => 'required|email|unique:managers,email',
            'password' => 'required|string',
        ]);
        $manager = Manager::create([
            'bank_id' => $request->bank_id,
            'manager_name' => $request->manager_name,
            'email' => $request->email,
            'user_type' => 'admin',
            'password' => Hash::make($request->password),
        ]);
        return redirect()->route('managers.index')
        ->with('success','تمت تســجيل مدير بنك بنجاح');

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
     * @param  \App\Models\Manager  $manager
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Manager $manager)
    {
        $request->validate([
            'manager_name' => 'required|string',
            // 'bank_id' => 'required|exists:banks,id',
            'email' => 'required|email',
            // 'password' => 'required|string',
        ]);
        $manager->update([
            'manager_name' => $request->manager_name,
            'user_type' => 'admin',
        ]);

        if ($request->email != $manager->email) {
            $manager->update([
                'email' => $request->email,
            ]);
        }

        if ($request->password) {
            $manager->update([
                'password' => Hash::make($request->password),
            ]);
        }
        return redirect()->route('managers.index')
        ->with('success','تمت تعديل بيانات المدير  بنجاح');
        

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @param  \App\Models\Manager  $manager
     * 
     */
    public function destroy(Manager $manager)
    {
        $manager->delete();
        return redirect()->route('managers.index')
        ->with('success','تم حذف الســـجل');
        
    }
}
