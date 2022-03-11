<?php if(!isset($_SESSION['admin'])): ?>

    <nav class="navbar navbar-dark bg-dark p-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo base_url ?>user/index">Rol - Permission</a>
            <ul class="nav">
                <li class="nav-item">
                    <a style="color: white;" class="nav-link" href="<?php echo base_url ?>login/logout">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

<?php endif; ?>


<main role="main" class="mt-5">
    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading">¡Hi, <?php echo $_SESSION['identity']->name ?>! know your permissions</h1>
            <p class="lead text-muted">There are a variety of permissions offered by the page administrator</p>
        </div>
    </section>

    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <?php 
                    $arrayAttributes = explode(", ", $_SESSION['identity']->attribute);
                    foreach ($arrayAttributes as $permission): 
                ?>
                    <div class="col">
                        <div class="card shadow-sm">
                            <svg class="bd-placeholder-img card-img-top" width="100%" height="125" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: صورة مصغرة" preserveAspectRatio="xMidYMid slice" focusable="false">
                                <title>Placeholder</title>
                                <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef" dy=".3em">Service <?php echo $permission ?></text>
                            </svg>

                            <div class="card-body">
                                <p class="card-text d-inline">Access your permission</p> <a href="#"><?php echo $permission ?></a>
                            </div>
                        </div>
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