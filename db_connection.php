<?php
class DbConnection {
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'for women';
    private $conn;
    private $lastError;

    public function __construct() {
        $this->connect();
    }

    private function connect() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);

        if ($this->conn->connect_error) {
            $this->lastError = "Connection failed: " . $this->conn->connect_error;
            die($this->lastError);
        }
    }

    public function prepare($sql) {
        return $this->conn->prepare($sql);
    }

    public function query($sql) {
        $result = $this->conn->query($sql);

        if (!$result) {
            $this->lastError = "Query failed: " . $this->conn->error;
            die($this->lastError);
        }

        return $result;
    }

    public function escapeString($value) {
        return $this->conn->real_escape_string($value);
    }

    public function close() {
        $this->conn->close();
    }

    // public function getLastError() {
    //     return $this->lastError;
    // }
    // public function getConnection() {
    //     return $this->conn;
    // }
}
?>
