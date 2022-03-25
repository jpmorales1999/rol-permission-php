<?php

  require_once 'config/db.php';
  require_once 'models/user.php';
  require_once 'models/rol.php';
  require_once 'models/permission.php';

  $data = [
    "id_user" => "32",
    "id_rol" => "89",
  ];
  json_encode($data);

  $metodo = $_SERVER["REQUEST_METHOD"];
  $datos = json_decode(file_get_contents("php://input"));
  //echo $datos;
  switch($metodo){
    case 'POST':
      $put_vars = json_decode(file_get_contents("php://input"), true);
      $id_user = intval($put_vars["id_user"]);
      $id_rol = intval($put_vars["id_rol"]);
      
			$user = new User();
      $user->setId($id_user);
      $u = $user->getOne()->fetch_object();

      $rol = new Rol();
      $rol->setId($id_rol);
      $r = $rol->getOne()->fetch_object();

      $user_rol = new Rol();
      $user_rol->setId(intval($u->idrol));
      $u_r = $user_rol->getOne()->fetch_object();
      //$nombreUsuario = json_encode($data);
      
      $u_permission = explode(', ',$u->attribute);
      $r_permission = explode(', ',$r->attribute);
      $u_r_permission = explode(', ',$u_r->attribute);
      
      //echo "PERMISOS DEL USUARIO {$u->name} <br>";
      //echo var_dump($u_permission);
      //echo "<br><br>PERMISOS DEL rol {$r->name}<br>";
      //echo var_dump($r_permission);
      //echo "<br><br>PERMISOS DEL ROL {$u_r->name} QUE ESTA RELACIONADO CON EL USUARIO {$u->name}<br>";
      //echo var_dump($u_r_permission);

      $special_permission = array();

      if (!empty($u_permission))
      foreach ($u_permission as $key => $attribute) {
        if (!in_array($attribute, $u_r_permission)) array_push($special_permission, $attribute);
      }

      $new_permission = $r_permission;
      
      if (!empty($special_permission))
      foreach ($special_permission as $key => $attribute) {
        if (!in_array($attribute, $new_permission)) array_push($new_permission, $attribute);
      }
      
      //echo "<br><br>PERMISOS ESPECIALES DEL USUARIO {$u->name}<br>";
      //echo var_dump($special_permission);

      //echo "<br><br>NUEVOS PERMISOS PARA EL USUARIO {$u->name}<br>";
      //echo var_dump($new_permission);
      
      $new_special_permission = array();

      if (!empty($new_permission))
      foreach ($new_permission as $key => $attribute) {
        if (!in_array($attribute, $r_permission)) array_push($new_special_permission, $attribute);
      }

      //echo "<br><br>NUEVOS PERMISOS ESPECIALES PARA EL USUARIO {$u->name}<br>";
      //echo var_dump($new_special_permission);

      $response = [
        "new_permission" => join(', ', $new_permission),
        "new_special_permission" => join(', ', $new_special_permission),
      ];
      echo json_encode($response);
      break;
    break;
    case 'GET':
			$user = new User();
      $user->setId(intval($data["id_user"]));
      $u = $user->getOne()->fetch_object();

      $rol = new Rol();
      $rol->setId(intval($data["id_rol"]));
      $r = $rol->getOne()->fetch_object();

      $user_rol = new Rol();
      $user_rol->setId(intval($u->idrol));
      $u_r = $user_rol->getOne()->fetch_object();
      //$nombreUsuario = json_encode($data);
      
      $u_permission = explode(', ',$u->attribute);
      $r_permission = explode(', ',$r->attribute);
      $u_r_permission = explode(', ',$u_r->attribute);
      
      //echo "PERMISOS DEL USUARIO {$u->name} <br>";
      //echo var_dump($u_permission);
      //echo "<br><br>PERMISOS DEL rol {$r->name}<br>";
      //echo var_dump($r_permission);
      //echo "<br><br>PERMISOS DEL ROL {$u_r->name} QUE ESTA RELACIONADO CON EL USUARIO {$u->name}<br>";
      //echo var_dump($u_r_permission);

      $special_permission = array();

      if (!empty($u_permission))
      foreach ($u_permission as $key => $attribute) {
        if (!in_array($attribute, $u_r_permission)) array_push($special_permission, $attribute);
      }

      $new_permission = $r_permission;
      
      if (!empty($special_permission))
      foreach ($special_permission as $key => $attribute) {
        if (!in_array($attribute, $new_permission)) array_push($new_permission, $attribute);
      }
      
      //echo "<br><br>PERMISOS ESPECIALES DEL USUARIO {$u->name}<br>";
      //echo var_dump($special_permission);

      //echo "<br><br>NUEVOS PERMISOS PARA EL USUARIO {$u->name}<br>";
      //echo var_dump($new_permission);
      
      $new_special_permission = array();

      if (!empty($new_permission))
      foreach ($new_permission as $key => $attribute) {
        if (!in_array($attribute, $r_permission)) array_push($new_special_permission, $attribute);
      }

      //echo "<br><br>NUEVOS PERMISOS ESPECIALES PARA EL USUARIO {$u->name}<br>";
      //echo var_dump($new_special_permission);

      $response = [
        "new_permission" => join(', ', $new_permission),
        "new_special_permission" => join(', ', $new_special_permission),
      ];
      echo json_encode($response);
      break;
    default:
      header('Location: ' . base_url . 'user');
  }
?>