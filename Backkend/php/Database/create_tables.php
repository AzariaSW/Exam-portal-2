<?php

$conn = new mysqli("localhost", "root", "", "exam_portal");

$sql = "CREATE TABLE quizzes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    description TEXT,
    time_limit INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE questions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    quiz_id INT,
    question TEXT,
    option_a VARCHAR(255),
    option_b VARCHAR(255),
    option_c VARCHAR(255),
    option_d VARCHAR(255),
    correct_answer VARCHAR(1),
    FOREIGN KEY (quiz_id) REFERENCES quizzes(id)
);

CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100),
    status VARCHAR(20) DEFAULT 'pending'
<<<<<<< HEAD:Backkend/php/Database/create_tables.php
);";

if ($conn->query($sql) === TRUE) {
    echo "Table created successfully";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();

?>
=======
);
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('student','teacher','admin') NOT NULL,
    approved TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    time_limit INT,
    max_attempts INT,
    passing_score INT,
    randomize_questions BOOLEAN,
    show_result_immediately BOOLEAN
);

INSERT INTO settings 
(time_limit, max_attempts, passing_score, randomize_questions, show_result_immediately)
VALUES (30, 2, 50, 1, 1);
>>>>>>> 7fa295f5857c948ea27fa1a27c6e525caf4320b5:php/Database/Exam_portal.sql
