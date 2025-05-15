<?php
require_once 'config.php';
session_start();

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];

    $stmt = $conn->prepare("DELETE FROM appointments WHERE appointment_id = ?");
    $stmt->execute([$id]);

    // Redirect back to appointment.php with success message
    header("Location: appointment.php?success=1");
    exit();
}

// Fallback redirect
header("Location: appointment.php");
exit();
