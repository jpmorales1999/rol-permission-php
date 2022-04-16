@extends('layouts.dashboard')

@section('content')

<div class="container mt-3">
    @if(Session::has('message'))
        <div class="alert alert-success" role="alert">
            {{Session::get('message')}}
        </div>   
    @endif
    <div class="row mt-5">
        <div class="col-md-7">
            <table class="table table-bordered table-hover" id="myTable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Current Permissions</th>
                        <th>Rol</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->attribute }}</td>
                            <td>{{ $user->rols->name }}</td>
                            <td>
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf()
                        
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" value="{{ old('password') }}">
                        </div>
                        <div class="mb-3">
                            <label for="rol" class="form-label">Rol</label>
                            <select class="form-control" name="idrol">
                                @foreach($rols as $rol)
                                    <option value="{{ $rol->id }}">{{ $rol->name }}</option>
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
    </div>
</div>

@endsection