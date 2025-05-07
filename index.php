<?php 
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Medicare Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #f4f4f4;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #2E8B57;
            color: white;
            padding: 15px 30px;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
        }
        nav a {
            color: white;
            margin: 0 10px;
            text-decoration: none;
        }
        nav a:hover {
            text-decoration: underline;
        }
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
            letter-spacing: 1px;
        }
        .sidebar a {
            display: block;
            padding: 12px 20px;
            text-decoration: none;
            color: white;
            font-size: 16px;
            transition: background-color 0.3s, padding-left 0.3s, font-weight 0.3s;
        }
        .sidebar a:hover {
            background-color: #2E8B57;
            padding-left: 25px;
            font-weight: bold;
        }
        .sidebar a:active {
            background-color: #2E8B57;
        }
        .main {
            margin-left: 240px;
            padding: 20px;
        }
        .button-group {
            margin-top: 20px;
        }
        .button-group button {
            padding: 10px 20px;
            margin-right: 10px;
            background: #2E8B57;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }
        .button-group button:hover {
            background: #246b45;
        }
        .chart {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .last-chat, .patient-history {
            margin-top: 30px;
        }
        .last-chat input[type="text"] {
            padding: 8px;
            width: 100%;
            margin-bottom: 10px;
        }
        .patient-history .chart {
            display: inline-block;
            width: 22%;
            margin-right: 20px;
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <div class="header">
        <div class="logo">MEDICARE</div>
        <nav>
            <a href="index.php">Home</a>
            <a href="services.php">Services</a>
            <a href="appointment-list.php">Appointments</a>
            <a href="about.php">About Us</a>
            <a href="contact.php">Contact</a>
        </nav>
    </div>

    <!-- Sidebar Section -->
    <div class="sidebar">
        <h2>MEDICARE</h2>
        <a href="index.php" class="nav-link">🏠 Dashboard</a>
        <a href="schedule-form.php" class="nav-link">📅 Schedule</a>
        <a href="appointment-list.php" class="nav-link">📋 Appointments</a>
        <a href="about.php" class="nav-link">ℹ️ About Us</a>
        <a href="services.php" class="nav-link">🛠️ Services</a>
        <a href="contact.php" class="nav-link">📞 Contact</a>
        <a href="logout.php" class="nav-link" style="color: #ff4d4d;">🚪 Log Out</a>
    </div>

    <!-- Main Content Section -->
    <div class="main">
        <h3>Good Morning, 
            <?php 
                echo isset($_SESSION['user']['name']) ? htmlspecialchars($_SESSION['user']['name']) : 'Guest'; 
            ?>!
        </h3>

        <!-- Button Group -->
        <div class="button-group">
            <button onclick="location.href='schedule-form.php'">New Appointment</button>
            <button onclick="location.href='appointment-list.php'">View Appointments</button>
            <button onclick="location.href='services.php'">Our Services</button>
        </div>

        <!-- Last Chat Section -->
        <div class="last-chat">
            <h4>Last Chat</h4>
            <input type="text" placeholder="Search Doctor...">
            <ul>
                <li>Doc, Daboy D. Makabungkag</li>
                <li>Doc, Oscar D. Makamahay</li>
                <li>Doc, Nardo D. Makalangkat</li>
            </ul>
        </div>

        <!-- Patient History Section -->
        <div class="patient-history">
            <div class="chart">In-Patient Records</div>
            <div class="chart">Scheduled Appointments</div>
            <div class="chart">Out-Patient Consults</div>
            <div class="chart">Consultancy Requests</div>
        </div>
    </div>
</body>
</html>
