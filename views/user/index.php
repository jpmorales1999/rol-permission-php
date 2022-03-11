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
                        <th>Email</th>
                        <th>Current Permissions</th>
                        <th>Rol</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($user = $users->fetch_object()): ?>
                        <tr>
                            <td><?php echo $user->name ?> <?php echo $user->lastname ?></td>
                            <td><?php echo $user->email ?></td>
                            <td><?php echo $user->attribute ?></td>
                            <td><?php echo $user->rol ?></td>
                            <td>
                                <a href="<?php echo base_url ?>user/edit&id=<?php echo $user->id ?>" class="btn btn-warning">Edit</a>
                                <a href="<?php echo base_url ?>user/delete&id=<?php echo $user->id ?>" class="btn btn-danger delete-form">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <form action="<?php echo base_url ?>user/save" method="POST">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="lastname" class="form-label">Lastname</label>
                            <input type="text" class="form-control" name="lastname" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="rol" class="form-label">Rol</label>
                            <select class="form-control" name="idrol">
                                <?php while ($rol = $rols->fetch_object()): ?>
                                    <option value="<?php echo $rol->id ?>"><?php echo $rol->name ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>