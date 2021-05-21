<?php

class Authentication
{
    /**
     * @param $email
     * @param $password
     * @return bool
     */
    public function login($email, $password)
    {
        $user = new Usuario();
        $user = $user->getByEmail($email);

        if ($user !== null) {
            if (password_verify($password, $user->getPassword())) {
                $this->setAsAuthenticated($user);
                return true;
            }
        }
        return false;
    }

    /**
     * @param Usuario $user
     */

    public function setAsAuthenticated(Usuario $user): void
    {
        $_SESSION['id'] = $user->getId();
    }

    public function logout()
    {
        unset($_SESSION['id']);
    }

    /**
     * @return bool
     */

    public function isAuthenticated(): bool
    {
        return isset($_SESSION['id']);
    }

    /**
     * @return Usuario|null
     */

    public function getUser()
    {
        if (!$this->isAuthenticated()) {
            return null;
        }

        $user = new Usuario();
        return $user->getByPk($_SESSION['id']);
    }
}
