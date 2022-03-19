<?php

namespace App\Http\Controllers\manager;
use App\Http\Controllers\Controller;
use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ManagerController extends Controller
{
    public function authenticate(Request $request) {

        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $host = explode('.', $request->getHost());

        $bank = null;

        if($host[0] != "harcurrency"){
            if(count($host) == 2){
                $bank = Bank::where("url", $host[0])->get();
            }elseif(count($host) == 3){
                $bank = Bank::where("url", $host[1])->get();
            }
            $bank = $bank[0];
        }


        if($bank){
            if(Auth::guard('manager')->attempt(['bank_id'=>$bank->id,'email' => $request->email, 'password' => $request->password],$request->get('remember'))) {
                return redirect()->route('manager.stats');
            }else {
                session()->flash('error','Either Email/Password is incorrect');
                return view("manager.login", compact('bank'));
            }
        }else{
            if(Auth::guard('manager')->attempt(['email' => $request->email, 'password' => $request->password],$request->get('remember'))) {
                return redirect()->route('manager.stats');
            }else {
                session()->flash('error','Either Email/Password is incorrect');
                return view("manager.login", compact('bank'));
            }
        }

    }

    public function logout() {
        $bank=Bank::find(Auth::user()->bank_id);
        Auth::guard('manager')->logout();
        return  view('manager.login', compact("bank"));
    }
}
