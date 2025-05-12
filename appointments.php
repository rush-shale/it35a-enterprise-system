<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}

require_once 'config.php';

// Fetch appointment records with JOINs
try {
    $stmt = $conn->query("
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
    $appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Appointments - Medicare Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background: #f5f5f5;
        }
        h2 {
            text-align: center;
            color: #2E8B57;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 5px 10px rgba(0,0,0,0.1);
            border-radius: 10px;
            overflow: hidden;
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #2E8B57;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .status {
            padding: 4px 8px;
            border-radius: 6px;
            font-weight: bold;
            text-transform: capitalize;
        }
        .scheduled { background: #f0ad4e; color: white; }
        .completed { background: #5cb85c; color: white; }
        .cancelled { background: #d9534f; color: white; }
    </style>
</head>
<body>
    <h2>Appointment Management</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Patient</th>
                <th>Doctor</th>
                <th>Date</th>
                <th>Reason</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
<?php if ($appointments): ?>
    <?php foreach ($appointments as $appt): ?>
        <tr>
            <td><?= $appt['appointment_id'] ?></td>
            <td><?= htmlspecialchars($appt['patient_name'] ?? 'N/A') ?></td>
            <td><?= htmlspecialchars($appt['doctor_name'] ?? 'N/A') ?></td>
            <td><?= date('M d, Y h:i A', strtotime($appt['appointment_date'])) ?></td>
            <td><?= htmlspecialchars($appt['reason']) ?></td>
            <td><span class="status <?= $appt['status'] ?>"><?= $appt['status'] ?></span></td>
            <td>
                <a href="edit-appointment.php?id=<?= $appt['appointment_id'] ?>">Edit</a> |
                <a href="delete_appointment.php?id=<?= $appt['appointment_id'] ?>" onclick="return confirm('Are you sure you want to delete this appointment?');">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
<?php else: ?>
    <tr><td colspan="7">No appointments found.</td></tr>
<?php endif; ?>
</tbody>

    </table>
</body>
</html>
