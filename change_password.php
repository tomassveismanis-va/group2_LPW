<?php
// Start the session to access user login data
session_start();
// Load the database connection
require_once "includes/db.php";

// If user is not logged in, redirect to login page
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

// Variable to store success or error message
$message = "";

// Run this block only when the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Get and clean all three password fields from the form
    $current = trim($_POST["current_password"]);
    $new = trim($_POST["new_password"]);
    $confirm = trim($_POST["confirm_password"]);

    // Check that new password and confirm password match
    if ($new !== $confirm) {
        $message = "Passwords do not match.";
    } else {

        // Find the user in the database by their username
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :u");
        $stmt->execute([":u" => $_SESSION["username"]]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check that user exists and current password is correct
        if ($user && password_verify($current, $user["password"])) {

            // Hash the new password before saving
            $hash = password_hash($new, PASSWORD_DEFAULT);

            // Update the password in the database
            $update = $pdo->prepare("
                UPDATE users 
                SET password = :p 
                WHERE id = :id
            ");

            $update->execute([
                ":p" => $hash,
                ":id" => $user["id"]
            ]);

            $message = "Password successfully changed!";
        } else {
            // Current password was wrong
            $message = "Current password is incorrect.";
        }
    }
}

// Load header
require_once "includes/header.php";
?>

<!-- Center the form on the page -->
<div class="row justify-content-center">
    <div class="col-md-6">

        <!-- Card container with shadow -->
        <div class="card shadow p-4">

            <!-- Page title -->
            <h3 class="mb-3">Change Password</h3>

            <!-- Show message if one exists with security, so hacker can't code-->
            <?php if ($message): ?>
                <div class="alert alert-info">
                    <?= htmlspecialchars($message) ?>
                </div>
            <?php endif; ?>

            <!-- Change password form -->
            <form method="POST">

                <!-- Current password field -->
                <input type="password" name="current_password" class="form-control mb-2" placeholder="Current password" required>
                <!-- New password field -->
                <input type="password" name="new_password" class="form-control mb-2" placeholder="New password" required>
                <!-- Confirm new password field -->
                <input type="password" name="confirm_password" class="form-control mb-3" placeholder="Confirm password" required>

                <!-- Submit button -->
                <button class="btn btn-primary w-100">
                    Change Password
                </button>

            </form>

        </div>

    </div>
</div>

<!-- Load footer -->
<?php require_once "includes/footer.php"; ?>