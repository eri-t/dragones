<?php
header("Content-Type: application/json");

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
?>