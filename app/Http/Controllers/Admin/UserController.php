<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $user = User::find(auth()->user()->id);

        return view('user.profile')->with(compact('user'));
    }

    public function update(Request $request)
    {
        $user = User::find(auth()->user()->id);

        $user->email = $request->input('email');
        $user->tel =  $request->input('tel');

        if($request->input('password') != '')
        {
            $user->password = bcrypt($request->input('password'));
        }

        $user->save();

        return back()->with('notification', 'Datos Actualizados');
    }

    public function read(Request $request)
    {

        if($request->get('name') != '')
        {
            $users = User::search($request->get('name'))->paginate('10');
        }
        else
        {
            $users = User::paginate('10');
        }

    	return view('user.read')->with(compact('users'));
    }

    public function edit($id)
    {
    	$user = User::find($id);

    	return view('user.edit')->with(compact('user'));
    }

    public function auth(Request $request)
    {
        $user = User::find($request->input('idUsuario'));

        if($request->input('option') == 1)
        {
            $user->auth = true;
            $user->save();
        }
        else
        {
            $user->forceDelete();
        }

        return back()->with('notification', 'Datos Actualizados');
    }

    public function delete(Request $request, $id)
    {
        $users = User::paginate('10');
        $user = User::find($id);

        $user->delete();

        return view('user.read')->with(compact('users'));
    }
}
