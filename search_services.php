<?php
// Load Service class
require_once "classes/Service.php";

// Create Service object
$service = new Service();

// Get search keyword from URL, empty string if not set
$search = $_GET["search"] ?? "";

// If search keyword exists, search services, otherwise get all services
$services = !empty($search)
    ? $service->search($search)
    : $service->readAll();

// Check if any services were found
if (!empty($services)) {

    // Loop through each service and display as a card
    foreach ($services as $row) {

        echo '
        <div class="col-md-4 mb-4">

            <div class="card h-100 shadow-sm">

                <!-- Service image -->
                <img src="' . htmlspecialchars($row['image']) . '"
                     class="card-img-top"
                     alt="service image">

                <div class="card-body">

                    <!-- Service title -->
                    <h5 class="card-title">
                        ' . htmlspecialchars($row["title"]) . '
                    </h5>

                    <!-- Service description -->
                    <p class="card-text text-muted">
                        ' . htmlspecialchars($row["description"]) . '
                    </p>

                    <!-- Button to contact page -->
                    <a href="contact.php"
                       class="btn btn-outline-primary btn-sm">
                        Request this service
                    </a>

                </div>

            </div>

        </div>
        ';
    }

} else {

    // Show warning if no services found
    echo '
    <div class="col-12">
        <div class="alert alert-warning">
            No services found.
        </div>
    </div>
    ';
}
?>