<?php
// Start the session to access user login data
session_start();
// Load the database connection
require_once "includes/db.php";

// Variables to store success or error messages
$success = "";
$error = "";

// Run this block only when the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Get and clean all form values, use empty string if not set
    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $message = trim($_POST["message"] ?? "");

    // Check that all fields are filled in
    if (empty($name) || empty($email) || empty($message)) {
        $error = "All fields are required.";

    // Check that email format is valid
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";

    } else {
        try {
            // Get user_id from session if logged in, otherwise null
            $user_id = $_SESSION["user_id"] ?? null;

            // Insert the message into the database
            $sql = "INSERT INTO messages (name, email, message, user_id) VALUES (:name, :email, :message, :user_id)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':name' => $name,
                ':email' => $email,
                ':message' => $message,
                ':user_id' => $user_id
            ]);

            $success = "Message sent successfully!";

        } catch (PDOException $e) {
            // If database insert fails, show error
            $error = "Failed to send message.";
        }
    }
}

// Load header
require_once "includes/header.php";
?>

<div class="container mt-5">
    <!-- Page title -->
    <h2>Contact Us</h2>

    <!-- Show success message if message was sent -->
    <?php if ($success): ?>
        <div class="alert alert-success"><?php echo $success; ?></div>
    <?php endif; ?>

    <!-- Show error message if something went wrong -->
    <?php if ($error): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>

    <!-- Contact form -->
    <form method="POST" id="contactForm">

        <!-- Name field -->
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control">
        </div>

        <!-- Email field -->
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="text" name="email" id="email" class="form-control">
        </div>

        <!-- Message field -->
        <div class="mb-3">
            <label class="form-label">Message</label>
            <textarea name="message" id="message" class="form-control"></textarea>
        </div>

        <!-- Submit button -->
        <button type="submit" class="btn btn-primary">Send</button>
    </form>
</div>

<script>
// Validate form fields before submitting on browser
document.getElementById("contactForm").addEventListener("submit", function(e) {

    const name = document.getElementById("name").value.trim();
    const email = document.getElementById("email").value.trim();
    const message = document.getElementById("message").value.trim();

    // Stop submission if any field is empty
    if (name === "" || email === "" || message === "") {
        alert("All fields are required.");
        e.preventDefault();
        return;
    }

    // Check email format using a pattern
    const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,}$/i;

    // Stop submission if email format is invalid
    if (!emailPattern.test(email)) {
        alert("Please enter a valid email address.");
        e.preventDefault();
    }
});
</script>

<!-- Load footer -->
<?php require_once "includes/footer.php"; ?>