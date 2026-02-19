<?php
// lets user log in, checks if email + password matches, if correct -> create sessiona nd send user to dashboard 
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/db.php';

// stores error message
$error = '';

//checks if the form was submitted 
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    // gets the email and password from the form
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    //sql query to find the user by email
    $stmt = mysqli_prepare($con, "SELECT id, name, password_hash FROM users WHERE email = ?");

    mysqli_stmt_bind_param($stmt, "s", $email);
    //execute the query
    mysqli_stmt_execute($stmt);
    //get the result of the query
    $result = mysqli_stmt_get_result($stmt);
    // fetch if it exists
    $user = mysqli_fetch_assoc($result);

    // if no user was foundf or password does not match, login fails
    if(!$user || !password_verify($password, $user['password_hash'])) {
        $error = "invalid email or password.";
    } else {
        session_regenerate_id(true);
        $_SESSION['user_id'] = (int)$user['id'];
        $_SESSION['name'] = $user['name'];

        // redirect to dashboard 
        header("Location: " . BASE_URL . "/dashboard.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Login</title></head>
<body>
    <h2>Login</h2>
    <!-- shows error message in red -->
    <?php if($error) echo "<p style = 'color:red;'>$error</p>"; ?>

    <form method="POST">
        <input name="email" placeholder="Email" required><br>
        <input name="password" type="password" placeholder="Password" required><br>
        <button type="submit">Login</button>
    </form>
    <p>
        No account?
        <a href="<?php echo BASE_URL; ?>/auth/register.php">Register</a>
    </p>
</body>
</html>
