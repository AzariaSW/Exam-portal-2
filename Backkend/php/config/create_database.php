<?php

$host = "localhost";
$user = "root";
$password = "";

$conn = new mysqli($host, $user, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE DATABASE exam_portal";

if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();

?>