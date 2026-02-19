<?php
// plans user workouts and meals 
// would probably add calorie total and add weekly view as an uprade
require_once __DIR__ . '/../includes/auth_check.php';
require_once __DIR__ . '/../includes/db.php';

$user_id = (int)$_SESSION['user_id'];

$workouts = [];
$meals = [];

// fetch workouts
$stmt = mysqli_prepare($con, "SELECT * FROM workouts WHERE user_id = ? ORDER BY planned_date DESC");
mysqli_stmt_bind_param($stmt, "i", $user_id);
// run the query
mysqli_stmt_execute($stmt);
//get the result set 
$res = mysqli_stmt_get_result($stmt);
// add each workout into the $workouts array
while ($row = mysqli_fetch_assoc($res)){
    $workouts[] = $row;
}

// fetch meals 
$stmt = mysqli_prepare(
    $con,
    "SELECT * FROM meals WHERE user_id = ? ORDER BY planned_date DESC"
);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);

while ($row = mysqli_fetch_assoc($res)){
    $meal[] = $row;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Planner</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">
</head>
<body>
    <div class="container">

    <?php if (isset($_GET['success'])): ?>
        <div class="alert success">
            <?php echo htmlspecialchars($_GET['success']); ?> ✅
    </div>
    <?php endif; ?>

    <?php if (isset($_GET['error'])): ?>
        <div class="alert error">
            Please fill in all required fields ❌
    </div>
    <?php endif; ?>
    <div class="card">

<h2>Planner</h2>
<p>
    <a href="<?php echo BASE_URL; ?>/dashboard.php">
        Back to Dashboard
    </a>
</p>

<!-- Add workout form -->
<h3>Add Workout</h3>
<!-- This form sends data to add_workout.php -->
<form method="POST" action="<?php echo BASE_URL; ?>/planner/add_workout.php">

    <!-- Date of workout -->
     <input type="date" name="planned_date" required>
    <!-- Date of title -->
     <input type="text" name= "title" placeholder="workout title" required>
    <!-- Duration (optional) -->
     <input type="number" name="duration_minutes" placeholder="Minutes">
    <!-- notes-->
     <textarea name="notes" placeholder="Workout notes (optional)"></textarea>
    <button type="submit">Add</button>
</form>

<!-- Add meal form-->
<h3>Add Meal</h3>
<!-- This form sends data to add_meal.php -->
<form method="POST" action="<?php echo BASE_URL; ?>/planner/add_meal.php">

    <!-- Date of meal -->
     <input type="date" name="planned_date" required>

    <!-- Meal name -->
     <input type="text" name="text" placeholder="Meal title" required>
    
    <!-- Meal type-->
     <select name="meal_type" required>
        <option value="breakfast">breakfast</option>
        <option value="lunch">lunch</option>
        <option value="dinner">dinner</option>
        <option value="snack">snack</option>
    </select>

    <!-- cals and macros-->
     <input type="number" name="calories" placeholder="Calories">
     <input type="number" name="protein_g" placeholder="Protein (g)">
     <input type="number" name="carbs_g" placeholder="Carbs (g)">
     <input type="number" name="fats_g" placeholder="Fats (g)">

     <button type="submit">Add</button>
</form>

<hr>


<!-- display workout-->
<h3> Your Workouts</h3>

<ul>
<?php foreach ($workouts as $w): ?>
    <li>
        <?php echo htmlspecialchars($w['planned_date'] . " - " . $w['title']);?>
        <a href="<?php echo BASE_URL; ?>/planner/delete_item.php?type=workout&id=<?php echo (int)$w['id']; ?>">
             Delete
        </a>
    </li>
<?php endforeach; ?>
</ul>

<!-- display meals-->
 <h3>Your Meals</h3>

<ul>
<?php foreach ($meals as $m): ?>
    <li>

        <?php echo htmlspecialchars($m['planned_date'] . " - " . $m['meal_type'] . " - " . $m['title']); ?>
        <a href="<?php echo BASE_URL; ?>/planner/delete_item.php?type=meal&id=<?php echo (int)$m['id']; ?>">
             Delete
        </a>
    </li>
<?php endforeach; ?>
</ul>
    </div>
    </div>
</body>
</html>


