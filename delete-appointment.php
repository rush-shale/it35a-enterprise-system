<?php
require_once 'config.php';
session_start();

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];

    // Prepare and execute the delete statement
    $stmt = $conn->prepare("DELETE FROM appointments WHERE appointment_id = ?");
    if ($stmt->execute([$id])) {
        $_SESSION['message'] = "Appointment successfully deleted.";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "Failed to delete appointment.";
        $_SESSION['message_type'] = "error";
    }
} else {
    $_SESSION['message'] = "Invalid request.";
    $_SESSION['message_type'] = "warning";
}

header("Location: appointment.php");
exit();
