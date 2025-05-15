<?php
// schedule-form.php

$conn = new mysqli("localhost", "root", "", "medicare");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT 
            a.appointment_id,
            p.full_name AS patient_name,
            d.full_name AS doctor_name,
            a.appointment_date,
            a.reason,
            a.status
        FROM appointments a
        LEFT JOIN patients p ON a.patient_id = p.patient_id
        LEFT JOIN doctors d ON a.doctor_id = d.doctor_id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Appointment Schedule - MEDICARE</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f7fa;
        }
        .sidebar {
            width: 220px;
            background: #2E8B57;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            padding-top: 60px;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        }
        .sidebar h2 {
            text-align: center;
            margin: 0;
            padding: 15px 0;
            font-size: 24px;
            border-bottom: 1px solid #fff;
        }
        .sidebar a {
            padding: 12px 20px;
            text-decoration: none;
            font-size: 16px;
            color: white;
            display: block;
        }
        .sidebar a:hover {
            background-color: #1e6f45;
        }
        .main {
            margin-left: 240px;
            padding: 30px;
        }
        h2 {
            color: #2E8B57;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        th, td {
            padding: 12px;
            border: 1px solid #ccc;
            text-align: left;
        }
        th {
            background-color: #e7f4ec;
        }
        .action-buttons button {
            padding: 6px 12px;
            margin-right: 5px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }
        .reschedule {
            background-color: #ffc107;
            color: #000;
        }
        .cancel {
            background-color: #dc3545;
            color: white;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
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

<!-- Main Content -->
<div class="main">
    <h2>Scheduled Appointments</h2>

    <?php if ($result->num_rows > 0): ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Patient</th>
                <th>Doctor</th>
                <th>Date</th>
                <th>Reason</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row["appointment_id"] ?></td>
                <td><?= $row["patient_name"] ?? 'N/A' ?></td>
                <td><?= $row["doctor_name"] ?? 'N/A' ?></td>
                <td><?= $row["appointment_date"] ?></td>
                <td><?= $row["reason"] ?></td>
                <td><?= $row["status"] ?></td>
                <td class="action-buttons">
                    <form method="POST" action="reschedule.php" style="display:inline;">
                        <input type="hidden" name="appointment_id" value="<?= $row["appointment_id"] ?>">
                        <button type="submit" class="reschedule">Reschedule</button>
                    </form>
                    <form method="POST" action="cancel.php" style="display:inline;" onsubmit="return confirm('Are you sure you want to cancel this appointment?');">
                        <input type="hidden" name="appointment_id" value="<?= $row["appointment_id"] ?>">
                        <button type="submit" class="cancel">Cancel</button>
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <?php else: ?>
        <p>No appointments found.</p>
    <?php endif; ?>

</div>

<?php $conn->close(); ?>
</body>
</html>
