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

// If ID exists in URL
if (isset($_GET["id"])) {

    // Convert to integer for safety
    $id = (int)$_GET["id"];

    // Delete the service
    $service = new Service();
    $service->delete($id);
}

// Redirect back to dashboard after deleting
header("Location: dashboard.php");
exit();
?>