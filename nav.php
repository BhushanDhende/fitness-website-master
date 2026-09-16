<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$isLoggedIn = isset($_SESSION['id']);

include('db.php'); // Include database connection file

// Logout logic
if (isset($_POST['logout'])) {
  session_destroy();
  echo "<script>window.location='index.php';</script>";
  exit;
}

// Signup logic
if (isset($_POST['signup'])) {
  if (empty($conn)) {
    echo "<script>alert('Database connection is not available yet.');</script>";
  } else {
    $name = $conn->real_escape_string($_POST['signup_name']);
    $user = $conn->real_escape_string($_POST['signup_username']);
    $email = $conn->real_escape_string($_POST['signup_email']);
    $pass = password_hash($_POST['signup_password'], PASSWORD_DEFAULT);

    // Check if username or email exists
    $check = $conn->query("SELECT * FROM users WHERE username='$user' OR email='$email'");
    if ($check && $check->num_rows > 0) {
      echo "<script>alert('Username or Email already exists!');</script>";
    } else {
      $sql = "INSERT INTO users (name, username, email, password) VALUES ('$name', '$user', '$email', '$pass')";
      if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Signup successful! You can now login.');</script>";
      } else {
        echo "<script>alert('Signup failed!');</script>";
      }
    }
  }
}

// Login logic
if (isset($_POST['login'])) {
  $user = isset($_POST['login_username']) ? trim($_POST['login_username']) : '';
  $pass = isset($_POST['login_password']) ? $_POST['login_password'] : '';

  if (($user == 'harsh' && $pass == 'admin') || ($user == 'bhushan' && $pass == 'admin')) {
    $_SESSION['auth'] = true;
    $_SESSION['uname'] = $user;
    $_SESSION['pass'] = $pass;
    echo "<script>alert('Admin Login successful!'); window.location='admin/html/index.php';</script>";
    exit;
  }

  if (empty($conn)) {
    echo "<script>alert('Database connection is not available yet.');</script>";
  } else {
    $userEscaped = $conn->real_escape_string($user);
    $sql = "SELECT * FROM users WHERE username='$userEscaped'";
    $result = $conn->query($sql);
    if ($result && $result->num_rows == 1) {
      $row = $result->fetch_assoc();
      if (password_verify($pass, $row['password'])) {
        $_SESSION['id'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        echo "<script>alert('Login successful!'); window.location='index.php';</script>";
        exit;
      } else {
        echo "<script>alert('Invalid password!');</script>";
      }
    } else {
      echo "<script>alert('User not found!');</script>";
    }
  }
}
?>

<!-- High-Speed CDN Icons (Guarantees zero missing icon boxes on InfinityFree / any server) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<!-- Start header -->
<header id="header">
  <!-- header top search -->
  <div class="header-top">
    <div class="container">
      <form action="search.php" method="GET">
        <div id="search">
          <input type="text" placeholder="Search workouts, plant protein, muscle anatomy, BMI..." name="q" id="m_search" style="display: inline-block;">
          <button type="submit" aria-label="Search">
            <i class="fa fa-search"></i>
          </button>
        </div>
      </form>
    </div>
  </div>
  <!-- header bottom -->
  <div class="header-bottom">
    <div class="container">
      <div class="row" style="display:flex; align-items:center;">
        <div class="col-md-7 col-sm-7 col-xs-7">
          <div class="header-contact">
            <ul>
              <li>
                <div class="phone">
                  <i class="fa fa-phone"></i>
                  <span>+91-7021779054</span>
                </div>
              </li>
              <li>
                <div class="mail hidden-xs">
                  <i class="fa fa-envelope"></i>
                  <span>bhushandhende34@gmail.com</span>
                </div>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-md-5 col-sm-5 col-xs-5">
          <div class="header-login">
            <?php if ($isLoggedIn): ?>
              <form method="post" style="display:inline;">
                <button type="submit" name="logout" class="logout-btn-custom">
                  <i class="fa fa-sign-out"></i> Logout (<?= htmlspecialchars($_SESSION['username'] ?? 'User'); ?>)
                </button>
              </form>
            <?php else: ?>
              <a class="login-btn-custom" data-target="#login-form" data-toggle="modal" href="#">
                <i class="fa fa-user"></i> Login / Sign Up
              </a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>
<!-- End header -->

<!-- Start login modal window -->
<div aria-hidden="true" role="dialog" tabindex="-1" id="login-form" class="modal leread-modal fade">
  <div class="modal-dialog">
    <div class="modal-content" style="border-radius:16px; overflow:hidden; border:none; box-shadow:0 20px 40px rgba(0,0,0,0.2);">
      <!-- Login Section -->
      <div id="login-content">
        <div class="modal-header" style="background:#0f172a; color:#fff; padding:18px 24px; border:none;">
          <button aria-label="Close" data-dismiss="modal" class="close" type="button" style="color:#fff; opacity:0.8;"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" style="font-family:'Outfit',sans-serif; font-weight:700; display:flex; align-items:center; gap:8px;">
            <i class="fa fa-lock" style="color:#10b981;"></i> Welcome Back
          </h4>
        </div>
        <div class="modal-body" style="padding:28px 24px;">
          <form method="post" action="">
            <div class="form-group" style="margin-bottom:18px;">
              <label style="font-size:13px; font-weight:600; color:#475569; margin-bottom:6px;">Username</label>
              <input type="text" name="login_username" placeholder="Enter your username" class="form-control" style="height:46px; border-radius:10px; border:1px solid #cbd5e1;" required>
            </div>
            <div class="form-group" style="margin-bottom:20px;">
              <label style="font-size:13px; font-weight:600; color:#475569; margin-bottom:6px;">Password</label>
              <input type="password" name="login_password" placeholder="Enter your password" class="form-control" style="height:46px; border-radius:10px; border:1px solid #cbd5e1;" required>
            </div>
            <div class="loginbox" style="display:flex; justify-content:space-between; align-items:center; margin-top:20px;">
              <label style="font-weight:normal; font-size:13px; color:#64748b;"><input type="checkbox" style="margin-right:6px;"> Remember me</label>
              <button class="btn" type="submit" name="login" style="background:linear-gradient(135deg, #10b981, #059669); color:#fff; font-weight:600; padding:10px 24px; border-radius:10px; border:none; box-shadow:0 4px 12px rgba(16,185,129,0.3);">
                Sign In
              </button>
            </div>
          </form>
        </div>
        <div class="modal-footer footer-box" style="background:#f8fafc; border-top:1px solid #e2e8f0; padding:16px 24px; display:flex; justify-content:space-between; font-size:13px;">
          <span style="color:#64748b;">No account? <a id="signup-btn" href="#" style="color:#10b981; font-weight:600;">Create Account</a></span>
          <span style="color:#94a3b8; font-size:11px;">Admin demo: harsh / admin</span>
        </div>
      </div>
      <!-- Signup Section -->
      <div id="signup-content" style="display:none;">
        <div class="modal-header" style="background:#0f172a; color:#fff; padding:18px 24px; border:none;">
          <button aria-label="Close" data-dismiss="modal" class="close" type="button" style="color:#fff; opacity:0.8;"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" style="font-family:'Outfit',sans-serif; font-weight:700; display:flex; align-items:center; gap:8px;">
            <i class="fa fa-user-plus" style="color:#10b981;"></i> Join Lean'N'Green
          </h4>
        </div>
        <div class="modal-body" style="padding:28px 24px;">
          <form method="post" action="">
            <div class="form-group" style="margin-bottom:14px;">
              <label style="font-size:13px; font-weight:600; color:#475569; margin-bottom:4px;">Full Name</label>
              <input name="signup_name" placeholder="John Doe" class="form-control" style="height:44px; border-radius:8px; border:1px solid #cbd5e1;" required>
            </div>
            <div class="form-group" style="margin-bottom:14px;">
              <label style="font-size:13px; font-weight:600; color:#475569; margin-bottom:4px;">Username</label>
              <input name="signup_username" placeholder="johndoe" class="form-control" style="height:44px; border-radius:8px; border:1px solid #cbd5e1;" required>
            </div>
            <div class="form-group" style="margin-bottom:14px;">
              <label style="font-size:13px; font-weight:600; color:#475569; margin-bottom:4px;">Email</label>
              <input name="signup_email" placeholder="john@example.com" class="form-control" style="height:44px; border-radius:8px; border:1px solid #cbd5e1;" required type="email">
            </div>
            <div class="form-group" style="margin-bottom:18px;">
              <label style="font-size:13px; font-weight:600; color:#475569; margin-bottom:4px;">Password</label>
              <input type="password" name="signup_password" placeholder="Create password" class="form-control" style="height:44px; border-radius:8px; border:1px solid #cbd5e1;" required>
            </div>
            <div style="display:flex; justify-content:space-between; align-items:center; margin-top:16px;">
              <span style="font-size:13px; color:#64748b;">Have an account? <a id="login-btn" href="#" style="color:#10b981; font-weight:600;">Sign In</a></span>
              <button class="btn" type="submit" name="signup" style="background:linear-gradient(135deg, #10b981, #059669); color:#fff; font-weight:600; padding:10px 24px; border-radius:10px; border:none;">
                Register
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End login modal window -->

<script>
  document.addEventListener("DOMContentLoaded", function () {
    var signupBtn = document.getElementById('signup-btn');
    var loginBtn = document.getElementById('login-btn');
    var loginContent = document.getElementById('login-content');
    var signupContent = document.getElementById('signup-content');
    if (signupBtn && loginBtn && loginContent && signupContent) {
      signupBtn.addEventListener('click', function (e) {
        e.preventDefault();
        loginContent.style.display = 'none';
        signupContent.style.display = 'block';
      });
      loginBtn.addEventListener('click', function (e) {
        e.preventDefault();
        signupContent.style.display = 'none';
        loginContent.style.display = 'block';
      });
    }
  });
</script>

<!-- BEGIN MENU -->
<section id="menu-area">
  <nav class="navbar navbar-default" role="navigation">
    <div class="container">
      <div class="navbar-header">
        <!-- FOR MOBILE VIEW COLLAPSED BUTTON -->
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
          aria-expanded="false" aria-controls="navbar" style="border-color:#10b981; margin-top:18px;">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar" style="background:#10b981;"></span>
          <span class="icon-bar" style="background:#10b981;"></span>
          <span class="icon-bar" style="background:#10b981;"></span>
        </button>
        <!-- BRAND LOGO -->
        <a class="navbar-brand-custom" href="index.php" title="Lean'N'Green Home">
          <img src="assets/images/lean-green-logo.svg" alt="Lean'N'Green Logo" class="img-responsive">
        </a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <?php
        $currentPage = basename(urldecode($_SERVER['PHP_SELF']));
        ?>
        <ul id="top-menu" class="nav navbar-nav navbar-right main-nav">
          <li class="<?php echo ($currentPage == 'index.php' || $currentPage == '') ? 'active' : ''; ?>">
            <a href="index.php">Home</a>
          </li>
          <li class="dropdown <?php echo ($currentPage == 'Muscles.php' || $currentPage == 'Terminolgies.php' || $currentPage == 'Plant-Protein.php') ? 'active' : ''; ?>">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              Basic <i class="fa fa-angle-down"></i>
            </a>
            <ul class="dropdown-menu" role="menu">
              <li class="<?php echo ($currentPage == 'Muscles.php') ? 'active' : ''; ?>"><a href="Muscles.php"><i class="fa fa-cube" style="margin-right:8px; color:#10b981;"></i>Muscles</a></li>
              <li class="<?php echo ($currentPage == 'Terminolgies.php') ? 'active' : ''; ?>"><a href="Terminolgies.php"><i class="fa fa-book" style="margin-right:8px; color:#10b981;"></i>Terminologies</a></li>
              <li class="<?php echo ($currentPage == 'Plant-Protein.php') ? 'active' : ''; ?>"><a href="Plant-Protein.php"><i class="fa fa-leaf" style="margin-right:8px; color:#10b981;"></i>Plant Protein</a></li>
            </ul>
          </li>
          <li class="dropdown <?php echo ($currentPage == 'cardio.php' || $currentPage == 'Anatomy-and-Exercises.php' || $currentPage == 'Chest.php' || $currentPage == 'Arms.php' || $currentPage == 'Legs.php' || $currentPage == 'Back.php' || $currentPage == 'Shoulder.php' || $currentPage == 'Abdomen.php') ? 'active' : ''; ?>">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              Workout <i class="fa fa-angle-down"></i>
            </a>
            <ul class="dropdown-menu" role="menu">
              <li class="<?php echo ($currentPage == 'cardio.php') ? 'active' : ''; ?>"><a href="cardio.php"><i class="fa fa-heartbeat" style="margin-right:8px; color:#10b981;"></i>Cardio</a></li>
              <li class="<?php echo ($currentPage == 'Anatomy-and-Exercises.php') ? 'active' : ''; ?>"><a href="Anatomy-and-Exercises.php"><i class="fa fa-dumbbell" style="margin-right:8px; color:#10b981;"></i>Anatomy & Exercises</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="Chest.php">Chest Workouts</a></li>
              <li><a href="Arms.php">Arms Workouts</a></li>
              <li><a href="Back.php">Back Workouts</a></li>
              <li><a href="Legs.php">Legs Workouts</a></li>
              <li><a href="Shoulder.php">Shoulder Workouts</a></li>
              <li><a href="Abdomen.php">Abdomen Workouts</a></li>
            </ul>
          </li>
          <li class="dropdown <?php echo ($currentPage == 'Vegan-Diet-Plan.php' || $currentPage == 'Workout-Routine.php') ? 'active' : ''; ?>">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              Plans <i class="fa fa-angle-down"></i>
            </a>
            <ul class="dropdown-menu" role="menu">
              <li class="<?php echo ($currentPage == 'Vegan-Diet-Plan.php') ? 'active' : ''; ?>"><a href="Vegan-Diet-Plan.php"><i class="fa fa-apple-alt" style="margin-right:8px; color:#10b981;"></i>Vegan Diet Plan</a></li>
              <li class="<?php echo ($currentPage == 'Workout-Routine.php') ? 'active' : ''; ?>"><a href="Workout-Routine.php"><i class="fa fa-calendar-check" style="margin-right:8px; color:#10b981;"></i>Workout Routine</a></li>
            </ul>
          </li>
          <li class="<?php echo ($currentPage == 'BMI-calc.php') ? 'active' : ''; ?>">
            <a href="BMI-calc.php">BMI Cal</a>
          </li>
          <li class="<?php echo ($currentPage == 'food-nutrtion.php') ? 'active' : ''; ?>">
            <a href="food-nutrtion.php">Nutrition</a>
          </li>
          <li class="<?php echo ($currentPage == 'Ebooks.php') ? 'active' : ''; ?>">
            <a href="Ebooks.php">Ebooks</a>
          </li>
          <li class="dropdown <?php echo ($currentPage == 'exercise-done.php' || $currentPage == 'user-setting.php') ? 'active' : ''; ?>">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              Profile <i class="fa fa-angle-down"></i>
            </a>
            <ul class="dropdown-menu" role="menu">
              <li class="<?php echo ($currentPage == 'exercise-done.php') ? 'active' : ''; ?>"><a href="exercise-done.php"><i class="fa fa-check-circle" style="margin-right:8px; color:#10b981;"></i>Exercise Log</a></li>
              <li class="<?php echo ($currentPage == 'user-setting.php') ? 'active' : ''; ?>"><a href="user-setting.php"><i class="fa fa-cog" style="margin-right:8px; color:#10b981;"></i>Account Settings</a></li>
            </ul>
          </li>
        </ul>
      </div><!--/.nav-collapse -->
      <a href="#" id="search-icon" title="Search">
        <i class="fa fa-search"></i>
      </a>
    </div>
  </nav>
</section>
<!-- END MENU -->