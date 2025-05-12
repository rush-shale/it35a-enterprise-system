<?php
require_once 'config.php';
session_start();

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}

$appointment_id = $_GET['id'] ?? null;
if (!$appointment_id) {
    echo "Invalid appointment ID.";
    exit();
}

// Fetch current appointment
$stmt = $conn->prepare("SELECT * FROM appointments WHERE appointment_id = ?");
$stmt->execute([$appointment_id]);
$appointment = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$appointment) {
    echo "Appointment not found.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date = $_POST['appointment_date'];
    $reason = $_POST['reason'];
    $status = $_POST['status'];

    $update = $conn->prepare("UPDATE appointments SET appointment_date = ?, reason = ?, status = ? WHERE appointment_id = ?");
    $update->execute([$date, $reason, $status, $appointment_id]);

    header("Location: appointment.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Appointment</title>
</head>
<body>
    <h2>Edit Appointment #<?= $appointment_id ?></h2>
    <form method="POST">
        <label>Date:</label><br>
        <input type="datetime-local" name="appointment_date" value="<?= date('Y-m-d\TH:i', strtotime($appointment['appointment_date'])) ?>"><br><br>

        <label>Reason:</label><br>
        <textarea name="reason" rows="4" cols="50"><?= htmlspecialchars($appointment['reason']) ?></textarea><br><br>

        <label>Status:</label><br>
        <select name="status">
            <option value="scheduled" <?= $appointment['status'] === 'scheduled' ? 'selected' : '' ?>>Scheduled</option>
            <option value="completed" <?= $appointment['status'] === 'completed' ? 'selected' : '' ?>>Completed</option>
            <option value="cancelled" <?= $appointment['status'] === 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
        </select><br><br>

        <button type="submit">Update Appointment</button>
    </form>
</body>
</html>
