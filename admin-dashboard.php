<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}

require_once 'config.php';

// Fetch dashboard data
try {
    $stmtAppointments = $conn->query("SELECT COUNT(*) FROM appointments");
    $appointmentsCount = $stmtAppointments->fetchColumn();

    $stmtPatients = $conn->query("SELECT COUNT(*) FROM patients");
    $patientsCount = $stmtPatients->fetchColumn();

    $stmtDoctors = $conn->query("SELECT COUNT(*) FROM doctors");
    $doctorsCount = $stmtDoctors->fetchColumn();
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
    exit();
}

$admin = $_SESSION['admin']; // Get admin info
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Medicare</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
        }
        .sidebar {
            background-color: #2E8B57;
            color: white;
            width: 250px;
            height: 100vh;
            padding: 20px;
            box-sizing: border-box;
        }
        .sidebar h2 {
            text-align: center;
        }
        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
        }
        .sidebar a:hover {
            background-color: #246b45;
        }
        .content {
            flex-grow: 1;
            padding: 20px;
        }
        .card {
            background-color: #f9f9f9;
            padding: 20px;
            margin: 10px;
            border-radius: 10px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        }
        .card h3 {
            margin-top: 0;
        }
        .card p {
            font-size: 20px;
        }
        .logout-btn {
            background-color: #ff4d4d;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
        }
        .logout-btn:hover {
            background-color: #e60000;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <h2>MEDICARE ADMIN</h2>
    <p>👤 <?= htmlspecialchars($admin['username']) ?></p>
    <a href="admin-dashboard.php">🏠 Dashboard</a>
    <a href="appointments.php">📅 Appointments</a>
    <a href="patients.php">👥 Patients</a>
    <a href="doctors.php">👩‍⚕️ Doctors</a>
    <a href="logout.php" class="logout-btn">🚪 Log Out</a>
</div>

<!-- Main Content -->
<div class="content">
    <h1>Welcome, <?= htmlspecialchars($admin['username']) ?>!</h1>

    <div class="card">
        <h3>Total Appointments</h3>
        <p><?= $appointmentsCount ?> appointments</p>
    </div>

    <div class="card">
        <h3>Total Patients</h3>
        <p><?= $patientsCount ?> patients</p>
    </div>

    <div class="card">
        <h3>Total Doctors</h3>
        <p><?= $doctorsCount ?> doctors</p>
    </div>

    <a href="appointments.php" class="btn">Manage Appointments</a>
    <a href="patients.php" class="btn">Manage Patients</a>
    <a href="doctors.php" class="btn">Manage Doctors</a>
</div>

</body>
</html>
