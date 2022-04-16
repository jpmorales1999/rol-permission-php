<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" href="{{asset('css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/dataTables.min.css')}}">
</head>

<body>

    <nav class="navbar navbar-dark bg-dark p-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{url('/home')}}">Rol - Permission</a>
            <ul class="nav">
                @if(Auth::user()->rols->name == 'ADMINISTRADOR')
                    <li class="nav-item">
                        <a style="color: white;" class="nav-link" href="{{ route('users.index') }}">User</a>
                    </li>
                    <li class="nav-item">
                        <a style="color: white;" class="nav-link" href="{{ route('rols.index') }}">Rol</a>
                    </li>
                    <li class="nav-item">
                        <a style="color: white;" class="nav-link" href="{{ route('permissions.index') }}">Permission</a>
                    </li>
                    <li class="nav-item">
                        <a style="color: white;" class="nav-link" href="">My Permissions</a>
                    </li>
                @endif
                <li class="nav-item">
                    <a style="color: white;" class="nav-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>      
            </ul>
        </div>
    </nav>

    @yield('content')

    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/select2.min.js')}}"></script>
    <script src="{{asset('js/dataTables.min.js')}}"></script>
    <script text="javascript">
        $(document).ready(function() {
            $('#myTable').DataTable();
            $('.js-example-basic-multiple').select2();
        });
    </script>
</body>
</html>