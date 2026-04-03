<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Management System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<!-- Navigation -->
<nav>
    <ul>
        <li><a href="#finance">Finance Portal</a></li>
        <li><a href="#library">Library</a></li>
        <li><a href="#production">Production Unit</a></li>
        <li><a href="#stores">Stores Portal</a></li>
    </ul>
</nav>

<!-- Carousel -->
<div class="carousel">
    <!-- Placeholder for 75 images -->
    <?php for ($i = 1; $i <= 75; $i++): ?>
        <div class="carousel-item">
            <img src="images/image<?php echo $i; ?>.jpg" alt="Image <?php echo $i; ?>">
        </div>
    <?php endfor; ?>
</div>

<!-- Student Login Form -->
<section id="login">
    <h2>Student Login</h2>
    <form action="login.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        
        <button type="submit">Login</button>
    </form>
</section>

<!-- Mission and Vision -->
<section id="mission-vision">
    <div class="card">
        <h3>Our Mission</h3>
        <p>[Your mission statement here]</p>
    </div>
    <div class="card">
        <h3>Our Vision</h3>
        <p>[Your vision statement here]</p>
    </div>
</section>

<!-- Social Media Links -->
<section id="social-media">
    <h2>Follow Us</h2>
    <a href="https://facebook.com" target="_blank">Facebook</a>
    <a href="https://twitter.com" target="_blank">Twitter</a>
    <a href="https://linkedin.com" target="_blank">LinkedIn</a>
</section>

<!-- Footer -->
<footer>
    <p>&copy; <?php echo date("Y"); ?> School Management System. All Rights Reserved.</p>
</footer>

</body>
</html>