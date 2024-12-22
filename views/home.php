<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Dealership</title>
    <!-- Link to the external CSS file in the css folder -->
    <link rel="stylesheet" href="../assets/css/home.css">
</head>
<body>

    <!-- Background Video -->
    <video autoplay muted loop id="background-video">
        <!-- Correct video source with relative path -->
        <source src="../assets/vedios/mclaren-1.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <!-- Content over the background video -->
    <div class="content">
        <h1>Welcome to the House of Motors</h1>
    
        <!-- Button that redirects to the signup page -->
        <a href="signup.php">
            <button class="btn-signup">Sign Up</button>
        </a>

        <!-- Link for users who already have an account -->
        <p><a href="login.php" class="btn-login">Already have an account? Login</a></p>
    </div>

</body>
</html>
