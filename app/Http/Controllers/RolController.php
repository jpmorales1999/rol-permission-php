<?php

namespace App\Http\Controllers;

use App\User;
use App\Rol;
use App\Permission;
use Illuminate\Http\Request;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rols = Rol::all();
        $permissions = Permission::all();
        return view('rol.index', compact('rols', 'permissions'));
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
            'name' => 'required|string|unique:rols',
            'permissions' => 'required'
        ]);

        // Convertir Array a String - Están separados por " " -> Espacio en blanco, le agrego una coma para mejor visualización
        $string = implode(", ", $request->input('permissions'));

        $rol = new Rol();
        $rol->name = strtoupper($request->input('name'));
        $rol->attribute = $string;
        $rol->save();

        return redirect(route('rols.index'))->with('message', 'Added Successfully');
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
        $rol = Rol::findOrFail($id);
        $permissions = Permission::all();
        return view('rol.edit', compact('rol', 'permissions'));
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
            'permissions' => 'required'
        ]);

        $rol = Rol::findOrFail($id);
        $this->updateUsersPermission($request->input('permissions'), $rol);
        $rol->name = strtoupper($request->input('name'));

        // Convertir Array a String - Están separados por " " -> Espacio en blanco, le agrego una coma para mejor visualización
        $string = implode(", ", $request->input('permissions'));

        $rol->attribute = $string;
        $rol->save();
        return redirect(route('rols.index'))->with('message', 'Added Successfully');
    }
    
    private function updateUsersPermission($rol_permissions_post, $rol_post) {
      try {
        $users_db = 
          User::select(
            "users.id", 
            "users.name as  name",
            "users.attribute as attribute"
          )
          ->join("rols","users.idrol","=","rols.id")
          ->where('users.idrol','=',$rol_post->id)
          ->get();
      } catch (Throwable $th) {
        $users_db = [];
        throw $th;
      }

      $add_permissions = array();
      $del_permissions = array();

      $rol_permissions_db = explode(", ", $rol_post->attribute);
      
      if (!empty($rol_permissions_post))
      foreach ($rol_permissions_post as $key => $attribute_rol_post) {
        if (!in_array($attribute_rol_post, $rol_permissions_db)) array_push($add_permissions, $attribute_rol_post);
      }

      if (!empty($rol_permissions_post))
      foreach ($rol_permissions_db as $key => $attribute_rol_db) {
        if (!in_array($attribute_rol_db, $rol_permissions_post)) array_push($del_permissions, $attribute_rol_db);
      }

      $new_user_permission = Array();
      
      if (!empty($users_db))
      foreach ($users_db as $key => $users) {
                $new_user_permission = [];
        $new_user_permission = explode(", ", $users->attribute);
        
        if (!empty($add_permissions))
        foreach ($add_permissions as $key => $attribute) {
          if (!in_array($attribute, $new_user_permission)) array_push($new_user_permission, $attribute);
        }
        
        if (!empty($new_user_permission))
        foreach ($new_user_permission as $key => $attribute) {
          if (in_array($attribute, $del_permissions) && !empty($del_permissions)) {
            array_splice($new_user_permission, array_search($attribute, $new_user_permission), 1);
          }
        }
        
        $permissions = "";
        $permissions = join(", ", $new_user_permission);

        $users->attribute = $permissions;
        $users->save();
      }
    }

    private function UserUpdateRol($id, $atribute) {
      try {
        //code...
      } catch (\Throwable $th) {
        throw $th;
      }
      //$user->name = $user->name;
      //$user->attribute = "HTTP, NAS, VOIP, SSL";
      // $result = false;

      // if ($user->save()) {
      //   $result = true;
      // }

      // $result;
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
