<?php
require_once __DIR__ . '/../autoload.php';

header("Content-Type: application/json");

$inputData = file_get_contents('php://input');
$postData = json_decode($inputData, true);

$email = trim($postData['email']);
$password = $postData['password'];

$auth = new Authentication();
$success = $auth->login($email, $password);

if($auth->login($email, $password)){
    echo json_encode([
        'success' => true,
        'msg' => 'El producto se insertó con éxito.',
    ]);
} else {
    echo json_encode([
        'success' => false,
        'msg' => 'Ocurrió un error al tratar de insertar el producto :(',
    ]);
}
