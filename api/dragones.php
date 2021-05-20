<?php
require '../autoload.php';

header("Content-Type: application/json");

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if (isset($_GET['id'])) {

            try {
                $id = $_GET['id'];
                $dragon = new Dragon;
                $dragon_por_id = $dragon->traerPorPk($id);

                $result = new stdClass();
                $result->success = true;
                $result->msg = 'Éxito';

                $response = new stdClass();
                $response->result = $result;
                $response->data = $dragon_por_id;

                echo json_encode($response);
            } catch (Exception $e) {

                $result = new stdClass();
                $result->success = false;
                $result->msg = $e->getMessage();

                $response = new stdClass();
                $response->result = $result;
                $response->data = null;

                echo json_encode($response);
            }
        } else {
            $dragon = new Dragon;
            $dragones = $dragon->traerTodo();
            echo json_encode($dragones);
        }
        break;

    case 'POST':

        $inputData = file_get_contents('php://input');

        $postData = json_decode($inputData, true);

        $nombre = $postData['nombre'];
        $categorias_id = $postData['categorias_id'];
        $descripcion = $postData['descripcion'];

        sleep(2); // para mostrar el loader

        if (isset($postData['imagen'])) {
            $imagenParts = explode(',', $postData['imagen']);
            $imagenDecoded = base64_decode($imagenParts[1]);
            // Ahí tenemos la imagen ya decodificada en _memoria_.
            // El paso final sería grabar en disco la imagen.
            $imagenNombre = time() . ".jpg";
            file_put_contents('../img/' . $imagenNombre, $imagenDecoded);
        } else {
            $imagenNombre = 'default.jpg';
        }

        $data = [
            "nombre"        => $nombre,
            "categorias_id" => $categorias_id,
        ];

        $rules = [
            "nombre" => ["required", "min:3"],
            "categorias_id" => ["required"],
        ];

        $validator = new Validator($data, $rules);


        if ($validator->passes()) {
            $dragon = new Dragon();
            $exito = $dragon->crear([
                'nombre' => $nombre,
                'categorias_id' => $categorias_id,
                'descripcion' => $descripcion,
                'imagen' => $imagenNombre
            ]);

            if ($exito) {
                echo json_encode([
                    'success' => true,
                    'msg' => 'El dragón se agregó con éxito.',
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'msg' => 'Ocurrió un error al tratar de agregar el dragón',
                ]);
            }
        } else {
            echo json_encode([
                "success" => false,
                "msg" => $validator->getErrors()
            ]);
        }

        break;

    case 'PUT':

        $id = $_GET['id'];

        $inputData = file_get_contents('php://input');

        $postData = json_decode($inputData, true);

        $nombre = $postData['nombre'];
        $categorias_id = $postData['categorias_id'];
        $descripcion = $postData['descripcion'];

        sleep(2);
        if (isset($postData['imagen'])) {
            $imagenParts = explode(',', $postData['imagen']);
            $imagenDecoded = base64_decode($imagenParts[1]);
            // Ahí tenemos la imagen ya decodificada en _memoria_.
            // El paso final sería grabar en disco la imagen.
            $imagenNombre = time() . ".jpg";
            file_put_contents('../img/' . $imagenNombre, $imagenDecoded);
        } else {
            $imagenNombre = '';
        }

        // TODO: Validar...


        $data = [
            "nombre"        => $nombre,
            "categorias_id" => $categorias_id,
        ];

        $rules = [
            "nombre" => ["required", "min:3"],
            "categorias_id" => ["required"],
        ];

        $validator = new Validator($data, $rules);


        if ($validator->passes()) {
            $dragon = new Dragon();
            $exito = $dragon->editar($id, [
                'id' => $id,
                'nombre' => $nombre,
                'categorias_id' => $categorias_id,
                'descripcion' => $descripcion,
                'imagen' => $imagenNombre
            ]);

            if ($exito) {
                echo json_encode([
                    'success' => true,
                    'msg' => 'Los cambios se guardaron con éxito.',
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'msg' => 'Ocurrió un error al guardar los cambios',
                ]);
            }
        } else {
            echo json_encode([
                "success" => false,
                "msg" => $validator->getErrors()
            ]);
        }

        break;

    case 'DELETE':

        $id = $_GET['id'];
        $dragon = new Dragon;
        $exito = $dragon->eliminar($id);

        if ($exito) {
            echo json_encode([
                'success' => true,
                'msg' => 'El dragón se eliminó con éxito.',
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'msg' => 'Ocurrió un error al tratar de eliminar el dragón.',
            ]);
        }

        break;

    default:
        echo json_encode([
            'success' => false,
            'El método HTTP pedido no existe.',
        ]);
}
