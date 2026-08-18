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
                            <h2>exercise</h2>
                            <!--                <p><blockquote>Fitness is not about being better that someone else...<br>Its about being than you used to be</blockquote></p>-->
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="single-page-header-right">
                            <ol class="breadcrumb">
                                <li><a href="#">Home</a></li>
                                <li class="active">WORKOUT</li>
                                <li class="active">Anatomy and Exercises</li>
                                <li class="active"></li>
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


                            // Include database connection if not already included
                            include 'db.php';
                            // Check if the user is logged in
                            if (!isset($_SESSION['id'])) {
                                echo "You must be logged in to log exercises.";
                                exit;
                            }
                            ?>






                            <?php
                            // Start session if not already started
                            
                            $user_id = $_SESSION['id'];  // Assuming the user's ID is stored in the session
                            
                            // Validate and sanitize GET parameters
                            $exercise_id = isset($_GET['exercise_id']) ? intval($_GET['exercise_id']) : 0;

                            // $name = isset($_GET['name']) ? htmlspecialchars($_GET['name']) : '';
                            // Use the name from the exercise record to ensure consistency
                            $muscle_group = isset($_GET['muscle_group']) ? htmlspecialchars($_GET['muscle_group']) : '';

                            if ($exercise_id <= 0) {
                                echo "Invalid exercise ID.";
                                exit;
                            }

                            // Fetch the exercise details
                            $query = "SELECT * FROM exercises WHERE id = ?";
                            $stmt = $pdo->prepare($query);
                            $stmt->execute([$exercise_id]);
                            $exercise = $stmt->fetch();

                            // If exercise not found, redirect
                            if (!$exercise) {
                                echo "Exercise not found.";
                                exit;
                            }

                            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                // Get data from the form and validate
                                $duration = isset($_POST['duration']) ? intval($_POST['duration']) : 0;
                                $sets = isset($_POST['sets']) ? intval($_POST['sets']) : 0;
                                $reps = isset($_POST['reps']) ? intval($_POST['reps']) : 0;
                                $weight = isset($_POST['weight']) && $_POST['weight'] !== '' ? floatval($_POST['weight']) : null;  // Optional for weighted exercises
                            
                                if ($duration <= 0 || $sets <= 0 || $reps <= 0) {
                                    echo "Please enter valid values for duration, sets, and reps.";
                                } else {
                                    // Calculate calories burned
                                    $calories_burned = $duration * $exercise['avg_calories_burned_per_min'];
                                    $fat_loss = $calories_burned / 9;  // Convert calories to fat loss (grams)
                            
                                    // Insert into the user_exercises table
                                    $query = "INSERT INTO user_exercises (user_id, exercise_id, name, duration_minutes, sets, reps, weight_kg, date_performed, calories_burned, fat_loss_grams)
              VALUES (?, ?, ?, ?, ?, ?, ?, CURDATE(), ?, ?)";
                                    $stmt = $pdo->prepare($query);
                                    $stmt->execute([$user_id, $exercise_id, $exercise['name'], $duration, $sets, $reps, $weight, $calories_burned, $fat_loss]);

                                    echo "Exercise logged successfully!";
                                }
                            }
                            ?>


                            <h1>Log Exercise: <?= $exercise['name'] ?></h1>
                            <div style="display: flex; justify-content: center;">
                                <form action="" method="POST">
                                    <table class="table table-bordered" style="max-width: 500px; margin: 0 auto;">
                                        <tr>
                                            <th><label for="duration">Duration (minutes):</label></th>
                                            <td><input type="number" name="duration" id="duration" class="form-control"
                                                    required></td>
                                        </tr>
                                        <tr>
                                            <th><label for="sets">Sets:</label></th>
                                            <td><input type="number" name="sets" id="sets" class="form-control"
                                                    required></td>
                                        </tr>
                                        <tr>
                                            <th><label for="reps">Reps per set:</label></th>
                                            <td><input type="number" name="reps" id="reps" class="form-control"
                                                    required></td>
                                        </tr>
                                        <tr>
                                            <th><label for="weight">Weight (kg) [Optional]:</label></th>
                                            <td><input type="number" name="weight" id="weight" class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="text-align:center;">
                                                <button type="submit" class="btn btn-success">Log Exercise</button>
                                            </td>
                                        </tr>
                                    </table>
                                </form>
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