<?php

namespace App\Http\Controllers;

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
        $rol->name = strtoupper($request->input('name'));

        // Convertir Array a String - Están separados por " " -> Espacio en blanco, le agrego una coma para mejor visualización
        $string = implode(", ", $request->input('permissions'));

        $rol->attribute = $string;
        $rol->save();

        return redirect(route('rols.index'))->with('message', 'Added Successfully');
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
