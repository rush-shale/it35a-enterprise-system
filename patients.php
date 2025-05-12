<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}

require_once 'config.php';

// Fetch patient details based on the patient ID
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $patient_id = $_GET['id'];

    try {
        $stmt = $conn->prepare("
            SELECT 
                patient_id, 
                full_name, 
                email, 
                phone, 
                date_of_birth, 
                gender, 
                address, 
                medical_history, 
                registration_date
            FROM patients
            WHERE patient_id = :id
        ");
        $stmt->execute(['id' => $patient_id]);
        $patient = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
        exit();
    }

    if (!$patient) {
        echo "Patient not found!";
        exit();
    }
} else {
    echo "Invalid patient ID!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Patient Details - Medicare Admin</title>
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
        .patient-details {
            background: white;
            box-shadow: 0 5px 10px rgba(0,0,0,0.1);
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
        }
        .patient-details table {
            width: 100%;
            border-collapse: collapse;
        }
        .patient-details th, .patient-details td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .patient-details th {
            background-color: #2E8B57;
            color: white;
        }
    </style>
</head>
<body>
    <h2>Patient Details</h2>

    <a href="admin-dashboard.php" class="back-btn">Back to Dashboard</a>

    <div class="patient-details">
        <h3>Patient Information</h3>
        <table>
            <tr>
                <th>Full Name</th>
                <td><?= htmlspecialchars($patient['full_name']) ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?= htmlspecialchars($patient['email']) ?></td>
            </tr>
            <tr>
                <th>Phone</th>
                <td><?= htmlspecialchars($patient['phone']) ?></td>
            </tr>
            <tr>
                <th>Date of Birth</th>
                <td><?= date('M d, Y', strtotime($patient['date_of_birth'])) ?></td>
            </tr>
            <tr>
                <th>Gender</th>
                <td><?= htmlspecialchars($patient['gender']) ?></td>
            </tr>
            <tr>
                <th>Address</th>
                <td><?= htmlspecialchars($patient['address']) ?></td>
            </tr>
            <tr>
                <th>Medical History</th>
                <td><?= htmlspecialchars($patient['medical_history']) ?></td>
            </tr>
            <tr>
                <th>Registration Date</th>
                <td><?= date('M d, Y', strtotime($patient['registration_date'])) ?></td>
            </tr>
        </table>
    </div>
</body>
</html>
