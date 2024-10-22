<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'ecommerce_db');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $seller_email = $_POST['seller_email'];

    // Delete the seller from the database
    $stmt = $conn->prepare("DELETE FROM sellers WHERE email = ?");
    $stmt->bind_param("s", $seller_email);

    if ($stmt->execute()) {
        header("Location: admin_panel.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
