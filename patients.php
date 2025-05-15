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
    echo "Database error: " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Patients - Medicare Admin</title>
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
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 5px 10px rgba(0,0,0,0.1);
            border-radius: 10px;
            overflow: hidden;
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #2E8B57;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .action-form {
            display: inline;
        }
        .delete-btn {
            background: none;
            border: none;
            color: red;
            cursor: pointer;
            font-weight: bold;
        }
        .edit-link {
            color: #2E8B57;
            font-weight: bold;
            text-decoration: none;
        }
        .edit-link:hover {
            text-decoration: underline;
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
    </style>
</head>
<body>
    <h2>Patient Records</h2>

    <a href="admin-dashboard.php" class="back-btn">Back to Dashboard</a>

    <?php if (isset($_GET['deleted']) && $_GET['deleted'] == 1): ?>
        <div class="message">Patient record deleted successfully.</div>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th>ID</th>
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
            <?php if ($patients): ?>
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
                            <a class="edit-link" href="edit-patient.php?id=<?= $patient['patient_id'] ?>">Edit</a> |
                            <form class="action-form" method="POST" action="delete-patient.php" onsubmit="return confirm('Are you sure you want to delete this patient?');">
                                <input type="hidden" name="id" value="<?= $patient['patient_id'] ?>">
                                <button type="submit" class="delete-btn">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="8">No patients found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
