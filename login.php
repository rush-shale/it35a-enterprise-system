<?php
require_once 'config.php';
session_start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (!empty($email) && !empty($password)) {
        try {
        

            // Try user login
            $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user'] = [
                    'id' => $user['user_id'],
                    'name' => $user['name'],
                    'email' => $user['email']
                ];
                header('Location: index.php');
                exit();
            }

            // If neither matched
            $error = "Invalid email or password.";
        } catch (PDOException $e) {
            $error = "Database error: " . $e->getMessage();
        }
    } else {
        $error = "Please fill in both email and password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Medicare</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background: white;
            padding: 30px;
            width: 320px;
            border-radius: 10px;
            box-shadow: 0 5px 10px rgba(0,0,0,0.1);
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
        .link-btn {
            margin-top: 12px;
            display: block;
            color: #2E8B57;
            text-decoration: none;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
        .toggle-password {
            margin-top: -6px;
            font-size: 12px;
            cursor: pointer;
            color: #2E8B57;
        }
    </style>
</head>
<body>
<div class="login-container">
    <h2>Login to Medicare</h2>
    <?php if ($error): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="POST" action="">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" id="password" placeholder="Password" required>
        <div class="toggle-password" onclick="togglePassword()">Show Password</div>
        <button type="submit" class="btn">Login</button>
    </form>
    <a href="register.php" class="link-btn">Don't have an account? Register</a>
</div>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById("password");
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
        } else {
            passwordInput.type = "password";
        }
    }
</script>
</body>
</html>
