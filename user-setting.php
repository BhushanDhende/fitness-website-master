<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Lean'N'Green : Setting</title>
  <!-- Favicon -->
  <link rel="shortcut icon" type="image/icon" href="assets/images/favicon.ico" />
  <!-- Font Awesome -->
  <link href="assets/css/font-awesome.css" rel="stylesheet">
  <!-- Bootstrap -->
  <link href="assets/css/bootstrap.css" rel="stylesheet">
  <!-- Slick slider -->
  <link rel="stylesheet" type="text/css" href="assets/css/slick.css" />
  <!-- Fancybox slider -->
  <link rel="stylesheet" href="assets/css/jquery.fancybox.css" type="text/css" media="screen" />
  <!-- Animate css -->
  <link rel="stylesheet" type="text/css" href="assets/css/animate.css" />
  <!-- Bootstrap progressbar  -->
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-progressbar-3.3.4.css" />
  <!-- Theme color -->
  <link id="switcher" href="assets/css/theme-color/default-theme.css" rel="stylesheet">

  <!-- Main Style -->
  <link href="style.css" rel="stylesheet">

  <!-- Fonts -->

  <!-- Open Sans for body font -->
  <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
  <!-- Lato for Title -->
  <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>


  <!-- BEGAIN PRELOADER -->
  <div id="preloader">
    <div id="status">&nbsp;</div>
  </div>
  <!-- END PRELOADER -->

  <!-- SCROLL TOP BUTTON -->
  <a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
  <!-- END SCROLL TOP BUTTON -->
  <?php
  include('nav.php');
  ?>

  <!-- END MENU -->

  <!-- Start single page header -->
  <section id="single-page-header4">
    <div class="overlay">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="single-page-header-left">
              <h2>Setting</h2>
              <!--                <p><blockquote>Fitness is not about being better that someone else...<br>Its about being than you used to be</blockquote></p>-->
            </div>
          </div>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="single-page-header-right">
              <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Profile</li>
                <li class="active">Setting</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- End single page header -->
  <!-- Start error section  -->

  <!-- Start error section  -->
  <section id="error">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="errror-page-area">
            <!--            <h1 class="error-title"><span class="fa fa-bug"></span></h1>-->
            <div class="error-content">
              <!--              <span>Opps!</span>-->
              <?php
              // Assume user is logged in and user id is stored in session
              $user_id = $_SESSION['id'];
              $fullname = $username = $email = '';

              include('db.php');

              if (!$user_id) {
                echo "<p>User not logged in.</p>";
              } else {
                $stmt = $conn->prepare("SELECT name, username, email FROM users WHERE id = ?");
                $stmt->bind_param("i", $user_id);
                if ($stmt->execute()) {
                  $stmt->bind_result($fullname, $username, $email);
                  if (!$stmt->fetch()) {
                    $fullname = $username = $email = 'Not found';
                  }
                } else {
                  echo "<p>Error fetching user data.</p>";
                }
                $stmt->close();
              }

              if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
                $new_fullname = trim($_POST['fullname']);
                $new_username = trim($_POST['username']);
                $new_email = trim($_POST['email']);

                // Simple validation
                if ($new_fullname && $new_username && $new_email) {
                  $stmt = $conn->prepare("UPDATE users SET name = ?, username = ?, email = ? WHERE id = ?");
                  $stmt->bind_param("sssi", $new_fullname, $new_username, $new_email, $user_id);
                  if ($stmt->execute()) {
                    $fullname = $new_fullname;
                    $username = $new_username;
                    $email = $new_email;
                    echo '<div class="alert alert-success">Profile updated successfully.</div>';
                  } else {
                    echo '<div class="alert alert-danger">Error updating profile.</div>';
                  }
                  $stmt->close();
                } else {
                  echo '<div class="alert alert-warning">All fields are required.</div>';
                }
              }
              ?>
              <div class="row" style="max-width:900px;margin:20px auto;">
                <!-- Profile Table (Left) -->
                <div class="col-md-6">
                  <div class="card mb-4">
                    <div class="card-header">
                      <h3>Profile</h3>
                    </div>
                    <div class="card-body">
                      <table class="table table-bordered">
                        <tr>
                          <th>Full Name</th>
                          <td><?php echo htmlspecialchars($fullname); ?></td>
                        </tr>
                        <tr>
                          <th>Username</th>
                          <td><?php echo htmlspecialchars($username); ?></td>
                        </tr>
                        <tr>
                          <th>Email</th>
                          <td><?php echo htmlspecialchars($email); ?></td>
                        </tr>
                      </table>
                    </div>
                  </div>
                </div>
                <!-- Edit Profile Form (Right) -->
                <div class="col-md-6">
                  <div class="card mb-4">
                  <div class="card-header">
                    <h3>Edit Profile</h3>
                  </div>
                  <div class="card-body">
                    <form method="post" action="">
                    <table class="table table-bordered">
                      <tr>
                      <th><label for="fullname">Full Name</label></th>
                      <td>
                        <input type="text" class="form-control" id="fullname" name="fullname" value="<?php echo htmlspecialchars($fullname); ?>" required>
                      </td>
                      </tr>
                      <tr>
                      <th><label for="username">Username</label></th>
                      <td>
                        <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
                      </td>
                      </tr>
                      <tr>
                      <th><label for="email">Email</label></th>
                      <td>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                      </td>
                      </tr>
                      <tr>
                      <td colspan="2" class="text-center">
                        <button type="submit" name="update_profile" class="btn btn-primary comment-btn">Save Changes</button>
                      </td>
                      </tr>
                    </table>
                    </form>
                  </div>
                  </div>
                </div>


                <!-- Change Password Form (Bottom) -->
                <div class="col-md-12" style="margin-top:30px;">
                  <div class="card mb-4">
                    <div class="card-header">
                      <h3>Change Password</h3>
                    </div>
                    <div class="card-body">
                      <?php
                      if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_password'])) {
                        $old_password = $_POST['old_password'] ?? '';
                        $new_password = $_POST['new_password'] ?? '';
                        $re_password = $_POST['re_password'] ?? '';

                        if ($old_password && $new_password && $re_password) {
                          if ($new_password !== $re_password) {
                            echo '<div class="alert alert-warning">New passwords do not match.</div>';
                          } else {
                            // Fetch current password hash
                            $stmt = $conn->prepare("SELECT password FROM users WHERE id = ?");
                            $stmt->bind_param("i", $user_id);
                            $stmt->execute();
                            $stmt->bind_result($db_password_hash);
                            if ($stmt->fetch()) {
                              if (password_verify($old_password, $db_password_hash)) {
                                $stmt->close();
                                $new_password_hash = password_hash($new_password, PASSWORD_DEFAULT);
                                $stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
                                $stmt->bind_param("si", $new_password_hash, $user_id);
                                if ($stmt->execute()) {
                                  echo '<div class="alert alert-success">Password changed successfully.</div>';
                                } else {
                                  echo '<div class="alert alert-danger">Error updating password.</div>';
                                }
                                $stmt->close();
                              } else {
                                echo '<div class="alert alert-danger">Old password is incorrect.</div>';
                                $stmt->close();
                              }
                            } else {
                              echo '<div class="alert alert-danger">User not found.</div>';
                              $stmt->close();
                            }
                          }
                        } else {
                          echo '<div class="alert alert-warning">All fields are required.</div>';
                        }
                      }
                      ?>
                      <form method="post" action="">
                        <table class="table table-bordered">
                          <tr>
                            <th><label for="old_password">Old Password</label></th>
                            <td>
                              <input type="password" class="form-control" id="old_password" name="old_password" required>
                            </td>
                          </tr>
                          <tr>
                            <th><label for="new_password">New Password</label></th>
                            <td>
                              <input type="password" class="form-control" id="new_password" name="new_password" required>
                            </td>
                          </tr>
                          <tr>
                            <th><label for="re_password">Re-enter New Password</label></th>
                            <td>
                              <input type="password" class="form-control" id="re_password" name="re_password" required>
                            </td>
                          </tr>
                          <tr>
                            <td colspan="2" class="text-center">
                              <button type="submit" name="change_password" class="btn btn-warning comment-btn">Change Password</button>
                            </td>
                          </tr>
                        </table>
                      </form>
                    </div>
                  </div>
                </div>
              </div>

              <!--              <a class="error-home" href="index.html">Home Page</a>-->
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- End error section  -->
  <?php include('footer.php'); ?>

  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <!-- Bootstrap -->
  <script src="assets/js/bootstrap.js"></script>
  <!-- Slick Slider -->
  <script type="text/javascript" src="assets/js/slick.js"></script>
  <!-- mixit slider -->
  <script type="text/javascript" src="assets/js/jquery.mixitup.js"></script>
  <!-- Add fancyBox -->
  <script type="text/javascript" src="assets/js/jquery.fancybox.pack.js"></script>
  <!-- counter -->
  <script src="assets/js/waypoints.js"></script>
  <script src="assets/js/jquery.counterup.js"></script>
  <!-- Wow animation -->
  <script type="text/javascript" src="assets/js/wow.js"></script>
  <!-- progress bar   -->
  <script type="text/javascript" src="assets/js/bootstrap-progressbar.js"></script>


  <!-- Custom js -->
  <script type="text/javascript" src="assets/js/custom.js"></script>

</body>

</html>