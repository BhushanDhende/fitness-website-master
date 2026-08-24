<?php
session_start();
$isLoggedIn = isset($_SESSION['id']);

// echo '<pre>';
// print_r($_SESSION);
// echo '</pre>';

?>

<!-- Start header -->
<header id="header">
  <!-- header top search -->
  <div class="header-top">
    <div class="container">
      <form action="">
        <div id="search">
          <input type="text" placeholder="Type your search keyword here and hit Enter..." name="s" id="m_search"
            style="display: inline-block;">
          <button type="submit">
            <i class="fa fa-search"></i>
          </button>
        </div>
      </form>
    </div>
  </div>
  <!-- header bottom -->
  <div class="header-bottom">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-6">
          <div class="header-contact">
            <ul>
              <li>
                <div class="phone">
                  <i class="fa fa-phone"></i>
                  +91-7021779054
                </div>
              </li>
              <li>
                <div class="mail">
                  <i class="fa fa-envelope"></i>
                  bhushandhende34@gmail.com
                </div>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-6">
          <div class="header-login">
            <style>
              .header-login .btn.btn-primary.btn-sm {
              background-color: #fff !important;
              color:#949494 !important;
              border-color:#949494 !important;
              }
              .header-login .btn.btn-primary.btn-sm:hover,
              .header-login .btn.btn-primary.btn-sm:focus {
              background-color: #2bcdc1 !important;
              color: #fff !important;
              border-color: #337ab7 !important;
              }
            </style>
            <?php if ($isLoggedIn): ?>
              <form method="post" style="display:inline;">
              <button type="submit" name="logout" class="login modal-form btn btn-primary btn-sm">
              Logout ( <?= htmlspecialchars($_SESSION['username']); ?> )
              </button>
              </form>
            <?php else: ?>
              <a class="login modal-form btn btn-primary btn-sm" data-target="#login-form" data-toggle="modal"
              href="#">Login / Sign Up</a>
            <?php endif; ?>
          </div>


        </div>
      </div>
    </div>
  </div>
</header>
<!-- End header -->





<!-- Start login modal window -->
<div aria-hidden="false" role="dialog" tabindex="-1" id="login-form" class="modal leread-modal fade in">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Login Section -->
      <div id="login-content">
        
        <div class="modal-body">
          <form method="post" action="">
            <div class="form-group">
              <input type="text" name="login_username" placeholder="User name" class="form-control" required>
            </div>
            <div class="form-group">
              <input type="password" name="login_password" placeholder="Password" class="form-control" required>
            </div>
            <div class="loginbox">
              <label><input type="checkbox"><span>Remember me</span></label>
              <button class="btn signin-btn" type="submit" name="login">SIGN IN</button>
            </div>
          </form>
        </div>
        <div class="modal-footer footer-box">
          <a href="#">Forgot password ?</a>
          <span>No account ? <a id="signup-btn" href="#">Sign Up.</a></span>
        </div>
      </div>
      <!-- Signup Section -->
      <div id="signup-content" style="display:none;">
        <div class="modal-header">
          <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span
              aria-hidden="true">×</span></button>
          <h4 class="modal-title"><i class="fa fa-lock"></i>Sign Up</h4>
        </div>
        <div class="modal-body">
          <form method="post" action="">
            <div class="form-group">
              <input name="signup_name" placeholder="Name" class="form-control" required>
            </div>
            <div class="form-group">
              <input name="signup_username" placeholder="Username" class="form-control" required>
            </div>
            <div class="form-group">
              <input name="signup_email" placeholder="Email" class="form-control" required type="email">
            </div>
            <div class="form-group">
              <input type="password" name="signup_password" placeholder="Password" class="form-control" required>
            </div>
            <div class="signupbox">
              <span>Already got account? <a id="login-btn" href="#">Sign In.</a></span>
            </div>
            <div class="loginbox">
              <label><input type="checkbox"><span>Remember me</span><i class="fa"></i></label>
              <button class="btn signin-btn" type="submit" name="signup">SIGN UP</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End login modal window -->

<script>
  // Toggle between login and signup forms in modal
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

<?php
// Database connection
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "fitness_db"; // Make sure this database exists

// $conn = new mysqli($servername, $username, $password, $dbname);
// if ($conn->connect_error) {
//   die("Connection failed: " . $conn->connect_error);
// }


include('db.php'); // Include your database connection file


// Logout logic
if (isset($_POST['logout'])) {
  session_destroy();
  echo "<script>window.location='index.php';</script>";
  exit;
}

// Signup logic
if (isset($_POST['signup'])) {
  $name = $conn->real_escape_string($_POST['signup_name']);
  $user = $conn->real_escape_string($_POST['signup_username']);
  $email = $conn->real_escape_string($_POST['signup_email']);
  $pass = password_hash($_POST['signup_password'], PASSWORD_DEFAULT);

  // Check if username or email exists
  $check = $conn->query("SELECT * FROM users WHERE username='$user' OR email='$email'");
  if ($check->num_rows > 0) {
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

// Login logic
if (isset($_POST['login'])) {
  $user = $conn->real_escape_string($_POST['login_username']);
  $pass = $_POST['login_password'];

  if($user=='harsh' && $pass=='admin' || $user=='bhushan' && $pass=='admin' ){

    $_SESSION['auth']=true;

    $_SESSION['uname']=$user;
    $_SESSION['pass']=$pass;

    echo "<script>alert('Admin Login successful!'); window.location='admin/html/index.php';</script>";
}


  $sql = "SELECT * FROM users WHERE username='$user'";
  $result = $conn->query($sql);
  if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    if (password_verify($pass, $row['password'])) {
      $_SESSION['id'] = $row['id']; // Store user id in session
      $_SESSION['username'] = $row['username']; // Optional: store username if needed elsewhere
      echo "<script>alert('Login successful!'); window.location='index.php';</script>";
    } else {
      echo "<script>alert('Invalid password!');</script>";
    }
  } else {
    echo "<script>alert('User not found!');</script>";
  }
}

?>



<!-- BEGIN MENU -->
<section id="menu-area">
  <nav class="navbar navbar-default" role="navigation">
    <div class="container">
      <div class="navbar-header">
        <!-- FOR MOBILE VIEW COLLAPSED BUTTON -->
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
          aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <!-- LOGO -->
        <!-- TEXT BASED LOGO -->
        <a class="navbar-brand" href="index.php">Lean'N'Green</a>
        <!-- IMG BASED LOGO  -->
        <!--            <a class="navbar-brand" href="index.html"><img src="assets/images/New-LeanNGreen.png" alt="logo" width="200" height="100"></a> -->
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <?php
        // Get current file name (decode for spaces)
        $currentPage = basename(urldecode($_SERVER['PHP_SELF']));
        ?>
        <ul id="top-menu" class="nav navbar-nav navbar-right main-nav">
          <li class="<?php echo ($currentPage == 'index.php') ? 'active' : ''; ?>"><a href="index.php">Home</a></li>
          <li
            class="dropdown <?php echo ($currentPage == 'Muscles.php' || $currentPage == 'Terminolgies.php' || $currentPage == 'Plant-Protein.php') ? 'active' : ''; ?>">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">BASIC <span class="fa fa-angle-down"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li class="<?php echo ($currentPage == 'Muscles.php') ? 'active' : ''; ?>"><a
                  href="Muscles.php">Muscles</a></li>
              <li class="<?php echo ($currentPage == 'Terminolgies.php') ? 'active' : ''; ?>"><a
                  href="Terminolgies.php">Terminologies</a></li>
                  <li class="<?php echo ($currentPage == 'Plant-Protein.php') ? 'active' : ''; ?>"><a
                  href="Plant-Protein.php">PLANT PROTEIN</a></li>
            </ul>
          </li>
          <!--<li><a href="service.html">Service</a></li>-->
          <li
            class="dropdown <?php echo ($currentPage == 'cardio.php' || $currentPage == 'Anatomy-and-Exercises.php') ? 'active' : ''; ?>">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">WORKOUT <span
                class="fa fa-angle-down"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li class="<?php echo ($currentPage == 'cardio.php') ? 'active' : ''; ?>"><a href="cardio.php">Cardio</a>
              </li>
              <li class="<?php echo ($currentPage == 'Anatomy-and-Exercises.php') ? 'active' : ''; ?>"><a
                  href="Anatomy-and-Exercises.php">Anatomy and Exercises</a></li>
            </ul>
          </li>
         
          <li
            class="dropdown <?php echo ($currentPage == 'Vegan-Diet-Plan.php' || $currentPage == 'Workout-Routine.php') ? 'active' : ''; ?>">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">PLANS <span class="fa fa-angle-down"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li class="<?php echo ($currentPage == 'Vegan-Diet-Plan.php') ? 'active' : ''; ?>"><a
                  href="Vegan-Diet-Plan.php">Vegan Diet Plan</a></li>
              <li class="<?php echo ($currentPage == 'Workout-Routine.php') ? 'active' : ''; ?>"><a
                  href="Workout-Routine.php">Workout Routine</a></li>
            </ul>
          </li>
          <li class="<?php echo ($currentPage == 'BMI-calc.php') ? 'active' : ''; ?>"><a href="BMI-calc.php">BMI CAL</a>
          </li>
          <li class="<?php echo ($currentPage == 'food-nutrtion.php') ? 'active' : ''; ?>"><a
              href="food-nutrtion.php">Food Nutrtion</a></li>
              <li class="<?php echo ($currentPage == 'Ebooks.php') ? 'active' : ''; ?>"><a href="Ebooks.php">EBOOKS</a></li>
          </li>
          <li
            class="dropdown <?php echo ($currentPage == 'exercise-done.php' || $currentPage == 'Setting.php') ? 'active' : ''; ?>">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Profile <span
                class="fa fa-angle-down"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li class="<?php echo ($currentPage == 'exercise-done.php') ? 'active' : ''; ?>"><a href="exercise-done.php">Exercise Done</a>
              </li>
              <li class="<?php echo ($currentPage == 'user-setting.php') ? 'active' : ''; ?>"><a href="user-setting.php">Setting</a></li>
            </ul>
          </li>
        </ul>
      </div><!--/.nav-collapse -->
      <a href="#" id="search-icon">
        <i class="fa fa-search">
        </i>
      </a>
    </div>
  </nav>
</section>
<!-- END MENU -->