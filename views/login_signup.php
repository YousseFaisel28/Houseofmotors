<?php
require_once '../controllers/USER.php';

$error = '';
$controller = new UserController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($action === 'login') {
        $error = $controller->handleLogin($email, $password);
    } elseif ($action === 'signup') {
        $error = $controller->handleSignup($name, $email, $password);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Signup</title>
</head>
<body>

    <h2>Login</h2>
    <form action="login_signup.php" method="POST">
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit" name="action" value="login">Login</button>
    </form>
    
    <h2>Sign Up</h2>
    <form action="login_signup.php" method="POST">
        <input type="text" name="name" placeholder="Full Name" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit" name="action" value="signup">Sign Up</button>
    </form>

    <?php if ($error) { echo "<p style='color: red;'>$error</p>"; } ?>

</body>
</html>
