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
  <style>
    img {
      display: inline-block;
    }

    .list {
      display: block;
      align-self: center;
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
              <h2>Anatomy and Exercises</h2>
              <p>
              <blockquote>"PEOPLE eat meat and think will become STRONG as an OX , forgetting that the OX eats GRASS"
              </blockquote>
              </p>
            </div>
          </div>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="single-page-header-right">
              <ol class="breadcrumb">
                <li><a href="index.php">Home</a></li>
                <li class="active">Workout</li>
                <li class="active">Anatomy and Exercises</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End single page header -->





  <!-- content -->

  <!-- BEGIN LISTING LAYOUT -->




  <!-- Start error section  -->
  <section id="error">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="errror-page-area">
            <!--            <h1 class="error-title"><span class="fa fa-bug"></span></h1>-->
            <div class="error-content">
              <!--              <span>Opps!</span>-->
              <img src="assets/images/muscle%20man.jpg" alt="muscle man" style="max-width:100%; height:auto; display:block; margin:0 auto;">
              <!--              <a class="error-home" href="index.html">Home Page</a>-->
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- End error section -->
  <div class="container">
    <style>
      .exercise-table {
        margin: 30px auto;
        border-collapse: separate;
        border-spacing: 0 15px;
        width: 60%;
        background: #f9f9f9;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
      }

      .exercise-table td {
        padding: 16px 0;
        text-align: center;
      }

      .exercise-btn:hover {
        background: #388e3c;
      }

      @media (max-width: 768px) {
        .exercise-table {
          width: 95%;
        }

        .exercise-btn {
          width: 100%;
          margin: 6px 0;
        }
      }
    </style>
    <table class="exercise-table">
      <tr>
        <td><a href="Back.php"><button class="comment-btn " style = "width : 200px">Back</button></a></td>
        <td><a href="Shoulder.PHP"><button class="comment-btn" style = "width : 200px">Shoulders</button></a></td>
      </tr>
      <tr>
        <td><a href="Chest.php"><button class="comment-btn" style = "width : 200px">Chest</button></a></td>
        <td><a href="Arms.php"><button class="comment-btn" style = "width : 200px">Arms</button></a></td>
      </tr>
      <tr>
        <td><a href="Abdomen.php"><button class="comment-btn" style = "width : 200px">Abdominal</button></a></td>
        <td><a href="Buttocks.php"><button class="comment-btn" style = "width : 200px">Buttocks</button></a></td>
      </tr>
      <tr>
        <td colspan="2"><a href="Legs.php"><button class="comment-btn" style = "width : 200px">Legs</button></a></td>
      </tr>
    </table>
  </div>


<?php include ('footer.php'); ?>
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