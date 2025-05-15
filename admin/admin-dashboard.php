<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}

require_once 'config.php';

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

$admin = $_SESSION['admin'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Medicare</title>
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            background-color: #f4f4f4;
        }

        .sidebar {
            width: 250px;
            background-color: #2E8B57;
            color: #fff;
            height: 100vh;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        .sidebar a {
            display: block;
            padding: 12px;
            margin: 10px 0;
            background-color: #3a9d70;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            transition: background 0.3s;
        }

        .sidebar a:hover {
            background-color: #26764c;
        }

        .logout-btn {
            background-color: #e74c3c;
            text-align: center;
        }

        .logout-btn:hover {
            background-color: #c0392b;
        }

        .content {
            flex: 1;
            padding: 30px;
        }

        .header {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .stats {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .card {
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            padding: 20px;
            flex: 1;
            min-width: 250px;
            text-align: center;
        }

        .card h3 {
            margin: 10px 0;
            font-size: 18px;
            color: #333;
        }

        .card p {
            font-size: 26px;
            color: #2E8B57;
            margin: 0;
        }

        .btn-group {
            margin-top: 30px;
        }

        .btn-group a {
            display: inline-block;
            padding: 10px 20px;
            margin-right: 10px;
            background-color: #2E8B57;
            color: white;
            border-radius: 6px;
            text-decoration: none;
            transition: background 0.3s;
        }

        .btn-group a:hover {
            background-color: #246b45;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <div>
        <h2>MEDICARE</h2>
        <p>👤 <?= htmlspecialchars($admin['username']) ?></p>
        <a href="admin-dashboard.php">🏠 Dashboard</a>
        <a href="appointments.php">📅 Appointments</a>
        <a href="patients.php">👥 Patients</a>
        <a href="doctors.php">👩‍⚕️ Doctors</a>
    </div>
    <a href="logout.php" class="logout-btn">🚪 Log Out</a>
</div>

<!-- Main Content -->
<div class="content">
    <div class="header">Welcome back, <?= htmlspecialchars($admin['username']) ?> 👋</div>

    <div class="stats">
        <div class="card">
            <h3>Total Appointments</h3>
            <p><?= $appointmentsCount ?></p>
        </div>
        <div class="card">
            <h3>Total Patients</h3>
            <p><?= $patientsCount ?></p>
        </div>
        <div class="card">
            <h3>Total Doctors</h3>
            <p><?= $doctorsCount ?></p>
        </div>
    </div>

    <div class="btn-group">
        <a href="appointments.php">Manage Appointments</a>
        <a href="patients.php">Manage Patients</a>
        <a href="doctors.php">Manage Doctors</a>
    </div>
</div>

</body>
</html>
