<?php
require '../autoload.php';

header("Content-Type: application/json");

// TODO: Verificar que me haya conectado.

// $_SERVER['REQUEST_METHOD'] retorna el método de la petición.
switch($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if(isset($_GET['id'])) {
            // A diferencia de POST, esta parte no cambia en REST como lo estamos usando.
            /*    $id = (int) $_GET['id'];

                $query = "SELECT * FROM productos
                            WHERE id_producto = {$id}";

                $res = mysqli_query($db, $query);

                echo json_encode(mysqli_fetch_assoc($res));
*/
            $id = $_GET['id'];
            $categoria = new Categoria();
            $categoria_por_id = $categoria->traerPorPKCategoria($id);
            echo json_encode($categoria_por_id);

        } else {
            $categoria = new Categoria;
            $categorias = $categoria->traerCategorias();
            echo json_encode($categorias);
        }

        break;
}

// $_SERVER['REQUEST_METHOD'] retorna el método de la petición.
//if($_SERVER['REQUEST_METHOD'] === 'GET') {
//    $query = "SELECT * FROM productos";
//
//    $res = mysqli_query($db, $query);
//
//    $datos = [];
//
//    while($fila = mysqli_fetch_assoc($res)) {
//        $datos[] = $fila;
//    }
//
//    echo json_encode($datos);
//} else if($_SERVER['REQUEST_METHOD'] === 'POST') {
//} else if($_SERVER['REQUEST_METHOD'] === 'PUT') {
//    // Entonces hacemos el alta.
//    // Capturamos los datos, hacemos el query, ejecutamos, verificamos éxito, somos felices, informamos
//    // el resultado.
//    // Vamos a notar que no podemos capturar los datos que llegaron como un JSON usando $_POST.
////    $nombre         = $_POST['nombre']; // Lanza Notice de que no existe esta clave.
////    $precio         = $_POST['precio']; // Lanza Notice de que no existe esta clave.
////    $id_categoria   = $_POST['id_categoria']; // Lanza Notice de que no existe esta clave.
////    $id_marca       = $_POST['id_marca']; // Lanza Notice de que no existe esta clave.
////    $descripcion    = $_POST['descripcion']; // Lanza Notice de que no existe esta clave.
//    // ¿Cómo lo obtenemos?
//    // Vamos a tener que parsear la entrada de datos manualmente, en dos pasos:
//    // 1. Leer el "búffer" de entrada de php.
//    // 2. Parsear el contenido de dicho búffer como JSON.
//
//    // 1. Leer el búffer de entrada de php, con ayuda de la función file_get_contents.
//    // El búffer de entrada es donde php almacena el contenido completo del cuerpo de la petición.
//    // En este caso, sería el objeto JSON que nois enviaron.
//    $inputData = file_get_contents('php://input');
////    die($inputData);
//    // 2. Parsear el JSON obtenido.
//    $postData = json_decode($inputData, true);
//    // Sacamos los datos obtenidos del objeto JSON a variables independientes.
//    $nombre         = $postData['nombre'];
//    $precio         = $postData['precio'];
//    $id_categoria   = $postData['id_categoria'];
//    $id_marca       = $postData['id_marca'];
//    $descripcion    = $postData['descripcion'];
//
//    // TODO: Validar...
//
//    $query = "INSERT INTO productos (nombre, precio, id_categoria, id_marca, descripcion)
//            VALUES ('{$nombre}', '{$precio}', '{$id_categoria}', '{$id_marca}', '{$descripcion}')";
//
//    $exito = mysqli_query($db, $query);
//
//    if($exito) {
//        echo json_encode([
//            'success' => true,
//            'msg' => 'El producto se insertó con éxito.',
//        ]);
//    } else {
//        echo json_encode([
//            'success' => false,
//            'msg' => 'Ocurrió un error al tratar de insertar el producto :(',
//        ]);
//    }
//} else if($_SERVER['REQUEST_METHOD'] === 'PATCH') {
//    // Entonces hacemos el alta.
//    // Capturamos los datos, hacemos el query, ejecutamos, verificamos éxito, somos felices, informamos
//    // el resultado.
//    // Vamos a notar que no podemos capturar los datos que llegaron como un JSON usando $_POST.
////    $nombre         = $_POST['nombre']; // Lanza Notice de que no existe esta clave.
////    $precio         = $_POST['precio']; // Lanza Notice de que no existe esta clave.
////    $id_categoria   = $_POST['id_categoria']; // Lanza Notice de que no existe esta clave.
////    $id_marca       = $_POST['id_marca']; // Lanza Notice de que no existe esta clave.
////    $descripcion    = $_POST['descripcion']; // Lanza Notice de que no existe esta clave.
//    // ¿Cómo lo obtenemos?
//    // Vamos a tener que parsear la entrada de datos manualmente, en dos pasos:
//    // 1. Leer el "búffer" de entrada de php.
//    // 2. Parsear el contenido de dicho búffer como JSON.
//
//    // 1. Leer el búffer de entrada de php, con ayuda de la función file_get_contents.
//    // El búffer de entrada es donde php almacena el contenido completo del cuerpo de la petición.
//    // En este caso, sería el objeto JSON que nois enviaron.
//    $inputData = file_get_contents('php://input');
////    die($inputData);
//    // 2. Parsear el JSON obtenido.
//    $postData = json_decode($inputData, true);
//    // Sacamos los datos obtenidos del objeto JSON a variables independientes.
//    $nombre         = $postData['nombre'];
//    $precio         = $postData['precio'];
//    $id_categoria   = $postData['id_categoria'];
//    $id_marca       = $postData['id_marca'];
//    $descripcion    = $postData['descripcion'];
//
//    // TODO: Validar...
//
//    $query = "INSERT INTO productos (nombre, precio, id_categoria, id_marca, descripcion)
//            VALUES ('{$nombre}', '{$precio}', '{$id_categoria}', '{$id_marca}', '{$descripcion}')";
//
//    $exito = mysqli_query($db, $query);
//
//    if($exito) {
//        echo json_encode([
//            'success' => true,
//            'msg' => 'El producto se insertó con éxito.',
//        ]);
//    } else {
//        echo json_encode([
//            'success' => false,
//            'msg' => 'Ocurrió un error al tratar de insertar el producto :(',
//        ]);
//    }
//} else if($_SERVER['REQUEST_METHOD'] === 'DELETE') {
//    // Entonces hacemos el alta.
//    // Capturamos los datos, hacemos el query, ejecutamos, verificamos éxito, somos felices, informamos
//    // el resultado.
//    // Vamos a notar que no podemos capturar los datos que llegaron como un JSON usando $_POST.
////    $nombre         = $_POST['nombre']; // Lanza Notice de que no existe esta clave.
////    $precio         = $_POST['precio']; // Lanza Notice de que no existe esta clave.
////    $id_categoria   = $_POST['id_categoria']; // Lanza Notice de que no existe esta clave.
////    $id_marca       = $_POST['id_marca']; // Lanza Notice de que no existe esta clave.
////    $descripcion    = $_POST['descripcion']; // Lanza Notice de que no existe esta clave.
//    // ¿Cómo lo obtenemos?
//    // Vamos a tener que parsear la entrada de datos manualmente, en dos pasos:
//    // 1. Leer el "búffer" de entrada de php.
//    // 2. Parsear el contenido de dicho búffer como JSON.
//
//    // 1. Leer el búffer de entrada de php, con ayuda de la función file_get_contents.
//    // El búffer de entrada es donde php almacena el contenido completo del cuerpo de la petición.
//    // En este caso, sería el objeto JSON que nois enviaron.
//    $inputData = file_get_contents('php://input');
////    die($inputData);
//    // 2. Parsear el JSON obtenido.
//    $postData = json_decode($inputData, true);
//    // Sacamos los datos obtenidos del objeto JSON a variables independientes.
//    $nombre         = $postData['nombre'];
//    $precio         = $postData['precio'];
//    $id_categoria   = $postData['id_categoria'];
//    $id_marca       = $postData['id_marca'];
//    $descripcion    = $postData['descripcion'];
//
//    // TODO: Validar...
//
//    $query = "INSERT INTO productos (nombre, precio, id_categoria, id_marca, descripcion)
//            VALUES ('{$nombre}', '{$precio}', '{$id_categoria}', '{$id_marca}', '{$descripcion}')";
//
//    $exito = mysqli_query($db, $query);
//
//    if($exito) {
//        echo json_encode([
//            'success' => true,
//            'msg' => 'El producto se insertó con éxito.',
//        ]);
//    } else {
//        echo json_encode([
//            'success' => false,
//            'msg' => 'Ocurrió un error al tratar de insertar el producto :(',
//        ]);
//    }
//}

