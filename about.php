<?php
// Load header (navigation bar, HTML head, session start)
require_once "includes/header.php";
?>

<!-- Main about page container with white background -->
<div class="p-5 bg-white rounded shadow-sm">

    <!-- Page title -->
    <h1 class="fw-bold mb-4">
        About Us
    </h1>

    <!-- Company introduction text -->
    <p class="fs-5 text-muted">
        We are a modern web services platform focused on creating
        secure, responsive, and user-friendly digital solutions
        for individuals, businesses, and organizations.
    </p>

    <!-- Company goal description -->
    <p class="mt-4">
        Our goal is to help clients improve their online presence
        by providing high-quality web development services,
        database solutions, and modern website functionality.
    </p>

    <!-- Services list section -->
    <div class="mt-5">

        <!-- Section title -->
        <h3 class="fw-bold">
            What We Offer
        </h3>

        <!-- List of offered services -->
        <ul class="mt-3">
            <li>Modern responsive website development</li>
            <li>Secure user authentication systems</li>
            <li>Database-driven web applications</li>
            <li>Professional UI design using Bootstrap</li>
            <li>Admin management systems</li>
            <li>Technical support and maintenance</li>
        </ul>

    </div>

    <!-- Contact section -->
    <div class="mt-5">

        <!-- Section title -->
        <h3 class="fw-bold">
            Request Our Services
        </h3>

        <!-- Section description -->
        <p class="text-muted">
            Visitors can explore available services on the platform
            and contact us directly to request assistance or discuss
            custom web development solutions tailored to their needs.
        </p>

        <!-- Button that links to the contact page -->
        <a href="contact.php" class="btn btn-primary mt-3">
            Contact Us
        </a>

    </div>

</div>

<!-- Load footer (closing HTML tags, Bootstrap JS) -->
<?php require_once "includes/footer.php"; ?>