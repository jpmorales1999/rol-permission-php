@extends('layouts.dashboard')

@section('content')

    <div class="container col-md-5 mt-5">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <h2>Edit User</h2>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('users.update', $user->id) }}" method="POST">

                    @csrf()
                    <input type="hidden" name="_method" value="put">

                    <input type="hidden" id="idr" name="idr" value="{{ $user->idrol }}">

                    <input type="hidden" id="permision_user" name="permision_user" value="{{ $user->attribute }}">

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                    </div>

                    <div class="mb-3">
                        <label for="rol" class="form-label">Rol</label>
                        <select class="form-control rols" name="idrol" id="idrol">
                            <?php 
                                function compareRol($idRol, $rol) 
                                {
                                    if ($idRol == $rol->id) {
                                        // Option With Selected
                                        return "<option value='$rol->id' selected>$rol->name</option>";
                                    } else {
                                        return "<option value='$rol->id'>$rol->name</option>";
                                    }
                                }
                            ?>
                            @foreach($rols as $rol)
                                <?php echo compareRol($user->idrol, $rol); ?>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3 w-100">
                        <label for="attribute" class="form-label">Add Permissions</label>
                        <select id="permissions" name="permissions[]" class="form-control js-example-basic-multiple" multiple>
                            <?php 

                                $arrayAttributes = explode(", ", $user->attribute);

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

                            ?>
                            @foreach($permissions as $permission)
                                <?php echo comparePermission($arrayAttributes, $permission); ?>
                            @endforeach
                        </select>
                    </div>
                    
                    @if(count($errors) >= 1)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>      
    </div>

@endsection