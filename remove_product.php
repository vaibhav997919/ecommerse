<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'ecommerce_db');

if (!isset($_SESSION['seller_id'])) {
    header("Location: seller_login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];

    $stmt = $conn->prepare("DELETE FROM products WHERE id = ? AND seller_id = ?");
    $stmt->bind_param("ii", $product_id, $_SESSION['seller_id']);
    
    if ($stmt->execute()) {
        echo "Product removed successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
}

// Fetch seller's products
$seller_id = $_SESSION['seller_id'];
$products = $conn->query("SELECT * FROM products WHERE seller_id = $seller_id");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Remove Product</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Remove Your Products</h2>
    <form action="" method="POST">
        <label for="product_id">Select Product to Remove:</label>
        <select id="product_id" name="product_id" required>
            <?php while ($row = $products->fetch_assoc()): ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
            <?php endwhile; ?>
        </select>
        <button type="submit">Remove Product</button>
    </form>
</body>
</html>
