<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <title>Login</title>
</head>
<body>
<?php 
require_once 'db_connection.php';
require_once 'LoginUser.php';
require_once 'LoginC.php';

try {
    $db = new DbConnection();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $db->escapeString($_POST['username']);
        $password = $db->escapeString($_POST['password']);

        // Perform server-side validation here if needed
        if (empty($username) || empty($password)) {
            echo "<script>alert('Please enter both username and password.');</script>";
        } else {
            $loginUser = new LoginUser($username, $password);

            $login = new Login($loginUser, $db);
            $result = $login->authenticate();

            // Debugging output
            echo "<pre>";
            var_dump($result);
            echo "</pre>";

            // Redirect after successful login
            if ($result === "Login successful") {
                header("Location: index.php"); // Redirect to your dashboard or any other page
                exit();
            }
        }
    }

    $db->close();
} catch (Exception $e) {
    // Log the error to a file for debugging
    var_dump("Error: " . $e->getMessage(), 3, "error.log");
    echo "<p style='color: red;'>An error occurred. Please try again later.</p>";
}
?>


<div class="container">
    <div class="box">
        <h2>Login</h2>
        <form method="POST" action="login.php">
            <div class="inputbox">
                <input type="text" name="username" required>
                <label>Username</label>
            </div>

            <div class="inputbox">
                <input type="password" name="password" required>
                <label>Password</label>
            </div>
            
            <button class="signupB" type="submit" name="submit" value="submit">Login</button>
            
            <div class="login_link"><a href="signup.php">Don't have an Account</a></div>
        </form>
    </div>
</div>

</body>
</html>
