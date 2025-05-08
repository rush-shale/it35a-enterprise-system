<?php 
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - MEDICARE</title>
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
            background-color: #00509e;
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
        .contact-form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            max-width: 600px;
            margin: 0 auto;
        }
        .contact-form h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .contact-form input, .contact-form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }
        .contact-form textarea {
            resize: vertical;
        }
        .contact-form button {
            background: #2E8B57;
            color: white;
            border: none;
            padding: 12px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
            width: 100%;
        }
        .contact-form button:hover {
            background: #246b45;
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
        <a href="index.php">🏠 Dashboard</a>
        <a href="schedule-form.php">📅 Schedule</a>
        <a href="appointment-list.php">📋 Appointments</a>
        <a href="about.php">ℹ️ About Us</a>
        <a href="services.php">🛠️ Services</a>
        <a href="contact.php">📞 Contact</a>
        <a href="logout.php" style="color: #ff4d4d;">🚪 Log Out</a>
    </div>

    <!-- Main Content Section -->
    <div class="main">
        <h3>Contact Us</h3>
        
        <!-- Contact Form Section -->
        <div class="contact-form">
            <h2>We'd Love to Hear From You!</h2>
            
            <!-- Check if the form was submitted successfully -->
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $name = htmlspecialchars($_POST['name']);
                $email = htmlspecialchars($_POST['email']);
                $message = htmlspecialchars($_POST['message']);

                // Simple validation (you can make this more advanced)
                if (empty($name) || empty($email) || empty($message)) {
                    echo "<p style='color: red;'>All fields are required!</p>";
                } else {
                    // Process the form here, like sending an email or saving to a database
                    echo "<p style='color: green;'>Thank you for contacting us, $name! We will get back to you soon.</p>";
                }
            }
            ?>

            <!-- Form -->
            <form method="POST" action="contact.php">
                <input type="text" name="name" placeholder="Your Name" required>
                <input type="email" name="email" placeholder="Your Email" required>
                <textarea name="message" placeholder="Your Message" rows="6" required></textarea>
                <button type="submit">Send Message</button>
            </form>
        </div>
    </div>

</body>
</html>
