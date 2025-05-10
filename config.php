<?php
$host = 'localhost'; // Your database host, often 'localhost'
$dbname = 'medicare'; // Your database name
$username = 'root'; // Database username (change if needed)
$password = ''; // Database password (change if needed)

try {
    // Create a PDO connection to the database
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Enable exceptions for errors
} catch (PDOException $e) {
    // Handle connection errors
    die("Database connection failed: " . $e->getMessage());
}
?>
