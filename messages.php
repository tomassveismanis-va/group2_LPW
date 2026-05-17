<?php
session_start();
require_once "includes/db.php";

if (!isset($_SESSION["username"]) || $_SESSION["role"] !== "admin") {
    header("Location: index.php");
    exit();
}

$stmt = $pdo->query("
    SELECT m.*, u.username 
    FROM messages m 
    LEFT JOIN users u ON m.user_id = u.id 
    ORDER BY m.created_at DESC
");
$messages = $stmt->fetchAll();

require_once "includes/header.php";
?>

<h2 class="mb-4">Messages</h2>

<?php if (count($messages) === 0): ?>
    <div class="alert alert-info">No messages yet.</div>
<?php else: ?>
<div class="table-responsive">
    <table class="table table-bordered table-striped">
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
        <?php foreach ($messages as $msg): ?>
            <tr>
                <td><?php echo $msg["id"]; ?></td>
                <td><?php echo htmlspecialchars($msg["name"]); ?></td>
                <td><?php echo htmlspecialchars($msg["email"]); ?></td>
                <td><?php echo $msg["username"] ? htmlspecialchars($msg["username"]) : "Guest"; ?></td>
                <td><?php echo htmlspecialchars($msg["message"]); ?></td>
                <td><?php echo $msg["created_at"]; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php endif; ?>

<?php require_once "includes/footer.php"; ?>