<?php
header('Content-Type: application/json');
$path = __DIR__ . '/../data/results.json';
if (!file_exists(dirname($path))) {
    @mkdir(dirname($path), 0755, true);
}

$data = json_decode(file_get_contents('php://input'), true);
if (!$data) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid payload']);
    exit;
}

$all = [];
if (file_exists($path)) {
    $current = json_decode(file_get_contents($path), true);
    if (is_array($current)) $all = $current;
}
$all[] = $data;
file_put_contents($path, json_encode($all, JSON_PRETTY_PRINT));

echo json_encode(['status' => 'success', 'saved' => $data]);
