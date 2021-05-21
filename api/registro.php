<?php

require '../autoload.php';

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $inputData = file_get_contents('php://input');
    $postData = json_decode($inputData, true);

    $usuario = $postData['usuario'];
    $email = $postData['email'];
    $password = $postData['password'];

    $data = [
        "usuario"  => $usuario,
        "email"    => $email,
        "password" => $password,
    ];

    $rules = [
        "usuario" => ["required", "min:3"],
        "email" => ["required"],
        "password" => ["required", "min:3"],
    ];

    $validator = new Validator($data, $rules);


    if ($validator->passes()) {
        $password = password_hash($postData['password'], PASSWORD_DEFAULT);
        $usuario_obj = new Usuario();
        $exito = $usuario_obj->crear([
            'usuario' => $usuario,
            'email' => $email,
            'password' => $password,
        ]);

        if ($exito) {
            echo json_encode([
                'success' => true,
                'msg' => 'El usuario se registró con éxito. Redireccionando...',
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'msg' => 'Ocurrió un error al tratar de registrar el usuario.',
            ]);
        }
    } else {
        echo json_encode([
            "success" => false,
            "msg" => $validator->getErrors()
        ]);
    }
}
