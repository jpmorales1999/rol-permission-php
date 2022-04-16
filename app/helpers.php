<?php 

    function comparePermission ($array, $permission) {
        // Contador para determinar si el permiso no ha sido repetido
        $count = 0;

        // Recorrer el Array de atributos actuales comparando con cada uno de los permisos de la tabla Permission
        foreach ($array as $item) {
            if ($item == $permission->name) {
                $count++;
                // Option con Selected
                return "<option value='$permission->name' selected>$permission->name</option>";
            }
        }

        if ($count == 0) {
            // En caso de que no encuentre permisos sementajes, mostrar option sin checked 
            return "<option value='$permission->name'>$permission->name</option>"; 
        }
    }

    function compareRol($idRol, $rol) 
    {
        if ($idRol == $rol->id) {
            // Option With Selected
            return "<option value='$rol->id' selected>$rol->name</option>";
        } else {
            return "<option value='$rol->id'>$rol->name</option>";
        }
    }