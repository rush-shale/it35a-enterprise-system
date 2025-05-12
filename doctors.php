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
        /* Your existing styles */
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
