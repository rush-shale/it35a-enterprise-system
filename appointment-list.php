<?php require_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Appointment List - MEDICARE</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <div class="header">
        <div class="header-Left">
            <a href="index.php" class="logo">MEDICARE</a>
        </div>
        <div class="header-Right">
            <a href="index.php">Home</a>
            <a class="active" href="appointment-list.php">Appointments</a>
        </div>
    </div>
</header>

<section>
    <h1>Appointment List</h1>
    <?php
    $stmt = $conn->prepare("
        SELECT 
            a.appointment_id,
            p.full_name AS patient_name,
            d.full_name AS doctor_name,
            a.appointment_date,
            a.reason,
            a.status
        FROM appointments a
        LEFT JOIN patients p ON a.patient_id = p.patient_id
        LEFT JOIN doctors d ON a.doctor_id = d.doctor_id
        ORDER BY a.appointment_date DESC
    ");
    $stmt->execute();
    $appointments = $stmt->fetchAll();
    ?>

    <?php if ($appointments): ?>
        <table border="1" cellpadding="10" cellspacing="0">
            <tr>
                <th>Patient</th>
                <th>Doctor</th>
                <th>Date</th>
                <th>Reason</th>
                <th>Status</th>
            </tr>
            <?php foreach ($appointments as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['patient_name']) ?></td>
                    <td><?= htmlspecialchars($row['doctor_name']) ?></td>
                    <td><?= htmlspecialchars($row['appointment_date']) ?></td>
                    <td><?= htmlspecialchars($row['reason']) ?></td>
                    <td><?= htmlspecialchars($row['status']) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>No appointments found.</p>
    <?php endif; ?>
</section>

<footer>
    <div class="footer">
        &copy; 2025 <strong>MEDICARE</strong>. All Rights Reserved.
    </div>
</footer>
</body>
</html>
