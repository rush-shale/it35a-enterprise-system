<?php
// reschedule.php

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['appointment_id'])) {
    $appointment_id = intval($_POST['appointment_id']);
    
    // Redirect to reschedule form page with the appointment ID as query parameter
    header("Location: reschedule-form.php?appointment_id=" . $appointment_id);
    exit;
} else {
    echo "Invalid request.";
}
?>
