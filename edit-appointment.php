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

    header("Location: appointment.php?success=1");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Appointment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f7f7f7;
        }
        h2 {
            color: #2E8B57;
        }
        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 400px;
            margin: auto;
        }
        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }
        input[type="datetime-local"],
        textarea,
        select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #2E8B57;
            color: white;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #246d48;
        }
    </style>
</head>
<body>

<h2>Edit Appointment #<?= $appointment_id ?></h2>

<form method="POST" action="edit-appointment.php?id=<?= $appointment_id ?>">
    <label for="appointment_date">Date:</label>
    <input type="datetime-local" id="appointment_date" name="appointment_date"
           value="<?= date('Y-m-d\TH:i', strtotime($appointment['appointment_date'])) ?>" required>

    <label for="reason">Reason:</label>
    <textarea name="reason" id="reason" rows="4" required><?= htmlspecialchars($appointment['reason']) ?></textarea>

    <label for="status">Status:</label>
    <select name="status" id="status" required>
        <option value="scheduled" <?= $appointment['status'] === 'scheduled' ? 'selected' : '' ?>>Scheduled</option>
        <option value="completed" <?= $appointment['status'] === 'completed' ? 'selected' : '' ?>>Completed</option>
        <option value="cancelled" <?= $appointment['status'] === 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
    </select>

    <button type="submit">Update Appointment</button>
</form>

</body>
</html>
