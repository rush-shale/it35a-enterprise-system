<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

require_once 'config.php';

if (isset($_POST['id'])) {
    $patient_id = $_POST['id'];

    try {
        // Delete the patient record
        $stmt = $conn->prepare("DELETE FROM patients WHERE patient_id = ?");
        $stmt->execute([$patient_id]);

        header("Location: patients.php?deleted=1");
        exit();
    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
        exit();
    }
} else {
    echo "No patient ID provided.";
    exit();
}
