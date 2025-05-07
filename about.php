<?php 
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>About Us - Medicare</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .about-container {
            margin-left: 220px;
            padding: 40px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 12px;
            max-width: 900px;
            margin-top: 100px;
        }

        h2, h3 {
            color: #2a7a78;
        }

        .about-section {
            margin-bottom: 40px;
        }

        .team {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .team-member {
            background: #f1f1f1;
            padding: 15px;
            border-radius: 10px;
            flex: 1 1 200px;
            text-align: center;
        }

        .team-member img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="header">
    <div class="header-Left">
        <h2 class="logo">MEDICARE</h2>
    </div>
    <div class="header-Right">
        <a href="index.php">Home</a>
        <a href="services.php">Services</a>
        <a href="appointment-list.php">Appointment</a>
        <a href="about.php" class="active">About Us</a>
        <a href="contact.php">Contact</a>
    </div>
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

<div class="main about-container">
    <div class="about-section">
        <h2>About MEDICARE</h2>
        <p>MEDICARE is a modern healthcare management system designed to streamline appointment scheduling, patient care, and medical services. We aim to bring digital convenience to both healthcare providers and patients.</p>
    </div>

    <div class="about-section">
        <h3>Our Mission</h3>
        <p>To provide efficient, reliable, and accessible healthcare technology that empowers hospitals and clinics to serve better.</p>
    </div>

    <div class="about-section">
        <h3>Our Vision</h3>
        <p>To be a leading provider of innovative healthcare solutions that transform patient care and hospital efficiency worldwide.</p>
    </div>

    <div class="about-section">
        <h3>Our Team</h3>
        <div class="team">
            <div class="team-member">
                <img src="https://via.placeholder.com/100" alt="Team Member">
                <h4>John Rushel Hinoyog</h4>
                <p>Lead Developer</p>
            </div>
            <div class="team-member">
                <img src="https://via.placeholder.com/100" alt="Team Member">
                <h4>Jane Doe</h4>
                <p>UI/UX Designer</p>
            </div>
            <div class="team-member">
                <img src="https://via.placeholder.com/100" alt="Team Member">
                <h4>Mark Smith</h4>
                <p>Backend Engineer</p>
            </div>
        </div>
    </div>
</div>

</body>
</html>
