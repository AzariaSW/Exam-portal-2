<?php

header("Content-Type: application/json");

require_once "../config/db.php";
try{
$sql = "SELECT id, name, email, approved 
        FROM users 
        WHERE role= :role";

$stmt = $conn->prepare($sql);
    $stmt->execute(['role' => 'student']);
 $students = $stmt->fetchAll(PDO::FETCH_ASSOC);




echo json_encode([
    "status" => "success",
    "students" => $students
]);
} catch (PDOException $e) {
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
}
?>
