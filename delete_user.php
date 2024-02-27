<?php
include('db_connection.php');


$dbConnection = new DbConnection();

// Get user ID from the URL
$userId = $_GET['id'];

// Check if the user ID is provided and is a numeric value
if (isset($userId) && is_numeric($userId)) {
    // Prepare and execute the delete query
    $stmt = $dbConnection->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $stmt->close();

    // Redirect back to the admin dashboard after deletion
    header("Location: AdminDashboard.php");
    exit();
} else {
    // Handle invalid user ID
    echo "Invalid user ID";
}

// Close the database connection
$dbConnection->close();
?>
