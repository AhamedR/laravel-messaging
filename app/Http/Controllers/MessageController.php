<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Schema\Blueprint;
use App\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use function Symfony\Component\VarDumper\Tests\Fixtures\bar;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'message' => 'required'
        ]);
        $table_insert = $request->input('invisible');

        DB::table($table_insert)->insert(
            array(
                'user_id' => Auth::id(),
                'message' =>$request->input('message')
            )
        );
       return back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
                    $table->string('message',500);
                });
            }

            $tableName = null;
            if (Schema::hasTable($tabl_nm))
            {
                $tableName = $tabl_nm;
                $messages = DB::table($tabl_nm)->get();

            }
            elseif (Schema::hasTable($tabl_nm2))
            {
                $tableName = $tabl_nm2;
                $messages = DB::table($tabl_nm2)->get();

            }


            return view('messages')
                ->with('user_det',$users)
                ->with('messages',$messages)
                ->with('table_name',$tableName);

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
