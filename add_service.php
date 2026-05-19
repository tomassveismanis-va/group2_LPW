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

// Variable to store success or error message
$message = "";

// Run this block only when the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Get and clean form values
    $title = trim($_POST["title"]);
    $description = trim($_POST["description"]);
    $image = trim($_POST["image"]);

    // Check that all fields are filled in
    if (!empty($title) &&
        !empty($description) &&
        !empty($image)) {

        // Create a new Service object
        $service = new Service();

        // Try to save the service to the database
        if ($service->create($title, $description, $image)) {

            $message = "Service added successfully!";

        } else {

            $message = "Error adding service.";
        }

    } else {

        // Show error if any field is empty
        $message = "Please fill in all fields.";
    }
}

// Load header
require_once "includes/header.php";
?>

<!-- Page title -->
<h2 class="mb-4">Add Service</h2>

<!-- Show message if one exists -->
<?php if ($message): ?>
    <div class="alert alert-info">
        <?php echo $message; ?>
    </div>
<?php endif; ?>

<!-- Add service form -->
<form method="POST">

    <!-- Title field -->
    <div class="mb-3">
        <label class="form-label">
            Title
        </label>
        <input type="text"
               name="title"
               class="form-control">
    </div>

    <!-- Description field -->
    <div class="mb-3">
        <label class="form-label">
            Description
        </label>
        <textarea name="description"
                  class="form-control"></textarea>
    </div>

    <!-- Image URL field -->
    <div class="mb-3">
        <label class="form-label">
            Image URL
        </label>
        <input type="text"
               name="image"
               class="form-control">
    </div>

    <!-- Submit button -->
    <button type="submit"
            class="btn btn-primary">
        Add Service
    </button>

</form>

<!-- Load footer -->
<?php require_once "includes/footer.php"; ?>