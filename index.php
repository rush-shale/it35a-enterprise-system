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
            width: 200px;
            background: #333;
            color: white;
            position: fixed;
            top: 60px;
            left: 0;
            height: 100%;
            padding-top: 20px;
            display: flex;
            flex-direction: column;
        }
        .sidebar a {
            color: white;
            padding: 12px;
            text-decoration: none;
            transition: background 0.3s;
        }
        .sidebar a:hover {
            background: #575757;
        }
        .main {
            margin-left: 220px;
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
    </style>
</head>
<body>
<div class="header">
    <div class="logo">MEDICARE</div>
    <nav>
        <a href="index.php">Home</a>
        <a href="services.php">Services</a>
        <a href="appointment-list.php">Appointment</a>
        <a href="about.php">About Us</a>
        <a href="contact.php">Contact</a>
    </nav>
</div>

<div class="sidebar">
    <a href="index.php">Dashboard</a>
    <a href="schedule-form.php">Schedule</a>
    <a href="#">Message</a>
    <a href="#">Activity</a>
    <a href="#">Security</a>
    <a href="#">Settings</a>
    <a href="logout.php">Log out</a>
</div>

<div class="main">
    <h3>
        Good Morning, 
        <?php 
        echo isset($_SESSION['user']['name']) 
            ? htmlspecialchars($_SESSION['user']['name']) 
            : 'Guest'; 
        ?>!
    </h3>

    <div class="button-group">
        <button onclick="location.href='schedule-form.php'">New Appointment</button>
        <button onclick="location.href='appointment-list.php'">View Appointments</button>
        <button onclick="location.href='services.php'">Our Services</button>
    </div>

    <div class="last-chat">
        <h4>Last Chat</h4>
        <input type="text" placeholder="Search Doctor...">
        <ul>
            <li>Doc, Daboy D. Makabungkag</li>
            <li>Doc, Oscar D. Makamahay</li>
            <li>Doc, Nardo D. Makalangkat</li>
        </ul>
    </div>

    <div class="patient-history">
        <div class="chart">In-Patient Records</div>
        <div class="chart">Scheduled Appointments</div>
        <div class="chart">Out-Patient Consults</div>
        <div class="chart">Consultancy Requests</div>
    </div>
</div>
</body>
</html>
