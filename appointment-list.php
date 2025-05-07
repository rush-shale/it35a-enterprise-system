<?php
require_once 'config.php';
session_start();

$appointments = [];
$error = '';

try {
    $sql = "SELECT a.appointment_id, p.full_name AS patient, d.full_name AS doctor, a.appointment_date, a.status 
            FROM appointments a
            JOIN patients p ON a.patient_id = p.patient_id
            JOIN doctors d ON a.doctor_id = d.doctor_id
            WHERE a.appointment_date >= NOW()
            ORDER BY a.appointment_date ASC";

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
    <title>Upcoming Appointments - Medicare</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f4f4;
        }
        .sidebar {
            width: 220px;
            background-color: #2E8B57;
            color: #fff;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 60px;
        }
        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        .sidebar a {
            display: block;
            padding: 12px 20px;
            color: #fff;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #2E8B57;
        }
        .main {
            margin-left: 240px;
            padding: 30px;
        }
        h3 {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px 15px;
            border-bottom: 1px solid #ddd;
        }
        th {
            background: #2E8B57;
            color: white;
            text-align: left;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .status {
            padding: 4px 8px;
            border-radius: 6px;
            color: white;
            font-size: 0.9em;
        }
        .status.Pending { background: orange; }
        .status.Confirmed { background: green; }
        .status.Cancelled { background: red; }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>MEDICARE</h2>
    <a href="index.php">🏠 Dashboard</a>
    <a href="schedule-form.php">📅 Schedule</a>
    <a href="appointment-list.php">📋 Appointments</a>
    <a href="about.php">ℹ️ About Us</a>
    <a href="services.php">🛠️ Services</a>
    <a href="contact.php">📞 Contact</a>
    <a href="logout.php" style="color: #ff4d4d;">🚪 Log Out</a>
</div>

<div class="main">
    <h3>Upcoming Appointments</h3>
    <?php if ($error): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php elseif (empty($appointments)): ?>
        <p>No upcoming appointments found.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Patient</th>
                    <th>Doctor</th>
                    <th>Date & Time</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($appointments as $appt): ?>
                    <tr>
                        <td><?= htmlspecialchars($appt['patient']) ?></td>
                        <td><?= htmlspecialchars($appt['doctor']) ?></td>
                        <td><?= htmlspecialchars($appt['appointment_date']) ?></td>
                        <td>
                            <span class="status <?= htmlspecialchars($appt['status']) ?>">
                                <?= htmlspecialchars($appt['status']) ?>
                            </span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

</body>
</html>
