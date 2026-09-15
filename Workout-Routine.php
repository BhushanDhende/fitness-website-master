<?php
$pageTitle = "Lean'N'Green : Workout Routine";
include('header.php');
?>
<style>
  img {
    display: inline-block;
  }
</style>


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