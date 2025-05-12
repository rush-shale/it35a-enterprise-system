<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

require_once 'config.php';

try {
    $stmt = $conn->query("SELECT * FROM patients ORDER BY created_at DESC");
    $patients = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Patients - Admin Dashboard</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #1f1f1f;
            color: #f5f5f5;
        }

        .container {
            width: 90%;
            max-width: 1100px;
            margin: 40px auto;
            padding: 30px;
            background-color: #2a2a2a;
            border-radius: 10px;
            box-shadow: 0 0 10px #000;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .back-btn {
            display: inline-block;
            padding: 8px 16px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            padding: 12px 14px;
            border-bottom: 1px solid #444;
            text-align: left;
        }

        th {
            background-color: #333;
            color: #fff;
        }

        tr:hover {
            background-color: #3a3a3a;
        }

        .btn {
            padding: 6px 12px;
            margin: 0 2px;
            text-decoration: none;
            color: #fff;
            border-radius: 4px;
            font-size: 14px;
        }

        .btn.view { background-color: #28a745; }
        .btn.edit { background-color: #ffc107; color: #000; }
        .btn.delete { background-color: #dc3545; }

    </style>
</head>
<body>
    <div class="container">
        <a href="admin-dashboard.php" class="back-btn">← Back to Dashboard</a>
        <h2>Patient Records</h2>

        <?php if (count($patients) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Birth Date</th>
                        <th>Gender</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Created</th>
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
                                <a class="btn view" href="view_patient.php?id=<?= $patient['patient_id'] ?>">View</a>
                                <a class="btn edit" href="edit_patient.php?id=<?= $patient['patient_id'] ?>">Edit</a>
                                <a class="btn delete" href="delete_patient.php?id=<?= $patient['patient_id'] ?>" onclick="return confirm('Are you sure you want to delete this patient?');">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No patient records found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
