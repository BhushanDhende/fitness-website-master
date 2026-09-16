<?php
$pageTitle = "Lean'N'Green : Plant Protein Sources & Guide";
$extraCss = 'assets/css/components/plant-protein.css';
include('header.php');
include_once('db.php');

// Fetch plant protein data ordered by protein content descending
$sql = "SELECT id, name, type, protein_per_100g, calories_per_100g, source_category, is_complete_protein, notes 
        FROM plant_protein 
        ORDER BY protein_per_100g DESC";
$result = $conn->query($sql);
$allFoods = [];
$categories = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $allFoods[] = $row;
        $cat = $row['source_category'];
        if (!in_array($cat, $categories)) {
            $categories[] = $cat;
        }
    }
}
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
              <blockquote>"There is absolutely no nutrient, no protein, no vitamin, no mineral that can't be obtained from a plant-based diet."</blockquote>
              </p>
            </div>
          </div>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="single-page-header-right">
              <ol class="breadcrumb">
                <li><a href="index.php">Home</a></li>
                <li><a href="Plant-Protein.php">Basics</a></li>
                <li class="active">Plant Protein</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End single page header -->

  <section id="blog-archive" style="padding: 50px 0; background: #f8fafc;">
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-sm-12">
          <div class="blog-archive-left">
            <!-- Start blog news single -->
            <article class="blog-news-single">
              <div class="blog-news-title">
                <h2>All About Plant Proteins</h2>
                <p>By <a class="blog-author" href="#">Vibhore Aggarwal</a> <span class="blog-date">| Nutritional Science Review</span></p>
              </div>
              <div class="blog-news-details blog-single-details">
                <h2>Protein in Vegetarian and Vegan Diets</h2>
                <p>
                  Protein is a macronutrient made of amino acids—the fundamental building blocks for your body's musculoskeletal structures, including lean muscle tissue, bones, skin, and connective tissues. They also synthesize vital enzymes, hormones, and neurotransmitters that sustain optimal daily performance.
                </p>
                
                <h3>Plant Proteins &amp; Amino Acid Completeness</h3>
                <p>
                  Most plant foods, with notable exceptions such as soy (tofu, tempeh, edamame), quinoa, hemp seeds, spirulina, and nutritional yeast, contain varying proportions of essential amino acids. However, you can effortlessly achieve complete amino acid synergy by enjoying a diverse spectrum of whole plant foods across your daily meals. It was historically believed that plant proteins had to be combined within a single meal to form "complete" proteins. Contemporary nutritional science confirms that the body's circulating amino acid pool stores and combines amino acids over a 24-hour period.
                </p>
                <p>
                  Legumes (including lentils, chickpeas, and black beans), soy products, raw nuts, and seeds provide exceptionally concentrated protein yields. Whole ancient grains like spelt, farro, wild rice, and rolled oats contribute meaningful amino acid mass while providing sustained complex carbohydrate fuel and prebiotic fiber.
                </p>

                <h3>How Much Protein Do We Need?</h3>
                <p>
                  The standard baseline recommendation for general health is roughly 0.8 grams per kilogram of body weight. For active individuals, resistance trainees, and plant-based athletes aiming to build or preserve lean muscle mass, sports nutrition science recommends <strong>1.4 to 2.0 grams of protein per kilogram of body weight</strong> (approximately 0.7 to 0.9 grams per pound).
                </p>

                <!-- Modern Plant Protein Table Card -->
                <div class="protein-table-card">
                  <div class="protein-table-header">
                    <div>
                      <h3 class="protein-table-title">
                        <i class="fa fa-leaf" style="color: #10b981;"></i>
                        Plant Protein Density Chart
                      </h3>
                      <p style="color: #64748b; font-size: 13.5px; margin: 4px 0 0 0;">
                        Ranked by protein concentration per 100 grams. Filter by category or search foods.
                      </p>
                    </div>

                    <!-- Quick Search Input -->
                    <div class="protein-search-wrapper">
                      <i class="fa fa-search protein-search-icon"></i>
                      <input type="text" id="protein-search" class="protein-search-input" placeholder="Search protein source..." onkeyup="filterProteinTable()">
                    </div>
                  </div>

                  <!-- Category Pills -->
                  <div class="protein-filter-nav">
                    <button type="button" class="protein-filter-btn active" onclick="filterProteinCategory('all', this)">
                      <i class="fa fa-layer-group"></i> All Foods (<?= count($allFoods) ?>)
                    </button>
                    <?php foreach ($categories as $cat): ?>
                      <button type="button" class="protein-filter-btn" onclick="filterProteinCategory('<?= htmlspecialchars(strtolower($cat)) ?>', this)">
                        <?= htmlspecialchars($cat) ?>
                      </button>
                    <?php endforeach; ?>
                  </div>

                  <!-- Table -->
                  <div class="protein-table-responsive">
                    <table class="protein-table" id="protein-table">
                      <thead>
                        <tr>
                          <th style="width: 45px;">#</th>
                          <th>Food Name &amp; Form</th>
                          <th>Category</th>
                          <th style="text-align: right;">Protein / 100g</th>
                          <th style="text-align: right;">Calories / 100g</th>
                          <th style="text-align: center;">Amino Acid Quality</th>
                          <th>Nutritional Highlights</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $idx = 1; foreach ($allFoods as $food): ?>
                          <tr class="protein-row" data-category="<?= htmlspecialchars(strtolower($food['source_category'])) ?>" data-name="<?= htmlspecialchars(strtolower($food['name'] . ' ' . $food['type'] . ' ' . $food['notes'])) ?>">
                            <td style="font-weight: 700; color: #94a3b8;"><?= $idx++ ?></td>
                            <td>
                              <div class="protein-food-name"><?= htmlspecialchars($food['name']) ?></div>
                              <div class="protein-food-type"><?= htmlspecialchars($food['type']) ?></div>
                            </td>
                            <td>
                              <span class="category-tag"><?= htmlspecialchars($food['source_category']) ?></span>
                            </td>
                            <td style="text-align: right;">
                              <span class="protein-value-badge">
                                <?= number_format($food['protein_per_100g'], 1) ?>g
                              </span>
                            </td>
                            <td style="text-align: right; font-weight: 600; color: #64748b;">
                              <?= number_format($food['calories_per_100g'], 0) ?> kcal
                            </td>
                            <td style="text-align: center;">
                              <?php if ($food['is_complete_protein']): ?>
                                <span class="badge-complete" title="Contains all 9 essential amino acids in optimal ratios">
                                  <i class="fa fa-check-circle"></i> Complete EAA
                                </span>
                              <?php else: ?>
                                <span class="badge-incomplete" title="Combine with complementary grains or legumes">
                                  <i class="fa fa-adjust"></i> Incomplete
                                </span>
                              <?php endif; ?>
                            </td>
                            <td style="color: #475569; font-size: 13px; max-width: 260px; line-height: 1.4;">
                              <?= htmlspecialchars($food['notes']) ?>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>

                <!-- Topics Section -->
                <div class="blog-single-bottom-modern">
                  <div class="blog-tag-list">
                    <span class="blog-tag-title"><i class="fa fa-tags" style="color:#10b981;"></i> Topics:</span>
                    <a href="Plant-Protein.php" class="blog-tag-chip">#PlantProtein</a>
                    <a href="Vegan-Diet-Plan.php" class="blog-tag-chip">#VeganGains</a>
                    <a href="food-nutrtion.php" class="blog-tag-chip">#NutritionFacts</a>
                    <a href="Muscles.php" class="blog-tag-chip">#MuscleBuilding</a>
                  </div>
                </div>

              </div>
            </article>
          </div>
        </div>

        <?php include("sidebar.php"); ?>
      </div>
    </div>
  </section>
  <!-- End blog archive -->

  <!-- Start Centered Comment Section -->
  <section style="padding: 10px 0 60px 0; background: #f8fafc;">
    <div class="container">
      <div class="row">
        <div class="col-md-10 col-md-offset-1 col-sm-12">
          <div style="background: #ffffff; border-radius: 16px; padding: 28px; box-shadow: 0 4px 18px rgba(15, 23, 42, 0.05); border: 1px solid #e2e8f0;">
            <?php include("comment.php"); ?>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Centered Comment Section -->

  <!-- Interactive Client-side Filter Script -->
  <script>
    var currentProteinCategory = 'all';

    function filterProteinCategory(cat, btn) {
      currentProteinCategory = cat.toLowerCase();
      var buttons = document.querySelectorAll('.protein-filter-btn');
      buttons.forEach(function(b) { b.classList.remove('active'); });
      if (btn) btn.classList.add('active');
      filterProteinTable();
    }

    function filterProteinTable() {
      var query = document.getElementById('protein-search').value.toLowerCase().trim();
      var rows = document.querySelectorAll('.protein-row');
      
      rows.forEach(function(row) {
        var rowCat = row.getAttribute('data-category');
        var rowText = row.getAttribute('data-name');
        
        var matchesCat = (currentProteinCategory === 'all' || rowCat === currentProteinCategory);
        var matchesQuery = (query === '' || rowText.indexOf(query) !== -1);
        
        if (matchesCat && matchesQuery) {
          row.style.display = '';
        } else {
          row.style.display = 'none';
        }
      });
    }
  </script>

<?php include("footer.php"); ?>