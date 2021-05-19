<?php

class Dragon implements JsonSerializable
{
    private $id;
    private $categorias_id;
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
        ORDER BY id DESC";
        $stmt = $db->prepare($query);
        $stmt->execute();

        $salida = [];

        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
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
     * Retorna un objeto que contiene el resultado, y el dragón al que pertenece la $id, o null si no existe.
     *
     * @param int $id
     * @return object
     */
    public function traerPorPK(int $id)
    {
        $db = DBConnection::getConnection();

        $query = "SELECT * FROM dragones WHERE id = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);


        // Si no podemos obtener la fila:
        if (!$fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            throw new Exception('El dragón solicitado no existe.');

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
        $query = "INSERT INTO dragones (categorias_id, nombre, descripcion, imagen) 
                  VALUES (:categorias_id, :nombre, :descripcion, :imagen)";
        $stmt = $db->prepare($query);

        if (!$stmt->execute($data)) {
            return false;
        }
        return true;
    }

    /**
     * Edita un dragón en la base de datos.
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function editar(int $id, array $data): bool
    {
        $db = DBConnection::getConnection();

        $query = "SELECT * FROM dragones WHERE id = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);

        // Si no podemos obtener la fila, retornamos false.
        if (!$fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return false;
        }

        $queryEditar = "UPDATE dragones SET 
            categorias_id = :categorias_id, 
            nombre = :nombre, 
            descripcion = :descripcion, 
            imagen = :imagen
                WHERE id = :id";

        $stmt2 = $db->prepare($queryEditar);
        $stmt2->execute($data);

        if (!$stmt2->execute($data)) {
            return false;
        }
        return true;
    }

    /**
     * Borra un dragón de la base de datos.
     *
     * @param int $id
     * @return bool
     */
    public function eliminar(int $id): bool
    {
        $db = DBConnection::getConnection();
        $query = "SELECT * FROM dragones WHERE id = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);

        if (!$fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return false;
        }

        $dragon = new self();
        $dragon->setImagen($fila['imagen']);

        $queryEliminar = "DELETE FROM dragones WHERE id = ?";
        $stmt = $db->prepare($queryEliminar);
        $stmt->execute([$id]);

        if (!$fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return false;
        }

        // borrar archivo:
        $root = explode("classes", __DIR__)[0];

        if ($dragon["imagen"] != 'default.jpg') :
            unlink($root . '/img/' . $dragon["imagen"]);
        endif;

        return true;
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
