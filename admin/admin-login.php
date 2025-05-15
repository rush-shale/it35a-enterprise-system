<?php
require_once 'config.php';
session_start();

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (!empty($email) && !empty($password)) {
        try {
            $stmt = $conn->prepare("SELECT * FROM admins WHERE email = :email");
            $stmt->execute(['email' => $email]);
            $admin = $stmt->fetch();

            if ($admin && password_verify($password, $admin['password'])) {
                $_SESSION['admin'] = [
                    'id' => $admin['id'],
                    'username' => $admin['username'],
                    'email' => $admin['email']
                ];

                header('Location: admin-dashboard.php');
                exit();
            } else {
                $error = "Invalid email or password.";
            }
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
    <title>ADMIN LOGIN MEDICARE</title>
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
    <h2>Admin Login</h2>
    <?php if ($error): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="POST" action="">
        <input type="email" name="email" placeholder="Admin Email" required>
        <input type="password" name="password" id="password" placeholder="Password" required>
        <div class="toggle-password" onclick="togglePassword()">Show Password</div>
        <button type="submit" class="btn">Login</button>
    </form>

    <?php
        $adminRegisterPath = 'admin-register.php'; // Adjust if it's in a folder
        if (file_exists($adminRegisterPath)):
    ?>
        <a href="<?= $adminRegisterPath ?>" class="link-btn">Register as Admin</a>
    <?php else: ?>
        <div style="margin-top:12px; color:red;">
            Registration page not found. Check file location.
        </div>
    <?php endif; ?>
</div>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById("password");
        passwordInput.type = passwordInput.type === "password" ? "text" : "password";
    }
</script>
</body>
</html>
