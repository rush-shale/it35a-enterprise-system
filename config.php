<?php
$host = 'localhost';        // Database host (usually localhost)
$dbname = 'medicare';    // Database name (create this in phpMyAdmin or MySQL)
$username = 'root';         // MySQL username (default is 'root' for XAMPP)
$password = '';             // MySQL password (leave blank if none in XAMPP)

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Optional: set default fetch mode
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    // echo "Connected successfully"; // Uncomment for testing
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
