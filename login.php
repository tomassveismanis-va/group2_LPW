<?php
// Start session
session_start();
// Load database connection
require_once "includes/db.php";

// Variable to store error message
$message = "";

// Run when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get email and password from form
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    // Find user by email in database
    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([":email" => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if user exists and password is correct
    if ($user && password_verify($password, $user["password"])) {

        // Save user data in session
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["username"] = $user["username"];
        $_SESSION["role"] = $user["role"];

        // Save welcome message to show on next page
        $_SESSION["welcome_message"] =
            "Welcome back, " . $user["username"] . "!";

        // Save previous visit time if it exists
        if (!empty($user["last_visit"])) {
            $_SESSION["previous_visit"] = $user["last_visit"];
        }

        // Get current time
        $currentTime = date("Y-m-d H:i:s");

        // Update last visit time in database
        $updateSql = "
            UPDATE users
            SET last_visit = :last_visit
            WHERE id = :id
        ";
        $updateStmt = $pdo->prepare($updateSql);
        $updateStmt->execute([
            ":last_visit" => $currentTime,
            ":id" => $user["id"]
        ]);

        // Save username in cookie for 30 days
        setcookie(
            "username",
            $user["username"],
            time() + (86400 * 30),
            "/"
        );

        // Redirect to homepage after login
        header("Location: index.php");
        exit();

    } else {
        // Show error if email or password is wrong
        $message = "Wrong login!";
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
            <h2 class="mb-4">Login</h2>

            <!-- Show error message if login failed -->
            <?php if ($message): ?>
                <div class="alert alert-danger">
                    <?php echo htmlspecialchars($message); ?>
                </div>
            <?php endif; ?>

            <!-- Login form -->
            <form method="POST">

                <!-- Email field -->
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <!-- Password field -->
                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <!-- Submit button -->
                <button class="btn btn-primary w-100">Login</button>

            </form>

        </div>
    </div>
</div>

<!-- Load footer -->
<?php require_once "includes/footer.php"; ?>