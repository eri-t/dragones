<?php

require '../autoload.php';

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $inputData = file_get_contents('php://input');
    $postData = json_decode($inputData, true);

    $usuario = $postData['usuario'];
    $email = $postData['email'];
    $password = password_hash($postData['password'], PASSWORD_DEFAULT);

    $usuario_obj = new Usuario();
    $exito = $usuario_obj->crear([
        'usuario' => $usuario,
        'email' => $email,
        'password' => $password
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
    }
}
