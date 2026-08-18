<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Lean'N'Green : Cardio</title>
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
              <h2>Cardio</h2>
              <!--                <p><blockquote>Fitness is not about being better that someone else...<br>Its about being than you used to be</blockquote></p>-->
            </div>
          </div>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="single-page-header-right">
              <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">WORKOUT</li>
                <li class="active">Cardio</li>
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
              // db.php
              include('db.php');
                // Fetch only "Back" exercises
                $query = "SELECT * FROM exercises WHERE muscle_group = 'Cardio' ORDER BY name";
                $stmt = $pdo->prepare($query);
                $stmt->execute();
                $exercises = $stmt->fetchAll(PDO::FETCH_ASSOC);
                ?>

                <h1>Cardio Exercises</h1>

                <div class="table-responsive">
                <table class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Calories Burned (cal/min)</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($exercises as $exercise): ?>
                    <tr>
                      <td><?= htmlspecialchars($exercise['name']) ?></td>
                      <td><?= htmlspecialchars($exercise['description']) ?></td>
                      <td><?= htmlspecialchars($exercise['avg_calories_burned_per_min']) ?></td>
                      <td>
                        <?php
                          if (isset($_SESSION['id'])): ?>
                            <a href="log_exercise.php?exercise_id=<?= urlencode($exercise['id']) ?>&muscle_group=Cardio"
                               class="btn btn-success btn-sm">
                              Log this exercise
                            </a>
                        <?php else: ?>
                            <button class="btn btn-warning btn-sm" onclick="alert('Login required to log this exercise!')">
                              Log this exercise
                            </button>
                        <?php endif; ?>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                  </tbody>
                </table>
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