<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    public function index(){ //View Login 
        return view('Login.form'); //Folder and file (Route)
      }

    public function register(RegisterRequest $request){ //View Login      
        //Create User
        $user = User::create($request->validated()); //Validate the fields of the registered user (app\Http\Requests\RegisterRequest)
    // If validation passes, process the data...
    // Returns a success response
    return response()->json(['success' => true]);
      //$credentials = request();          //Returns the inputs of the view login in "credentials"

    }

}