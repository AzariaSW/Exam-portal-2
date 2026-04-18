<?php
include "../config/db.php";

$stmt = $conn->query("SELECT * FROM settings LIMIT 1");
$s = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Quiz Settings</title>
</head>
<body>

<h2>Quiz Settings</h2>

<?php if(isset($_GET['success'])) { ?>
    <p style="color:green;">Settings saved successfully!</p>
<?php } ?>

<form method="POST" action="save_settings.php">

    <label>Time Limit (minutes):</label><br>
    <input type="number" name="time_limit" value="<?= $s['time_limit'] ?>" required>
    <br><br>

    <label>Maximum Attempts:</label><br>
    <input type="number" name="max_attempts" value="<?= $s['max_attempts'] ?>" required>
    <br><br>

    <label>Passing Score (%):</label><br>
    <input type="number" name="passing_score" value="<?= $s['passing_score'] ?>" required>
    <br><br>

    <label>Randomize Questions:</label><br>
    <input type="radio" name="randomize" value="1" <?= $s['randomize_questions'] ? 'checked' : '' ?>> Yes
    <input type="radio" name="randomize" value="0" <?= !$s['randomize_questions'] ? 'checked' : '' ?>> No
    <br><br>

    <label>Show Results Immediately:</label><br>
    <input type="radio" name="show_result" value="1" <?= $s['show_result_immediately'] ? 'checked' : '' ?>> Yes
    <input type="radio" name="show_result" value="0" <?= !$s['show_result_immediately'] ? 'checked' : '' ?>> No
    <br><br>

    <button type="submit">Save Settings</button>

</form>

</body>
</html>