<?php
// Start the session to access user login data
session_start();

// Load the Service class
require_once "classes/Service.php";

// If user is not logged in or is not an admin, redirect to homepage
if (
    !isset($_SESSION["username"]) ||
    $_SESSION["role"] !== "admin"
) {
    header("Location: index.php");
    exit();
}

// Get all services from the database
$service = new Service();
$services = $service->readAll();

// Load header
require_once "includes/header.php";
?>

<!-- Page title -->
<h2 class="mb-4">Dashboard</h2>

<!-- Button to go to add service page -->
<a href="add_service.php"
   class="btn btn-success mb-3">
    Add New Service
</a>

<!-- Scrollable table wrapper for small screens -->
<div class="table-responsive">

    <!-- Services table with borders and striped rows -->
    <table class="table table-bordered table-striped">

        <!-- Table header with dark background -->
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>

        <!-- Loop through each service and display as a table row -->
        <?php foreach ($services as $row): ?>

            <tr>

                <!-- Service ID -->
                <td>
                    <?php echo $row["id"]; ?>
                </td>

                <!-- Service title with security -->
                <td>
                    <?php echo htmlspecialchars($row["title"]); ?>
                </td>

                <!-- Service description with security -->
                <td>
                    <?php echo htmlspecialchars($row["description"]); ?>
                </td>

                <!-- Service image filename with security-->
                <td>
                    <?php echo htmlspecialchars($row["image"]); ?>
                </td>

                <td>

                    <!-- Edit button - links to edit page with service ID -->
                    <a href="edit_service.php?id=<?php echo $row['id']; ?>"
                       class="btn btn-warning btn-sm">
                        Edit
                    </a>

                    <!-- Delete button - asks for confirmation before deleting -->
                    <a href="delete_service.php?id=<?php echo $row['id']; ?>"
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('Are you sure?');">
                        Delete
                    </a>

                </td>

            </tr>

        <?php endforeach; ?>

        </tbody>

    </table>

</div>

<!-- Load footer -->
<?php require_once "includes/footer.php"; ?>