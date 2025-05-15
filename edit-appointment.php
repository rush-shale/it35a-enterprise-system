<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

require_once 'config.php';

if (isset($_GET['id'])) {
    $appointment_id = $_GET['id'];

    try {
        $stmt = $conn->prepare("SELECT * FROM appointments WHERE appointment_id = ?");
        $stmt->execute([$appointment_id]);
        $appointment = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
        exit();
    }

    if (!$appointment) {
        echo "Appointment not found.";
        exit();
    }
} else {
    echo "No appointment ID provided.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $appointment_date = $_POST['appointment_date'];
    $reason = $_POST['reason'];
    $status = $_POST['status'];

    try {
        $stmt = $conn->prepare("UPDATE appointments SET appointment_date = ?, reason = ?, status = ? WHERE appointment_id = ?");
        $stmt->execute([$appointment_date, $reason, $status, $appointment_id]);

        header("Location: appointment.php?updated=1");
        exit();
    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Edit Appointment - Medicare Admin</title>
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
    .message {
        background-color: #dff0d8;
        color: #3c763d;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 20px;
        text-align: center;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }
    .back-btn {
        display: inline-block;
        background-color: #2E8B57;
        color: white;
        padding: 10px 20px;
        border-radius: 25px;
        text-decoration: none;
        margin-bottom: 20px;
        font-size: 16px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        transition: background-color 0.3s ease, transform 0.3s ease;
    }
    .back-btn:hover {
        background-color: #238c4b;
        transform: translateY(-2px);
    }
    .back-btn:active {
        background-color: #1f7a40;
        transform: translateY(2px);
    }
    .form-container {
        background-color: white;
        box-shadow: 0 5px 10px rgba(0,0,0,0.1);
        border-radius: 10px;
        padding: 20px;
        max-width: 600px;
        margin: auto;
    }
    .form-group {
        margin-bottom: 15px;
    }
    label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }
    input[type="datetime-local"],
    textarea,
    select {
        width: 100%;
        padding: 8px;
        border-radius: 5px;
        border: 1px solid #ddd;
        font-size: 16px;
        box-sizing: border-box;
    }
    textarea {
        resize: vertical;
        min-height: 80px;
    }
    button[type="submit"] {
        background-color: #2E8B57;
        color: white;
        padding: 10px 20px;
        border-radius: 25px;
        font-size: 16px;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s ease;
        width: 100%;
    }
    button[type="submit"]:hover {
        background-color: #238c4b;
    }
</style>
</head>
<body>

<h2>Edit Appointment</h2>

<a href="appointment.php" class="back-btn">Back to Appointments</a>

<?php if (isset($_GET['updated']) && $_GET['updated'] == 1): ?>
    <div class="message">Appointment updated successfully.</div>
<?php endif; ?>

<div class="form-container">
    <form method="POST">
        <div class="form-group">
            <label for="appointment_date">Date</label>
            <input
                type="datetime-local"
                id="appointment_date"
                name="appointment_date"
                value="<?= htmlspecialchars(date('Y-m-d\TH:i', strtotime($appointment['appointment_date']))) ?>"
                required
            >
        </div>
        <div class="form-group">
            <label for="reason">Reason</label>
            <textarea id="reason" name="reason" required><?= htmlspecialchars($appointment['reason']) ?></textarea>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select id="status" name="status" required>
                <option value="scheduled" <?= $appointment['status'] === 'scheduled' ? 'selected' : '' ?>>Scheduled</option>
                <option value="completed" <?= $appointment['status'] === 'completed' ? 'selected' : '' ?>>Completed</option>
                <option value="cancelled" <?= $appointment['status'] === 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
            </select>
        </div>
        <button type="submit">Update Appointment</button>
    </form>
</div>

</body>
</html>
