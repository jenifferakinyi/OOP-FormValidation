<?php
include('db_connection.php');

// Assuming you have an instance of DbConnection
$dbConnection = new DbConnection();

// Get user ID from the URL
$userId = $_GET['id'];

// Check if the user ID is provided and is a numeric value
if (isset($userId) && is_numeric($userId)) {
    // Fetch user details from the database
    $stmt = $dbConnection->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $result_user = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    // Check if the form is submitted for updating
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve updated user details from the form
        $updatedUsername = $dbConnection->escapeString($_POST['updated_username']);
        $updatedEmail = $dbConnection->escapeString($_POST['updated_email']);

        // Prepare and execute the update query
        $stmt = $dbConnection->prepare("UPDATE users SET username = ?, email = ? WHERE id = ?");
        $stmt->bind_param('ssi', $updatedUsername, $updatedEmail, $userId);
        $stmt->execute();
        $stmt->close();

        // Redirect back to the admin dashboard after updating
        header("Location: admin_dashboard.php");
        exit();
    }
} else {
    // Handle invalid user ID
    echo "Invalid user ID";
}

// Close the database connection
$dbConnection->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <title>Update User</title>
</head>
<body>
    <div class="container">
    <h1 style="text-align: center; padding-top:60px;">Update User</h1>
        <div class="box">

    <form method="POST" action="update_user.php">
    <div class="inputbox">
        <input type="text" name="updated_username" value="<?php echo $result_user['id']; ?>" required>
        <label>ID:</label>
        </div>
        <div class="inputbox">
        <input type="text" name="updated_username" value="<?php echo $result_user['username']; ?>" required>
        <label>Username:</label>
        </div>
        <div class="inputbox">
       
        <input type="email" name="updated_email" value="<?php echo $result_user['email']; ?>" required>
        <label>Email:</label>
        </div>
        <button class="signupB" type="submit" name="submit" value="submit">Update</button>
       
    </form>

    <div class="login_link"><a href="AdminDashboard.php">Back to Dashboard</a></div>
    </div>
    </div>
</body>
</html>
