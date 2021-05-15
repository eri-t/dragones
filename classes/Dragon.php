<?php

class Dragon implements JsonSerializable
{
    private $id;
    private $categoria_id;
    private $nombre;
    private $descripcion;
    private $imagen;

    /**
     * Esta función debe retornar cómo se representa como JSON este objeto.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'id'            => $this->getId(),
            'categorias_id' => $this->getCategoriasId(),
            'nombre'        => $this->getNombre(),
            'descripcion'   => $this->getDescripcion(),
            'imagen'        => $this->getImagen(),
        ];
    }

    /**
     * Retorna todos los dragones de la base de datos.
     *
     * @return array|Dragon[]
     */
    public function traerTodo(): array
    {
        // Pedimos la conexión a la clase DBConnection...
        $db = DBConnection::getConnection();

        $query = "SELECT * FROM dragones
        /* LEFT JOIN categorias ON categorias_id = categorias.id*/
        ";
        $stmt = $db->prepare($query);
        $stmt->execute();

        $salida = [];

        while($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // En cada vuelta, instanciamos un dragón para almacenar los datos del registro.
            $dragon = new self();
            $dragon->setId($fila['id']);
            $dragon->setCategoriasId($fila['categorias_id']);
            $dragon->setNombre($fila['nombre']);
            $dragon->setDescripcion($fila['descripcion']);
            $dragon->setImagen($fila['imagen']);

            $salida[] = $dragon;
        }

        return $salida;
    }

    /**
     * Retorna el dragón al que pertenece la $id.
     * De no existir, retorna null.
     *
     * @param int $id
     * @return Dragon|null
     */
    public function traerPorPK(int $id)
    {
        $db = DBConnection::getConnection();

        $query = "SELECT * FROM dragones WHERE id = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);

        // Si no podemos obtener la fila, retornamos null.
        if(!$fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return null;
        }
            $dragon = new self();
            $dragon->setId($fila['id']);
            $dragon->setCategoriasId($fila['categorias_id']);
            $dragon->setNombre($fila['nombre']);
            $dragon->setDescripcion($fila['descripcion']);
            $dragon->setImagen($fila['imagen']);

            return $dragon;
    }

    /**
     * Crea un nuevo dragón en la base de datos.
     *
     * @param array $data
     * @return bool
     */
    public function crear(array $data): bool
    {
        $db = DBConnection::getConnection();
        $query = "INSERT INTO dragones (categorias_id, nombre, descripcion) 
                  VALUES (:categorias_id, :nombre, :descripcion)";
        $stmt = $db->prepare($query);

        if(!$stmt->execute($data)) {
            return false;
        }
        return true;
    }

    public function editar()
    {
        $db = DBConnection::getConnection();
    }

    public function eliminar(int $id)
    {
        $db = DBConnection::getConnection();
        $query = "SELECT * FROM dragones WHERE id = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);

        if(!$fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // ver qué hacer si no lo encuentra
            echo('no lo encuentra');
        }

     //   $queryEliminar = "UPDATE dragones SET existe = 0 WHERE id = ?";
        $queryEliminar = "DELETE FROM dragones WHERE id = ?";
        $stmt = $db->prepare($queryEliminar);
        $stmt->execute([$id]);

        // hacer algo si sale mal
/*
        if($dragon["imagen"] != 'default.jpg'):
            unlink(ROOT . $dragon["imagen"]);
        endif;
*/
        // mensaje de éxito
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getCategoriasId()
    {
        return $this->categorias_id;
    }

    /**
     * @param mixed $categorias_id
     */
    public function setCategoriasId($categorias_id)
    {
        $this->categorias_id = $categorias_id;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @param mixed $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    /**
     * @return mixed
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * @param mixed $imagen
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }

}
