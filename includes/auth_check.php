<?php
// Purpose: checks if the user is logged in, if not send back to login page. 
require_once __DIR__ . '/config.php';

if(!isset($_SESSION['user_id'])){
    header("Location: " . BASE_URL . "/auth/login.php");
    exit;
}