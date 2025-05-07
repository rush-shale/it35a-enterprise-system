<?php
require_once 'config.php';

$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $patient = $_POST['patient'];
    $doctor = $_POST['doctor'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    if (empty($patient) || empty($doctor) || empty($date) || empty($time)) {
        $error = 'Please fill all fields.';
    } else {
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

            header("Location: appointment-list.php");
            exit;

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
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .main {
            margin-left: 220px;
            padding: 20px;
        }
        .sidebar {
            width: 200px;
            height: 100vh;
            position: fixed;
            background-color: #2E8B57;
            color: white;
            padding: 20px 15px;
        }
        .sidebar h2 {
            margin-top: 0;
        }
        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            margin: 10px 0;
        }
        .sidebar a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="sidebar">
    <h2>MEDICARE</h2>
    <a href="index.php">🏠 Dashboard</a>
    <a href="schedule.php">📅 Schedule</a>
    <a href="appointment-list.php">📋 Appointments</a>
    <a href="about.php">ℹ️ About Us</a>
    <a href="services.php">🛠️ Services</a>
    <a href="contact.php">📞 Contact</a>
    <a href="logout.php" style="color: #ff4d4d;">🚪 Log Out</a>
</div>

<div class="main">
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
