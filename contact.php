<?php 
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
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
      box-shadow: 2px 0 5px rgba(0,0,0,0.1);
    }
    .sidebar h2 {
      text-align: center;
      margin-bottom: 40px;
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
    .main {
      margin-left: 240px;
      padding: 40px 20px;
    }
    .contact-section {
      max-width: 800px;
      margin: auto;
      background-color: white;
      padding: 30px 40px;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
    h1, h2, h3 {
      color: #2E8B57;
      text-align: center;
    }
    p.intro {
      text-align: center;
      margin-bottom: 30px;
      font-size: 16px;
    }
    .contact-info {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      margin-top: 20px;
      gap: 30px;
    }
    .contact-card {
      flex: 1 1 45%;
      background-color: #f0f9f7;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }
    .contact-card h3 {
      color: #2E8B57;
      margin-bottom: 10px;
    }
    .contact-card p {
      margin: 5px 0;
      font-size: 15px;
    }
    .icon {
      font-weight: bold;
      margin-right: 6px;
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
    <div class="contact-section">
      <h1>Contact Us</h1>
      <p class="intro">
        Get in Touch with <strong>Medicare ERP</strong><br>
        We’re here to help! Whether you have questions, need support, or want to request a demo, our team is ready to assist you.
      </p>

      <div class="contact-info">
        <div class="contact-card">
          <h3>📍 Our Office</h3>
          <p><span class="icon">🏢</span>Address: 123 Healthcare Avenue, MedCity, USA</p>
          <p><span class="icon">📞</span>Phone: +1 234 567 8900</p>
          <p><span class="icon">📧</span>Email: support@medicareerp.com</p>
        </div>

        <div class="contact-card">
          <h3>🕒 Support Hours</h3>
          <p><span class="icon">⏰</span>Monday – Friday: 8:00 AM – 6:00 PM (EST)</p>
          <p><span class="icon">📍</span>Saturday – Sunday: Closed</p>
        </div>
      </div>
    </div>
  </div>

</body>
</html>
