<?php 

    require_once 'models/rol.php';
	require_once 'models/permission.php';

	class RolController {

		public function index(){
			Utils::isAdmin();
            $rol = new Rol();
            $rols = $rol->getAll();

			$permission = new Permission();
            $permissions = $permission->getAll();

            // Renderizar vista
			require_once 'views/rol/index.php';
		}
		
		public function edit () {
			Utils::isAdmin();
			if (isset($_GET)) {
				$id = isset($_GET['id']) ? $_GET['id'] : false;
				
				if ($id) {
					$rol = new Rol();
					$rol->setId($id);
					$result = $rol->getOne();

					$permission = new Permission();
            		$permissions = $permission->getAll();
				}
				
			}
			require_once 'views/rol/edit.php';
		}

		public function update () {
			Utils::isAdmin();
			if(isset($_POST)){
				$id = isset($_POST['id']) ? $_POST['id'] : false;
				$name = isset($_POST['name']) ? strtoupper($_POST['name']) : false;
				// Obtener el Array Permisos enviado desde el Select Multiple
				$permissions = isset($_POST['permissions']) ? $_POST['permissions'] : false;

				if($id && $name && $permissions){
					$rol = new Rol();
					$rol->setId($id);	
					$rol->setName($name);	
					// Convertir Array a String - Están separados por " " -> Espacio en blanco, le agrego una coma para mejor visualización
					$string = implode(", ", $permissions);
					$rol->setAttribute($string);
					// echo var_dump($permissions);
					// die();
					$rol->updateUsersPermission($permissions);	
					$save = $rol->update();

					if ($save) {
						$_SESSION['register'] = "completed";
					} else {
						$_SESSION['register'] = "failed";
					}
				} else {
					$_SESSION['register'] = "failed";
				}
			} else {
				$_SESSION['register'] = "failed";
				header('Location: ' . base_url . 'rol/index');
			}
      header('Location: ' . base_url . 'rol/index');
		}

    public function save(){
			Utils::isAdmin();
			if(isset($_POST)){
				$name = isset($_POST['name']) ? strtoupper($_POST['name']) : false;
				// Obtener el Array Permisos enviado desde el Select Multiple
				$permissions = isset($_POST['permissions']) ? $_POST['permissions'] : false;

				if($name && $permissions){
					$rol = new Rol();
					$rol->setName($name);	
					// Convertir Array a String - Están separados por " " -> Espacio en blanco, le agrego una coma para mejor visualización
					$string = implode(", ", $permissions);
					$rol->setAttribute($string);	
					$save = $rol->save();

					if ($save) {
						$_SESSION['register'] = "completed";
					} else {
						$_SESSION['register'] = "failed";
					}
				} else {
					$_SESSION['register'] = "failed";
				}
			} else {
				$_SESSION['register'] = "failed";
				header('Location: ' . base_url . 'rol/index');
			}
			header('Location: ' . base_url . 'rol/index');
		}

    }

?>