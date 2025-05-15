<?php
session_start();
include 'db_connection.php'; // your DB connection file

// Check if user is logged in
if (!isset($_SESSION['patient_id'])) {
    header("Location: login.php");
    exit();
}

$patient_id = $_SESSION['patient_id'];

$sql = "SELECT * FROM patient_history WHERE patient_id = ? ORDER BY appointment_date DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $patient_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Medical History</title>
    <style>
        body {
            font-family: Arial;
            background: #f9f9f9;
            margin: 40px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            background: white;
            box-shadow: 0 0 10px #ccc;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
        }
        th {
            background: #00a8ff;
            color: white;
        }
        h2 {
            color: #333;
        }
    </style>
</head>
<body>
    <h2>My Medical History</h2>

    <?php if ($result->num_rows > 0): ?>
        <table>
            <tr>
                <th>Date</th>
                <th>Doctor</th>
                <th>Diagnosis</th>
                <th>Treatment</th>
                <th>Notes</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['appointment_date']) ?></td>
                    <td><?= htmlspecialchars($row['doctor_name']) ?></td>
                    <td><?= htmlspecialchars($row['diagnosis']) ?></td>
                    <td><?= htmlspecialchars($row['treatment']) ?></td>
                    <td><?= htmlspecialchars($row['notes']) ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No history records found.</p>
    <?php endif; ?>

</body>
</html>
