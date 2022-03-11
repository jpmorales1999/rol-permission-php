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