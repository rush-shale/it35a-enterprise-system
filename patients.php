<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}
require_once 'config.php';

try {
    $stmt = $conn->query("SELECT * FROM patients ORDER BY created_at DESC");
    $patients = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error fetching patients: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Patients - Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 30px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .container {
            max-width: 1000px;
            margin: auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-radius: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background: #007BFF;
            color: #fff;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .btn {
            padding: 6px 12px;
            margin: 0 2px;
            text-decoration: none;
            color: #fff;
            border-radius: 4px;
        }

        .view-btn { background-color: #28a745; }
        .edit-btn { background-color: #ffc107; }
        .delete-btn { background-color: #dc3545; }
        .back-btn {
            display: inline-block;
            margin-bottom: 15px;
            padding: 8px 15px;
            background-color: #6c757d;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        .back-btn:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="admin-dashboard.php" class="back-btn">← Back to Dashboard</a>
        <h1>Patients List</h1>

        <?php if (count($patients) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Patient ID</th>
                    <th>Full Name</th>
                    <th>Birth Date</th>
                    <th>Gender</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($patients as $patient): ?>
                    <tr>
                        <td><?= htmlspecialchars($patient['patient_id']) ?></td>
                        <td><?= htmlspecialchars($patient['full_name']) ?></td>
                        <td><?= htmlspecialchars($patient['birth_date']) ?></td>
                        <td><?= htmlspecialchars($patient['gender']) ?></td>
                        <td><?= htmlspecialchars($patient['phone']) ?></td>
                        <td><?= htmlspecialchars($patient['email']) ?></td>
                        <td><?= htmlspecialchars($patient['created_at']) ?></td>
                        <td>
                            <a class="btn view-btn" href="view_patient.php?id=<?= $patient['patient_id'] ?>">View</a>
                            <a class="btn edit-btn" href="edit_patient.php?id=<?= $patient['patient_id'] ?>">Edit</a>
                            <a class="btn delete-btn" href="delete_patient.php?id=<?= $patient['patient_id'] ?>" onclick="return confirm('Are you sure you want to delete this patient?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>
            <p>No patients found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
