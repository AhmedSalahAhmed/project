<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;

class FirstRouteController extends Controller
{
    //

    public function index(Request $request)
    {

        $host = explode('.', $request->getHost());

        // return $host;

        if($host[0] == "hardcurrency"){
            return view('auth.login');
        }
        
        if (count($host)) {
                $bank = Bank::where("url", $host[1])->get();
                $bank = $bank??$bank[0];
            if(count($host) >=2){
                    $bank = Bank::where("url", $host[1])->get();
                if($host[0] == "admin"){
                    $bank = $bank[0];
                    return view('manager.login', compact("bank"));
                }elseif($host[0] == "teller"){
                    $bank = $bank[0];
                    return view('bank.login', compact("bank")); 
                }else{
                    $bank = Bank::where("url", $host[0])->get();
                    $bank = $bank[0];
                    return view('manager.login', compact("bank"));
                }
                return view('manager.login', compact("bank"));
            } else {
                return view('auth.login');
            };
        }

    }

}
