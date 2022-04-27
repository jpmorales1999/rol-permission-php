<?php

namespace App\Http\Controllers;

use App\User;
use App\Rol;
use App\Permission;
use Illuminate\Http\Request;

class PermissionUsers extends Controller
{
  public function specialPermission(Request $request) {
    
    if(!isset($request) || !isset($request->id_rol) || !isset($request->id_user))
    return response()->json(['success' => false, 'data' => $request]);

    $id_user = $request->id_user;
    $id_rol = $request->id_rol;
    
    $u = User::findOrFail($id_user);
    $r = Rol::findOrFail($id_rol);
    $u_r = Rol::all()->where('id', $u->idrol)->first();
    
    $u_permission = explode(', ',$u->attribute);
    $r_permission = explode(', ',$r->attribute);
    $u_r_permission = explode(', ',$u_r->attribute);
    
    $special_permission = array();
    
    if (!empty($u_permission))
    foreach ($u_permission as $key => $attribute) {
      if (!in_array($attribute, $u_r_permission)) array_push($special_permission, $attribute);
    }

    $new_permission = $r_permission;
    
    if (!empty($special_permission))
    foreach ($special_permission as $key => $attribute) {
      if (!in_array($attribute, $new_permission)) array_push($new_permission, $attribute);
    }

    $new_special_permission = array();

    if (!empty($new_permission))
    foreach ($new_permission as $key => $attribute) {
      if (!in_array($attribute, $r_permission)) array_push($new_special_permission, $attribute);
    }

    ///$token = csrf_token();

    $response = Array(
      "new_permission" => join(', ', $new_permission), 
      "new_special_permission" => join(', ', $new_special_permission),
      ///"csrf" => "$token",
    );

    return response()->json($response);
  }
}
