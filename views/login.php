<?php
require_once '../controllers/USER.php';

$error = '';
$controller = new UserController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    $name = $_POST['username'] ?? '';  // Changed to match the form field name
    $password = $_POST['password'] ?? '';

    // Handle login action
    if ($action === 'login') {
        $error = $controller->handleLogin($name, $password);
    } elseif ($action === 'signup') {
        $email = $_POST['email'] ?? '';
        $error = $controller->handleSignup($name, $email, $password);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign In</title>
    <link rel="stylesheet" href="../assets/css/login.css" />
    <!-- Toastify for notifications -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
</head>
<body>
    <!-- Background Video -->
    <video autoplay muted loop id="background-video">
        <source src="../assets/vedios/KSLV - Override (BMW M8 Gran Coupe) 4K EDIT (1080p).mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <!-- Form Container -->
    <div class="container">
        <div class="header">
            <h2>Log In</h2>
        </div>
        <form id="form" class="form" method="POST" action="login.php">
            <input type="hidden" name="action" value="login"> <!-- Hidden input for action -->
            
            <!-- Username field -->
            <div class="form-control">
                <label for="username">Username</label>
                <input type="text" name="username" placeholder="Please enter your username" id="username" required />
            </div>
            
            <!-- Password field -->
            <div class="form-control">
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Password" id="password" required />
            </div>

            <!-- Displaying error message if there was an issue -->
            <?php if ($error): ?>
                <div class="error-message">
                    <p><?php echo htmlspecialchars($error); ?></p>
                </div>
            <?php endif; ?>

            <!-- Link to signup page -->
            <a href="signup.php">Don't have an account?</a>

            <!-- Submit Button -->
            <button type="submit">Log In</button>
        </form>
    </div>

    <!-- Toast notifications for login or signup errors -->
    <script>
        <?php if ($error): ?>
            Toastify({
                text: "<?php echo htmlspecialchars($error); ?>",
                backgroundColor: "linear-gradient(to right, #ff5f6d, #ffc3a0)",
                close: true
            }).showToast();
        <?php endif; ?>
    </script>
</body>
</html>
