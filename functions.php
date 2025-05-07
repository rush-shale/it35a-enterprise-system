<?php
session_start();

// Simulated user login
if (!isset($_SESSION['user'])) {
    $_SESSION['user'] = 'Nurse Joy';
}

// Doctor list
function getDoctors() {
    return ['Dr. Alice Santos', 'Dr. John Cruz', 'Dr. Maria Lopez', 'Dr. Daniel Reyes'];
}

// Search logic
function filterDoctors($search) {
    $doctors = getDoctors();
    $filtered = [];

    if ($search !== '') {
        foreach ($doctors as $doctor) {
            if (stripos($doctor, $search) !== false) {
                $filtered[] = $doctor;
            }
        }
    } else {
        $filtered = $doctors;
    }

    return $filtered;
}