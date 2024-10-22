<?php include 'database.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Seller Login</h1>
    </header>
    <section>
        <form action="" method="POST">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <br>
            <button type="submit">Login</button>
        </form>
        <?php
        session_start();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $stmt = $conn->prepare("SELECT * FROM sellers WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if (password_verify($password, $row['password'])) {
                    $_SESSION['seller_id'] = $row['id'];
                    header("Location: manage_products.php");
                    exit();
                } else {
                    echo "Invalid password.";
                }
            } else {
                echo "No seller found with that email.";
            }
        }
        ?>
    </section>
</body>
</html>
