<?php
require_once 'config.php';
session_start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (!empty($email) && !empty($password)) {
        try {
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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background-color: #ffffff;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .container {
            display: flex;
            width: 1000px;
            height: 600px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            border-radius: 16px;
            overflow: hidden;
        }
        .left {
            flex: 1;
            background-color: #f8f8f8;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 30px;
        }
        .left h2 {
            font-size: 20px;
            text-align: center;
            font-weight: 600;
            margin-bottom: 20px;
        }
        .left h2 span {
            color: #28a745;
        }
        .left img {
            width: 250px;
        }
        .right {
            flex: 1;
            background-color: white;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .right h1 {
            font-size: 28px;
            margin-bottom: 10px;
            letter-spacing: 1.5px;
        }
        .right p {
            font-size: 14px;
            margin-bottom: 25px;
            color: #666;
        }
        .right form input {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: none;
            border-bottom: 2px solid #ccc;
            font-size: 15px;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
        .toggle-password {
            margin-top: -15px;
            font-size: 13px;
            color: #28a745;
            cursor: pointer;
        }
        .login-btn {
            width: 100%;
            padding: 12px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 15px;
            cursor: pointer;
        }
        .login-btn:hover {
            background-color: #218838;
        }
        .signup-link {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
        }
        .signup-link a {
            color: #28a745;
            text-decoration: none;
        }
        .footer-bar {
            height: 6px;
            background-color: #28a745;
            margin-top: auto;
            border-radius: 0 0 8px 8px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="left">
            <h2>Access Your Coverage,<br>Empower Your<br><span>Health with Medicare</span></h2>
            <img src="image/male-doctor.webp" alt="Doctor Image">
        </div>
        <div class="right">
            <h1>Medicare</h1>
            <p>Welcome back! Please log in your account.</p>
            <?php if ($error): ?>
                <div class="error"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <form method="POST">
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <div class="toggle-password" onclick="togglePassword()">Show Password</div>
                <button type="submit" class="login-btn">Login</button>
            </form>
            <div class="signup-link">
                Don't have an account? <a href="register.php">Register</a>
            </div>
            <div class="footer-bar"></div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const password = document.getElementById("password");
            password.type = password.type === "password" ? "text" : "password";
        }
    </script>
</body>
</html>
s