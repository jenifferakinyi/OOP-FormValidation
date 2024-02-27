<!-- display_products.php -->
<?php

require_once('db_connection.php');
require_once('product.php');

$db = new DbConnection();

// Fetch products from the database
$sql = "SELECT * FROM products";
$result = $db->query($sql);

// Display products
while ($row = $result->fetch_assoc()) {
    $product = new Product($row['id'], $row['name'], $row['description'], $row['price'], $row['image']);

    echo '<div class="product-card">';
    echo '<img src="' . $product->getProductImage() . '" alt="' . $product->getProductName() . '">';
    echo '<h4>' . $product->getProductName() . '</h4>';
    echo '<p>Description: ' . $product->getProductDescription() . '</p>';
    echo '<span>Price: $' . $product->getProductPrice() . '</span>';
    echo '<br>';
    echo '<button type="button" class="btn "><i class="fa-solid fa-cart-shopping" 
    style="color: #fcfcfd;"></i>Add to Cart</button>';
    echo '</div>';
}

$db->close();

?>
