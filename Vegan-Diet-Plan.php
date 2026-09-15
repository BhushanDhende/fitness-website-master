<?php
$pageTitle = "Lean'N'Green : Vegan Diet Plan";
include('header.php');
?>
<style>
  img {
    display: inline-block;
  }
</style>


  <!-- Start single page header -->
  <section id="single-page-header3">
    <div class="overlay">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="single-page-header-left">
              <h2>Vegan Diet Plan</h2>
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
                <li class="active">PLANS</li>
                <li class="active">Vegan Diet Plan</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End single page header -->

  <!-- Start Feature -->
  <section id="feature">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="title-area">
            <!--            <h2 class="title">Features</h2>-->

            <p>Life is as dear to a mute creature as it is to man.
              Just as one wants happiness and fears pain, just as one wants to live and not die ,
              So do the other creatures.</p>
            <span class="line"></span>
          </div>
          <div class="errror-page-area">
            <!--            <h1 class="error-title"><span class="fa fa-bug"></span></h1>-->
            <div class="error-content">
              <!--              <span>Opps!</span>-->
              <div class="blog-news-details blog-single-details">

                <?php
                // Database connection
                include("db.php");
                
                // Fetch plant protein data
                $sql = "SELECT id, day_of_week,  meal_time, meal_name, description, calories, protein, fat, carbs, source_link FROM vegan_diet_plan";
                $result = $conn->query($sql);

                echo '<br><h2>Vegan Diet Plan Table</h2><br>';
                echo '<div class="table-responsive">';
                echo '<table class="table table-bordered">';
                echo '<thead><tr>
                    <th>No.</th>
                    <th>day of week</th>
                    <th>meal time</th>
                    <th>meal name</th>
                    <th>description</th>
                    <th>calories</th>
                    <th>protein</th>
                    <th>fat</th>
                    <th>carbs</th>
                  </tr></thead><tbody>';

                if ($result && $result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($row["id"]) . '</td>';
                    echo '<td>' . htmlspecialchars($row["day_of_week"]) . '</td>';
                    echo '<td>' . htmlspecialchars($row["meal_time"]) . '</td>';
                    echo '<td>' . htmlspecialchars($row["meal_name"]) . '</td>';
                    echo '<td>' . htmlspecialchars($row["description"]) . '</td>';
                    echo '<td>' . htmlspecialchars($row["calories"]) . '</td>';
                    echo '<td>' . htmlspecialchars($row['protein']) . '</td>';
                    echo '<td>' . htmlspecialchars($row["fat"]) . '</td>';
                    echo '<td>' . htmlspecialchars($row['carbs']) . '</td>';
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
    </div>
  </section>
  <!-- End error section  -->
  <?php
  include("footer.php");
  ?>