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

        if (count($host) == 2) {
            $bank = Bank::where("url", $host[0])->get();
            // return $bank[0];
            if (count($bank) != 0) {
                $bank = $bank[0];
                return view('manager.login', compact("bank"));
            } else {
                return view('auth.login');
            };
        }

    }

}
