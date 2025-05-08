<?php
require_once 'config.php';
session_start();

// Fetch basic stats
$totalPatients = $conn->query("SELECT COUNT(*) FROM patients")->fetchColumn();
$totalDoctors = $conn->query("SELECT COUNT(*) FROM doctors")->fetchColumn();
$totalAppointments = $conn->query("SELECT COUNT(*) FROM appointments")->fetchColumn();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .sidebar {
            width: 220px;
            background-color: #003366;
            color: #fff;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 60px;
            font-family: Arial, sans-serif;
        }
        .sidebar a {
            display: block;
            padding: 10px 20px;
            color: white;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #005599;
        }
        .main {
            margin-left: 240px;
            padding: 20px;
        }
        .card {
            background: #f4f4f4;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h2 style="text-align:center;">MEDICARE</h2>
    <a href="admin-dashboard.php">📊 Admin Dashboard</a>
    <a href="appointment-list.php">📋 View Appointments</a>
    <a href="schedule-form.php">🗕️ Schedule</a>
    <a href="patients.php">👨‍⚕️ Patients</a>
    <a href="doctors.php">👩‍⚕️ Doctors</a>
    <a href="logout.php" style="color: #ff4d4d;">🚪 Log Out</a>
</div>

<div class="main">
    <h1>Admin Dashboard</h1>
    <div class="card">Total Patients: <?= $totalPatients ?></div>
    <div class="card">Total Doctors: <?= $totalDoctors ?></div>
    <div class="card">Total Appointments: <?= $totalAppointments ?></div>
</div>

</body>
</html>
