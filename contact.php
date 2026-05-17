<?php
session_start();
require_once "includes/db.php";
$success = "";
$error = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $message = trim($_POST["message"] ?? "");
    if (empty($name) || empty($email) || empty($message)) {
        $error = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } else {
        try {
            $user_id = $_SESSION["user_id"] ?? null;
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
            $error = "Failed to send message.";
        }
    }
}
require_once "includes/header.php";
?>
<div class="container mt-5">
    <h2>Contact Us</h2>
    <?php if ($success): ?>
        <div class="alert alert-success"><?php echo $success; ?></div>
    <?php endif; ?>
    <?php if ($error): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    <form method="POST" id="contactForm">
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="text" name="email" id="email" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Message</label>
            <textarea name="message" id="message" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Send</button>
    </form>
</div>
<script>
document.getElementById("contactForm").addEventListener("submit", function(e) {
    const name = document.getElementById("name").value.trim();
    const email = document.getElementById("email").value.trim();
    const message = document.getElementById("message").value.trim();
    if (name === "" || email === "" || message === "") {
        alert("All fields are required.");
        e.preventDefault();
        return;
    }
    const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,}$/i;
    if (!emailPattern.test(email)) {
        alert("Please enter a valid email address.");
        e.preventDefault();
    }
});
</script>
<?php require_once "includes/footer.php"; ?>