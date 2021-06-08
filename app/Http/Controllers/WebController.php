<?php

namespace App\Http\Controllers;

use App\Models\Member;
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
        $members = Member::orderBy('id','desc')->get()->makeHidden(['splits']);

        return view('website.expense')->with('members',$members);
    }
}
