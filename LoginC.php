<?php

class Login
{
    private $user;
    private $db;

    public function __construct($user, $db)
    {
        $this->user = $user;
        $this->db = $db;
    }

    public function authenticate()
    {
        $username = $this->user->getUsername();
        $password = $this->user->getPassword();

        // Fetch user data from the database based on the provided username
        $userData = $this->getUserData($username);

        if (!$userData) {
            return "Invalid username or password";
        }

        // Verify the password
        if (password_verify($password, $userData['password'])) {
            return "Login successful";
        } else {
            return "Invalid username or password";
        }
    }

    private function getUserData($username)
    {
        $query = "SELECT * FROM users WHERE username = ?";
        $stmt = $this->db->prepare($query);
    
        if (!$stmt) {
            throw new Exception("Error preparing statement: " . $this->db->error);
        }
    
        $stmt->bind_param("s", $username);
        $stmt->execute();
    
        if ($stmt->error) {
            throw new Exception("Error executing statement: " . $stmt->error);
        }
    
        $result = $stmt->get_result();
    
        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc();
        }
    
        return null;
    }
     
}

?>
