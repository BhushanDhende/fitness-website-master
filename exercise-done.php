<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Lean'N'Green : Anatomy and Workout</title>
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
              <h2>Exercise done</h2>
              <!--                <p><blockquote>Fitness is not about being better that someone else...<br>Its about being than you used to be</blockquote></p>-->
            </div>
          </div>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="single-page-header-right">
              <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Profile</li>
                <li class="active">Exercise Done</li>
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
              // Start session if not already started
              if (session_status() == PHP_SESSION_NONE) {
                session_start();
              }

              // Check if user is logged in
              if (!isset($_SESSION['id'])) {
                echo '<div class="alert alert-warning">Login required to view your exercise log!</div>';
                echo '<button class="btn btn-warning" onclick="window.location.href=\'login.php\'">Go to Login</button>';
                return;
              }

              // Database connection
              include('db.php');

              
              // Fetch user's logged "Back" exercises, ordered by date
              $user_id = $_SESSION['id'];
              $query = "SELECT * FROM user_exercises WHERE user_id = :user_id ORDER BY date_performed DESC, id ASC";
              $stmt = $pdo->prepare($query);
              $stmt->execute(['user_id' => $user_id]);
              $user_exercises = $stmt->fetchAll(PDO::FETCH_ASSOC);
              ?>

              <h1>Your Logged Exercises</h1>

              <?php if (empty($user_exercises)): ?>
                <div class="alert alert-info">You have not logged any Back exercises yet.</div>
              <?php else: ?>
                <div class="table-responsive">
                  <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>Date</th>
                      <th>Exercise Name</th>
                      <th>Sets</th>
                      <th>Reps (min)</th>
                      <th>Weight kg</th>
                      <th>Calories Burned</th>
                      <th>Fat Loss (grams)</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $current_date = null;
                    $date_totals = [
                      'calories_burned' => 0,
                      'fat_loss_grams' => 0
                    ];
                    foreach ($user_exercises as $idx => $ex):
                      // If this is a new date, reset totals
                      if ($current_date !== $ex['date_performed']) {
                        $current_date = $ex['date_performed'];
                        $date_totals = [
                          'calories_burned' => 0,
                          'fat_loss_grams' => 0
                        ];
                      }
                      // Add to totals
                      $date_totals['calories_burned'] += (int)$ex['calories_burned'];
                      $date_totals['fat_loss_grams'] += (int)$ex['fat_loss_grams'];
                      ?>
                      <tr>
                        <td><?= htmlspecialchars($ex['date_performed']) ?></td>
                        <td><?= htmlspecialchars($ex['name']) ?></td>
                        <td><?= htmlspecialchars($ex['sets']) ?></td>
                        <td><?= htmlspecialchars($ex['reps']) ?></td>
                        <td><?= htmlspecialchars($ex['weight_kg']) ?></td>
                        <td><?= htmlspecialchars($ex['calories_burned']) ?></td>
                        <td><?= htmlspecialchars($ex['fat_loss_grams'])?></td>
                      </tr>
                      <?php
                      // If next row is a new date or last row, print totals
                      $next = $user_exercises[$idx+1] ?? null;
                      if (!$next || $next['date_performed'] !== $current_date) {
                        ?>
                        <tr style="background:#e9f7ef;font-weight:bold;">
                          <td colspan="5" class="text-right">Total for <?= htmlspecialchars($current_date) ?>:</td>
                          <td><?= $date_totals['calories_burned'] ?></td>
                          <td><?= $date_totals['fat_loss_grams'] ?></td>
                        </tr>
                        <?php
                      }
                    endforeach;
                    ?>
                    </tbody>
                  </table>
                </div>
              <?php endif; ?>

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