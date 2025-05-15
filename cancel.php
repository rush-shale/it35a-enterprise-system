<?php
// cancel.php

$conn = new mysqli("localhost", "root", "", "medicare");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['appointment_id'])) {
    $appointment_id = intval($_POST['appointment_id']);

    $sql = "UPDATE appointments SET status = 'Cancelled' WHERE appointment_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $appointment_id);

    if ($stmt->execute()) {
        echo "<script>
                alert('Appointment cancelled successfully.');
                window.location.href = 'schedule-form.php';
              </script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}

$conn->close();
?>
