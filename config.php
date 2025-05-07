<?php
$host = 'localhost'; // or your server address
$dbname = 'medicare'; // Your database name
$username = 'root'; // default for local setups
$password = ''; // leave empty if no password is set

try {
    // Create PDO connection
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    // Set PDO error mode to exception for better error handling
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Set default fetch mode to associative array
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
    // If you reach here, connection was successful
    // echo "Connected successfully";  // (Optional, for testing)
} catch (PDOException $e) {
    // If the connection fails, show an error message
    die("Connection failed: " . $e->getMessage());
}
?>
