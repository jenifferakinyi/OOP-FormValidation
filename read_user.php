<?php
include('db_connection.php');

// Assuming you have an instance of DbConnection
$dbConnection = new DbConnection();

// Get user ID from the URL
$userId = $_GET['id'];

// Fetch user details from the database
$stmt = $dbConnection->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param('i', $userId);
$stmt->execute();
$result_user = $stmt->get_result()->fetch_assoc();
$stmt->close();

// Close the database connection
$dbConnection->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet">
    <title>Read User</title>
    <style>
        *{
    padding: 0;
    margin: 0;
}
.container{
    width: 100%;
    height: 100vh;
    background: #db166f;
    position: relative;
}
.container .box{
    position: absolute;
    width: 350px;
    left:50% ;
    top: 50%;
    transform: translate(-50%,-50%);
    background-color: #fff;
    padding: 25px 25px 45px;
    border-radius: 20px;
}
         .signupB{
    width: 100%;
    background: #db166f;
    border: none;
    padding: 10px 16px;
    margin-top: 30px;
    font-size: 30px;
    color: #fff;
    cursor: pointer;
    border-radius: 50px;
    transition: 0.3s;
}
h2{
    color: #002004;
    text-align: center;
    font-size: 44px;
    margin-bottom: 30px;
    position: relative;
}
p{
    font-family:'Roboto', sans-serif ;
   font-size: larger;
}
.signupB a{
    color: white;
    list-style-type: none;
    text-decoration: none;
}
.signupB :active{
    transform: scale3d(0.9,0.9,0.9);
}
    </style>
</head>
<body>
    <div class="container">
        <div class="box">
    <h2>User Details</h2>

        <p>ID: <?php echo $result_user['id']; ?></p>
        <p>Username: <?php echo $result_user['username']; ?></p>
        <p>Email: <?php echo $result_user['email']; ?></p>

        <button class="signupB" type="submit" name="submit" value="Save Changes"> <a href="AdminDashboard.php">Back to Dashboard</a></button>
    </div>
    </div>
</body>
</html>
