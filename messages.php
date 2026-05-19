<?php
// Start session
session_start();
// Load database connection
require_once "includes/db.php";

// Block non-admins
if (!isset($_SESSION["username"]) || $_SESSION["role"] !== "admin") {
    header("Location: index.php");
    exit();
}

// Get all messages, include username if message was sent by logged in user
$stmt = $pdo->query("
    SELECT m.*, u.username 
    FROM messages m 
    LEFT JOIN users u ON m.user_id = u.id 
    ORDER BY m.created_at DESC
");
$messages = $stmt->fetchAll();

// Load header
require_once "includes/header.php";
?>

<!-- Page title -->
<h2 class="mb-4">Messages</h2>

<!-- Show info message if no messages exist -->
<?php if (count($messages) === 0): ?>
    <div class="alert alert-info">No messages yet.</div>
<?php else: ?>

<!-- Scrollable table wrapper for small screens -->
<div class="table-responsive">
    <table class="table table-bordered table-striped">

        <!-- Table header -->
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>User</th>
                <th>Message</th>
                <th>Sent</th>
            </tr>
        </thead>

        <tbody>
        <!-- Loop through each message and display as a table row -->
        <?php foreach ($messages as $msg): ?>
            <tr>
                <!-- Message ID -->
                <td><?php echo $msg["id"]; ?></td>
                <!-- Sender name -->
                <td><?php echo htmlspecialchars($msg["name"]); ?></td>
                <!-- Sender email -->
                <td><?php echo htmlspecialchars($msg["email"]); ?></td>
                <!-- Show username if logged in, otherwise show "Guest" -->
                <td><?php echo $msg["username"] ? htmlspecialchars($msg["username"]) : "Guest"; ?></td>
                <!-- Message content -->
                <td><?php echo htmlspecialchars($msg["message"]); ?></td>
                <!-- Time message was sent -->
                <td><?php echo $msg["created_at"]; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>

    </table>
</div>
<?php endif; ?>

<!-- Load footer -->
<?php require_once "includes/footer.php"; ?>