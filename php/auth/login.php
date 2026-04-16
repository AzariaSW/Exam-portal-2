<?php
session_start();
require 'config/db.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["email"];
    $password = $_POST["password"];
    $role = $_POST["role"];

    // prepare query
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email AND role = :role");
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":role", $role);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {

        // verify password
        if (password_verify($password, $user["password"])) {

            $_SESSION["user"] = $user["email"];
            $_SESSION["role"] = $user["role"];

            // redirect based on role
            if ($role == "student") {
                header("Location: student_dashboard.php");
            } elseif ($role == "teacher") {
                header("Location: teacher_dashboard.php");
            } else {
                header("Location: admin_dashboard.php");
            }
            exit();

        } else {
            $error = "Invalid password!";
        }

    } else {
        $error = "User not found!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>
</head>
<body>

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

<p style="color:red;"><?php echo $error; ?></p>

</body>
</html>
