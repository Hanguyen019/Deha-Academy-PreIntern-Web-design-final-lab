<?php
include_once "./user.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = User::login($email, $password);
    if ($user) {
        session_start();
        $_SESSION['user'] = $user;
        header("Location: index.php");
    } else {
        $error = "no login.";
    }
}
?>

<!DOCTYPE html>
<html >
<head>
    <title>Login</title>
</head>
<body>
    <form method="POST">
        <h1>Login</h1>
        <label>Email:</label>
        <input type="email" name="email" required>
        <label>Password:</label>
        <input type="password" name="password" required>
        <button type="submit">Login</button>
    </form>
    <?php if (isset($error)) { echo "<p>$error</p>"; } ?>
</body>
</html>
