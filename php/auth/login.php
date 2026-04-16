<?php
session_start();

$users = [
    "student@test.com" => ["password" => "123456", "role" => "student"],
    "teacher@test.com" => ["password" => "123456", "role" => "teacher"],
    "admin@test.com"   => ["password" => "admin123", "role" => "admin"]
];

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["email"];
    $password = $_POST["password"];
    $role = $_POST["role"];

    if (isset($users[$email])) {

        if ($users[$email]["password"] === $password && $users[$email]["role"] === $role) {

            $_SESSION["user"] = $email;
            $_SESSION["role"] = $role;

            if ($role == "student") {
                header("Location: student_dashboard.php");
            } elseif ($role == "teacher") {
                header("Location: teacher_dashboard.php");
            } else {
                header("Location: admin_dashboard.php");
            }
            exit();

        } else {
            $error = "Invalid password or role!";
        }

    } else {
        $error = "User not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>

<style>
body {
    font-family: Arial;
    background: #f2f2f2;
    text-align: center;
}

.container {
    width: 300px;
    margin: 100px auto;
    padding: 20px;
    background: white;
    border-radius: 8px;
}

input, select {
    width: 100%;
    padding: 8px;
    margin: 10px 0;
}

button {
    padding: 10px;
    width: 100%;
    background: #007bff;
    color: white;
    border: none;
}

.error {
    color: red;
}
</style>

</head>
<body>

<div class="container">
<h2>Login</h2>

<form method="POST">

<label>Email</label>
<input type="email" name="email" required>

<label>Password</label>
<input type="password" name="password" required>

<label>Role</label>
<select name="role">
<option value="student">Student</option>
<option value="teacher">Teacher</option>
<option value="admin">Admin</option>
</select>

<button type="submit">Login</button>

</form>

<p style="color:red;">
<?php echo $error; ?>
</p>

</div>

</body>
</html>
