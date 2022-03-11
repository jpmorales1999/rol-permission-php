<?php 

    require_once 'models/permission.php';

	class PermissionController {

		public function index(){
			Utils::isAdmin();
            $permission = new Permission();
            $permissions = $permission->getAll();

            // Renderizar vista
			require_once 'views/permission/index.php';
		}

        public function save(){
			Utils::isAdmin();
			if(isset($_POST)){
				$name = isset($_POST['name']) ? strtoupper($_POST['name']) : false;

				if($name){
					$permission = new Permission();
					$permission->setName($name);	
					$save = $permission->save();

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
				header('Location: ' . base_url . 'permission/index');
			}
			header('Location: ' . base_url . 'permission/index');
		}

    }

?>