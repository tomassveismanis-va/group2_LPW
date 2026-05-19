<?php
// Load database connection
require_once "includes/db.php";

// Variable to store success or error message
$message = "";

// Run when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get and clean form values
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    // Check that all fields are filled in
    if (!empty($username) && !empty($email) && !empty($password)) {

        // Hash the password before saving
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert new user into database
        $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
        $stmt = $pdo->prepare($sql);

        try {
            $stmt->execute([
                ":username" => $username,
                ":email" => $email,
                ":password" => $hashedPassword
            ]);

            $message = "Registration successful!";

        } catch (PDOException $e) {
            // Email must be unique, show error if already exists
            $message = "Error: email already exists.";
        }

    } else {
        // Show error if any field is empty
        $message = "All fields required.";
    }
}

// Load header
require_once "includes/header.php";
?>

<!-- Center the form on the page -->
<div class="row justify-content-center">
    <div class="col-md-6">

        <div class="card shadow p-4">

            <!-- Page title -->
            <h2 class="mb-4">Register</h2>

            <!-- Show message if one exists -->
            <?php if ($message): ?>
                <div class="alert alert-info">
                    <?php echo htmlspecialchars($message); ?>
                </div>
            <?php endif; ?>

            <!-- Registration form -->
            <form method="POST">

                <!-- Username field -->
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text"
                           name="username"
                           class="form-control"
                           required>
                </div>

                <!-- Email field -->
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email"
                           name="email"
                           class="form-control"
                           required>
                </div>

                <!-- Password field -->
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password"
                           name="password"
                           class="form-control"
                           required>
                </div>

                <!-- Submit button -->
                <button type="submit"
                        class="btn btn-success w-100">
                    Register
                </button>

            </form>

            <!-- Link to login page -->
            <div class="mt-3 text-center">
                <a href="login.php">
                    Go to Login
                </a>
            </div>

        </div>

    </div>
</div>

<!-- Load footer -->
<?php require_once "includes/footer.php"; ?>