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
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($permissions as $permission)
                        <tr>
                            <td>{{ $permission->name }}</td>
                            <td>
                                <a href="" class="btn btn-warning">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('permissions.store') }}">
                        @csrf()
                        
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
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