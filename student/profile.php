<?php
require '../php/config/db.php';

$stmt = $conn->query("SELECT * FROM users LIMIT 1");
$user = $stmt->fetch();
?>

<!DOCTYPE html>
<html>
<head>
<title>Profile</title>

<link rel="stylesheet" href="../css/style.css">
</head>

<body>

<header>
  <h2>Exam Portal</h2>
  <a href="dashboard.php">⬅ Back</a>
</header>

<div class="container">

  <div class="profile-box">

    <h2>My Profile</h2>

    <p><strong>Name:</strong> <?php echo $user['name']; ?></p>
    <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
    <p><strong>Role:</strong> <?php echo $user['role']; ?></p>

  </div>

</div>

</body>
</html>