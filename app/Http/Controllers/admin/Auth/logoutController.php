<?php

namespace App\Http\Controllers\admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Route;
class logoutController extends Controller
{



    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    public function logout()
    {

       Auth::guard('web')->logout();
        return redirect(route("home"));
    }
}
