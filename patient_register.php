<?php
session_start();

// Database connection settings - change these to your own
$host = 'localhost';
$dbname = 'medicare';
$username = 'root';
$password = '';

try {
    // Create PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    $_SESSION['error'] = 'Database connection failed: ' . $e->getMessage();
    header('Location: index.php');
    exit();
}

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate inputs
    $full_name = trim($_POST['full_name'] ?? '');
    $birth_date = $_POST['birth_date'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $phone = trim($_POST['phone'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $email = trim($_POST['email'] ?? '');

    // Basic validation
    if (empty($full_name) || empty($birth_date) || empty($gender) || empty($phone)) {
        $_SESSION['error'] = 'Please fill in all required fields.';
        header('Location: index.php');
        exit();
    }

    if (!in_array($gender, ['Male', 'Female'])) {
        $_SESSION['error'] = 'Invalid gender selected.';
        header('Location: index.php');
        exit();
    }

    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = 'Invalid email format.';
        header('Location: index.php');
        exit();
    }

    try {
        // Insert patient data into the database
        $stmt = $pdo->prepare("INSERT INTO patients (full_name, birth_date, gender, phone, address, email) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$full_name, $birth_date, $gender, $phone, $address, $email]);

        $_SESSION['success'] = 'Patient registered successfully!';
    } catch (PDOException $e) {
        $_SESSION['error'] = 'Failed to register patient: ' . $e->getMessage();
    }

} else {
    $_SESSION['error'] = 'Invalid request method.';
}

// Redirect back to index.php
header('Location: index.php');
exit();
