<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

require_once 'config.php';

if (isset($_POST['id'])) {
    $doctor_id = $_POST['id'];

    try {
        // Delete the doctor record
        $stmt = $conn->prepare("DELETE FROM doctors WHERE doctor_id = ?");
        $stmt->execute([$doctor_id]);

        header("Location: doctors.php?deleted=1");
        exit();
    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
        exit();
    }
} else {
    echo "No doctor ID provided.";
    exit();
}
