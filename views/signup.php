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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign Up</title>
    <!-- Toastify for notifications -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <link rel="stylesheet" href="../assets/css/signup.css" />
</head>
<body>

    <!-- Background Video -->
    <video autoplay muted loop id="background-video">
        <source src="../assets/vedios/trailer-2.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <!-- Form Container -->
    <div class="container">
        <div class="header">
            <h2>Create Account</h2>
        </div>
        <form id="form" class="form" method="post" action="signup.php">
            <div class="form-control">
                <label for="name">Name</label>
                <input type="text" name="name" placeholder="Please enter name" id="name" required />
            </div>
            <div class="form-control">
                <label for="username">Username</label>
                <input type="text" name="username" placeholder="Please enter username" id="username" required />
            </div>
            <div class="form-control">
                <label for="email">Email</label>
                <input type="email" name="email" placeholder="Please enter a valid email" id="email" required />
            </div>
            <div class="form-control">
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Password" id="password" required />
            </div>
            <div class="form-control">
                <label for="password2">Confirm Password</label>
                <input type="password" name="password2" placeholder="Confirm Password" id="password2" required />
            </div>

            <!-- Hidden input to send action as 'signup' -->
            <input type="hidden" name="action" value="signup" />

            <a href="login.php">Already have an account?</a>
            <button type="submit">Submit</button>
        </form>
    </div>

</body>
</html>
