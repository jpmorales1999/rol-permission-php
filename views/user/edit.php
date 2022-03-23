<?php while ($user = $result->fetch_object()) : ?>
    <div class="container col-md-5 mt-5">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <h2>Edit User</h2>
                </div>
            </div>
            <div class="card-body">
                    <form action="<?php echo base_url ?>user/update" method="POST">
                    <input type="hidden" name="id" value="<?php echo $user->id ?>">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" value="<?php echo $user->name ?>">
                    </div>
                    <div class="mb-3">
                        <label for="lastname" class="form-label">Lastname</label>
                        <input type="text" class="form-control" name="lastname" value="<?php echo $user->lastname ?>">
                    </div>
                    <div class="mb-3">
                        <label for="rol" class="form-label">Rol</label>
                        <select class="form-control" name="idrol">
                            <?php while ($rol = $rols->fetch_object()) : ?>
                                <?php echo Utils::compareRol($user->idrol, $rol); ?>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="attribute" class="form-label">Add Permissions</label>
                        <select name="permissions[]" class="form-control js-example-basic-multiple" multiple>
                            <?php // Convertir String En Array
                                $arrayAttributes = explode(", ", $user->attribute);
                            ?>
                            <?php while ($permission = $permissions->fetch_object()) : ?>
                                <?php echo Utils::comparePermission($arrayAttributes, $permission); ?>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="<?php echo base_url ?>user/update&idUser=<?php echo $user->id ?>&idRol=<?php echo $user->idrol ?>" class="btn btn-secondary">Restore Permissions</a>
                </form>
            </div>
        </div>
        
    </div>
<?php endwhile; ?>