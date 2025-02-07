<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function showHomePage(){
        return response()->view('parts.home-page');
    }
}
