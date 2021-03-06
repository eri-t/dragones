<?php
require '../autoload.php';

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $categoria = new Categoria;
        $categoria_por_id = $categoria->traerPorPKCategoria($id);
        echo json_encode($categoria_por_id);
    } else {
        $categoria = new Categoria;
        $categorias = $categoria->traerCategorias();
        echo json_encode($categorias);
    }
}
