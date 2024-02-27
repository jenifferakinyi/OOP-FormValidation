<?php
class Signup {
    protected $user;
    protected $db;

    public function __construct(User $user, $db) {
        $this->user = $user;
        $this->db = $db;
    }

    public function signUp() {
        $username = $this->user->getUsername();
        $email = $this->user->getEmail();
        $password = $this->user->getPassword();

        // Check for duplicate username or email
        if ($this->isDuplicate($username, $email)) {
            return "Username or email already exists.";
        }

        $stmt = $this->db->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");

        $stmt->bind_param("sss", $username, $email, $password);

        if ($stmt->execute()) {
            $stmt->close(); // Close the prepared statement
            return "Account created successfully";
        } else {
            throw new Exception("Error: " . $this->db->error);
        }
    }

    protected function isDuplicate($username, $email) {
        $stmt = $this->db->prepare("SELECT username FROM users WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $stmt->store_result();
        $result = $stmt->num_rows > 0;
        $stmt->close(); // Close the prepared statement
        return $result;
    }
}
?>
