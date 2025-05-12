<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

require_once 'config.php';

if (isset($_GET['id'])) {
    $doctor_id = $_GET['id'];

    // Fetch doctor details by ID
    try {
        $stmt = $conn->prepare("SELECT * FROM doctors WHERE doctor_id = ?");
        $stmt->execute([$doctor_id]);
        $doctor = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
        exit();
    }

    if (!$doctor) {
        echo "Doctor not found.";
        exit();
    }
} else {
    echo "No doctor ID provided.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle the form submission to update the doctor
    $full_name = $_POST['full_name'];
    $specialization = $_POST['specialization'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    try {
        $stmt = $conn->prepare("UPDATE doctors SET full_name = ?, specialization = ?, phone = ?, email = ? WHERE doctor_id = ?");
        $stmt->execute([$full_name, $specialization, $phone, $email, $doctor_id]);

        header("Location: doctors.php?updated=1");
        exit();
    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Doctor - Medicare Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background: #f5f5f5;
        }
        h2 {
            text-align: center;
            color: #2E8B57;
        }
        .message {
            background-color: #dff0d8;
            color: #3c763d;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }
        .back-btn {
            display: inline-block;
            background-color: #2E8B57;
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            text-decoration: none;
            margin-bottom: 20px;
            font-size: 16px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .back-btn:hover {
            background-color: #238c4b;
            transform: translateY(-2px);
        }
        .back-btn:active {
            background-color: #1f7a40;
            transform: translateY(2px);
        }
        .form-container {
            background-color: white;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 20px;
            max-width: 600px;
            margin: auto;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        input[type="text"], input[type="tel"], input[type="email"] {
            width: 100%;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ddd;
            font-size: 16px;
        }
        button[type="submit"] {
            background-color: #2E8B57;
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            font-size: 16px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button[type="submit"]:hover {
            background-color: #238c4b;
        }
    </style>
</head>
<body>

    <h2>Edit Doctor</h2>
    
    <a href="doctors.php" class="back-btn">Back to Doctors</a>

    <?php if (isset($_GET['updated']) && $_GET['updated'] == 1): ?>
        <div class="message">Doctor record updated successfully.</div>
    <?php endif; ?>

    <div class="form-container">
        <form method="POST">
            <div class="form-group">
                <label for="full_name">Full Name</label>
                <input type="text" id="full_name" name="full_name" value="<?= htmlspecialchars($doctor['full_name']) ?>" required>
            </div>
            <div class="form-group">
                <label for="specialization">Specialization</label>
                <input type="text" id="specialization" name="specialization" value="<?= htmlspecialchars($doctor['specialization']) ?>" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="tel" id="phone" name="phone" value="<?= htmlspecialchars($doctor['phone']) ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($doctor['email']) ?>" required>
            </div>
            <button type="submit">Update Doctor</button>
        </form>
    </div>

</body>
</html>
