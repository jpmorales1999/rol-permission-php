<?php 

  class Utils {

    public static function deleteSession ($session) {
        if (isset($_SESSION[$session])) {
            $_SESSION[$session] = null;
            unset($_SESSION[$session]);
        }
    }

    /* Funcion Compare, Se encargará de determinar y mostrar los permisos ya almacenados y no almacenados en base de datos por parte del Rol */
    public static function comparePermission ($array, $permission) {
        // Contador para determinar si el permiso no ha sido repetido
        $count = 0;

        // Recorrer el Array de atributos actuales comparando con cada uno de los permisos de la tabla Permission
        foreach ($array as $item) {
            if ($item == $permission->name) {
                $count++;
                // Option con Selected
                return "<option value='$permission->name' selected>$permission->name</option>";
            }
        }

        if ($count == 0) {
            // En caso de que no encuentre permisos sementajes, mostrar option sin checked 
            return "<option value='$permission->name'>$permission->name</option>"; 
        }
    }

    /* Funcion compareRol se encarga de determinar el rol del usuario ya previamente almacenado en base de datos*/
    public static function compareRol ($idRol, $rol) {
        if ($idRol == $rol->id) {
            // Option con Selected
            return "<option value='$rol->id' selected>$rol->name</option>";
        } else {
            return "<option value='$rol->id'>$rol->name</option>";
        }
    }

    public static function isAdmin(){
			if(!isset($_SESSION['admin'])){
				header('Location:' . base_url);
			}else{
				return true;
			}
		}

    public function rol_updated() {
      $data = [
          "nombre" => "Luis Cabrera Benito",
          "web" => "https://parzibyte.me/blog",
      ];
      // if (isset($_POST['ids'])) {
      //   echo json_encode($datos);
      //   exit;
      // }
      // echo json_encode($datos);
      // exit;

      $metodo = $_SERVER["REQUEST_METHOD"];
      $datos = json_decode(file_get_contents("php://input"));
      //echo $datos;
      switch($metodo){
        case 'POST':
          $nombreUsuario = "Daniel";
          //Aquí podríamos acceder a otras propiedades
          //echo json_encode($data);
          echo $nombreUsuario;
          break;
        break;
        case 'GET':
          $nombreUsuario = "Enviado pro get";
          //Aquí podríamos acceder a otras propiedades
          echo $nombreUsuario;
          exit;
          break;
        default:
          header('Location: ' . base_url . 'user');
      }
    }

  }

?>