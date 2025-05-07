<?php
require_once 'config.php';

$appointments = [];

try {
    $sql = "SELECT a.appointment_id, p.full_name AS patient, d.full_name AS doctor, a.appointment_date, a.status 
            FROM appointments a
            JOIN patients p ON a.patient_id = p.patient_id
            JOIN doctors d ON a.doctor_id = d.doctor_id
            WHERE a.appointment_date >= NOW()";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $appointments = $stmt->fetchAll();
} catch (PDOException $e) {
    $error = 'Error fetching appointments: ' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upcoming Appointments</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .main {
            margin-left: 220px;
            padding: 20px;
        }
        .sidebar {
            width: 200px;
            height: 100vh;
            position: fixed;
            background-color: #2E8B57;
            color: white;
            padding: 20px 15px;
        }
        .sidebar h2 {
            margin-top: 0;
        }
        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            margin: 10px 0;
        }
        .sidebar a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="sidebar">
    <h2>MEDICARE</h2>
    <a href="index.php">🏠 Dashboard</a>
    <a href="schedule.php">📅 Schedule</a>
    <a href="appointment-list.php">📋 Appointments</a>
    <a href="about.php">ℹ️ About Us</a>
    <a href="services.php">🛠️ Services</a>
    <a href="contact.php">📞 Contact</a>
    <a href="logout.php" style="color: #ff4d4d;">🚪 Log Out</a>
</div>

<div class="main">
    <h3>Upcoming Appointments</h3>

    <a href="schedule.php" style="display: inline-block; padding: 10px 20px; background-color: #2E8B57; color: white; text-decoration: none; border-radius: 4px; margin-bottom: 20px;">Schedule Appointment</a>

    <?php if (!empty($error)): ?>
        <p style="color: red;"><?= $error ?></p>
    <?php else: ?>
        <ul>
            <?php foreach ($appointments as $appt): ?>
                <li>
                    <?= htmlspecialchars($appt['patient']) ?> with <?= htmlspecialchars($appt['doctor']) ?> on <?= htmlspecialchars($appt['appointment_date']) ?> (Status: <?= htmlspecialchars($appt['status']) ?>)
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>
</body>
</html>
