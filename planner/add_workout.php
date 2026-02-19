<?php
// handles inserting workouts into database 
require_once __DIR__ . '/../includes/auth_check.php';
require_once __DIR__ . '/../includes/db.php';

$user_id = (int)$_SESSION['user_id'];

$planned_date = $_POST['planned_date'] ?? '';
$title = trim($_POST['title'] ?? '');
$duration = $_POST['duration_minutes'] ?? null;
$notes = trim($_POST['notes'] ?? '');

// validatges required fields 
if ($planned_date === '' || $title === '') {
    header("Location: " . BASE_URL . "/planner/planner.php?error=missing_workout_fields");
    exit;
}

$duration_int = ($duration === '' || $duration === null) ? null : (int)$duration;

$stmt = mysqli_prepare($con, "INSERT INTO workouts (user_id, planned_date, title, duration_minutes, notes) VALUES (?, ?, ?, ?, ?)");

mysqli_stmt_bind_param($stmt, "issis", $user_id, $planned_date, $title, $duration_int, $notes);

// Execute insert
mysqli_stmt_execute($stmt);

// Redirect back so user sees the new workout
header("Location: " . BASE_URL . "/planner/planner.php?success=workout_added");
exit;