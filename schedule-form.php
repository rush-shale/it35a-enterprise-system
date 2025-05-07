<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Schedule Appointment</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="main" style="margin-left: 220px; padding: 20px;">
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
