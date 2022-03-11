<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rol - Permission</title>
    <link rel="stylesheet" href="<?php echo base_url ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url ?>assets/css/main.css">
    <link rel="stylesheet" href="<?php echo base_url ?>assets/css/select2.min.css">
    <link rel="stylesheet" href="<?php echo base_url ?>assets/css/dataTables.min.css">
</head>

<body>

    <?php if(isset($_SESSION['admin'])): ?>
        <nav class="navbar navbar-dark bg-dark p-3">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?php echo base_url ?>user/index">Rol - Permission</a>
                <ul class="nav">
                    <li class="nav-item">
                        <a style="color: white;" class="nav-link" href="<?php echo base_url ?>user/index">User</a>
                    </li>
                    <li class="nav-item">
                        <a style="color: white;" class="nav-link" href="<?php echo base_url ?>rol/index">Rol</a>
                    </li>
                    <li class="nav-item">
                        <a style="color: white;" class="nav-link" href="<?php echo base_url ?>permission/index">Permission</a>
                    </li>
                    <li class="nav-item">
                        <a style="color: white;" class="nav-link" href="<?php echo base_url ?>login/listPermissions">My Permissions</a>
                    </li>
                    <li class="nav-item">
                        <a style="color: white;" class="nav-link" href="<?php echo base_url ?>login/logout">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>
    <?php endif; ?>