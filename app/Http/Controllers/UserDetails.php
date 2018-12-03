<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UserDetails extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = User::all("id","status");
        return $data;
    }
    public function show($id)
    {
        $users = User::find($id);

        if (Auth::id()==$id || $users == null)
        {
            return redirect()->route('home');
        }
        else
        {
            $tabl_nm = "chat_".Auth::id()."_and_".$id;
            $tabl_nm2 = "chat_".$id."_and_".Auth::id();
            $messages = null;

            if (Schema::hasTable($tabl_nm) || Schema::hasTable($tabl_nm2)) {
                //new chat
            }
            else
            {
                Schema::create($tabl_nm, function (Blueprint $table) {
                    $table->increments('id');
                    $table->string('user_id');
                    $table->string('message');
                });
            }


            if (Schema::hasTable($tabl_nm))
            {
                $messages = DB::table($tabl_nm)->get();

            }
            elseif (Schema::hasTable($tabl_nm2))
            {
                $messages = DB::table($tabl_nm2)->get();

            }

            return view('messages')->with('user_det',$users)->with('messages',$messages);

        }


    }

    public function store(Request $request)
    {

        return 'ahamed';
    }
}
