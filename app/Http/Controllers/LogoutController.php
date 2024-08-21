<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
class LogoutController extends Controller
{
    public function logout(Request $request){
        Auth::logout();   #Log out
        $request->session()->invalidate();      #Invalidate session
        $request->session()->regenerateToken(); #Regenerate security token
        Session::flush();    #Release the session flow
        return redirect()->to('login');
    }

}
