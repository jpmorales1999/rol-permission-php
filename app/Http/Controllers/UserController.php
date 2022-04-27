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
        $restore = false;
        $user = User::findOrFail($id);
        $rols = Rol::all();
        $permissions = Permission::all();

        $r = Rol::all()->where('id', $user->idrol)->first();

        $u_permission = explode(', ',$user->attribute);
        $r_permission = explode(', ',$r->attribute);
        
        $old_permission = array();
        $special_permission = array();

        if (!empty($u_permission))
        foreach ($u_permission as $key => $attribute) {
          if (!in_array($attribute, $r_permission)){ array_push($special_permission, $attribute); }
          else { array_push($old_permission, $attribute); }
        }

        if(!empty($special_permission) || count($old_permission) != count($r_permission)) $restore = true;

        return view('user.edit', compact('user', 'rols', 'permissions', 'restore'));
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
      $user = User::findOrFail($id);
      if (!isset($request->restore)) {
        $request->validate([
          'name' => 'required|string',
          'idrol' => 'required',
          'permissions' => 'required'
        ]);
        
        $user->name = strtoupper($request->input('name'));
        $user->idrol = $request->input('idrol');
        $string = implode(", ", $request->input('permissions'));
        $user->attribute = $string;
        $user->save();
        
        return redirect(route('users.index'))->with('message', 'Added Successfully');
        
      } else {
        $r = Rol::all()->where('id', $user->idrol)->first();
        $user->attribute = $r->attribute;
        $user->save();
        $restore = false;
        return redirect(route('users.edit', $id));
      }
    }

    public function restorePremission(Request $request, $id)
    {
      print_r($request);
      die();
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
