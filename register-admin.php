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
            // Check if two admins already exist
            $stmt = $conn->query("SELECT COUNT(*) FROM admins");
            $adminCount = $stmt->fetchColumn();

            if ($adminCount >= 2) {
                $error = "Only 2 admin accounts are allowed.";
            } else {
                // Check if email already exists
                $stmt = $conn->prepare("SELECT * FROM admins WHERE email = :email");
                $stmt->execute(['email' => $email]);

                if ($stmt->rowCount() > 0) {
                    $error = "Email already registered.";
                } else {
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                    $stmt = $conn->prepare("INSERT INTO admins (username, email, password) VALUES (:username, :email, :password)");
                    $stmt->execute([
                        'username' => $username,
                        'email' => $email,
                        'password' => $hashedPassword
                    ]);

                    $success = "Admin registered successfully.";
                }
            }
        } catch (PDOException $e) {
            $error = "Database error: " . $e->getMessage();
        }
    } else {
        $error = "Please fill in all fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #eef1f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            background: white;
            padding: 30px;
            width: 350px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        h2 {
            margin-bottom: 20px;
            text-align: center;
            color: #2c3e50;
        }
        input {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .btn {
            width: 100%;
            padding: 10px;
            margin-top: 15px;
            background-color: #2E8B57;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #246b45;
        }
        .message {
            text-align: center;
            margin-top: 15px;
        }
        .error {
            color: red;
        }
        .success {
            color: green;
        }
    </style>
</head>
<body>
<div class="form-container">
    <h2>Register Admin</h2>
    <?php if ($error): ?>
        <div class="message error"><?= htmlspecialchars($error) ?></div>
    <?php elseif ($success): ?>
        <div class="message success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>
    <form method="POST" action="">
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" class="btn">Register Admin</button>
    </form>
</div>
</body>
</html>
