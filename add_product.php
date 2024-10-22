<?php
session_start();
include 'database.php';

if (!isset($_SESSION['seller_id'])) {
    header("Location: seller_login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $seller_id = $_SESSION['seller_id'];

    $stmt = $conn->prepare("INSERT INTO products (name, price, image_url, seller_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sdsi", $product_name, $product_price, $product_image, $seller_id);
    
    if ($stmt->execute()) {
        header("Location: manage_products.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
