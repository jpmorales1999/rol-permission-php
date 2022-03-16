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
                        <th>Permisos</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($rol = $rols->fetch_object()): ?>
                        <tr>
                            <td><?php echo $rol->name ?></td>
                            <td><?php echo $rol->attribute ?></td>
                            <td>
                              <?php
                              if (!Rol::isRolRelated($rol->id)) {
                              ?>
                                <a href="<?php echo base_url ?>rol/edit&id=<?php echo $rol->id ?>" class="btn btn-warning">Edit</a>
                              <?php
                              } else {
                                ?>
                                <p class="btn btn-secondary disabled">Edit</p>
                                <?php
                              }
                              ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <form action="<?php echo base_url ?>rol/save" method="POST">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="permissions" class="form-label">Permissions</label><br>
                            <select name="permissions[]" class="form-control js-example-basic-multiple" multiple>
                                <?php while ($permission = $permissions->fetch_object()): ?>
                                    <div class="form-check form-check-inline">
                                        <option value="<?php echo $permission->name ?>"><?php echo $permission->name ?></option>
                                    </div>
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