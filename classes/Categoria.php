<?php


class Categoria implements JsonSerializable
{
    private $id;
    private $nombre;

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'id'     => $this->getId(),
            'nombre' => $this->getNombre()
        ];
    }

    /**
     * @return array|Categoria[]
     */

    public function traerCategorias(): array
    {
        // Pedimos la conexión a la clase DBConnection...
        $db = DBConnection::getConnection();

        $query = "SELECT * FROM categorias";
        $stmt = $db->prepare($query);
        $stmt->execute();

        $salida = [];

        while($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // En cada vuelta, instanciamos un dragón para almacenar los datos del registro.
            $categoria = new self();
            $categoria->setId($fila['id']);

            $categoria->setNombre($fila['nombre']);


            $salida[] = $categoria;
        }

        return $salida;
    }

    /**
     * @param int $id
     * @return Categoria|null
     */

    public function traerPorPKCategoria(int $id)
    {
        $db = DBConnection::getConnection();

        $query = "SELECT * FROM categorias WHERE id = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);

        // Si no podemos obtener la fila, retornamos null.
        if(!$fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return null;
        }
        $categoria = new self();
        $categoria->setId($fila['id']);
        $categoria->setNombre($fila['nombre']);

        return $categoria;
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
    public function setId($id): void
    {
        $this->id = $id;
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
    public function setNombre($nombre): void
    {
        $this->nombre = $nombre;
    }


}