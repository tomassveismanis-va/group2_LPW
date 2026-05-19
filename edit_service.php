<?php
// Start session
session_start();
// Load Service class
require_once "classes/Service.php";

// Block non-admins
if (
    !isset($_SESSION["username"]) ||
    $_SESSION["role"] !== "admin"
) {
    header("Location: index.php");
    exit();
}

// Create Service object and empty message variable
$service = new Service();
$message = "";

// Stop if no ID in URL
if (!isset($_GET["id"])) {
    die("Service ID is missing.");
}

// Convert ID to integer for safety
$id = (int)$_GET["id"];
// Get current service data by ID
$currentService = $service->readById($id);

// Stop if service doesn't exist
if (!$currentService) {
    die("Service not found.");
}

// Run when form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = trim($_POST["title"]);
    $description = trim($_POST["description"]);

    // Check that fields are not empty
    if (!empty($title) && !empty($description)) {
        // Try to update the service
        if ($service->update($id, $title, $description)) {
            $message = "Service updated successfully!";
            // Reload updated service data
            $currentService = $service->readById($id);
        } else {
            $message = "Error updating service.";
        }
    } else {
        $message = "Please fill in all fields.";
    }
}
// Load header
require_once "includes/header.php";
?>

<!-- Page title -->
<h2 class="mb-4">Edit Service</h2>
    <title>Edit Service</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

    <!-- Show message if one exists -->
    <?php if ($message): ?>
        <div class="alert alert-info"><?php echo $message; ?></div>
    <?php endif; ?>

    <!-- Edit service form -->
    <form method="POST">

        <!-- Title field, pre-filled with current value -->
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($currentService['title']); ?>">
        </div>

        <!-- Description field, pre-filled with current value -->
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control"><?php echo htmlspecialchars($currentService['description']); ?></textarea>
        </div>

        <!-- Submit button and back to dashboard link -->
        <button type="submit" class="btn btn-warning">Update Service</button>
        <a href="dashboard.php" class="btn btn-secondary">Back</a>

    </form>
<!-- Load footer -->
<?php require_once "includes/footer.php"; ?>