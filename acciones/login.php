<?php

require_once __DIR__ . '/../autoload.php';

$email = trim($_POST['email']);
$password = $_POST['password'];

$auth = new Authentication();
if($auth->login($email, $password)){
    $_SESSION['success'] = "Iniciaste sesión con éxito.";
    header('Location: ../secciones/abm.php');
} else {
    $_SESSION['error'] = "El email o la contraseña no coninciden.";
    header('Location: ../login.php');
}

