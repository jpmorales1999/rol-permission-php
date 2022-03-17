<?php

require_once 'models/user.php';
require_once 'models/rol.php';

class LoginController
{

	public function index()
	{
		// Si ya existe una sesion activa, no permitir volver al login hasta Logout
		if (isset($_SESSION['admin']) || isset($_SESSION['identity'])) {
			header('Location: ' . base_url . 'login/listPermissions');
		}

		require_once 'views/login/index.php';
	}

	public function login()
	{
		if (isset($_POST)) {
			$email = isset($_POST['email']) ? $_POST['email'] : false;
			$password = isset($_POST['password']) ? $_POST['password'] : false;

			if ($email && $password) {
				$usuario = new User();
				$usuario->setEmail($_POST['email']);
				$usuario->setPassword($_POST['password']);

				// Consulta comprobando si el usuario existe
				$identity = $usuario->login();

				// Crear una sesión

				if ($identity && is_object($identity)) {
					$_SESSION['identity'] = $identity;

					// Buscamos el rol, para determinar si el usuario logueado es administrador
					$rol = new Rol();
					$rol->setId($identity->idrol);
					$result = $rol->isAdmin();


					// Si es admin se crea sesion admin
					if ($result->fetch_object() != NULL && $result && is_object($result)) { 	
						$_SESSION['admin'] = true;
					}
				} else {
					$_SESSION['error_login'] = 'error';
				}
			}
		}
		// Si existe la sesión admin - Ir al Dasboard
		if ($_SESSION['admin']) {
			header('Location: ' . base_url . 'user/index');
		} 

		if (isset($_SESSION['identity'])) {
			header('Location: ' . base_url . 'login/listPermissions');
		} else {
			header('Location: ' . base_url . 'login/index');
		}
	}

	// Listado de Permisos para el Usuario o Admin
	public function listPermissions () {
		require_once 'views/login/list-permissions.php';
	} 

	public function logout () {
		if(isset($_SESSION['identity'])){
			unset($_SESSION['identity']);
		}

		if(isset($_SESSION['admin'])){
			unset($_SESSION['admin']);
		}

		header('Location: ' . base_url . 'login/index');
	}
}
