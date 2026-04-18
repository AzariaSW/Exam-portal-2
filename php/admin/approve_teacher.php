<?php

require_once "../config/db.php";

// APPROVE TEACHER 

if (isset($_GET['approve'])) {

    $teacher_id = $_GET['approve'];

    $stmt = $pdo->prepare("UPDATE teachers SET status = 'approved' WHERE id = :id");

    $stmt->execute([
        ':id' => $teacher_id
    ]);
}

// GET PENDING TEACHERS 

$stmt = $pdo->prepare("SELECT * FROM teachers WHERE status = 'pending'");
$stmt->execute();

$teachers = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>

<head>
<title>Approve Teachers</title>
</head>

<body>

<h2>Pending Teacher Approvals</h2>

<table border="1" cellpadding="10">

<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Action</th>
</tr>

<?php foreach ($teachers as $row): ?>

<tr>

<td><?= $row['id'] ?></td>
<td><?= $row['name'] ?></td>
<td><?= $row['email'] ?></td>

<td>
<a href="?approve=<?= $row['id'] ?>">
Approve
</a>
</td>

</tr>

<?php endforeach; ?>

</table>

</body>
</html>
