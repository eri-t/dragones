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
            'categoria_id'  => $this->getCategoriaId(),
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

        $query = "SELECT * FROM dragones";
        $stmt = $db->prepare($query);
        $stmt->execute();

        $salida = [];

        while($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // En cada vuelta, instanciamos un dragón para almacenar los datos del registro.
            $dragon = new self();
            $dragon->setId($fila['id']);
            $dragon->setCategoriaId($fila['categoria_id']);
            $dragon->setNombre($fila['nombre']);
            $dragon->setDescripcion($fila['descripcion']);
            $dragon->setImagen($fila['imagen']);

            $salida[] = $dragon;
        }

        return $salida;
    }

    public function traerPorPK($id)
    {
        $db = DBConnection::getConnection();
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
        $query = "INSERT INTO dragones (categoria_id, nombre, descripcion) 
                  VALUES (:categoria_id, :nombre, :descripcion)";
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

    public function eliminar()
    {
        $db = DBConnection::getConnection();
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
    public function setIdProducto($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getCategoriaId()
    {
        return $this->categoria_id;
    }

    /**
     * @param mixed $categoria_id
     */
    public function setCategoriaId($categoria_id)
    {
        $this->categoria_id = $categoria_id;
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
