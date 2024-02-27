<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <title>Document</title>
</head>
<body>
<?php
require_once 'db_connection.php';
require_once 'user.php';
require_once 'SignupC.php';

try {
    $db = new DbConnection();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $db->escapeString($_POST['username']);
        $email = $db->escapeString($_POST['email']);
        $password = $db->escapeString($_POST['password']);

        // Perform server-side validation here if needed

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $user = new User($username, $email, $hashedPassword);

        $signup = new Signup($user, $db);
        $result = $signup->signUp();

        echo "<script>alert('" . htmlspecialchars($result) . "');</script>";

        // Redirect after successful signup
        if ($result === "Account created successfully") {
            header("Location: login.php");
            exit();
        }
    }

    $db->close();
} catch (Exception $e) {
    echo "<p style='color: red;'>Error: " . htmlspecialchars($e->getMessage()) . "</p>";
}
?>



<div class="container">
        <div class="box">
            <h2>signup</h2>
            <form method="POST" action="signup.php">
    <div class="inputbox">
        <input type="text" name="username" required>
        <label>Username</label>
    </div>

    <div class="inputbox">
        <input type="email" name="email" required>
        <label>Email</label>
    </div>
    
    <div class="inputbox">
        <input type="password" name="password" required>
        <label>Password</label>
    </div>
    
    <button class="signupB" type="submit" name="submit" value="submit">Create Account</button>
    
    <div class="login_link"><a href="login.php">Already have an Account</a></div>
</form>

        </div>
    
    </div>
</body>
</html>