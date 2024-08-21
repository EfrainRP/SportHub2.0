<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke() //One route 
    {
        return view('welcome');
    }

}
