<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="
    sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/2329401839.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.google.com/specimen/Montserrat">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Allura&family=Fraunces:opsz,wght@9..144,200;9..144,500;9.
.144,700&family=Recursive:wght@300&display=swap" rel="stylesheet">
    <title>for women by women</title>
    <style>
        body {
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            justify-content: center;
           gap: 4rem;
        }

        .product-card {
            width: 300px;
            border: 1px solid #ddd;
            margin: 10px;
            padding: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            
        }

        .product-card img {
            width: 100%;
            height: 45%;
            margin-bottom: 10px;
        }
        .product-card h3{
            font-family:"Fraunces",serif ;
            font-weight: 500;
        }
        .product-card p{
            font-size: 16px;
            color:   hsl(228, 12%, 48%);
        }
        .product-card span{
            color:#db166f ;
           font-weight:600 ;
           font-size: 20px;
           font-family:"Fraunces",serif;
        }
        .product-card .btn{
            background-color: #db166f;
            color:  hsl(0, 0%, 100%);
            width: 80%;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
         include('display_product.php');

         class Product {
            private $productId;
            private $productName;
            private $productDescription;
            private $productPrice;
            private $productImage;
        
            public function __construct($id, $name, $description, $price, $image) {
                $this->productId = $id;
                $this->productName = $name;
                $this->productDescription = $description;
                $this->productPrice = $price;
                $this->productImage = $image;
            }
        
            public function getProductId() {
                return $this->productId;
            }
        
            public function getProductName() {
                return $this->productName;
            }
        
            public function getProductDescription() {
                return $this->productDescription;
            }
        
            public function getProductPrice() {
                return $this->productPrice;
            }
        
            public function getProductImage() {
                return $this->productImage;
            }
        }
        
         ?>
    </div>
</body>
</html>
