<!-- Start subscribe us -->
<?php
// Ensure database connection
if (!isset($conn) || !isset($db_connected)) {
  include_once('db.php');
}
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

$prefill_email = '';
if (!empty($_SESSION['id']) && !empty($conn) && !empty($db_connected)) {
  $user_id = $_SESSION['id'];
  $stmt = $conn->prepare("SELECT email FROM users WHERE id = ?");
  if ($stmt) {
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($email);
    if ($stmt->fetch()) {
      $prefill_email = htmlspecialchars($email);
    }
    $stmt->close();
  }
}

// Handle form submission
$subscribe_msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['subscribe_email'])) {
  $email = trim($_POST['subscribe_email']);
  if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    if (!empty($conn) && !empty($db_connected)) {
      $stmt = $conn->prepare("SELECT id FROM newsletter_subscribers WHERE email = ?");
      if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows === 0) {
          $stmt->close();
          $stmt = $conn->prepare("INSERT INTO newsletter_subscribers (email) VALUES (?)");
          $stmt->bind_param("s", $email);
          if ($stmt->execute()) {
            $subscribe_msg = '<div class="alert alert-success" style="border-radius:8px; margin-top:12px;"><i class="fa fa-check-circle"></i> Subscribed successfully! Welcome to the Lean\'N\'Green community.</div>';
          } else {
            $subscribe_msg = '<div class="alert alert-danger" style="border-radius:8px; margin-top:12px;">Subscription failed. Please try again.</div>';
          }
        } else {
          $subscribe_msg = '<div class="alert alert-info" style="border-radius:8px; margin-top:12px;">You are already subscribed!</div>';
        }
        $stmt->close();
      }
    } else {
      $subscribe_msg = '<div class="alert alert-success" style="border-radius:8px; margin-top:12px;"><i class="fa fa-check-circle"></i> Thank you for subscribing!</div>';
    }
  } else {
    $subscribe_msg = '<div class="alert alert-warning" style="border-radius:8px; margin-top:12px;">Please enter a valid email address.</div>';
  }
}
?>

<section id="subscribe">
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2 text-center">
        <div class="subscribe-area">
          <span class="subscribe-badge">
            <i class="fa fa-envelope-open-text" style="margin-right:6px;"></i> Weekly Fitness &amp; Nutrition Digest
          </span>
          <h2 class="subscribe-title">
            Subscribe to our Newsletter
          </h2>
          <p class="subscribe-subtitle">
            Get free workout routines, delicious vegan recipes, and science-backed training tips delivered straight to your inbox.
          </p>
          <?php if (!empty($subscribe_msg)) echo $subscribe_msg; ?>
          <form action="" method="post" class="subscrib-form">
            <input type="email" name="subscribe_email" placeholder="Enter your email address..." value="<?php echo $prefill_email; ?>" required>
            <button class="subscribe-btn" type="submit">
              Subscribe
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- End subscribe us -->

<!-- Start footer -->
<footer id="footer">
  <div class="container">
    <div class="row" style="margin-bottom:40px;">
      <!-- Brand & Mission Column -->
      <div class="col-md-4 col-sm-6" style="margin-bottom:30px;">
        <div style="margin-bottom:18px;">
          <a href="index.php" style="text-decoration:none;">
            <img src="assets/images/lean-green-logo.svg" alt="Lean'N'Green" class="footer-brand-logo">
          </a>
        </div>
        <p style="font-size:14px; line-height:1.7; color:#94a3b8; margin-bottom:20px;">
          Your ultimate destination for plant-powered fitness, anatomy insights, progressive workout routines, and free bodybuilding guides.
        </p>
        <div>
          <div class="footer-contact-item"><i class="fa fa-phone"></i> +91 7021779054</div>
          <div class="footer-contact-item"><i class="fa fa-envelope"></i> bhushandhende34@gmail.com</div>
        </div>
      </div>

      <!-- Quick Links -->
      <div class="col-md-2 col-sm-6 col-xs-6" style="margin-bottom:30px;">
        <h4 class="footer-col-title">EXPLORE</h4>
        <ul class="footer-link-list">
          <li><a href="index.php">Home</a></li>
          <li><a href="Muscles.php">Muscle Anatomy</a></li>
          <li><a href="Plant-Protein.php">Plant Protein</a></li>
          <li><a href="food-nutrtion.php">Nutrition Guide</a></li>
          <li><a href="Ebooks.php">Free Ebooks</a></li>
        </ul>
      </div>

      <!-- Workout Categories -->
      <div class="col-md-3 col-sm-6 col-xs-6" style="margin-bottom:30px;">
        <h4 class="footer-col-title">WORKOUTS</h4>
        <ul class="footer-link-list">
          <li><a href="Chest.php">Chest Routine</a></li>
          <li><a href="Arms.php">Arms &amp; Biceps</a></li>
          <li><a href="Legs.php">Legs &amp; Quads</a></li>
          <li><a href="Back.php">Back &amp; Lats</a></li>
          <li><a href="cardio.php">Cardio Conditioning</a></li>
        </ul>
      </div>

      <!-- Tools & Social -->
      <div class="col-md-3 col-sm-6" style="margin-bottom:30px;">
        <h4 class="footer-col-title">CALCULATORS &amp; SOCIAL</h4>
        <p style="font-size:14px; margin-bottom:15px;">Check your Body Mass Index (BMI) and health category instantly:</p>
        <a href="BMI-calc.php" style="display:inline-block; background:rgba(16,185,129,0.15); border:1px solid rgba(16,185,129,0.3); color:#34d399; padding:8px 18px; border-radius:8px; font-size:13px; font-weight:600; text-decoration:none; margin-bottom:20px; transition:all 0.2s;">
          <i class="fa fa-calculator" style="margin-right:6px;"></i> Open BMI Calculator
        </a>
        <div class="footer-social-links">
          <a href="https://www.facebook.com/harsh.mankame" target="_blank" rel="noopener" aria-label="Facebook" class="footer-social-btn">
            <i class="fa-brands fa-facebook-f fa-facebook"></i>
          </a>
          <a href="https://www.instagram.com/bhushan_dhende_mr.x_?igsh=MTlxbzZidWljdDEzcQ%3D%3D&utm_source=qr" target="_blank" rel="noopener" aria-label="Instagram" class="footer-social-btn">
            <i class="fa-brands fa-instagram fa-instagram"></i>
          </a>
          <a href="https://www.linkedin.com/in/shubham-bharekar-844657246" target="_blank" rel="noopener" aria-label="LinkedIn" class="footer-social-btn">
            <i class="fa-brands fa-linkedin-in fa-linkedin"></i>
          </a>
          <a href="https://github.com/callmeX34" target="_blank" rel="noopener" aria-label="GitHub" class="footer-social-btn">
            <i class="fa-brands fa-github fa-github"></i>
          </a>
        </div>
      </div>
    </div>

    <!-- Bottom Bar -->
    <div class="row footer-bottom-bar">
      <div class="col-md-6 col-sm-6 text-left">
        <p>
          &copy; <?php echo date('Y'); ?> <span style="color:#e2e8f0; font-weight:600;">Lean'N'Green</span>. All rights reserved.
        </p>
      </div>
      <div class="col-md-6 col-sm-6 text-right">
        <p>
          Crafted by <a href="https://github.com/callmeX34" target="_blank" rel="noopener" style="color:#10b981; font-weight:600; text-decoration:none;">callmeX</a>
        </p>
      </div>
    </div>
  </div>
</footer>
<!-- End footer -->

<!-- Global JS Bundles -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="assets/js/bootstrap.js"></script>
<script type="text/javascript" src="assets/js/slick.js"></script>
<script type="text/javascript" src="assets/js/jquery.mixitup.js"></script>
<script type="text/javascript" src="assets/js/jquery.fancybox.pack.js"></script>
<script src="assets/js/waypoints.js"></script>
<script src="assets/js/jquery.counterup.js"></script>
<script type="text/javascript" src="assets/js/wow.js"></script>
<script type="text/javascript" src="assets/js/bootstrap-progressbar.js"></script>
<script type="text/javascript" src="assets/js/custom.js"></script>

</body>
</html>