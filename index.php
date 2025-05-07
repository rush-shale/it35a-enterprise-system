index.php
---------
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Medicare Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="header">
    <div>
        <h2 class="logo">MEDICARE</h2>
    </div>
    <div>
        <nav>
            <a href="index.php">Home</a> |
            <a href="services.php">Services</a> |
            <a href="appointment-list.php">Appointment</a> |
            <a href="about.php">About us</a> |
            <a href="contact.php">Contact</a>
        </nav>
    </div>
</div>

<div class="sidebar">
    <a href="index.php">Dashboard</a>
    <a href="schedule-form.php">Schedule</a>
    <a href="#">Message</a>
    <a href="#">Activity</a>
    <a href="#">Security</a>
    <a href="#">Settings</a>
    <a href="#">Log out</a>
</div>

<div class="main">
    <h3>Good Morning!</h3>
    <div class="last-chat">
        <h4>Last Chat</h4>
        <input type="text" placeholder="Search Doctor...">
        <ul>
            <li>Doctor 1</li>
            <li>Doctor 2</li>
            <li>Doctor 3</li>
        </ul>
    </div>
    <div class="patient-history">
        <div class="chart">In-Patient</div>
        <div class="chart">Schedule</div>
        <div class="chart">Out-Patient</div>
        <div class="chart">Consultancy</div>
    </div>
</div>
</body>
</html>


config.php
----------
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "medicare";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>


appointment-list.php
---------------------
<?php
require_once 'config.php';
$appointments = [];

try {
    $sql = "SELECT a.appointment_id, p.full_name AS patient, d.full_name AS doctor, a.appointment_date, a.status 
            FROM appointments a
            JOIN patients p ON a.patient_id = p.patient_id
            JOIN doctors d ON a.doctor_id = d.doctor_id
            WHERE a.appointment_date >= NOW()";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
