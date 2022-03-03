<?php

namespace App\Http\Controllers\centralbank;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Bank;
use Illuminate\Support\Facades\Hash;



class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banks = Bank::all();
        
        $employees = Employee::join('banks', 'employees.bank_id', '=', 'banks.id')
               ->get(['employees.*', 'banks.bank_name']);
            //    return $employees;
        return view('centralbank.employee', compact('employees','banks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = Employee::all();
        return view('centeralbank.bank' , compact('employees'));
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
            'employee_name' => 'required|string',
            'bank_id' => 'required|exists:banks,id',
            'email' => 'required|email|unique:employees,email',
            'date_of_birth' => 'nullable|date',
            'national_id' => 'nullable|string',
            'password' => 'required|string',
        ]);
        $employee = Employee::create([
            'bank_id' => $request->bank_id,
            'employee_name' => $request->employee_name,
            'email' => $request->email,
            'user_type' => 'admin',
            'date_of_birth' => $request->date_of_birth,
            'national_id' => $request->national_id,
            'password' => Hash::make($request->password),
        ]);
        return redirect()->route('employee.index')
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
     * @param  \App\Models\Employee  $employee
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'employee_name' => 'required|string',
            // 'bank_id' => 'required|exists:banks,id',
            'email' => 'required|email',
            'date_of_birth' => 'nullable|date',
            'national_id' => 'nullable|string',
            // 'password' => 'required|string',
        ]);
        $employee->update([
            'employee_name' => $request->employee_name,
            'user_type' => 'admin',
            'date_of_birth' => $request->date_of_birth,
            'national_id' => $request->national_id,
        ]);

        if ($request->email != $employee->email) {
            $employee->update([
                'email' => $request->email,
            ]);
        }

        if ($request->password) {
            $employee->update([
                'password' => Hash::make($request->password),
            ]);
        }
        return redirect()->route('employee.index')
        ->with('success','تمت تعديل بيانات المدير  بنجاح');
        

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @param  \App\Models\Employee  $employee
     * 
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employee.index')
        ->with('success','تم حذف الســـجل');
        
    }
}
