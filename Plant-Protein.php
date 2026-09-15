<?php
$pageTitle = "Lean'N'Green : Plant Protein";
include('header.php');
?>


  <!-- Start single page header -->
  <section id="single-page-header10">
    <div class="overlay">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="single-page-header-left">
              <h2>Plant Proteins</h2>
              <p>
              <blockquote>"There is absolutely no nutrient, no protein, no vitamin, no mineral that can't be obtained
                from plant-based diet"</blockquote>
              </p>
            </div>
          </div>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="single-page-header-right">
              <ol class="breadcrumb">
                <li><a href="index.php">Home</a></li>
                <li class="active">BASICS</li>
                <li class="active">PLANT PROTEIN</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End single page header -->


  <div class="col-md-8">
    <div class="blog-archive-left">
      <!-- Start blog news single -->
      <article class="blog-news-single">
        <div class="blog-news-title">
          <h2>All about Proteins</h2>
          <p>By <a class="blog-author" href="#">Vibhore Aggarwal</a> <span class="blog-date">|18 Jan 2016</span></p>
        </div>
        <div class="blog-news-details blog-single-details">
          <h2>Protein in Vegetarian and Vegan Diets</h2>
          <p>
            Protein is a nutrient made of amino acids the building blocks for many of your body’s structures, including
            muscle, bone, skin, and hair. They also play a role in the creation of many substances that your body
            requires to go about its everyday business of living.
          </p>
          <h3>Plant Proteins</h3>
          <p>
            Most plant foods, with the
            exception of soy, quinoa,
            and spinach, may be low in
            one or two of the essential
            amino acids, but you can get
            enough of all these amino
            acids by including a variety of
            whole plant foods in your diet. It was once thought that
            plant proteins needed to be combined within a meal
            by mixing grains and legumes to create a “complete”
            protein, also called complementary proteins, with good
            amounts of all essential amino acids. Now we know that
            the liver can store the amino acids so we don’t have to
            combine them in one meal.<br><br>
            Legumes, which include beans, lentils, and dried peas,
            and soy, nuts and seeds, are rich sources of protein,
            but whole grains and vegetables contain protein, too.
            <br><br>
            Some whole grains, such as wheat varieties like farro,
            Kamut®, and wheat berries provide up to 11 grams
            of protein per cup. Even vegetables can provide
            protein, such as spinach (5 grams per cup) and peas
            (8 grams per cup).
            A variety of easy-to-use meat alternatives can be
            found in most supermarkets, such as veggie burgers,
            meatless bacon, hot dogs, and ‘beef’ crumbles, as
            well as faux chicken nuggets, sausage, and ‘beef’
            strips. While these are simple solutions to meal
            planning, you’re better off choosing minimally
            processed plant foods that have lower levels of
            sodium and no artificial additives.
            Many plant proteins, including beans, lentils, and
            soy, are naturally packed with other beneficial
            nutrients like fiber, vitamins, minerals, healthy fat,
            and antioxidants, and contain very little saturated
            fat, sodium and cholesterol. This may be one reason
            why vegetarian and vegan diets are linked with
            lower disease risk.
          </p>
          <h3>Lacto-Ovo Vegetarians Proteins</h3>
          <p>
            Animal protein, such as that found in meat, dairy
            and eggs, is considered “high quality” protein
            because it has good amounts of all essential amino
            acids. Meeting your protein needs may be more
            easily accessed on a vegetarian (versus vegan) diet,
            because you can include high quality animal protein
            sources such as milk, cheese, cottage cheese, and
            eggs to help meet protein needs. Some vegetarians
            choose to use these animal proteins, however, it’s
            important to choose reduced-fat dairy products and
            eat dairy and eggs in moderation to avoid excess
            intake of saturated fat and dietary cholesterol.
          </p>
          <h3>How much Proteins do we need?</h3>
          <p>The overall daily protein recommendation for
            vegetarians is the same as for every healthy person:
            0.4 grams per pound of body weight. For example,
            if you weigh 150 pounds, you would multiply 150 x
            0.4 = 60 grams of protein for your daily need. Vegans
            and older adults may benefit from a slightly higher
            amount of protein—approximately 0.5 grams per
            pound of body weight.
          </p>
          <h3>The Bottom Line</h3>
          <p>
            While many people think protein can be a challenge
            for vegetarians and vegans, it’s easier than you think
            to meet your needs. Focus on choices that include
            plenty of whole, minimally processed plant foods
            (see Protein-rich Plant Foods) at each meal and
            snack, and avoid filling up on highly processed, low-
            nutrient foods, such as chips, cookies and sweets,
            and refined grain crackers, which can crowd out
            protein in your diet.
          </p>
          

          <?php
          // Database connection
          include('db.php');

          
          // Fetch plant protein data
          $sql = "SELECT id, name, type, protein_per_100g, calories_per_100g, source_category, is_complete_protein, notes FROM plant_protein";
          $result = $conn->query($sql);

          echo '<br><h2>Plant Protein Sources Table</h2><br>';
          echo '<div class="table-responsive">';
          echo '<table class="table table-bordered">';
          echo '<thead><tr>
                  <th>No.</th>
                  <th>Name</th>
                  <th>Type</th>
                  <th>Protein/100g (g)</th>
                  <th>Calories/100g</th>
                  <th>Category</th>
                  <th>Complete Protein?</th>
                  <th>Notes</th>
                </tr></thead><tbody>';

          if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
              echo '<tr>';
              echo '<td>' . htmlspecialchars($row["id"]) . '</td>';
              echo '<td>' . htmlspecialchars($row["name"]) . '</td>';
              echo '<td>' . htmlspecialchars($row["type"]) . '</td>';
              echo '<td>' . htmlspecialchars($row["protein_per_100g"]) . '</td>';
              echo '<td>' . htmlspecialchars($row["calories_per_100g"]) . '</td>';
              echo '<td>' . htmlspecialchars($row["source_category"]) . '</td>';
              echo '<td>' . ($row["is_complete_protein"] ? 'Yes' : 'No') . '</td>';
              echo '<td>' . htmlspecialchars($row["notes"]) . '</td>';
              echo '</tr>';
            }
          } else {
            echo '<tr><td colspan="8">No data found.</td></tr>';
          }
          echo '</tbody></table></div>';

          
          ?>






          <div class="blog-single-bottom">
            <div class="row">
              <div class="col-md-8">
                <div class="blog-single-tag">
                  <span class="fa fa-tags"></span>
                  <a href="#">Workout,</a>
                  <a href="#">Gym,</a>
                  <a href="#">Exercise</a>
                </div>
              </div>
              <div class="col-md-4">
                <div class="blog-single-social">
                  <a href="#"><i class="fa fa-facebook"></i></a>
                  <a href="#"><i class="fa fa-twitter"></i></a>
                  <a href="#"><i class="fa fa-linkedin"></i></a>
                  <a href="#"><i class="fa fa-google-plus"></i></a>
                  <a href="#"><i class="fa fa-pinterest"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </article>
      <!-- Start blog navigation -->
      <div class="blog-navigation-area">
        <div class="blog-navigation-prev">
          <a href="#">
            <h5>All about Proteins</h5>
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
      <!-- Start Comment box -->
      <?php include("comment.php"); ?>
    </div>
  </div>
  <?php include("sidebar.php"); ?>
  </div>
  </div>
  </div>
  </div>
  </div>
  </section>
  <!-- End blog archive -->
<?php include("footer.php"); ?>