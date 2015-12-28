<?php

namespace App\Entity;

use App\Model\AbstractEntity;
use App\Model\UserInterface;

class User extends AbstractEntity implements UserInterface
{
    protected $id;

    protected $username;

    protected $email;

    protected $password;

    protected $hash;

    protected $active;

    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getHash()
    {
        return $this->hash;
    }

    public function getActive()
    {
        return $this->active;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function setUsername($username)
    {
        $this->username = strip_tags($username);

        return $this;
    }

    public function setEmail($email)
    {
        $this->email = strip_tags($email);

        return $this;
    }

    public function setPlainPassword($password)
    {
        $this->password = hash('sha512', $password);

        return $this;
    }

    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    public function setHash($hash)
    {
        $this->hash = hash('sha512', $hash);

        return $this;
    }

    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }
}
