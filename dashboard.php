<?php
// homepage after login 
require_once __DIR__ . '/includes/auth_check.php';
// Motivational quotes array
$quotes = [
    "Consistency beats intensity every time.",
    "Your only competition is who you were yesterday.",
    "Discipline is choosing what you want most over what you want now.",
    "Small progress is still progress.",
    "Fuel your body. Train your mind.",
    "Strong habits create strong results.",
    "You don't have to be extreme. Just consistent."];

// Pick a random quote
$randomQuote = $quotes[array_rand($quotes)];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">

</head>
<body>
    <div class="card">
    <h2>
        Welcome,
        <?php echo htmlspecialchars($_SESSION['name']);?> 👋🏾
    </h2>

    <p>
        This is your personal Student Gym & Meal Planner.
        Here you can track your workouts, plan your meals,
        and stay consitent with your fitness goals.
    </p>

    <div class="quote-box">
        <p class="quote">
         “<?php echo htmlspecialchars($randomQuote); ?>”
        </p>
    </div>

    <h3> What would you like to do today?</h3>

    <ul class="dashboard-links">
        <li>
        <a class="btn" href="<?php echo BASE_URL; ?>/planner/planner.php">
                🏋🏾 Open Planner
            </a>
        </li>

        <li>
            <a class="btn secondary" href="<?php echo BASE_URL; ?>/logout.php">
                🚪 Logout
            </a>
        </li>
    </ul>

</div>

</body>
</html>
