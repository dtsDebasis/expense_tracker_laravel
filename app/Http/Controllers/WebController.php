<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebController extends Controller
{
    public function home()
    {
        return view('website.home');
    }
    public function teams()
    {
        return view('website.team');
    }
    public function expenses()
    {
        return view('website.expense');
    }
}
