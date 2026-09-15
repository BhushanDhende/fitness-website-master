<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($conn)) {
    include_once('db.php');
}

$successMsg = "";
$errorMsg = "";
$name = "";
$email = "";

// Show success message from session
if (isset($_SESSION['commentSuccess'])) {
    $successMsg = $_SESSION['commentSuccess'];
    unset($_SESSION['commentSuccess']);
}

// Pre-fill name/email if user is logged in
if (isset($_SESSION['id']) && isset($conn)) {
    $user_id = (int)$_SESSION['id'];
    $u_res = $conn->query("SELECT name, email FROM users WHERE id = '$user_id' LIMIT 1");
    if ($u_res && $u_res->num_rows > 0) {
        $u_data = $u_res->fetch_assoc();
        $name = $u_data['name'];
        $email = $u_data['email'];
    }
}

// Handle comment submission
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['post_comment_submit'])) {
    if (!isset($_SESSION['id'])) {
        $name = isset($_POST['name']) ? trim($conn->real_escape_string($_POST['name'])) : '';
        $email = isset($_POST['email']) ? trim($conn->real_escape_string($_POST['email'])) : '';
    }
    $comment = isset($_POST['comment']) ? trim($_POST['comment']) : '';

    if (empty($name) || empty($email) || empty($comment)) {
        $errorMsg = "Please fill in all required fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMsg = "Please provide a valid email address.";
    } else {
        $u_id = isset($_SESSION['id']) ? (int)$_SESSION['id'] : 0;
        $stmt = $conn->prepare("INSERT INTO comments (user_id, name, email, comment) VALUES (?, ?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("isss", $u_id, $name, $email, $comment);
            if ($stmt->execute()) {
                $_SESSION['commentSuccess'] = "Your comment has been posted successfully!";
                echo "<script>window.location.href = window.location.pathname + '#comments-section';</script>";
                exit;
            } else {
                $errorMsg = "Failed to submit comment. Please try again.";
            }
            $stmt->close();
        } else {
            $errorMsg = "Database error: " . $conn->error;
        }
    }
}

// Fetch comments
$all_comments = [];
if (isset($conn)) {
    $c_query = $conn->query("SELECT * FROM comments ORDER BY id DESC LIMIT 20");
    if ($c_query) {
        while ($c_row = $c_query->fetch_assoc()) {
            $all_comments[] = $c_row;
        }
    }
}
$commentCount = count($all_comments);
?>

<div class="comments-section-wrapper" id="comments-section">
    <!-- Header -->
    <div class="comments-header">
        <div class="comments-header-left">
            <h3 class="comments-main-title">
                <i class="fa fa-comments text-emerald"></i> Community Discussion
            </h3>
            <span class="comments-count-badge"><?php echo $commentCount; ?> <?php echo ($commentCount === 1) ? 'Comment' : 'Comments'; ?></span>
        </div>
        <p class="comments-header-sub">Join the conversation, ask questions, and share your fitness progress.</p>
    </div>

    <!-- Alert Messages -->
    <?php if (!empty($successMsg)): ?>
        <div class="comment-alert comment-alert-success">
            <i class="fa fa-check-circle"></i>
            <span><?php echo htmlspecialchars($successMsg); ?></span>
        </div>
    <?php endif; ?>

    <?php if (!empty($errorMsg)): ?>
        <div class="comment-alert comment-alert-error">
            <i class="fa fa-exclamation-circle"></i>
            <span><?php echo htmlspecialchars($errorMsg); ?></span>
        </div>
    <?php endif; ?>

    <!-- Comments List -->
    <div class="comments-feed-container">
        <?php if (!empty($all_comments)): ?>
            <?php foreach ($all_comments as $c): 
                $initial = !empty($c['name']) ? strtoupper(substr(trim($c['name']), 0, 1)) : '?';
                $isMember = !empty($c['user_id']) && $c['user_id'] > 0;
                $formattedDate = !empty($c['created_at']) ? date('M j, Y \a\t g:i A', strtotime($c['created_at'])) : 'Recently';
            ?>
                <div class="comment-card-item">
                    <div class="comment-avatar">
                        <?php echo htmlspecialchars($initial); ?>
                    </div>
                    <div class="comment-content-area">
                        <div class="comment-meta-bar">
                            <span class="comment-author-name"><?php echo htmlspecialchars($c['name']); ?></span>
                            <?php if ($isMember): ?>
                                <span class="comment-verified-badge" title="Verified Member">
                                    <i class="fa fa-check-circle"></i> Member
                                </span>
                            <?php endif; ?>
                            <span class="comment-time-stamp">
                                <i class="fa fa-clock-o"></i> <?php echo $formattedDate; ?>
                            </span>
                        </div>
                        <div class="comment-text-body">
                            <?php echo nl2br(htmlspecialchars($c['comment'])); ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="comments-empty-state">
                <i class="fa fa-commenting-o empty-icon"></i>
                <p class="empty-title">No comments yet</p>
                <p class="empty-desc">Be the first to share your thoughts, tips, or questions below!</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Leave a Comment Card -->
    <div class="comment-form-card">
        <h4 class="form-card-title">
            <i class="fa fa-pencil text-emerald"></i> Leave a Reply
        </h4>
        <p class="form-card-subtitle">Your email address will not be published. All inputs are securely encrypted.</p>

        <?php if (isset($_SESSION['id'])): ?>
            <div class="comment-user-session-bar">
                <i class="fa fa-user-circle text-emerald"></i>
                <span>Posting as <strong><?php echo htmlspecialchars($name); ?></strong> (Logged in)</span>
            </div>
        <?php endif; ?>

        <form action="#comments-section" class="modern-comment-form" method="POST">
            <input type="hidden" name="post_comment_submit" value="1">
            
            <?php if (!isset($_SESSION['id'])): ?>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="comment-field-group">
                            <label for="comment-name">Your Full Name *</label>
                            <div class="input-with-icon">
                                <i class="fa fa-user field-icon"></i>
                                <input type="text" id="comment-name" name="name" class="form-control modern-input" placeholder="e.g. John Doe" required value="<?php echo htmlspecialchars($name); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="comment-field-group">
                            <label for="comment-email">Your Email Address *</label>
                            <div class="input-with-icon">
                                <i class="fa fa-envelope field-icon"></i>
                                <input type="email" id="comment-email" name="email" class="form-control modern-input" placeholder="e.g. john@example.com" required value="<?php echo htmlspecialchars($email); ?>">
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <input type="hidden" name="name" value="<?php echo htmlspecialchars($name); ?>">
                <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
            <?php endif; ?>

            <div class="comment-field-group">
                <label for="comment-message">Your Comment / Question *</label>
                <textarea id="comment-message" name="comment" class="form-control modern-textarea" rows="4" placeholder="Write your thoughts, questions, or workout feedback here..." required></textarea>
            </div>

            <div class="comment-form-actions">
                <button type="submit" class="btn-post-comment">
                    <i class="fa fa-paper-plane"></i> Post Comment
                </button>
            </div>
        </form>
    </div>
</div>
