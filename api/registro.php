<?php

require '../autoload.php';

header("Content-Type: application/json");

$db = mysqli_connect('localhost', 'root', '', 'dragones');
switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':

    $inputData = file_get_contents('php://input');
    $postData = json_decode($inputData, true);

    $usuario = $postData['usuario'];
    $email = $postData['email'];
    $password = password_hash($postData['password'], PASSWORD_DEFAULT);


   $query = "INSERT INTO usuarios (email, usuario, password)
                VALUES ('{$email}', '{$usuario}', '{$password}')";

    $exito = mysqli_query($db, $query);


        if ($exito) {
            echo json_encode([
                'success' => true,
                'msg' => 'El usuario se agregó con éxito.',
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'msg' => 'Ocurrio un error al tratar de agregar el usuario',
            ]);

        }
        break;
}

/*$inputData = file_get_contents('php://input');

$postData = json_decode($inputData, true);

$usuario = $postData['usuario'];
$email = $postData['email'];
$password = $postData['password'];


$usuario = new Usuario();
$exito = $usuario->crearUsuario([
    'usuario' => $usuario,
    'email' => $email,
    'password' => $password,
]);

if ($exito) {
    echo json_encode([
        'success' => true,
        'msg' => 'El usuario se agregó con éxito.',
    ]);
} else {
    echo json_encode([
        'success' => false,
        'msg' => 'Ocurrió un error al tratar de agregar el usuario',
    ]);
}*/
