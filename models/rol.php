<?php 
	
	class Rol {

        private $id;
        private $name;
        private $attribute;
        private $db;

    public function __construct(){
      $this->db = DataBase::connect();
    }

    function getId(){
			return $this->id;
		}

		function setId($id){
			$this->id = $id;
		}

    function getName(){
			return $this->name;
		}

		function setName($name){
			$this->name = $name;
		}

		function getAttribute(){
			return $this->attribute;
		}

		function setAttribute($attribute){
			$this->attribute = $attribute;
		}

    function updateUsersPermission($rol_permissions_post) {
			$user_sql = "SELECT id, attribute FROM user WHERE idrol = {$this->getId()}";
			$rol_sql = "SELECT attribute FROM rol WHERE id = {$this->getId()}";

			$users_permission_sql = $this->db->query($user_sql);
			$rol_permissions_sql = $this->db->query($rol_sql);
      
      $users_permission_db = array();
      while( $row = mysqli_fetch_array($users_permission_sql) )  { 
        $users_permission_db[] = $row; 
      } 
      
      $rol_permissions_db = array();
      while( $row = mysqli_fetch_array($rol_permissions_sql) )  { 
        $rol_permissions_db[] = $row; 
      } 


      $add_permissions = array();
      $del_permissions = array();
      print_r($rol_permissions_db);
      foreach ($rol_permissions_post as $key => $attribute) {
        in_array($attribute, $rol_permissions_db) 
          ? array_push($add_permissions, $attribute)
          : array_push($del_permissions, $attribute);
      }

      ///FIXME
      print_r($users_permission_db);
      echo "   *****asdfasd <br>";

      foreach ($users_permission_db as $key => $users) {
        print_r($users[1]);
        echo "  *****56asdfasdf4<br>";
        $new_user_permission = explode(", ", $users[1]);
        array_push($new_user_permission, $add_permissions);
        
        foreach ($new_user_permission as $key => $attribute) {
          if (in_array($attribute, $del_permissions)) {
            array_splice($new_user_permission, array_search($attribute, $new_user_permission), 1);
          }
        }
        
        $permissions = implode(", ", $new_user_permission);
        
        print_r($permissions);
        print_r(asdf);
        $this->UserUpdateRol($users[0], $permissions);
      }

      
		}
    
		function UserUpdateRol($id, $atribute) {
      $sql = "UPDATE user SET attribute='{$atribute}' WHERE id='{$id}'";
      $save = $this->db->query($sql);

      $result = false;

			if ($save) {
				$result = true;
			}

			return $result;
    }

    public function getAll(){
			$sql = "SELECT * FROM rol";
			$rols = $this->db->query($sql);
			return $rols;
		}

		public function getOne(){
			$sql = "SELECT * FROM rol WHERE id='{$this->getId()}'";
			$rols = $this->db->query($sql);
			return $rols;
		}

		public function getLast(){
			$sql = "SELECT * FROM rol ORDER BY id DESC LIMIT 1";
			$rol = $this->db->query($sql);
			return $rol;
		}

		public function isAdmin() {
			$sql = "SELECT * FROM rol WHERE id='{$this->getId()}' AND name='ADMINISTRADOR'";
			$rol = $this->db->query($sql);
			return $rol;
		}

		public function update() {
            $sql = "UPDATE rol SET name='{$this->getName()}', attribute='{$this->getAttribute()}' WHERE id='{$this->getId()}'";
            $save = $this->db->query($sql);

            $result = false;

			if ($save) {
				$result = true;
			}

			return $result;
        }

		public function save() {
            $sql = "INSERT INTO rol VALUES (null, '{$this->getName()}', '{$this->getAttribute()}')";
            $save = $this->db->query($sql);

            $result = false;

			if ($save) {
				$result = true;
			}

			return $result;
        }

    }

?>