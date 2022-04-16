@extends('layouts.dashboard')

@section('content')

    <div class="container col-md-5 mt-5">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <h2>Edit Rol</h2>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('rols.update', $rol->id) }}">
                    @csrf()
                    <input type="hidden" name="_method" value="put">

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" value="{{ $rol->name }}">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Permissions</label>
                        <textarea name="attribute" rows="3" class="form-control" disabled>{{ $rol->attribute }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="attribute" class="form-label">Add Permissions</label>
                        <select name="permissions[]" class="form-control js-example-basic-multiple" multiple>
                            <?php
                        
                                $arrayAttributes = explode(", ", $rol->attribute);

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