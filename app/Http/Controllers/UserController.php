<?php

namespace App\Http\Controllers;

use App\User;
use App\Rol;
use App\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all()->where('status', '1');
        $rols = Rol::all();
        return view('user.index', compact('users', 'rols'));
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
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'idrol' => 'required|integer'
        ]);

        $user = new User();
        $user->name = strtoupper($request->input('name'));
        $user->email = $request->input('email');
        $user->idrol = strtoupper($request->input('idrol'));
        $rol = Rol::findOrFail($request->input('idrol'));
        $user->attribute = $rol->attribute;
        $user->password = Hash::make($request->input('password'));
        $user->status = 1;
        $user->save();

        return redirect(route('users.index'))->with('message', 'Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $rols = Rol::all();
        $permissions = Permission::all();
        $activateJS = true;
        return view('user.edit', compact('user', 'rols', 'permissions', 'activateJS'));
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
        $request->validate([
            'name' => 'required|string',
            'idrol' => 'required',
            'permissions' => 'required'
        ]);

        $user = User::findOrFail($id);
        $user->name = strtoupper($request->input('name'));
        $user->idrol = $request->input('idrol');
        $string = implode(", ", $request->input('permissions'));
        $user->attribute = $string;
        $user->save();

        return redirect(route('users.index'))->with('message', 'Added Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
