<?php
// Start session and load header
session_start();
require_once "includes/header.php";
?>

<!-- HERO SECTION - main banner at the top of the page -->
<div class="p-5 mb-4 bg-white rounded-3 shadow-sm">

    <div class="container py-4">

        <!-- Main heading -->
        <h1 class="display-5 fw-bold">
            Professional Web Services Platform
        </h1>

        <!-- Short description -->
        <p class="col-md-8 fs-5 text-muted mt-3">
            We provide modern web-based services, user account management,
            and interactive tools for clients and visitors.
            Our platform is built with security, performance, and usability in mind.
        </p>

        <div class="mt-4">

            <!-- Button to services page -->
            <a href="services.php" class="btn btn-primary btn-lg me-2">
                Explore Services
            </a>

            <!-- Show register button if not logged in, contact button if logged in -->
            <?php if (!isset($_SESSION["username"])): ?>
                <a href="register.php" class="btn btn-success btn-lg">
                    Create Account
                </a>
            <?php else: ?>
                <a href="contact.php" class="btn btn-outline-dark btn-lg">
                    Contact Us
                </a>
            <?php endif; ?>

        </div>

    </div>

</div>

<!-- FEATURES - three info cards -->
<div class="row g-4">

    <!-- Card 1 - Web Services -->
    <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0">
            <div class="card-body">
                <h4 class="card-title">Web Services</h4>
                <p class="card-text text-muted">
                    Browse available services stored in the database.
                    Each service contains detailed information and images.
                </p>
            </div>
        </div>
    </div>

    <!-- Card 2 - Secure Accounts -->
    <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0">
            <div class="card-body">
                <h4 class="card-title">Secure Accounts</h4>
                <p class="card-text text-muted">
                    Users can register, log in, and manage their account securely.
                    Passwords are encrypted and protected.
                </p>
            </div>
        </div>
    </div>

    <!-- Card 3 - Contact System -->
    <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0">
            <div class="card-body">
                <h4 class="card-title">Contact System</h4>
                <p class="card-text text-muted">
                    Send messages directly through our contact form.
                    All messages are stored securely in the database.
                </p>
            </div>
        </div>
    </div>

</div>

<!-- CALL TO ACTION - dark banner at the bottom -->
<div class="mt-5 p-5 bg-dark text-white rounded-3 text-center shadow">

    <!-- Section heading -->
    <h2 class="fw-bold">
        Ready to get started?
    </h2>

    <!-- Section description -->
    <p class="mt-2 text-light">
        Join our platform and explore modern web functionality today.
    </p>

    <!-- Show login button if not logged in, services button if logged in -->
    <?php if (!isset($_SESSION["username"])): ?>
        <a href="login.php" class="btn btn-light btn-lg mt-3">
            Login Now
        </a>
    <?php else: ?>
        <a href="services.php" class="btn btn-light btn-lg mt-3">
            Go to Services
        </a>
    <?php endif; ?>

</div>

<!-- Load footer -->
<?php require_once "includes/footer.php"; ?>