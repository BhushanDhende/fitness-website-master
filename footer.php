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

<section id="subscribe" style="background: #0b1120 !important; background-image: none !important; padding: 40px 0; border-top: 1px solid rgba(255,255,255,0.06); clear: both; overflow: hidden; display: block; width: 100%;">
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2 text-center">
        <div class="subscribe-area" style="float: none !important; margin: 0 auto; display: block; background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%) !important; border: 1px solid rgba(255,255,255,0.12); border-radius: 20px; padding: 36px 28px; box-shadow: 0 20px 40px rgba(0,0,0,0.25);">
          <span style="display:inline-block; background:rgba(16,185,129,0.15); color:#34d399; padding:6px 16px; border-radius:20px; font-size:12px; font-weight:700; letter-spacing:1px; text-transform:uppercase; margin-bottom:12px;">
            <i class="fa fa-envelope-open-text" style="margin-right:6px;"></i> Weekly Fitness &amp; Nutrition Digest
          </span>
          <h2 style="color:#ffffff; font-family:'Outfit',sans-serif; font-size:28px; font-weight:700; margin-top:0; margin-bottom:10px;">
            Subscribe to our Newsletter
          </h2>
          <p style="color:#94a3b8; font-size:15px; max-width:520px; margin:0 auto 24px auto;">
            Get free workout routines, delicious vegan recipes, and science-backed training tips delivered straight to your inbox.
          </p>
          <?php if (!empty($subscribe_msg)) echo $subscribe_msg; ?>
          <form action="" method="post" class="subscrib-form" style="max-width:540px; margin:0 auto; display:flex; gap:10px; flex-wrap:wrap; justify-content:center;">
            <input type="email" name="subscribe_email" placeholder="Enter your email address..." value="<?php echo $prefill_email; ?>" required
              style="flex:1; min-width:260px; height:50px; background:#0f172a; border:1px solid #334155; border-radius:12px; padding:10px 20px; color:#fff; font-size:15px; outline:none; transition:border-color 0.2s;">
            <button class="subscribe-btn" type="submit"
              style="height:50px; padding:0 30px; background:linear-gradient(135deg, #10b981, #059669); color:#fff; font-weight:700; font-size:14px; letter-spacing:0.5px; text-transform:uppercase; border:none; border-radius:12px; box-shadow:0 6px 18px rgba(16,185,129,0.35); transition:all 0.2s; cursor:pointer;">
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
<footer id="footer" style="background:#090d16; color:#94a3b8; padding:60px 0 25px 0; border-top:1px solid rgba(255,255,255,0.06);">
  <div class="container">
    <div class="row" style="margin-bottom:40px;">
      <!-- Brand & Mission Column -->
      <div class="col-md-4 col-sm-6" style="margin-bottom:30px;">
        <div style="margin-bottom:18px;">
          <a href="index.php" style="text-decoration:none;">
            <img src="assets/images/lean-green-logo.svg" alt="Lean'N'Green" style="height:44px; filter:brightness(1.1);">
          </a>
        </div>
        <p style="font-size:14px; line-height:1.7; color:#94a3b8; margin-bottom:20px;">
          Your ultimate destination for plant-powered fitness, anatomy insights, progressive workout routines, and free bodybuilding guides.
        </p>
        <div style="display:flex; flex-direction:column; gap:8px; font-size:13.5px;">
          <div><i class="fa fa-phone" style="color:#10b981; width:20px;"></i> +91 7021779054</div>
          <div><i class="fa fa-envelope" style="color:#10b981; width:20px;"></i> bhushandhende34@gmail.com</div>
        </div>
      </div>

      <!-- Quick Links -->
      <div class="col-md-2 col-sm-6 col-xs-6" style="margin-bottom:30px;">
        <h4 style="color:#ffffff; font-family:'Outfit',sans-serif; font-size:16px; font-weight:700; margin-bottom:18px; letter-spacing:0.5px;">EXPLORE</h4>
        <ul style="list-style:none; padding:0; margin:0; line-height:2.2; font-size:14px;">
          <li><a href="index.php" style="color:#94a3b8; text-decoration:none; transition:color 0.2s;">Home</a></li>
          <li><a href="Muscles.php" style="color:#94a3b8; text-decoration:none; transition:color 0.2s;">Muscle Anatomy</a></li>
          <li><a href="Plant-Protein.php" style="color:#94a3b8; text-decoration:none; transition:color 0.2s;">Plant Protein</a></li>
          <li><a href="food-nutrtion.php" style="color:#94a3b8; text-decoration:none; transition:color 0.2s;">Nutrition Guide</a></li>
          <li><a href="Ebooks.php" style="color:#94a3b8; text-decoration:none; transition:color 0.2s;">Free Ebooks</a></li>
        </ul>
      </div>

      <!-- Workout Categories -->
      <div class="col-md-3 col-sm-6 col-xs-6" style="margin-bottom:30px;">
        <h4 style="color:#ffffff; font-family:'Outfit',sans-serif; font-size:16px; font-weight:700; margin-bottom:18px; letter-spacing:0.5px;">WORKOUTS</h4>
        <ul style="list-style:none; padding:0; margin:0; line-height:2.2; font-size:14px;">
          <li><a href="Chest.php" style="color:#94a3b8; text-decoration:none; transition:color 0.2s;">Chest Routine</a></li>
          <li><a href="Arms.php" style="color:#94a3b8; text-decoration:none; transition:color 0.2s;">Arms &amp; Biceps</a></li>
          <li><a href="Legs.php" style="color:#94a3b8; text-decoration:none; transition:color 0.2s;">Legs &amp; Quads</a></li>
          <li><a href="Back.php" style="color:#94a3b8; text-decoration:none; transition:color 0.2s;">Back &amp; Lats</a></li>
          <li><a href="cardio.php" style="color:#94a3b8; text-decoration:none; transition:color 0.2s;">Cardio Conditioning</a></li>
        </ul>
      </div>

      <!-- Tools & Social -->
      <div class="col-md-3 col-sm-6" style="margin-bottom:30px;">
        <h4 style="color:#ffffff; font-family:'Outfit',sans-serif; font-size:16px; font-weight:700; margin-bottom:18px; letter-spacing:0.5px;">CALCULATORS &amp; SOCIAL</h4>
        <p style="font-size:14px; margin-bottom:15px;">Check your Body Mass Index (BMI) and health category instantly:</p>
        <a href="BMI-calc.php" style="display:inline-block; background:rgba(16,185,129,0.15); border:1px solid rgba(16,185,129,0.3); color:#34d399; padding:8px 18px; border-radius:8px; font-size:13px; font-weight:600; text-decoration:none; margin-bottom:20px; transition:all 0.2s;">
          <i class="fa fa-calculator" style="margin-right:6px;"></i> Open BMI Calculator
        </a>
        <div style="display:flex; gap:10px;">
          <a href="https://www.facebook.com/harsh.mankame" target="_blank" rel="noopener" aria-label="Facebook"
            style="width:38px; height:38px; border-radius:50%; background:rgba(255,255,255,0.06); display:inline-flex; align-items:center; justify-content:center; color:#fff; text-decoration:none; transition:all 0.2s;">
            <i class="fa-brands fa-facebook-f fa-facebook"></i>
          </a>
          <a href="https://www.instagram.com/bhushan_dhende_mr.x_?igsh=MTlxbzZidWljdDEzcQ%3D%3D&utm_source=qr" target="_blank" rel="noopener" aria-label="Instagram"
            style="width:38px; height:38px; border-radius:50%; background:rgba(255,255,255,0.06); display:inline-flex; align-items:center; justify-content:center; color:#fff; text-decoration:none; transition:all 0.2s;">
            <i class="fa-brands fa-instagram fa-instagram"></i>
          </a>
          <a href="https://www.linkedin.com/in/shubham-bharekar-844657246" target="_blank" rel="noopener" aria-label="LinkedIn"
            style="width:38px; height:38px; border-radius:50%; background:rgba(255,255,255,0.06); display:inline-flex; align-items:center; justify-content:center; color:#fff; text-decoration:none; transition:all 0.2s;">
            <i class="fa-brands fa-linkedin-in fa-linkedin"></i>
          </a>
          <a href="https://github.com/callmeX34" target="_blank" rel="noopener" aria-label="GitHub"
            style="width:38px; height:38px; border-radius:50%; background:rgba(255,255,255,0.06); display:inline-flex; align-items:center; justify-content:center; color:#fff; text-decoration:none; transition:all 0.2s;">
            <i class="fa-brands fa-github fa-github"></i>
          </a>
        </div>
      </div>
    </div>

    <!-- Bottom Bar -->
    <div class="row" style="border-top:1px solid rgba(255,255,255,0.08); padding-top:24px; font-size:13px;">
      <div class="col-md-6 col-sm-6 text-left">
        <p style="margin:0; color:#64748b;">
          &copy; <?php echo date('Y'); ?> <span style="color:#e2e8f0; font-weight:600;">Lean'N'Green</span>. All rights reserved.
        </p>
      </div>
      <div class="col-md-6 col-sm-6 text-right">
        <p style="margin:0; color:#64748b;">
          Crafted by <a href="https://github.com/callmeX34" target="_blank" rel="noopener" style="color:#10b981; font-weight:600; text-decoration:none;">callmeX</a>
        </p>
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