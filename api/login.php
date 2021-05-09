<?php
header("Content-Type: application/json");

if(isset($_SESSION["id"])) {
    header("Location: index.php");
    exit;
}
/*
$email = trim($_POST['email']);
$password = $_POST['password'];

$auth = new Auth();
if($auth->login($email, $password)) {
    header('Location: ../secciones/abm.php');
} else {
    header('Location: ../login.php');
}
*/
session_start();

$db = mysqli_connect('localhost', 'root', '', 'dragones');

mysqli_set_charset($db, 'utf8mb4');

$inputData = file_get_contents('php://input');
$postData = json_decode($inputData, true);

$email = mysqli_real_escape_string($db, $postData['email']);
$password = $postData['password'];

$query = "SELECT * FROM usuarios
            WHERE email = '{$email}'";
$res = mysqli_query($db, $query);


if($fila = mysqli_fetch_assoc($res)) {
    if(password_verify($password, $fila['password'])) {
        $_SESSION['id'] = $fila['id'];
        echo json_encode([
            'success' => true,
            'data' => [
                'id' => $fila['id'],
                'usuario' => $fila['usuario'],
            ]
        ]);
        exit;
    }
}

echo json_encode([
    'success' => false,
]);
