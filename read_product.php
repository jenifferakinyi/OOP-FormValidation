<?php
include('db_connection.php');

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
    <title>View User</title>
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
    background:#db166f;
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
    <p >ID: <?php echo $product['id']; ?></p>
    <p>TITLE: <?php echo $product['name']; ?></p>
    <p>DESCRIPTION: <?php echo $product['description']; ?></p>

    <button class="signupB" type="submit" name="submit" value="Save Changes"> <a href="admin_dashboard.php" class="btn">Back to Dashboard</a></button>
        </div>
</div>
</body>
</html>
