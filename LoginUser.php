<?php
class LoginUser {
    private $username;
    private $password;

    public function __construct($username, $password) {
        $this->setUsername($username);
        $this->setPassword($password);
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }
}
