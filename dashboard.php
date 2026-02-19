<?php
// homepage after login 
require_once __DIR__ . '/includes/auth_check.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h2>
        Welcome,
        <?php
        echo htmlspecialchars($_SESSION['name']);
        ?>
        👋🏾
    </h2>

    <ul>
        <!-- link to planner page -->
        <a href="<?php echo BASE_URL; ?>/planner/planner.php">
            Open planner
        </a>
        </li>
        <!-- link to logout page -->
        <li>
            <a href="<?php echo BASE_URL; ?>/logout.php">
                logout
            </a>
        </li>
    </ul>
</body>
</html>


