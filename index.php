<?php
// checks if user is logged in
require_once __DIR__ . '/includes/config.php';

if (isset($_SESSION['user_id'])){
  header("Location: " . BASE_URL . "/dashboard.php");
  exit;
}
header("Location: " . BASE_URL . "/auth/login.php");
exit;