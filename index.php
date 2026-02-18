<?php
require_once __DIR__ . '/includes/db.php';

// Insert a test user (password is hashed properly)
$name = "Test User";
$email = "test@example.com";
$password = password_hash("password123", PASSWORD_DEFAULT);

$stmt = mysqli_prepare($con, "INSERT INTO users (name, email, password_hash) VALUES (?, ?, ?)");
mysqli_stmt_bind_param($stmt, "sss", $name, $email, $password);

if (mysqli_stmt_execute($stmt)) {
    echo "Inserted a test user ✅";
} else {
    echo "Insert failed: " . mysqli_error($con);
}

