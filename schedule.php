<?php
// Include the database connection
require_once 'config.php';

$message = '';
$error = '';

// Handle form submission for scheduling an appointment
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $patient = $_POST['patient'];
    $doctor = $_POST['doctor'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    // Validate inputs
    if (empty($patient) || empty($doctor) || empty($date) || empty($time)) {
        $error = 'Please fill all fields.';
    } else {
        // Insert the appointment into the database
        try {
            $sql = "INSERT INTO appointments (patient_id, doctor_id, appointment_date) 
                    VALUES ((SELECT patient_id FROM patients WHERE full_name = :patient LIMIT 1), 
                            (SELECT doctor_id FROM doctors WHERE full_name = :doctor LIMIT 1),
                            :appointment_date)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                ':patient' => $patient,
                ':doctor' => $doctor,
                ':appointment_date' => "$date $time"
            ]);
            $message = 'Appointment scheduled successfully!';
        } catch (PDOException $e) {
            $error = 'Error scheduling appointment: ' . $e->getMessage();
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Schedule Appointment</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="main" style="margin-left: 220px; padding: 20px;">
    <h2>Schedule Appointment</h2>

    <?php if (!empty($message)): ?>
        <p style="color: green;"><?= $message ?></p>
    <?php elseif (!empty($error)): ?>
        <p style="color: red;"><?= $error ?></p>
    <?php endif; ?>

    <form method="POST" style="max-width: 400px;">
        <label>Patient Name:</label>
        <input type="text" name="patient" required><br><br>

        <label>Doctor Name:</label>
        <input type="text" name="doctor" required><br><br>

        <label>Date:</label>
        <input type="date" name="date" required><br><br>

        <label>Time:</label>
        <input type="time" name="time" required><br><br>

        <button type="submit">Schedule</button>
    </form>
</div>
</body>
</html>
