<?php

namespace App\Http\Controllers\centralbank;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;



class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        
        $users = User::all();
            //    return $users;
           
        // if ($request->ajax()) {

        //     return view('centralbank.users', compact('users'))
        //     ->renderSections()['content'];
        //     }
        return view('centralbank.users', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('centeralbank.users' , compact('users'));
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
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'type' => 'user',
            'password' => Hash::make($request->password),
        ]);
        
        return redirect()->route('users.index')
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
     * @param  \App\Models\User  $user
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string',
            // 'bank_id' => 'required|exists:banks,id',
            'email' => 'required|email',
            // 'password' => 'required|string',
        ]);
        $user->update([
            'name' => $request->name,
            
        ]);

        if ($request->email != $user->email) {
            $user->update([
                'email' => $request->email,
            ]);
        }

        if ($request->password) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }
        return redirect()->route('users.index')
        ->with('success','تمت تعديل بيانات المدير  بنجاح');
        

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @param  \App\Models\User  $user
     * 
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')
        ->with('success','تم حذف الســـجل');
        
    }
}
