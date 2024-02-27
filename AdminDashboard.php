<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <title>admin</title>
    <style>
      body{
        background-color:  #f4f4f4;
        font-family: 'lato', sans-serif;
      }
      h1{
        font-family: 'lato', sans-serif;
        font-size: 40px;
        color:#db166f;
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
            background-color:#db166f;
            color: white;
            border-radius: 5px;
        }

        .btn-danger {
            background-color: #f44336;
        }
    </style>
</head>
<body>
<?php
include('db_connection.php');

// Assuming you have an instance of DbConnection
$dbConnection = new DbConnection();

// Fetch users from the database
$result_users = $dbConnection->query("SELECT * FROM users");
?>
    <h1>Welcome !</h1>
    <div class="dashboard-container">
        <div class="crud-section">
            <h3>User Management</h3>
            <a href="adminCreateUser.php" class="btn">Create User</a>

            <table>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
                  <!-- storing key value pairs -->
                 <?php while ($user = $result_users->fetch_assoc()) { ?>
    <tr>
        <td><?php echo $user['id']; ?></td>
        <td><?php echo $user['username']; ?></td>
        <td><?php echo $user['email']; ?></td>
        <td>
            <a href="read_user.php?id=<?php echo $user['id']; ?>" class="btn">Read</a>
            <a href="update_user.php?id=<?php echo $user['id']; ?>" class="btn">Update</a>
            <a href="delete_user.php?id=<?php echo $user['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
        </td>
    </tr>
<?php } ?>
            </table>
        </div>
</body>
</html>