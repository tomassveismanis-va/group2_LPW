<?php
// Load Service class and get all services from database
require_once "classes/Service.php";

$service = new Service();
$services = $service->readAll();

// Load header
require_once "includes/header.php";
?>

<!-- PAGE HEADER -->
<div class="mb-4">

    <!-- Page title -->
    <h1 class="fw-bold">
        Our Services
    </h1>

    <!-- Page description -->
    <p class="text-muted">
        Below you will find all available services provided by our platform.
        Each service is designed to help clients improve their online presence,
        business workflow, and digital solutions.
        Browse the services below and contact us if you would like
        to request one of them for your own project or business.
    </p>

</div>

<!-- LIVE SEARCH - filters services as user types -->
<div class="mb-4">
    <input type="text"
           id="searchInput"
           class="form-control"
           placeholder="Search services...">
</div>

<!-- SERVICES - container that gets updated by search -->
<div class="row" id="servicesContainer">

    <!-- Loop through each service and display as a card -->
    <?php foreach ($services as $row): ?>

        <div class="col-md-4 mb-4">

            <div class="card h-100 shadow-sm">

                <!-- Service image -->
                <img src="<?= htmlspecialchars($row['image']) ?>"
                     class="card-img-top"
                     alt="service image">

                <div class="card-body">

                    <!-- Service title -->
                    <h5 class="card-title">
                        <?= htmlspecialchars($row["title"]) ?>
                    </h5>

                    <!-- Service description -->
                    <p class="card-text text-muted">
                        <?= htmlspecialchars($row["description"]) ?>
                    </p>

                    <!-- Button to contact page -->
                    <a href="contact.php"
                       class="btn btn-outline-primary btn-sm">
                        Request this service
                    </a>

                </div>

            </div>

        </div>

    <?php endforeach; ?>

</div>

<!-- INFO SECTION -->
<div class="mt-4 p-4 bg-light rounded shadow-sm">
    <p class="mb-0 text-muted">
        Our goal is to provide modern and reliable digital services
        for individuals, businesses, and organizations.
        If you are unsure which service best fits your needs,
        feel free to contact us for guidance and recommendations.
    </p>
</div>

<!-- AJAX SEARCH - sends request to server as user types -->
<script>

document.getElementById("searchInput")
.addEventListener("keyup", function () {

    // Get current search value
    const search = this.value;

    // Send request to search_services.php with search keyword
    fetch("search_services.php?search=" + search)

        // Convert response to text
        .then(response => response.text())

        // Replace services container with search results
        .then(data => {
            document.getElementById("servicesContainer")
                .innerHTML = data;
        });

});

</script>

<!-- Load footer -->
<?php require_once "includes/footer.php"; ?>