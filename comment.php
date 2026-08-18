<?php


if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Start the session only if not already started
}
ob_start(); // Start output buffering


$successMsg = "";
$name = "";
$email = "";

// Show success message after redirect
if (isset($_SESSION['successMsg'])) {
    $successMsg = $_SESSION['successMsg'];
    unset($_SESSION['successMsg']);
}

// Pre-fill name/email if user is logged in
if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
    $result = $conn->query("SELECT name, email FROM users WHERE id = '$user_id' LIMIT 1");
    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $name = $user['name'];
        $email = $user['email'];
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Always set $name and $email from POST if not logged in, otherwise use session values
    if (!isset($_SESSION['id'])) {
        $name = isset($_POST['name']) ? $conn->real_escape_string($_POST['name']) : '';
        $email = isset($_POST['email']) ? $conn->real_escape_string($_POST['email']) : '';
    }
    // For logged-in users, $name and $email are already set above

    $comment = isset($_POST['comment']) ? $_POST['comment'] : '';

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO comments (name, email, comment) VALUES (?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("sss", $name, $email, $comment);
        if ($stmt->execute()) {
            $_SESSION['successMsg'] = "Comment is sent";
        } else {
            $successMsg = "Error: {$stmt->error}";
        }
        $stmt->close();
    } else {
        $successMsg = "Error: {$conn->error}";
    }
}
?>

<!-- ✅ Now the HTML begins — after all PHP processing and before any output -->

<div class="comments-box-area">
    <h2>Leave a Comment</h2>
    <p>Your email address will not be published.</p>
    <?php if ($successMsg) {
        echo "<p style='color:green;'>$successMsg</p>";
    } ?>
    <form action="" class="comments-form" method="POST">
        <div class="form-group">
            <input type="text" id="name" class="form-control" name="name" placeholder="Your Name" required
                value="<?php echo htmlspecialchars($name); ?>" <?php if ($name) echo 'readonly'; ?>>
        </div>
        <div class="form-group">
            <input type="email" id="email" class="form-control" name="email" placeholder="Email" required
                value="<?php echo htmlspecialchars($email); ?>" <?php if ($email) echo 'readonly'; ?>>
        </div>
        <div class="form-group">
            <textarea placeholder="Comment" rows="3" class="form-control" name="comment" required></textarea>
        </div>
        <button class="comment-btn" type="submit">Submit Comment</button>
    </form>
</div>

