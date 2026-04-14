<?php
session_start();
require '../config/db.php'; 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $role = $_POST['role'];
    if (!$name || !$email || !$password) {
        echo json_encode(['error' => 'Please fill all fields']);
        exit;
    }

    if (strlen($password) < 6) {
        echo json_encode(['error' => 'Password must be at least 6 characters']);
        exit;
    }

    try {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);

        if ($stmt->rowCount() > 0) {
            echo json_encode(['error' => 'Email already registered']);
            exit;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO users (name, email, password, role, approved) VALUES (?, ?, ?, ?, ?)");

        $approved = ($role === 'student') ? 0 : 1; 

        if ($stmt->execute([$name, $email, $hashedPassword, $role, $approved])) {
            echo json_encode(['success' => 'Account created']);
        } else {
            echo json_encode(['error' => 'Signup failed']);
        }

    } catch (PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
}