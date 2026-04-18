<?php
include "../config/db.php";

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    try {
        $stmt = $conn->prepare("DELETE FROM users WHERE id = :id");
        $stmt->execute([':id' => $id]);

        header("Location: get_users.php?deleted=1");
        exit();

    } catch (PDOException $e) {
        echo "Error deleting user: " . $e->getMessage();
    }

} else {
    echo "No user ID provided!";
}
?>