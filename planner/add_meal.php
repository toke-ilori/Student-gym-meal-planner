<?php
// handkes inserting meals into database 
require_once __DIR__ . '/../includes/auth_check.php';
require_once __DIR__ . '/../includes/db.php';

$user_id = (int)$_SESSION['user_id'];

$planned_date = $_POST['planned_date'] ?? '';
$title = trim($_POST['title'] ?? '');
$meal_type = $_POST['meal_type'] ?? '';
$calories = $_POST['calories'] ?? null;
$protein_g = $_POST['protein_g'] ?? null;
$carbs_g   = $_POST['carbs_g'] ?? null;
$fats_g    = $_POST['fats_g'] ?? null;

// validates required fields
if ($planned_date === '' || $title === '' || $meal_type === '') {
    header("Location: " . BASE_URL . "/planner/planner.php?error=missing_meal_fields");
    exit;
}

$cal_int   = ($calories === '' || $calories === null) ? null : (int)$calories;
$prot_int  = ($protein_g === '' || $protein_g === null) ? null : (int)$protein_g;
$carb_int  = ($carbs_g === '' || $carbs_g === null) ? null : (int)$carbs_g;
$fats_int  = ($fats_g === '' || $fats_g === null) ? null : (int)$fats_g;

$stmt = mysqli_prepare($con, "INSERT INTO meals (user_id, planned_date, meal_type, title, calories, protein_g, carbs_g, fats_g) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

mysqli_stmt_bind_param($stmt, "isssiiii", $user_id, $planned_date, $meal_type, $title, $cal_int, $prot_int, $carb_int, $fats_int);

// Execute insert
mysqli_stmt_execute($stmt);

//  Redirect back so user sees the new meal
header("Location: " . BASE_URL . "/planner/planner.php?success=meal_added");
exit;