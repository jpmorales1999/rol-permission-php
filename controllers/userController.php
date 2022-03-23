<?php 

    require_once 'models/user.php';
    require_once 'models/rol.php';
    require_once 'models/permission.php';

	class UserController {

		public function index(){
			Utils::isAdmin();

			$user = new User();
            $users = $user->getAll();

            $rol = new Rol();
            $rols = $rol->getAll();

            // Renderizar vista
			require_once 'views/user/index.php';
		}

        public function save(){
			Utils::isAdmin();
			if(isset($_POST)){
				$name = isset($_POST['name']) ? strtoupper($_POST['name']) : false;
				$lastname = isset($_POST['lastname']) ? strtoupper($_POST['lastname']) : false;
				$email = isset($_POST['email']) ? $_POST['email'] : false;
				$password = isset($_POST['password']) ? $_POST['password'] : false;
				$idrol = isset($_POST['idrol']) ? $_POST['idrol'] : false;

				if($name && $lastname && $email && $idrol && $password){
					// Instancia Rol
					$rol = new Rol();
					// Asigno Id Seleccionado por el User
					$rol->setId($idrol);
					// Obtengo un Rol según ID
            		$rols = $rol->getOne();

					// Obtener los atributos del ROL seleccionado para el usuario
					$rol = $rols->fetch_object();
					$attributes = $rol->attribute;

					$user = new User();
					$user->setName($name);	
					$user->setLastname($lastname);
					$user->setAttribute($attributes);
					$user->setEmail($email);
					$password_hash = password_hash($password, PASSWORD_BCRYPT);	
					$user->setPassword($password_hash);
					$user->setIdRol($idrol);
					$save = $user->save();

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
				header('Location: ' . base_url . 'user/index');
			}
			header('Location: ' . base_url . 'user/index');
		}

		public function edit () {
			Utils::isAdmin();
			if (isset($_GET)) {
				$id = isset($_GET['id']) ? $_GET['id'] : false;
				
				if ($id) {
					$user = new User();
					$user->setId($id);
					$result = $user->getOne();

					$rol = new Rol();
            		$rols = $rol->getAll();

					$permission = new Permission();
            		$permissions = $permission->getAll();
				}
			}
			require_once 'views/user/edit.php';
		}

		public function delete () {
			Utils::isAdmin();
			if (isset($_GET)) {
				$id = isset($_GET['id']) ? $_GET['id'] : false;
				
				if ($id) {
					$user = new User();
					$user->setId($id);
					$save = $user->delete();

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
				header('Location: ' . base_url . 'user/index');
			}
			header('Location: ' . base_url . 'user/index');
		}

		public function update () {
			Utils::isAdmin();
			if(isset($_POST['id']) && isset($_POST['name']) && isset($_POST['lastname']) && isset($_POST['idrol']) && isset($_POST['permissions'])){
				$id = isset($_POST['id']) ? $_POST['id'] : false;
				$name = isset($_POST['name']) ? strtoupper($_POST['name']) : false;
				$lastname = isset($_POST['lastname']) ? strtoupper($_POST['lastname']) : false;
				$idrol = isset($_POST['idrol']) ? $_POST['idrol'] : false;
				$permissions = isset($_POST['permissions']) ? $_POST['permissions'] : false;

				if($id && $name && $lastname && $idrol && $permissions){
					$user = new User();
					$user->setId($id);	
					$user->setName($name);	
					$user->setLastname($lastname);
					$user->setIdRol($idrol);
					// Convertir Array a String - Están separados por " " -> Espacio en blanco, le agrego una coma para mejor visualización
					$string = implode(", ", $permissions);
					$user->setAttribute($string);
					$save = $user->update();
					if ($save) {
						$_SESSION['register'] = "completed";
					} else {
						$_SESSION['register'] = "failed";
					}
				} else {
					$_SESSION['register'] = "failed";
				}
			} else if(isset($_GET['idUser']) && isset($_GET['idRol'])) {
				$idUser = isset($_GET['idUser']) ? $_GET['idUser'] : '-1';
				$idRol = isset($_GET['idRol']) ? $_GET['idRol'] : '-1';
        $user = new User();

        $rol_sql = "SELECT attribute as atr FROM rol WHERE id = {$idRol}";

        $rol_permission_db = DataBase::connect()->query($rol_sql)->fetch_object()->atr;

        $user->setId($idUser);	
        if(!empty($rol_permission_db))
        $user->setAttribute($rol_permission_db);

        $save = $user->update_rol_user();
        
        if ($save) {
          $_SESSION['register'] = "completed";
        } else {
          $_SESSION['register'] = "failed";
        }
      } else {
				$_SESSION['register'] = "failed";
				header('Location: ' . base_url . 'user/index');
			}

			header('Location: ' . base_url . 'user/index');
		}
	}
?>