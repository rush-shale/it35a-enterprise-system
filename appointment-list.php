<?php
// Include the database connection
require_once 'config.php';

$appointments = [];

// Get upcoming appointments
try {
    $sql = "SELECT a.appointment_id, p.full_name AS patient, d.full_name AS doctor, a.appointment_date, a.status 
            FROM appointments a
            JOIN patients p ON a.patient_id = p.patient_id
            JOIN doctors d ON a.doctor_id = d.doctor_id
            WHERE a.appointment_date >= NOW()";
    
    // Prepare and execute the query
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    // Fetch all results as associative arrays
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
</head>
<body>
<div class="main" style="margin-left: 220px; padding: 20px;">
    <h3>Upcoming Appointments</h3>
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
