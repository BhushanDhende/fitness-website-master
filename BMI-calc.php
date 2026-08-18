<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Lean'N'Green : Stories</title>
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

  <!-- Start single page header -->
  <section id="single-page-header">
    <div class="overlay">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="single-page-header-left">
              <h2>BMI Calculator</h2>
              <p>
              <blockquote>"BMI calculator quickly estimates body fat based on height and weight to help assess whether you're underweight, healthy, overweight, or obese."</blockquote>
              </p>
            </div>
          </div>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="single-page-header-right">
              <ol class="breadcrumb">
                <li><a href="index.php">Home</a></li>
                <li href="active">BMI Calculator</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- BMI code -->
  <script language="JavaScript">
    // JavaScript Document
    function calculateBmi() {
      var weight = document.bmiForm.weight.value
      var height = document.bmiForm.height.value
      if (weight > 0 && height > 0) {
        var finalBmi = weight / (height / 100 * height / 100)
        document.bmiForm.bmi.value = finalBmi
        if (finalBmi < 18.5) {
          document.bmiForm.meaning.value = "That you are too thin."
        }
        if (finalBmi > 18.5 && finalBmi < 25) {
          document.bmiForm.meaning.value = "That you are healthy."
        }
        if (finalBmi > 25) {
          document.bmiForm.meaning.value = "That you have overweight."
        }
      }
      else {
        alert("Please Fill in everything correctly")
      }
    }

  </script>


  <section id="feature">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="title-area" >
            <p style="text-align: justify;">
              BMI (Body Mass Index) is a measurement of body fat based on height and weight that applies to both men and
              women
              between the ages of 18 and 65 years.BMI can be used to indicate if you are overweight, obese, underweight
              or
              normal. A healthy BMI score is between 20 and 25. A score below 20 indicates that you may be underweight;
              a
              value above 25 indicates that you may be overweight.Please remember, however, that this is only one of
              many
              possible ways to assess your weight. If you have any concerns about your weight, please discuss them with
              your
              physician, who is in a position, unlike this BMI calculator, to address your specific individual
              situation.
            </p>

            <span class="line"></span>
          </div>
          <div class="errror-page-area">
            <!--            <h1 class="error-title"><span class="fa fa-bug"></span></h1>-->
            <div class="error-content"></div>

            <div class="blog-news-details blog-single-details">


              <div class="blog-news-details blog-single-details" style="text-align: center;">
                <br><h2>BMI Calculator</h2><br>

              </div> <br>

              <!-- Form for taking values for calculations -->
              <div class="blog-news-details blog-single-details" style="text-align: center;">
                <form name="bmiForm">
                  <table style="margin: 0 auto; border-collapse: collapse; border-spacing: 10px;">
                    <tr>
                      <td style="padding: 5px;">Your Weight (kg):</td>
                      <td style="padding: 5px;"><input type="text" name="weight" size="25"></td>
                    </tr>
                    <tr>
                      <td style="padding: 5px;">Your Height (cm):</td>
                      <td style="padding: 5px;"><input type="text" name="height" size="25"></td>
                    </tr>

                    <tr>
                      <td style="padding: 5px;">Your BMI:</td>
                      <td style="padding: 5px;"><input type="text" name="bmi" size="25"></td>
                    </tr>
                    <tr>
                      <td style="padding: 5px;">This Means:</td>
                      <td style="padding: 5px;"><input type="text" name="meaning" size="25"></td>
                    </tr>
                    <tr>
                      <td colspan="2" style="text-align: center; padding: 10px;">
                        <button type="button" value="Calculate BMI" onClick="calculateBmi()"
                          class="mu-send-btn comment-btn" style="margin-right:10px;">Calcutate BMI</button>
                        <button type="reset" value="Reset" class=" comment-btn">Reset</button>
                      </td>
                    </tr>
                  </table>
                </form>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- Start blog navigation -->
  <div class="blog-navigation-area">
    <div class="blog-navigation-prev">
      <a href="#">
        <h5>Stories</h5>
        <span>Previous Post</span>
      </a>
    </div>
    <div class="blog-navigation-next">
      <a href="#">
        <h5>All about friends story</h5>
        <span>Next Post</span>
      </a>
    </div>
  </div>

  <div class="col-md-8">
    <div class="blog-archive-left">
      <?php include('comment.php'); ?>
    </div>
  </div>

  <?php include('footer.php'); ?>


  <!-- End footer -->

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