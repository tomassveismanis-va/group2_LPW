<?php
// Start a session only if one isn't already running
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Makes the page responsive on mobile devices -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebProject Services</title>

    <!-- Load Bootstrap CSS for styling and layout -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            /* Page takes up at least full screen height */
            min-height: 100vh;
            display: flex;
            /* Stack elements vertically */
            flex-direction: column;
            /* Light grey background */
            background-color: #f8f9fa;
        }

        /* Main content grows to fill available space, pushes footer down */
        main { flex: 1; }

        .card img {
            /* Fixed image height in cards */
            height: 220px;
            /* Image fills space without stretching */
            object-fit: cover;
        }
    </style>
</head>

<body>

<!-- Top navigation bar with dark background -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">

        <!-- Website logo/name that links to homepage -->
        <a class="navbar-brand" href="index.php">
            WebProject Services
        </a>

        <!-- Hamburger button - appears on mobile instead of full nav -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation links - collapse on mobile -->
        <div class="collapse navbar-collapse" id="navbarNav">

            <!-- ms-auto pushes all links to the right side -->
            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="services.php">Services</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="about.php">About</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>

                <!-- Show these links only if user is logged in -->
                <?php if (isset($_SESSION["username"])): ?>

                    <!-- Show dashboard and messages only if user is admin -->
                    <?php if (($_SESSION["role"] ?? "") === "admin"): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard.php">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="messages.php">Messages</a>
                        </li>
                    <?php endif; ?>

                    <li class="nav-item">
                        <a class="nav-link" href="change_password.php">Change Password</a>
                    </li>

                    <!-- Logout link styled in red to stand out -->
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="logout.php">Logout</a>
                    </li>

                <!-- Show login and register if user is NOT logged in -->
                <?php else: ?>

                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Register</a>
                    </li>

                <?php endif; ?>

            </ul>

        </div>
    </div>
</nav>

<!-- Main content area with top margin -->
<main class="container mt-4">