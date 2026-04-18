<?php

require_once "../config/db.php";
if (isset($_POST['id']) && isset($_POST['action'])) {

    $id = $_POST['id'];
    $action = $_POST['action'];

    if ($action == "approve") {
        $approved = 1;
    } else {
        $approved = 0;
    }
    $stmt = $pdo->prepare("UPDATE users SET approved = :approved WHERE id = :id");

    $stmt->execute([
        ':approved' => $approved,
        ':id' => $id
    ]);
}
// GET STUDENTS 
$stmt = $pdo->query("SELECT * FROM users WHERE role='student'");
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>

<head>
<title>Approve Students</title>
</head>

<body>
<h2>Student Management</h2>
<table border="1" cellpadding="10">
<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Status</th>
<th>Action</th>
</tr>
<?php foreach ($students as $student): ?>
<tr>
<td><?= $student['id'] ?></td>
<td><?= $student['name'] ?></td>
<td><?= $student['email'] ?></td>
<td>
<?= $student['approved'] ? "Approved" : "Blocked" ?>
</td>
<td>
<form method="POST" style="display:inline;">
<input type="hidden" name="id" value="<?= $student['id'] ?>">
<input type="hidden" name="action" value="approve">
<button type="submit">Approve</button>
</form>
<form method="POST" style="display:inline;">
<input type="hidden" name="id" value="<?= $student['id'] ?>">
<input type="hidden" name="action" value="block">
<button type="submit">Block</button>
</form>
</td>
</tr>
<?php endforeach; ?>
</table>
</body>
</html>
