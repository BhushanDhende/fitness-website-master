 <!-- Start subscribe us -->
<?php
// Database connection
include('db.php'); // Include your database connection file
// Prefill email if session started
if (session_status() === PHP_SESSION_NONE) {
  session_start(); // Start the session only if not already started
}

$prefill_email = '';
if (isset($_SESSION['id'])) {
 $user_id = $_SESSION['id'];
  $stmt = $conn->prepare("SELECT email FROM users WHERE id = ?");
  $stmt->bind_param("i", $user_id);
  $stmt->execute();
  $stmt->bind_result($email);
  if ($stmt->fetch()) {
    $prefill_email = htmlspecialchars($email);
  }
  $stmt->close();
}

// Handle form submission
$subscribe_msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['subscribe_email'])) {
  $email = trim($_POST['subscribe_email']);
  if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    // Prevent duplicates
    $stmt = $conn->prepare("SELECT id FROM newsletter_subscribers WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows === 0) {
      $stmt->close();
      $stmt = $conn->prepare("INSERT INTO newsletter_subscribers (email) VALUES (?)");
      $stmt->bind_param("s", $email);
      if ($stmt->execute()) {
        $subscribe_msg = '<div style="color:green;">Subscribed successfully!</div>';
      } else {
        $subscribe_msg = '<div style="color:red;">Subscription failed. Try again.</div>';
      }
    } else {
      $subscribe_msg = '<div style="color:orange;">You are already subscribed.</div>';
    }
    $stmt->close();
  } else {
    $subscribe_msg = '<div style="color:red;">Invalid email address.</div>';
  }
}
?>

<section id="subscribe">
  <div class="subscribe-overlay">
    <div class="container">
    <div class="row">
      <div class="col-md-12">
      <div class="subscribe-area">
        <h2>Subscribe Newsletter</h2>
        <?php if (!empty($subscribe_msg)) echo $subscribe_msg; ?>
        <form action="" method="post" class="subscrib-form">
        <input type="text" name="subscribe_email" placeholder="Enter Your E-mail.." value="<?php echo $prefill_email; ?>">
        <button class="subscribe-btn" type="submit">Submit</button>
        </form>
      </div>
      </div>
    </div>
    </div>
  </div>
</section>
<!-- End subscribe us -->
 
 
 
 
 <!-- Start footer -->
 <footer id="footer">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-sm-6">
          <div class="footer-left">
            <p>Designed by <a href="https://github.com/callmeX34">callmeX</a></p>
          </div>
        </div>
        <div class="col-md-6 col-sm-6">
          <div class="footer-right">
            <a href="https://www.facebook.com/harsh.mankame"><i class="fa fa-facebook"></i></a>
            <a href="https://www.instagram.com/bhushan_dhende_mr.x_?igsh=MTlxbzZidWljdDEzcQ%3D%3D&utm_source=qr"><i class="fa fa-instagram"></i></a>
            <a href="#"><i class="fa fa-google-plus"></i></a>
            <a href="https://www.linkedin.com/in/shubham-bharekar-844657246?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=ios_app"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-pinterest"></i></a>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- End footer -->