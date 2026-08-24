<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Lean'N'Green : Workout Routine</title>
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
  <style>
    img {
      display: inline-block;
    }
  </style>
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

  <!-- Start single page header -->
  <section id="single-page-header">
    <div class="overlay">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="single-page-header-left">
              <h2>Workout Plan</h2>
              <p>
              <blockquote>"Fitness is not about being better that someone else...<br>Its about being than you used to
                be"</blockquote>
              </p>
            </div>
          </div>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="single-page-header-right">
              <ol class="breadcrumb">
                <li><a href="index.php">Home</a></li>
                <li class="active">PLANS</li>
                <li class="active">Workout Routine</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <section id="feature">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="title-area">
            <!--            <h2 class="title">Features</h2>-->

            <p>Tighten Your Body From Head to Toe! Want to tone your body from head to toe
              you can give yourself a total body makeover— tightening those glutes, blasting that fat, and toning your
              legs and arms</p>

            <span class="line"></span>
          </div>
          <div class="errror-page-area">
            <!--            <h1 class="error-title"><span class="fa fa-bug"></span></h1>-->
            <div class="error-content"></div>

            <div class="blog-news-details blog-single-details">
              <?php
              // Database connection
              include('db.php');

              

              // Fetch plant protein data
              $sql = "SELECT id, day_of_week,  workout_name, muscle_group, exercise_name, sets, reps, rest_seconds, duration_minutes, equipment_needed, is_cardio, notes FROM workout_routine";
              $result = $conn->query($sql);

              echo '<br><h2>Workout Routine Table</h2><br>';
              echo '<div class="table-responsive">';
              echo '<table class="table table-bordered">';
              echo '<thead><tr>
                    <th>No.</th>
                    <th>day of week</th>
                    <th>workout name</th>
                    <th>muscle group</th>
                    <th>exercise name</th>
                    <th>sets</th>
                    <th>reps</th>
                    <th>rest seconds</th>
                    <th>duration minutes</th>
                    <th>equipment needed</th>
                    <th>is cardio</th>
                    <th>notes</th>
                  </tr></thead><tbody>';

              if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  echo '<tr>';
                  echo '<td>' . htmlspecialchars($row["id"]) . '</td>';
                  echo '<td>' . htmlspecialchars($row["day_of_week"]) . '</td>';
                  echo '<td>' . htmlspecialchars($row["workout_name"]) . '</td>';
                  echo '<td>' . htmlspecialchars($row["muscle_group"]) . '</td>';
                  echo '<td>' . htmlspecialchars($row["exercise_name"]) . '</td>';
                  echo '<td>' . htmlspecialchars($row["sets"]) . '</td>';
                  echo '<td>' . htmlspecialchars($row['reps']) . '</td>';
                  echo '<td>' . htmlspecialchars($row["rest_seconds"]) . '</td>';
                  echo '<td>' . htmlspecialchars($row['duration_minutes']) . '</td>';
                  echo '<td>' . htmlspecialchars($row["equipment_needed"]) . '</td>';
                  echo '<td>' . htmlspecialchars($row['is_cardio']) . '</td>';
                  echo '<td>' . htmlspecialchars($row["notes"]) . '</td>';
                  echo '</tr>';
                }
              } else {
                echo '<tr><td colspan="8">No data found.</td></tr>';
              }
              echo '</tbody></table></div>';

              $conn->close();
              ?>

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