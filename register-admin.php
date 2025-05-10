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
            // Check number of admins
            $stmt = $conn->query("SELECT COUNT(*) FROM admins");
            $adminCount = $stmt->fetchColumn();

            if ($adminCount >= 2) {
                $error = "Only 2 admins are allowed. Registration disabled.";
            } else {
                // Check if email already exists
                $stmt = $conn->prepare("SELECT * FROM admins WHERE email = :email");
                $stmt->execute(['email' => $email]);

                if ($stmt->rowCount() > 0) {
                    $error = "Admin email already registered.";
                } else {
                    // Hash the password
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                    // Insert new admin
                    $stmt = $conn->prepare("INSERT INTO admins (username, email, password) VALUES (:username, :email, :password)");
                    $stmt->execute([
                        'username' => $username,
                        'email' => $email,
                        'password' => $hashedPassword
                    ]);

                    $success = "Admin registered successfully!";
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
