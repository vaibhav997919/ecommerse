<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'ecommerce_db');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Admin authentication check should be here (not implemented in this code)
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Admin Panel</h2>
    <p>Welcome, Admin!</p>
    <h3>Manage Products</h3>
    <form action="add_product.php" method="POST">
        <!-- Form to add products -->
        <label for="product-name">Product Name:</label>
        <input type="text" id="product-name" name="product_name" required><br>

        <label for="product-price">Product Price (₹):</label>
        <input type="number" id="product-price" name="product_price" required><br>

        <label for="product-image">Product Image URL:</label>
        <input type="text" id="product-image" name="product_image" required><br>

        <button type="submit">Add Product</button>
    </form>

    <h3>Manage Sellers</h3>
    <form action="remove_seller.php" method="POST">
        <label for="seller-email">Seller Email:</label>
        <input type="email" id="seller-email" name="seller_email" required><br>

        <button type="submit">Remove Seller</button>
    </form>
</body>
</html>
