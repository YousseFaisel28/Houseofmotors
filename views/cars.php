<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Brands</title>
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/css/cars.css">
    <link rel="stylesheet" href='../assets/cssnavbar.css'>
</head>
<body>
<?php include('../includes/navbar.php'); ?>

    <!-- Brand Slideshow -->
    <div class="brand-container">
        <h1>Explore Our Car Brands</h1>
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <!-- Lamborghini -->
                <div class="swiper-slide">
                    <a href="lamborghini.php">
                        <img src="../assets/carimages/images (1).png" alt="Lamborghini">
                        <p>Lamborghini</p>
                    </a>
                </div>
                <!-- Range Rover -->
                <div class="swiper-slide">
                    <a href="rangerover.php">
                        <img src="../assets/carimages/images.jpeg" alt="Range Rover">
                        <p>Range Rover</p>
                    </a>
                </div>
                <div class="swiper-slide">
    <a href="mercedes.php">
        <!-- Replace the image source below with your new image path -->
        <img src="../assets/carimages/c7e923e85e72be1bfcdf0891077b5a74.jpg" alt="Mercedes">
        <p>Mercedes</p>
    </a>
</div>


                <!-- BMW -->
                <div class="swiper-slide">
                    <a href="bmw.php">
                        <img src="../assets/carimages/images.png" alt="BMW">
                        <p>BMW</p>
                    </a>
                </div>
                <!-- McLaren -->
                <div class="swiper-slide">
                    <a href="mclaren.php">
                        <img src="../assets/carimages/download (1).png" alt="McLaren">
                        <p>McLaren</p>
                    </a>
                </div>
            </div>
            <!-- Navigation buttons -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <p><strong>About Us</strong></p>
            <p>Welcome to House of Motors, where we provide the best cars and car parts for our customers.</p>
            <p><strong>Contact Us:</strong></p>
            <p>Email: <a href="mailto:houseofmotors@gmail.com">houseofmotors@gmail.com</a></p>
            <p>Phone: +201017057756</p>
        </div>
    </footer>

    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        const swiper = new Swiper('.swiper-container', {
            loop: true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            slidesPerView: 1, /* Show one slide at a time */
            centeredSlides: true, /* Center the slide */
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
        });
        

    </script>
</body>
</html>
