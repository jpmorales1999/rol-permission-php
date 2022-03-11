<?php 
	
	class User {

        private $id;
        private $name;
        private $lastname;
		private $attribute;
		private $email;
		private $password;
        private $idrol;
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

        function getLastname(){
			return $this->lastname;
		}

		function setLastname($lastname){
			$this->lastname = $lastname;
		}

		function getAttribute(){
			return $this->attribute;
		}

		function setAttribute($attribute){
			$this->attribute = $attribute;
		}

		function getEmail(){
			return $this->email;
		}

		function setEmail($email){
			$this->email = $email;
		}

		function getPassword(){
			return $this->password;
		}

		function setPassword($password){
			$this->password = $password;
		}

        function getIdrol(){
			return $this->idrol;
		}

		function setIdrol($idrol){
			$this->idrol = $idrol;
		}

        public function getAll() {
			$sql = "SELECT u.id, u.name, u.lastname, u.attribute, u.idrol, u.email, r.name as rol FROM user as u INNER JOIN rol as r ON u.idrol=r.id WHERE u.status=1";
			$users = $this->db->query($sql);
			return $users;
		}

		public function getOne() {
			$sql = "SELECT * FROM user WHERE id='{$this->getId()}'";
			$user = $this->db->query($sql);
			return $user;
		}

        public function save() {
            $sql = "INSERT INTO user VALUES (null, '{$this->getName()}', '{$this->getLastname()}', '{$this->getAttribute()}', '{$this->getEmail()}', '{$this->getPassword()}', '{$this->getIdrol()}', 1)";
            $save = $this->db->query($sql);

            $result = false;

			if ($save) {
				$result = true;
			}

			return $result;
        }

		public function update() {
            $sql = "UPDATE user SET name='{$this->getName()}', lastname='{$this->getLastname()}', idrol='{$this->getIdrol()}', attribute='{$this->getAttribute()}' WHERE id='{$this->getId()}'";
            $save = $this->db->query($sql);

            $result = false;

			if ($save) {
				$result = true;
			}

			return $result;
        }

		public function delete() {
			$sql = "UPDATE user SET status=0 WHERE id='{$this->getId()}'";
            $save = $this->db->query($sql);

            $result = false;

			if ($save) {
				$result = true;
			}

			return $result;
		}

		public function login(){
			$result = false;

			$email = $this->getEmail();
			$password = $this->getPassword();

			// Comprobar si existe el Usuario
			$sql = "SELECT * FROM user WHERE email = '$email'";
			$login = $this->db->query($sql);

			if($login && $login->num_rows == 1){
				$user = $login->fetch_object();

				// Verificar la contraseña
				$verify = password_verify($password, $user->password);

				if($verify){
					$result = $user;
				}
			}
			
			return $result;
		}

    }

?>