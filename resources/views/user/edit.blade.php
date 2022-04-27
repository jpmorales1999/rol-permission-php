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
                    <input type="hidden" id="id" name="id" value="{{ $user->id }}">
                    <input type="hidden" id="permision_user" name="permision_user" value="{{ $user->attribute }}">

                    <input type="hidden" id="permision_user" name="permision_user" value="{{ $user->attribute }}">

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                    </div>

                    <div class="mb-3">
                        <label for="rol" class="form-label">Rol</label>
                        <select class="form-control rols" name="idrol" id="idrol">
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
                            ?>
                            @foreach($permissions as $permission)
                                <?php echo comparePermission($arrayAttributes, $permission) ?>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-control mb-3 w-100">
                      <span class="form-label">Permisos especiales</span>
                      <span class="button btn bg-warning" onclick="removePermissionAll()" id="removePermmission">quitar permisos especiales</span>
                      <hr/>
                      <span id="special_permission">Sin permisos adicionales al rol</span>
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