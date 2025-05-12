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
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #4e9f3d, #2E8B57);
            color: #fff;
        }

        /* Header */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #2E8B57;
            color: white;
            padding: 15px 30px;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .logo {
            font-size: 28px;
            font-weight: bold;
            letter-spacing: 1px;
        }

        nav a {
            color: white;
            margin: 0 10px;
            text-decoration: none;
            font-size: 16px;
            transition: 0.3s;
        }

        nav a:hover {
            text-decoration: underline;
        }

        /* Sidebar */
        .sidebar {
            width: 220px;
            background: #2E8B57;
            color: white;
            position: fixed;
            top: 60px;
            left: 0;
            height: 100%;
            padding-top: 60px;
            font-family: Arial, sans-serif;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 40px;
            font-size: 24px;
            letter-spacing: 1px;
        }

        .sidebar a {
            display: block;
            padding: 12px 20px;
            text-decoration: none;
            color: white;
            font-size: 16px;
            border-bottom: 1px solid #fff;
            transition: background-color 0.3s, padding-left 0.3s, font-weight 0.3s;
        }

        .sidebar a:hover {
            background-color: #00509e;
            padding-left: 25px;
            font-weight: bold;
        }

        .main {
            margin-left: 240px;
            padding: 40px;
            background-color:rgb(63, 63, 63);
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .schedule-btn-container {
            text-align: center;
            margin-bottom: 30px;
        }

        .schedule-btn {
            padding: 12px 25px;
            background-color: #4e9f3d;
            color: white;
            text-decoration: none;
            border-radius: 30px;
            font-size: 18px;
            font-weight: bold;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            transition: background-color 0.3s, transform 0.3s;
        }

        .schedule-btn:hover {
            background-color: #238c4b;
            transform: translateY(-3px);
        }

        /* Appointments List */
        ul {
            list-style: none;
            padding: 0;
        }

        li {
            background: #fff;
            color: #333;
            padding: 20px;
            margin-bottom: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s;
        }

        li:hover {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        li span {
            font-weight: bold;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
                padding-top: 40px;
            }

            .main {
                margin-left: 0;
                padding: 20px;
            }

            .header {
                flex-direction: column;
                align-items: flex-start;
            }

            nav a {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

<!-- Sidebar Section -->
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

<!-- Main Content Section -->
<div class="main">
    <h3>Upcoming Appointments</h3>

    <!-- Schedule Appointment Button -->
    <div class="schedule-btn-container">
        <a href="schedule.php" class="schedule-btn">Schedule Appointment</a>
    </div>

    <?php if (!empty($error)): ?>
        <p style="color: red;"><?= $error ?></p>
    <?php else: ?>
        <ul>
            <?php foreach ($appointments as $appt): ?>
                <li>
                    <span><?= htmlspecialchars($appt['patient']) ?></span> with <span><?= htmlspecialchars($appt['doctor']) ?></span> on <span><?= htmlspecialchars($appt['appointment_date']) ?></span> (Status: <span><?= htmlspecialchars($appt['status']) ?></span>)
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>

</body>
</html>
