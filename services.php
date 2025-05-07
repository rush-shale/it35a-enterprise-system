<?php 
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Services - MEDICARE</title>
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
            background: #003366;
            color: white;
            position: fixed;
            top: 60px;
            left: 0;
            height: 100%;
            padding-top: 60px;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        .sidebar a {
            display: block;
            padding: 12px 20px;
            text-decoration: none;
            color: white;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .sidebar a:hover {
            background-color: #00509e;
        }

        .main {
            margin-left: 240px;
            padding: 20px;
        }

        .service-card {
            background: #fff;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        .service-card h3 {
            margin-top: 0;
            color: #2E8B57;
        }

        .service-card p {
            margin: 10px 0;
        }

        .service-card button {
            padding: 10px 16px;
            background-color: #2E8B57;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .service-card button:hover {
            background-color: #246b45;
        }
    </style>
</head>
<body>

<!-- Header -->
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

<!-- Sidebar -->
<div class="sidebar">
    <h2>MEDICARE</h2>
    <a href="index.php">🏠 Dashboard</a>
    <a href="schedule-form.php">📅 Schedule</a>
    <a href="appointment-list.php">📋 Appointments</a>
    <a href="about.php">ℹ️ About Us</a>
    <a href="services.php">🛠️ Services</a>
    <a href="contact.php">📞 Contact</a>
    <a href="logout.php" style="color: #ff4d4d;">🚪 Log Out</a>
</div>

<!-- Main Content -->
<div class="main">
    <h2>Our Services</h2>

    <div class="service-card">
        <h3>General Consultation</h3>
        <p>Meet with our experienced physicians to discuss your health concerns.</p>
        <button onclick="window.location.href='schedule-form.php'">Book Here</button>
    </div>

    <div class="service-card">
        <h3>Pediatrics</h3>
        <p>Comprehensive healthcare services for infants, children, and adolescents.</p>
        <button onclick="window.location.href='schedule-form.php'">Book Here</button>
    </div>

    <div class="service-card">
        <h3>Dental Care</h3>
        <p>Quality oral care services including cleaning, fillings, and more.</p>
        <button onclick="window.location.href='schedule-form.php'">Book Here</button>
    </div>

    <div class="service-card">
        <h3>Laboratory Testing</h3>
        <p>Fast and reliable lab tests to support diagnosis and treatment.</p>
        <button onclick="window.location.href='schedule-form.php'">Book Here</button>
    </div>

    <div class="service-card">
        <h3>Mental Health Counseling</h3>
        <p>Confidential support for mental and emotional well-being.</p>
        <button onclick="window.location.href='schedule-form.php'">Book Here</button>
    </div>
</div>

</body>
</html>
