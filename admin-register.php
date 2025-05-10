<?php
require_once 'config.php';
session_start();

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (!empty($username) && !empty($email) && !empty($password)) {
        try {
            // Check if there are already 2 admins
            $stmt = $conn->query("SELECT COUNT(*) FROM admins");
            $adminCount = $stmt->fetchColumn();

            if ($adminCount >= 2) {
                $error = "Maximum of 2 admins already registered.";
            } else {
                // Check if email already exists
                $stmt = $conn->prepare("SELECT * FROM admins WHERE email = :email");
                $stmt->execute(['email' => $email]);

                if ($stmt->fetch()) {
                    $error = "Email is already registered.";
                } else {
                    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

                    $stmt = $conn->prepare("INSERT INTO admins (username, password, email) VALUES (:username, :password, :email)");
                    $stmt->execute([
                        'username' => $username,
                        'password' => $hashedPassword,
                        'email' => $email
                    ]);

                    // Redirect to login page after successful registration
                    $success = "Admin registered successfully. You can now <a href='admin-login.php'>login</a>.";
                }
            }
        } catch (PDOException $e) {
            $error = "Database error: " . $e->getMessage();
        }
    } else {
        $error = "All fields are required.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register Admin - Medicare</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #e0f7f1;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .register-container {
            background: white;
            padding: 30px;
            width: 350px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
            color: #2E8B57;
        }
        input {
            width: 90%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        .btn {
            width: 95%;
            padding: 10px;
            background-color: #2E8B57;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            margin-top: 10px;
        }
        .btn:hover {
            background-color: #246b45;
        }
        .msg {
            margin-bottom: 10px;
            color: red;
        }
        .success {
            color: green;
        }
    </style>
</head>
<body>
<div class="register-container">
    <h2>Register Admin</h2>
    <?php if ($error): ?>
        <div class="msg"><?= htmlspecialchars($error) ?></div>
    <?php elseif ($success): ?>
        <div class="msg success"><?= $success ?></div>
    <?php endif; ?>
    <form method="POST">
        <input type="text" name="username" placeholder="Admin Username" required>
        <input type="email" name="email" placeholder="Admin Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" class="btn">Register</button>
    </form>
    <a href="admin-login.php" style="display:block; margin-top:15px; color:#2E8B57;">Back to Login</a>
</div>
</body>
</html>
