<?php
// deletes meal/ workout
require_once __DIR__ . '/../includes/auth_check.php';
require_once __DIR__ . '/../includes/db.php';

$user_id = (int)$_SESSION['user_id'];

$type = $_GET['type'] ?? '';
$id = (int)($_GET['id'] ?? 0);

if ($id <= 0 || !in_array($type, ['meal', 'workout'], true)) {
    die("Invalid request.");
}
if ($type === 'meal') {
    // Delete meal only if it belongs to this user
    $stmt = mysqli_prepare($con, "DELETE FROM meals WHERE id = ? AND user_id = ?");
} else {
    // Delete workout only if it belongs to this user
    $stmt = mysqli_prepare($con,"DELETE FROM workouts WHERE id = ? AND user_id = ?");
}

mysqli_stmt_bind_param($stmt, "ii", $id, $user_id);
//  Execute delete
mysqli_stmt_execute($stmt);
// refreshes the list after deletion
header("Location: " . BASE_URL . "/planner/planner.php");
exit;

