<?php
header("Content-Type: application/json");
require_once "../config/db.php";

try {
$sql = "SELECT * FROM results ORDER BY date DESC";
$stmt = $conn->prepare($sql);
    $stmt->execute();

$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode([
    "status" => "success",
    "data" => $data
]);

} catch (PDOException $e) {
echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]); }
?>
