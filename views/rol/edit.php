<?php while ($rol = $result->fetch_object()) : ?>
    <div class="container col-md-5 mt-5">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <h2>Edit Rol</h2>
                </div>
            </div>
            <div class="card-body">
                <form action="<?php echo base_url ?>rol/update" method="POST">
                    <input type="hidden" name="id" value="<?php echo $rol->id ?>">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" value="<?php echo $rol->name ?>">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Permissions</label>
                        <textarea name="attribute" rows="5" class="form-control" disabled><?php echo $rol->attribute ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="attribute" class="form-label">Add Permissions</label>
                        <select name="permissions[]" class="form-control js-example-basic-multiple" multiple>
                            <?php // Convertir String En Array
                              $arrayAttributes = explode(", ", $rol->attribute);
                              
                              while ($permission = $permissions->fetch_object()) :
                                echo Utils::comparePermission($arrayAttributes, $permission); 
                              endwhile; 
                            ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>

    </div>
<?php endwhile; ?>