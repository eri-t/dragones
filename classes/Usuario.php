<?php


class Usuario
{
    private $id;
    private $user;
    private $password;
    private $email;
    /**
     * @param $email
     * @return Usuario|null
     */
    public function getByEmail($email)
    {
        $db = DBConnection::getConnection();

        $query = "SELECT * FROM usuarios
                    WHERE email = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$email]);

        if(!$row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return null;
        }

        $user = new Usuario();
        $user->id = $row['id'];
        $user->user = $row['usuario'];
        $user->password = $row['password'];
        $user->email = $row['email'];

        return $user;
    }

    /**
     * @param int $pk
     * @return Usuario|null
     */
    public function getByPk($pk)
    {
        $db = DBConnection::getConnection();

        $query = "SELECT * FROM usuarios
                    WHERE email = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$pk]);

        if(!$row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return null;
        }

        $user = new Usuario();
        $user->id = $row['id'];
        $user->user = $row['usuario'];
        $user->password = $row['password'];
        $user->email = $row['email'];

        return $user;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param string $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }


}