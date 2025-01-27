<?php

class User{
    public $username;
    public $password;
    public $id;
    public $role;
    public $firstName;
    public $lastName;

    public function __construct($username, $password, $id, $role, $firstName, $lastName){
        $this->username = $username;
        $this->password = $password;
        $this->id = $id;
        $this->role = $role;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }
}