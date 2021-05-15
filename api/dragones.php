<?php
require '../autoload.php';

header("Content-Type: application/json");

// TODO: Verificar que me haya conectado.

// $_SERVER['REQUEST_METHOD'] retorna el método de la petición.
switch($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $dragon = new Dragon;
            $dragon_por_id = $dragon->traerPorPk($id);
            echo json_encode($dragon_por_id);

        } else {
            $dragon = new Dragon;
            $dragones = $dragon->traerTodo();
            echo json_encode($dragones);
        }
        break;

    case 'POST':
        $inputData = file_get_contents('php://input');

        $postData = json_decode($inputData, true);

        $nombre         = $postData['nombre'];

// ver si sacar el (int):        
        $categorias_id   = (int) $postData['categorias_id'];
        $descripcion    = $postData['descripcion'];

        sleep(2);
        $imagenParts = explode(',', $postData['imagen']);
        $imagenDecoded = base64_decode($imagenParts[1]);
        // Ahí tenemos la imagen ya decodificada en _memoria_.
        // El paso final sería grabar en disco la imagen.
        $imagenNombre = time() . ".jpg";
        file_put_contents('../img/' . $imagenNombre, $imagenDecoded);

        // TODO: Validar...

        // Validamos usando la clase Validator, que más adelante haremos desde 0 en clase.
// $validator = new Validator($_POST, [
    // Aplicamos las reglas de validación definidas en la clase que queremos aplicar a cada clave del
    // array.

    /*
    'nombre'        => ['required', 'min:3'],
    'categorias_id'  => ['required', 'numeric'],
    */
// ]);

/*
if(!$validator->passes()) {
    $_SESSION['error'] = 'Ocurrieron errores de validación';
    header('Location: ./../producto-nuevo.php');
    exit;
}
*/

$dragon = new Dragon();
$exito = $dragon->crear([
    'nombre' => $nombre,
    'categorias_id' => $categorias_id,
    'descripcion' => $descripcion,
    'imagen' => $imagenNombre
]);

/*
if($exito) {
    $_SESSION['exito'] = 'El dragón fue creado con éxito.';
  //  header('Location: ./../index.php');
} else {
    $_SESSION['exito'] = 'Error al tratar de crear el dragón.';
  //  header('Location: ./../dragon-nuevo.php');


*/

        if($exito) {
            echo json_encode([
                'success' => true,
                'msg' => 'El dragón se agregó con éxito.',
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'msg' => 'Ocurrió un error al tratar de agregar el dragón :(',
            ]);
        }
        
        break;

    case 'PUT':
        // PUT funciona igual que POST.
        // Es decir, enviamos los datos en el cuerpo de la petición, y los parseamos leyendo el
        // php://input y pasándole el resultado al json_decode.
        // La única excepción es el id, que como siempre, va en el query string, y lo sacamos de $_GET.
        break;

    case 'PATCH':
        break;

    case 'DELETE':
        $id = $_GET['id'];
        $dragon = new Dragon;
        $dragones = $dragon->eliminar($id);

        break;

    default:
        echo json_encode([
            'success' => false,
            'El método HTTP pedido no existe.',
        ]);
}
