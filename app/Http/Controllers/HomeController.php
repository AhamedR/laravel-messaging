<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user_id =  Auth::id();
       if(Auth::user()->status==0)
       {
           DB::table('users')->where('id', '=',$user_id)->update(['status'=>1]);
       }

        $users_details = DB::table('users')->where('id', '!=',$user_id)->get();
        return view('home')->with('user_details',$users_details);
    }

}
