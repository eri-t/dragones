<?php
class DBConnection
{
    /** @var PDO|null Variable estática para guardar la conexión de PDO. */
    private static $db;

    // Constantes de conexión.
    const DB_HOST = "localhost";
    const DB_USER = "root";    
    const DB_PASS = "";
    const DB_BASE = "dragones";

    /**
     * DBConnection constructor.
     */
    private function __construct()
    {}

    /**
     * Abre la conexión a la base instanciando PDO.
     */
    protected static function openConnection()
    {
        $dsn = "mysql:host=" . self::DB_HOST . ";dbname=" . self::DB_BASE . ";charset=utf8mb4";

        try {
            self::$db = new PDO($dsn, self::DB_USER, self::DB_PASS);
        } catch(Exception $e) {
            echo "Error al conectar con la base de datos :(";
        }
    }

    /**
     * Retorna la conexión PDO a la base de datos.     *
     * @return PDO
     */
    public static function getConnection()
    {
        if(self::$db === null) {
            self::openConnection();
        }

        return self::$db;
    }
}
