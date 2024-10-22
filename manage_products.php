<?php 
session_start(); 
include 'database.php'; 
if (!isset($_SESSION['seller_id'])) {
    header("Location: seller_login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Manage Your Products</h1>
    </header>
    <section>
        <form action="add_product.php" method="POST">
            <label for="product-name">Product Name:</label>
            <input type="text" id="product-name" name="product_name" required>
            <br>
            <label for="product-price">Product Price (₹):</label>
            <input type="number" id="product-price" name="product_price" required>
            <br>
            <label for="product-image">Product Image URL:</label>
            <input type="text" id="product-image" name="product_image" required>
            <br>
            <button type="submit">Add Product</button>
        </form>
        <h2>Your Products</h2>
        <div id="product-list">
            <?php
            $seller_id = $_SESSION['seller_id'];
            $sql = "SELECT * FROM products WHERE seller_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $seller_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='product-card'>";
                    echo "<h3>" . $row['name'] . "</h3>";
                    echo "<p>Price: ₹" . $row['price'] . "</p>";
                    echo "<img src='" . $row['image_url'] . "' alt='" . $row['name'] . "' style='width: 100px; height: auto;'>";
                    echo "<form action='remove_product.php' method='POST'>";
                    echo "<input type='hidden' name='product_id' value='" . $row['id'] . "'>";
                    echo "<button type='submit'>Remove Product</button>";
                    echo "</form></div>";
                }
            } else {
                echo "No products found.";
            }
            ?>
        </div>
    </section>
</body>
</html>
