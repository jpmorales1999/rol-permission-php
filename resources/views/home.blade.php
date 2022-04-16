@extends('layouts.dashboard')

@section('content')

<main role="main" class="mt-5">
  
    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading">¡Hi, {{ Auth::user()->name }}! know your permissions</h1>
            <p class="lead text-muted">There are a variety of permissions offered by the page administrator</p>
        </div>
    </section>

    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <?php 
                    $arrayAttributes = explode(", ", Auth::user()->attribute); 
                ?>
                @foreach($arrayAttributes as $permission)
                    <div class="col">
                      <a href="#" class="card shadow-sm button p-0 view overlay text-decoration-none text-dark">
                            <svg class="bd-placeholder-img card-img-top" width="100%" height="125" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: صورة مصغرة" preserveAspectRatio="xMidYMid slice" focusable="false">
                                <title>{{ $permission }}</title>
                                <rect width="100%" height="100%" fill="#55595c" /><text x="30%" y="50%" fill="#eceeef" dy=".3em">Service <?php echo $permission ?></text>
                            </svg>

                            <div class="card-body mask flex-center rgba-red-strong">
                                <p class="card-text d-inline">Access your permission {{ $permission }}</p>
                            </div>
                      </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</main>

<footer class="text-muted py-5">
    <div class="container">
        <p class="mb-1">All Rights Reserved &copy; 2022.</p>
    </div>
</footer>

@endsection

