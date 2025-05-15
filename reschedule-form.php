<?php
// reschedule-form.php

session_start();

$conn = new mysqli("localhost", "root", "", "medicare");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_GET['appointment_id'])) {
    die("Appointment ID is missing.");
}

$appointment_id = intval($_GET['appointment_id']);

// Fetch appointment details
$sql = "SELECT 
            a.appointment_id,
            p.full_name AS patient_name,
            d.full_name AS doctor_name,
            a.appointment_date,
            a.reason,
            a.status
        FROM appointments a
        LEFT JOIN patients p ON a.patient_id = p.patient_id
        LEFT JOIN doctors d ON a.doctor_id = d.doctor_id
        WHERE a.appointment_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $appointment_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Appointment not found.");
}

$appointment = $result->fetch_assoc();

$error = '';
$success = '';

// Possible statuses
$statuses = ['Scheduled', 'Completed', 'Cancelled', 'Rescheduled'];

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $new_date = trim($_POST['appointment_date'] ?? '');
    $new_reason = trim($_POST['reason'] ?? '');
    $new_status = trim($_POST['status'] ?? '');

    // Validate date
    if (empty($new_date)) {
        $error = "Please select a new appointment date and time.";
    } elseif (strtotime($new_date) === false) {
        $error = "Invalid date/time format.";
    } elseif (strtotime($new_date) <= time()) {
        $error = "The appointment date must be in the future.";
    } elseif (!in_array($new_status, $statuses)) {
        $error = "Invalid status selected.";
    } else {
        // Update appointment
        $update_sql = "UPDATE appointments SET appointment_date = ?, reason = ?, status = ? WHERE appointment_id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("sssi", $new_date, $new_reason, $new_status, $appointment_id);

        if ($update_stmt->execute()) {
            $success = "Appointment updated successfully.";
            // Refresh appointment data
            $appointment['appointment_date'] = $new_date;
            $appointment['reason'] = $new_reason;
            $appointment['status'] = $new_status;
        } else {
            $error = "Failed to update appointment. Please try again.";
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Reschedule Appointment - MEDICARE</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f7fa;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            background: white;
            padding: 30px;
            margin: 40px auto;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        h2 {
            color: #2E8B57;
            margin-bottom: 20px;
            text-align: center;
        }
        label {
            font-weight: bold;
            display: block;
            margin: 15px 0 5px;
        }
        input[type="datetime-local"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
        }
        textarea {
            resize: vertical;
        }
        .buttons {
            margin-top: 25px;
            text-align: center;
        }
        button {
            background-color: #2E8B57;
            color: white;
            padding: 12px 30px;
            font-size: 16px;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #238c4b;
        }
        .message {
            margin-top: 15px;
            padding: 12px;
            border-radius: 4px;
            font-weight: bold;
            text-align: center;
        }
        .error {
            background-color: #f8d7da;
            color: #842029;
            border: 1px solid #f5c2c7;
        }
        .success {
            background-color: #d1e7dd;
            color: #0f5132;
            border: 1px solid #badbcc;
        }
        .info-row {
            margin-bottom: 10px;
            font-size: 16px;
        }
        .info-label {
            font-weight: bold;
            color: #555;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Reschedule Appointment #<?= htmlspecialchars($appointment['appointment_id']) ?></h2>

    <?php if ($error): ?>
        <div class="message error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="message success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <div class="info-row">
        <span class="info-label">Patient:</span> <?= htmlspecialchars($appointment['patient_name']) ?>
    </div>
    <div class="info-row">
        <span class="info-label">Doctor:</span> <?= htmlspecialchars($appointment['doctor_name']) ?>
    </div>
    <div class="info-row">
        <span class="info-label">Current Date:</span> <?= date("F j, Y, g:i a", strtotime($appointment['appointment_date'])) ?>
    </div>
    <div class="info-row">
        <span class="info-label">Current Status:</span> <?= htmlspecialchars($appointment['status']) ?>
    </div>

    <form method="POST" novalidate>
        <label for="appointment_date">New Appointment Date & Time:</label>
        <input
            type="datetime-local"
            id="appointment_date"
            name="appointment_date"
            value="<?= date('Y-m-d\TH:i', strtotime($appointment['appointment_date'])) ?>"
            required
            min="<?= date('Y-m-d\TH:i') ?>"
        />

        <label for="reason">Reason (optional):</label>
        <textarea id="reason" name="reason" rows="4"><?= htmlspecialchars($appointment['reason']) ?></textarea>

        <label for="status">Status:</label>
        <select id="status" name="status" required>
            <?php foreach ($statuses as $status): ?>
                <option value="<?= $status ?>" <?= ($appointment['status'] === $status) ? 'selected' : '' ?>>
                    <?= $status ?>
                </option>
            <?php endforeach; ?>
        </select>

        <div class="buttons">
            <button type="submit">Update Appointment</button>
        </div>
    </form>

    <p style="text-align:center; margin-top: 20px;">
        <a href="schedule-form.php" style="color: #2E8B57; text-decoration:none;">← Back to Schedule</a>
    </p>
</div>

</body>
</html>
