<?php
//lets user create an account, takes in: name, email, password, saves user into datbase 
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/db.php';

//stores error message
$error = '';

//checks if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    // ?? '' means if the value doesnt exist, use the empty string instead
    $name = trim($_POST['name'] ?? '' );
    $email = trim($_POST['email'] ?? '' );
    $password = $_POST['password'] ?? '';

    // validation 
    if ($name === '' || $email === '' || $password === '') {
        $error = "All fields are required.";

    //checks if the email format is correct 
    }else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $error = "Please enter a valid email.";

    } else {
        // SQL statement to check if emial already exits
        $stmt = mysqli_prepare($con, "SELECT id FROM users WHERE email = ?");
        // "s" parameter is a string 
        mysqli_stmt_bind_param($stmt, "s", $email);
        // execute query 
        mysqli_stmt_execute($stmt);
        // gets result from executed query
        $result = mysqli_stmt_get_result($stmt);
        // if somethinmg is returned, the email alreadt exists
        if(mysqli_fetch_assoc($result)) {
            $error = "Email already registered.";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = mysqli_prepare(
                $con,
                "INSERT INTO users (name, email, password_hash) VALUES (?, ?, ?)");
            // binds the values into the query
            mysqli_stmt_bind_param($stmt, "sss", $name, $email, $hash);
            if(mysqli_stmt_execute($stmt)) {
                //if successful, redirects to login page 
                header("Location: " . BASE_URL . "/auth/login.php");
                exit;
            } else {
                //if fails, show the mysql error
                $error = "Registration failed: " . mysql_error($con);
            }
        }

    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">
</head>
<body>
    <h2>Registration</h2>
    <!-- shows error messgages in red -->
    <?php if ($error) echo "<p style='color:red;'>$error</p>"; ?>

    <form method="POST">
        <input name="name" placeholder="Name" required><br>
        <input name="email" placeholder="Email" required><br>
        <input name="password" type="password" placeholder="Password" required><br>
        <button type="submit">Create account</button>
    </form>

    <p>
        Already have an account?
        <a href="<?php echo BASE_URL; ?>/auth/login.php">Login</a>
    </p>
</body>
</html>


