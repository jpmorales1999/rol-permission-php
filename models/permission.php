<?php 
	
	class Permission {

        private $id;
        private $name;
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

        public function getAll(){
			$sql = "SELECT * FROM permission";
			$permissions = $this->db->query($sql);
			return $permissions;
		}

		public function save() {
            $sql = "INSERT INTO permission VALUES (null, '{$this->getName()}')";
            $save = $this->db->query($sql);

            $result = false;

			if ($save) {
				$result = true;
			}

			return $result;
        }

    }

?>