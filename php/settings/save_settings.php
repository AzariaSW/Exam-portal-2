<?php
include "../config/db.php";

$time_limit = $_POST['time_limit'];
$max_attempts = $_POST['max_attempts'];
$passing_score = $_POST['passing_score'];
$randomize = $_POST['randomize'];
$show_result = $_POST['show_result'];

$sql = "UPDATE settings SET
    time_limit = :time_limit,
    max_attempts = :max_attempts,
    passing_score = :passing_score,
    randomize_questions = :randomize,
    show_result_immediately = :show_result
    WHERE id = 1";

 try {
 $stmt = $conn->prepare($sql);

$stmt->execute([
    ':time_limit' => $time_limit,
    ':max_attempts' => $max_attempts,
    ':passing_score' => $passing_score,
    ':randomize' => $randomize,
    ':show_result' => $show_result
]);

    header("Location: settings.php?success=1");
    exit();
} catch (PDOException $e) {
    echo "Database Error: " . $e->getMessage();
}

?>