<div class="container mt-3">

    <?php if (isset($_SESSION['register']) && $_SESSION['register'] == 'completed'): ?> 
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>¡Successfully!</strong> Successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php elseif(isset($_SESSION['register']) && $_SESSION['register'] == 'failed'): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>¡Error!</strong> Failed.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php 
        Utils::deleteSession('register');
    ?>

    <div class="row mt-5">
        <div class="col-md-7">
            <table class="table table-bordered table-hover" id="myTable">
                <thead>
                    <tr>
                        <th>Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($permission = $permissions->fetch_object()): ?>
                        <tr>
                            <td><?php echo $permission->name ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <form action="<?php echo base_url ?>permission/save" method="POST">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>