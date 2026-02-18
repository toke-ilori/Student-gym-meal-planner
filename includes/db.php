<?php
$hostname = "127.0.0.1";
$username = "root";
$password = "root";
$dbname = "Student_gym_meal_planner";
$port = 8889;

$con = mysqli_connect($hostname, $username, $password, $dbname, $port);

if (!$con) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}
?>
