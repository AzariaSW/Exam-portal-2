<?php

require_once __DIR__ . '/../config/db.php';

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    echo json_encode([
        "success" => false,
        "message" => "Invalid request method"
    ]);
    exit;
}

try {
    $sql = "SELECT id, name, email, role, approved, created_at FROM users";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        "success" => true,
        "data" => $users
    ]);

} catch (PDOException $e) {
    echo json_encode([
        "success" => false,
        "message" => "Database query failed",
        "error" => $e->getMessage()
    ]);
}