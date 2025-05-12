<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Schedule Appointment</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Sidebar styles */
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

        .sidebar a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 18px;
            color: white;
            display: block;
            transition: background-color 0.3s;
        }

        .sidebar a:hover {
            background-color: #00509e;
        }

        /* Main content styles */
        .main {
            margin-left: 220px;
            padding: 20px;
        }

        /* Button styles */
        button {
            background-color: #2E8B57;
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            font-size: 16px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #238c4b;
        }
    </style>
</head>
<body>

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

    <!-- Main content -->
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
