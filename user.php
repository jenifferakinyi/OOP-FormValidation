<?php
class User {
    protected $username;
    protected $email;
    protected $password;

    public function __construct($username, $email, $password) {
        $this->setUsername($username);
        $this->setEmail($email);
        $this->setHashedPassword($password);
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setEmail($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->email = $email;
        } else {
            throw new Exception("Invalid email format");
        }
    }

    public function setHashedPassword($password) {
        $this->password = $this->hashPassword($password);
    }

    protected function hashPassword($password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function getUsername() {
        return $this->username;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }
}
?>
