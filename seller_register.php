<?php include 'database.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Registration</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Register as a Seller</h1>
    </header>
    <section>
        <form action="" method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            <br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <br>
            <button type="submit">Register</button>
        </form>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            
            $stmt = $conn->prepare("INSERT INTO sellers (name, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $name, $email, $password);
            if ($stmt->execute()) {
                echo "Registration successful!";
            } else {
                echo "Error: " . $stmt->error;
            }
        }
        ?>
    </section>
</body>
</html>
