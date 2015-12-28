<?php

namespace App\Model;

interface UserInterface
{
    public function getId();

    public function getUsername();

    public function getEmail();

    public function getPassword();

    public function getHash();

    public function getActive();

    public function setUsername($username);

    public function setEmail($email);

    public function setPassword($password);

    public function setHash($hash);

    public function setActive($active);
}
