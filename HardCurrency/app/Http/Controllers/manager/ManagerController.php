<?php

namespace App\Http\Controllers\manager;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ManagerController extends Controller
{
    public function authenticate(Request $request) {

        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::guard('manager')->attempt(['email' => $request->email, 'password' => $request->password],$request->get('remember'))) {

            return redirect()->route('manager.stats');

        } else {
            session()->flash('error','Either Email/Password is incorrect');
            return back()->withInput($request->only('email'));
        }

    }

    public function logout() {
        Auth::guard('manager')->logout();
        return redirect()->route('manager.login');
    }
}
