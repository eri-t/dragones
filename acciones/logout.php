<?php
require_once __DIR__ . '/../autoload.php';

$auth = new Authentication();
$auth->logout();;

$_SESSION['success'] = "Cerraste sesión con éxito.";
header('Location: ./../login.php');
