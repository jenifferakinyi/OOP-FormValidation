<?php
include('db_connection.php');

// Create an instance of DbConnection
$dbConnection = new DbConnection();
$conn = $dbConnection->getConnection();

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Using a prepared statement to prevent SQL injection
    $sql = "SELECT * FROM products WHERE id=?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $product_id);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $product = $result->fetch_assoc();
        } else {
            // Redirect to the admin dashboard if the product is not found
            header("Location: admin_dashboard.php");
            exit();
        }
    } else {
        // Handle the case where the prepared statement fails
        die("Error in the prepared statement");
    }

    $stmt->close(); // Close the prepared statement
} else {
    // Redirect to the admin dashboard if the product ID is not provided
    header("Location: admin_dashboard.php");
    exit();
}

// Rest of your code to display the product details
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family:'Roboto', sans-serif ;
            margin: 20px;
        }

        h2 {
            color: #333;
        }

        .dashboard-container {
            display: flex;
            flex-direction: column;
        }

        .crud-section {
            flex: 1;
            margin-right: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .btn {
            padding: 10px;
            text-decoration: none;
            background-color: #4caf50;
            color: white;
            border-radius: 5px;
        }

        .btn-danger {
            background-color: #f44336;
        }
    </style>
</head>
<body>
            
    <h2>Welcome, Admin</h2>

    <div class="dashboard-container">
        <div class="crud-section">
            <h3>User Management</h3>
            <a href="signup.php" class="btn">Create User</a>

            <table>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
                  <!-- storing key value pairs -->
                <!-- <?php while ($user = $result_users->fetch_assoc()) { ?> -->
                    <tr>
                        <td><?php echo $user['id']; ?></td>
                        <td><?php echo $user['username']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td>
                        <a href="read_user.php?id=<?php echo $user['id']; ?>" class="btn">read</a>
                            <a href="update_user.php?id=<?php echo $user['id']; ?>" class="btn">update</a>
                            <a href="delete_user.php?id=<?php echo $user['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div><br>

        <div class="crud-section">
            <h3>Product Management</h3>
            <a href="create_product.php" class="btn">Add Product</a>

            <table>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
                <?php while ($product = $result_products->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $product['id']; ?></td>
                        <td><?php echo $product['image']; ?></td>
                        <td><?php echo $product['name']; ?></td>
                        <td><?php echo $product['description']; ?></td>
                        <td><?php echo $product['price']; ?></td>
                        <td>
                        <a href="read_product.php?id=<?php echo $product['id']; ?>" class="btn">Read</a>
                            <a href="update_product.php?id=<?php echo $product['id']; ?>" class="btn">Update</a>
                            <a href="delete_product.php?id=<?php echo $product['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div> <br><br>

    <a href="login.php" class="btn">Logout</a>
</body>
</html>
