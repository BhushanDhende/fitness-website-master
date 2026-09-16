<?php
$pageTitle = "Lean'N'Green : Full Week Vegan Diet Plan";
$extraCss = 'assets/css/components/vegan-diet-plan.css';
include('header.php');
include_once('db.php');

// Fetch full week vegan meal plan grouped and ordered by day & meal time
$sql = "SELECT id, day_of_week, meal_time, meal_name, description, calories, protein, fat, carbs, source_link 
        FROM vegan_diet_plan 
        ORDER BY FIELD(day_of_week, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'),
                 FIELD(meal_time, 'Breakfast', 'Lunch', 'Snack', 'Dinner'), id ASC";

$result = $conn->query($sql);
$daysOrder = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
$mealsByDay = [];
foreach ($daysOrder as $d) {
    $mealsByDay[$d] = [
        'meals' => [],
        'total_calories' => 0,
        'total_protein' => 0,
        'total_fat' => 0,
        'total_carbs' => 0
    ];
}

$totalMeals = 0;
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $day = $row['day_of_week'];
        if (isset($mealsByDay[$day])) {
            $mealsByDay[$day]['meals'][] = $row;
            $mealsByDay[$day]['total_calories'] += floatval($row['calories']);
            $mealsByDay[$day]['total_protein'] += floatval($row['protein']);
            $mealsByDay[$day]['total_fat'] += floatval($row['fat']);
            $mealsByDay[$day]['total_carbs'] += floatval($row['carbs']);
            $totalMeals++;
        }
    }
}
?>

  <!-- Start single page header -->
  <section id="single-page-header3">
    <div class="overlay">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="single-page-header-left">
              <h2>Weekly Vegan Diet Plan</h2>
              <p>
              <blockquote>"People eat meat and think they will become strong as an ox, forgetting that the ox eats grass."</blockquote>
              </p>
            </div>
          </div>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="single-page-header-right">
              <ol class="breadcrumb">
                <li><a href="index.php">Home</a></li>
                <li><a href="Vegan-Diet-Plan.php">Plans</a></li>
                <li class="active">Vegan Diet Plan</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End single page header -->

  <section class="diet-container">
    <div class="container">

      <!-- Header Summary & Day Filter Card -->
      <div class="diet-header-card">
        <span style="background: #ecfdf5; color: #059669; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; padding: 5px 16px; border-radius: 20px; display: inline-block; margin-bottom: 12px; border: 1px solid #a7f3d0;">
          <i class="fa fa-leaf" style="margin-right: 6px;"></i> Complete 7-Day Nutrition
        </span>
        <h2 style="font-family: 'Outfit', sans-serif; font-size: 28px; font-weight: 800; color: #0f172a; margin: 0 0 10px 0;">
          Full Week High-Protein Plant Fuel
        </h2>
        <p style="color: #64748b; font-size: 15px; max-width: 680px; margin: 0 auto;">
          Nutritionally balanced, chef-crafted 100% plant-based meal plan optimized for athletic performance, clean muscle synthesis, and sustained daily vitality.
        </p>

        <!-- Day Filter Navigation -->
        <div class="diet-filter-nav">
          <button type="button" class="diet-filter-btn active" onclick="filterDietDay('all', this)">
            <i class="fa fa-utensils"></i> All Week (<?= $totalMeals ?> Meals)
          </button>
          <?php foreach ($daysOrder as $day): ?>
            <?php 
              $mCount = count($mealsByDay[$day]['meals']);
              if ($mCount === 0) continue;
            ?>
            <button type="button" class="diet-filter-btn" onclick="filterDietDay('<?= strtolower($day) ?>', this)">
              <?= $day ?> (<?= $mCount ?>)
            </button>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- Days Meal Plan Cards -->
      <div id="diet-days-wrapper">
        <?php foreach ($daysOrder as $day): ?>
          <?php 
            $dayData = $mealsByDay[$day];
            if (empty($dayData['meals'])) continue;
            $dayId = 'diet-day-' . strtolower($day);
          ?>
          <div class="diet-day-card" id="<?= $dayId ?>" data-day="<?= strtolower($day) ?>">
            <!-- Day Card Header with Macros -->
            <div class="diet-day-header">
              <div class="diet-day-title-group">
                <span class="diet-day-badge"><?= htmlspecialchars($day) ?></span>
                <span style="color: #64748b; font-size: 14px; font-weight: 600;">
                  <i class="fa fa-check-circle text-emerald"></i> <?= count($dayData['meals']) ?> Scheduled Meals
                </span>
              </div>
              <div class="diet-day-macros">
                <span class="macro-chip macro-cal" title="Total Daily Energy">
                  <i class="fa fa-fire"></i> <?= number_format($dayData['total_calories'], 0) ?> kcal
                </span>
                <span class="macro-chip macro-protein" title="Total Daily Protein">
                  <i class="fa fa-dumbbell"></i> <?= number_format($dayData['total_protein'], 1) ?>g Protein
                </span>
                <span class="macro-chip macro-carbs" title="Total Daily Carbohydrates">
                  <i class="fa fa-bread-slice"></i> <?= number_format($dayData['total_carbs'], 1) ?>g Carbs
                </span>
                <span class="macro-chip macro-fat" title="Total Daily Healthy Fats">
                  <i class="fa fa-seedling"></i> <?= number_format($dayData['total_fat'], 1) ?>g Fat
                </span>
              </div>
            </div>

            <!-- Meals Table -->
            <div class="diet-table-wrapper">
              <table class="diet-table">
                <thead>
                  <tr>
                    <th style="width: 120px;">Meal Timing</th>
                    <th>Dish &amp; Ingredients</th>
                    <th>Calories</th>
                    <th>Protein</th>
                    <th>Carbohydrates</th>
                    <th>Healthy Fats</th>
                    <th style="text-align: center;">Recipe Guide</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($dayData['meals'] as $meal): ?>
                    <?php 
                      $timeClass = 'meal-' . strtolower($meal['meal_time']);
                    ?>
                    <tr>
                      <td>
                        <span class="meal-time-badge <?= $timeClass ?>">
                          <?= htmlspecialchars($meal['meal_time']) ?>
                        </span>
                      </td>
                      <td>
                        <div class="meal-name"><?= htmlspecialchars($meal['meal_name']) ?></div>
                        <?php if (!empty($meal['description'])): ?>
                          <div class="meal-desc"><?= htmlspecialchars($meal['description']) ?></div>
                        <?php endif; ?>
                      </td>
                      <td style="font-weight: 700; color: #b45309;">
                        <?= number_format($meal['calories'], 0) ?> kcal
                      </td>
                      <td style="font-weight: 700; color: #059669;">
                        <?= number_format($meal['protein'], 1) ?>g
                      </td>
                      <td style="font-weight: 600; color: #2563eb;">
                        <?= number_format($meal['carbs'], 1) ?>g
                      </td>
                      <td style="font-weight: 600; color: #9333ea;">
                        <?= number_format($meal['fat'], 1) ?>g
                      </td>
                      <td style="text-align: center;">
                        <a href="food-nutrtion.php" class="btn btn-default btn-xs" style="border-radius: 6px; font-weight: 600; padding: 5px 12px; color: #059669; border-color: #a7f3d0; background: #ecfdf5;" title="Explore nutrition facts">
                          <i class="fa fa-search"></i> Nutrition
                        </a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

    </div>
  </section>

  <!-- Interactive Day Filter Script -->
  <script>
    function filterDietDay(selectedDay, btn) {
      // Toggle button active state
      var buttons = document.querySelectorAll('.diet-filter-btn');
      buttons.forEach(function(b) {
        b.classList.remove('active');
      });
      if (btn) btn.classList.add('active');

      // Filter day cards
      var cards = document.querySelectorAll('.diet-day-card');
      cards.forEach(function(card) {
        if (selectedDay === 'all' || card.getAttribute('data-day') === selectedDay) {
          card.style.display = 'block';
        } else {
          card.style.display = 'none';
        }
      });
    }
  </script>

  <?php include("footer.php"); ?>