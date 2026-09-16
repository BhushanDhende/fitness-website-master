<?php
$pageTitle = "Lean'N'Green : Anatomy and Workout";
$extraCss = 'assets/css/components/exercise-table.css';
include('header.php');
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
              <img src="assets/images/muscle-man.jpg" alt="muscle man" style="max-width:100%; height:auto; display:block; margin:0 auto;">
              <!--              <a class="error-home" href="index.html">Home Page</a>-->
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- End error section -->
  <div class="container">
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