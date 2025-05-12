<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}

require_once 'config.php';

// Fetch doctor records
try {
    $stmt = $conn->query("SELECT * FROM doctors ORDER BY full_name ASC");
    $doctors = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Doctors - Medicare Admin</title>
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
    </style>
</head>
<body>

    
    <h2>Doctor Management</h2>
    
    <a href="admin-dashboard.php" class="back-btn">Back to Dashboard</a>

    <?php if (isset($_GET['deleted']) && $_GET['deleted'] == 1): ?>
        <div class="message">Doctor record deleted successfully.</div>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Specialization</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($doctors): ?>
                <?php foreach ($doctors as $doctor): ?>
                    <tr>
                        <td><?= $doctor['doctor_id'] ?></td>
                        <td><?= htmlspecialchars($doctor['full_name']) ?></td>
                        <td><?= htmlspecialchars($doctor['specialization'] ?? 'N/A') ?></td> <!-- Handle missing specialization -->
                        <td><?= htmlspecialchars($doctor['phone']) ?></td>
                        <td><?= htmlspecialchars($doctor['email']) ?></td>
                        <td>
                            <a href="edit-doctor.php?id=<?= $doctor['doctor_id'] ?>">Edit</a> |
                            <form class="action-form" method="POST" action="delete-doctor.php" onsubmit="return confirm('Are you sure you want to delete this doctor?');">
                                <input type="hidden" name="id" value="<?= $doctor['doctor_id'] ?>">
                                <button type="submit" class="delete-btn">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="6">No doctors found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>
