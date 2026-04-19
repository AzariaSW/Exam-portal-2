<?php
require '../php/config/db.php';

$stmt = $conn->query("SELECT * FROM users LIMIT 1");
$user = $stmt->fetch();

$name = $user['name'] ?? "Student";
$id = $user['id'] ?? "N/A";
?>
<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>

<link rel="stylesheet" href="../css/style.css">
</head>

<body>

<header>
  <h2>Exam Portal</h2>
  <div>
    <a href="dashboard.php">Dashboard</a>
    <a href="profile.php">Profile</a>
  </div>
</header>

<div class="hero">
  <h1>Welcome, <?php echo $name; ?> 👋</h1>
  <p>Student ID: <?php echo $id; ?></p>
</div>

<div class="container">

  <h2>Dashboard Actions</h2>

  <div class="features">

    <div class="feature-box">
      <h3>📝 Take Quiz</h3>
      <p>Start your exam</p>
    </div>

    <div class="feature-box">
      <h3>📊 Results</h3>
      <p>View your performance</p>
    </div>

    <div class="feature-box">
      <h3>👤 Profile</h3>
      <p>Check your details</p>
    </div>

  </div>

</div>

</body>
</html>