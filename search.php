<?php
$pageTitle = "Lean'N'Green : Search Results";
include('header.php');
include_once('db.php');
?>

  <style>
    .search-hero {
      background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
      padding: 55px 0 50px 0;
      border-bottom: 1px solid rgba(255,255,255,0.08);
    }
    .search-hero-title {
      font-family: 'Outfit', sans-serif;
      font-size: 34px;
      font-weight: 800;
      color: #ffffff;
      margin: 0 0 10px 0;
    }
    .search-hero-subtitle {
      color: #94a3b8;
      font-size: 15px;
      margin: 0;
    }
    .search-breadcrumb {
      background: rgba(255,255,255,0.06);
      border-radius: 10px;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      list-style: none;
      padding: 8px 16px;
      margin: 0;
    }
    .search-breadcrumb li {
      display: inline-flex;
      align-items: center;
      font-size: 13.5px;
    }
    .search-breadcrumb li + li::before {
      content: "/";
      color: #64748b;
      margin-right: 8px;
    }
    .search-page-section {
      padding: 45px 0 60px 0;
      background: #f8fafc;
      min-height: 600px;
    }
    .search-box-widget {
      background: #ffffff;
      border: 1.5px solid #e2e8f0;
      border-radius: 14px;
      padding: 18px 22px;
      margin-bottom: 28px;
      box-shadow: 0 4px 16px rgba(15, 23, 42, 0.04);
    }
    .search-box-widget form {
      display: flex;
      gap: 12px;
      align-items: center;
    }
    .search-box-input-wrapper {
      position: relative;
      flex-grow: 1;
    }
    .search-box-input-wrapper i {
      position: absolute;
      left: 16px;
      top: 50%;
      transform: translateY(-50%);
      color: #94a3b8;
      font-size: 16px;
    }
    .search-box-input {
      width: 100%;
      height: 48px;
      padding: 10px 18px 10px 46px;
      border-radius: 10px;
      border: 1.5px solid #cbd5e1;
      font-size: 15px;
      color: #0f172a;
      transition: all 0.2s ease;
    }
    .search-box-input:focus {
      border-color: #10b981;
      box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.15);
      outline: none;
    }
    .search-box-btn {
      background: linear-gradient(135deg, #10b981 0%, #059669 100%);
      color: #ffffff;
      border: none;
      height: 48px;
      padding: 0 28px;
      border-radius: 10px;
      font-family: 'Outfit', sans-serif;
      font-weight: 700;
      font-size: 14.5px;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      transition: all 0.25s ease;
      white-space: nowrap;
    }
    .search-box-btn:hover {
      background: linear-gradient(135deg, #059669 0%, #047857 100%);
      transform: translateY(-1px);
    }
    .search-filter-pills {
      display: flex;
      gap: 8px;
      flex-wrap: wrap;
      margin-bottom: 24px;
    }
    .filter-pill {
      background: #ffffff;
      border: 1px solid #cbd5e1;
      padding: 6px 14px;
      border-radius: 20px;
      font-size: 13px;
      font-weight: 600;
      color: #475569;
      cursor: pointer;
      text-decoration: none !important;
      transition: all 0.2s ease;
    }
    .filter-pill:hover,
    .filter-pill.active {
      background: #10b981;
      color: #ffffff !important;
      border-color: #10b981;
    }
    .search-results-list {
      display: flex;
      flex-direction: column;
      gap: 16px;
    }
    .search-result-card {
      background: #ffffff;
      border: 1px solid #e2e8f0;
      border-radius: 12px;
      padding: 22px 24px;
      box-shadow: 0 2px 10px rgba(15, 23, 42, 0.03);
      transition: transform 0.2s, box-shadow 0.2s, border-color 0.2s;
      position: relative;
    }
    .search-result-card:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(15, 23, 42, 0.07);
      border-color: #cbd5e1;
    }
    .result-card-top {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 8px;
      flex-wrap: wrap;
      gap: 8px;
    }
    .result-cat-badge {
      font-size: 11px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      padding: 4px 10px;
      border-radius: 6px;
      display: inline-flex;
      align-items: center;
      gap: 5px;
    }
    .cat-workout { background: #fee2e2; color: #b91c1c; }
    .cat-nutrition { background: #d1fae5; color: #065f46; }
    .cat-anatomy { background: #e0f2fe; color: #0369a1; }
    .cat-tool { background: #fef3c7; color: #92400e; }
    .cat-ebook { background: #f3e8ff; color: #7e22ce; }
    .result-card-title {
      font-family: 'Outfit', sans-serif;
      font-size: 19px;
      font-weight: 700;
      color: #0f172a;
      margin: 0 0 8px 0;
    }
    .result-card-title a {
      color: #0f172a;
      text-decoration: none;
      transition: color 0.2s;
    }
    .result-card-title a:hover {
      color: #10b981;
    }
    .result-card-desc {
      font-size: 14px;
      line-height: 1.6;
      color: #475569;
      margin-bottom: 14px;
    }
    .result-card-btn {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      color: #059669;
      font-weight: 700;
      font-size: 13.5px;
      text-decoration: none !important;
      transition: gap 0.2s;
    }
    .result-card-btn:hover {
      color: #047857;
      gap: 10px;
    }
    .highlight-term {
      background: #fef08a;
      padding: 1px 4px;
      border-radius: 3px;
      color: #854d0e;
      font-weight: 700;
    }
    .search-empty-box {
      background: #ffffff;
      border: 1.5px dashed #cbd5e1;
      border-radius: 14px;
      padding: 48px 24px;
      text-align: center;
    }
    .search-empty-icon {
      font-size: 48px;
      color: #94a3b8;
      margin-bottom: 14px;
    }
    .search-empty-title {
      font-family: 'Outfit', sans-serif;
      font-size: 20px;
      font-weight: 700;
      color: #0f172a;
      margin-bottom: 8px;
    }
    .search-empty-desc {
      color: #64748b;
      font-size: 14.5px;
      margin-bottom: 22px;
      max-width: 500px;
      margin-left: auto;
      margin-right: auto;
    }
    .popular-tags {
      display: flex;
      justify-content: center;
      gap: 8px;
      flex-wrap: wrap;
    }
    .pop-tag {
      background: #f1f5f9;
      color: #334155;
      padding: 6px 14px;
      border-radius: 20px;
      font-size: 13px;
      font-weight: 600;
      text-decoration: none !important;
      border: 1px solid #e2e8f0;
      transition: all 0.2s;
    }
    .pop-tag:hover {
      background: #10b981;
      color: #ffffff !important;
      border-color: #10b981;
    }
  </style>

  <?php
  // Retrieve search query
  $query = isset($_GET['q']) ? trim($_GET['q']) : (isset($_GET['s']) ? trim($_GET['s']) : '');
  $clean_query = htmlspecialchars($query);

  // High-value site content database for search
  $site_index = [
    // Workouts & Muscle Guides
    [
      'title' => 'Chest Workout & Pectorals Guide',
      'url' => 'Chest.php',
      'category' => 'workout',
      'cat_name' => 'Workout Guide',
      'icon' => 'fa-dumbbell',
      'desc' => 'Comprehensive upper, middle, and lower chest exercises including bench press, dumbbell flyes, incline press, push-ups, and form breakdowns.',
      'keywords' => ['chest', 'pecs', 'pectoral', 'bench press', 'incline', 'pushup', 'push-ups', 'dumbbell fly', 'cable crossover', 'upper chest', 'lower chest']
    ],
    [
      'title' => 'Arms, Biceps & Triceps Workout',
      'url' => 'Arms.php',
      'category' => 'workout',
      'cat_name' => 'Workout Guide',
      'icon' => 'fa-dumbbell',
      'desc' => 'Complete bicep and tricep isolation routines, hammer curls, barbell curls, tricep dips, pushdowns, and peak contraction tips.',
      'keywords' => ['arms', 'biceps', 'triceps', 'curls', 'hammer curls', 'tricep dips', 'pushdown', 'forearms', 'peak', 'arm day']
    ],
    [
      'title' => 'Legs, Quads & Hamstrings Workout',
      'url' => 'Legs.php',
      'category' => 'workout',
      'cat_name' => 'Workout Guide',
      'icon' => 'fa-dumbbell',
      'desc' => 'Lower body hypertrophy workouts featuring barbell squats, Romanian deadlifts, lunges, leg press, calf raises, and quad building.',
      'keywords' => ['legs', 'quads', 'hamstrings', 'squat', 'squats', 'deadlift', 'leg press', 'calves', 'lunges', 'leg day']
    ],
    [
      'title' => 'Back, Lats & Upper Body V-Taper Workout',
      'url' => 'Back.php',
      'category' => 'workout',
      'cat_name' => 'Workout Guide',
      'icon' => 'fa-dumbbell',
      'desc' => 'Develop back width and thickness with pull-ups, barbell rows, lat pulldowns, seated cable rows, and lower back stability training.',
      'keywords' => ['back', 'lats', 'pullups', 'pull-ups', 'rows', 'barbell rows', 'lat pulldown', 'v-taper', 'upper body', 'rhomboids']
    ],
    [
      'title' => 'Shoulder & Deltoid Training Guide',
      'url' => 'Shoulder.php',
      'category' => 'workout',
      'cat_name' => 'Workout Guide',
      'icon' => 'fa-dumbbell',
      'desc' => 'Target anterior, lateral, and rear deltoids with overhead shoulder press, lateral raises, face pulls, and Arnold presses.',
      'keywords' => ['shoulder', 'shoulders', 'deltoids', 'delts', 'overhead press', 'lateral raise', 'face pull', 'arnold press', 'rear delts']
    ],
    [
      'title' => 'Core, Abs & Abdominal Conditioning',
      'url' => 'Abdomen.php',
      'category' => 'workout',
      'cat_name' => 'Workout Guide',
      'icon' => 'fa-dumbbell',
      'desc' => 'Six-pack abs and functional core stability routines: planks, hanging leg raises, cable crunches, and oblique training.',
      'keywords' => ['abs', 'abdomen', 'core', 'six pack', 'plank', 'crunches', 'leg raise', 'obliques', 'belly']
    ],
    [
      'title' => 'Cardio, HIIT & Stamina Conditioning',
      'url' => 'cardio.php',
      'category' => 'workout',
      'cat_name' => 'Cardio & Stamina',
      'icon' => 'fa-heartbeat',
      'desc' => 'High-intensity interval training (HIIT), fat loss protocols, aerobic endurance, steady-state cardio, and heart rate optimization.',
      'keywords' => ['cardio', 'hiit', 'stamina', 'running', 'endurance', 'fat loss', 'heart rate', 'aerobic', 'calories']
    ],
    [
      'title' => 'Progressive Workout Routines & Split Plans',
      'url' => 'Workout-Routine.php',
      'category' => 'workout',
      'cat_name' => 'Routines',
      'icon' => 'fa-calendar-check',
      'desc' => 'Structured daily training splits, push-pull-legs (PPL), upper-lower splits, hypertrophy rep ranges, and rest periods.',
      'keywords' => ['routine', 'routines', 'split', 'ppl', 'push pull legs', 'workout plan', 'hypertrophy', 'reps', 'sets']
    ],

    // Nutrition & Diet
    [
      'title' => 'Plant-Based Protein Guide & Complete Food Chart',
      'url' => 'Plant-Protein.php',
      'category' => 'nutrition',
      'cat_name' => 'Nutrition Guide',
      'icon' => 'fa-leaf',
      'desc' => 'Comprehensive nutritional breakdown of tofu, tempeh, lentils, hemp seeds, seitan, quinoa, and essential amino acid profiles.',
      'keywords' => ['protein', 'plant protein', 'vegan protein', 'tofu', 'tempeh', 'lentils', 'hemp seeds', 'seitan', 'amino acids', 'complete protein']
    ],
    [
      'title' => '7-Day Vegan Meal & Diet Plans',
      'url' => 'Vegan-Diet-Plan.php',
      'category' => 'nutrition',
      'cat_name' => 'Diet Plans',
      'icon' => 'fa-apple-alt',
      'desc' => 'Full 7-day plant-based meal planning for muscle growth, fat loss, optimal micronutrient balance, and high-protein vegan recipes.',
      'keywords' => ['vegan', 'diet', 'meal plan', 'vegan meal', 'diet plan', 'recipes', 'vegan recipes', 'nutrition', 'calories']
    ],
    [
      'title' => 'Food & Nutrition Fundamentals',
      'url' => 'food-nutrtion.php',
      'category' => 'nutrition',
      'cat_name' => 'Nutrition Guide',
      'icon' => 'fa-utensils',
      'desc' => 'Macronutrient essentials: protein synthesis, healthy fats, complex carbohydrates, hydration, and nutritional timing.',
      'keywords' => ['nutrition', 'food', 'macros', 'carbs', 'fats', 'vitamins', 'minerals', 'dietary', 'supplements']
    ],

    // Anatomy & Science
    [
      'title' => 'Human Muscle Anatomy & 12 Target Zones',
      'url' => 'Muscles.php',
      'category' => 'anatomy',
      'cat_name' => 'Muscle Anatomy',
      'icon' => 'fa-cubes',
      'desc' => 'Interactive visual muscle map covering 12 anatomical muscle groups, origin, insertion, function, and target training movements.',
      'keywords' => ['muscle', 'muscles', 'anatomy', 'muscle anatomy', 'biomechanics', 'human body', 'muscle groups']
    ],
    [
      'title' => 'Fitness & Bodybuilding Terminology Glossary',
      'url' => 'Terminolgies.php',
      'category' => 'anatomy',
      'cat_name' => 'Terminology',
      'icon' => 'fa-book',
      'desc' => 'Understand gym terms: hypertrophy, progressive overload, TUT (time under tension), supersets, dropsets, 1RM, and DOMS.',
      'keywords' => ['terminology', 'glossary', 'terms', 'hypertrophy', 'overload', 'superset', '1rm', 'doms', 'reps']
    ],

    // Tools & Calculators
    [
      'title' => 'Interactive BMI Calculator & Calorie Estimator',
      'url' => 'BMI-calc.php',
      'category' => 'tool',
      'cat_name' => 'Health Tool',
      'icon' => 'fa-calculator',
      'desc' => 'Calculate your Body Mass Index (BMI), healthy weight ranges, Basal Metabolic Rate (BMR), and daily maintenance calorie requirements.',
      'keywords' => ['bmi', 'bmi calculator', 'calculator', 'calories', 'bmr', 'weight', 'height', 'underweight', 'overweight', 'body mass']
    ],
    [
      'title' => 'Exercise Logger & Workout Tracking',
      'url' => 'log_exercise.php',
      'category' => 'tool',
      'cat_name' => 'Tracking Tool',
      'icon' => 'fa-pencil-alt',
      'desc' => 'Log your completed exercises, sets, reps, and weights to monitor progressive overload and consistency over time.',
      'keywords' => ['log', 'track', 'exercise log', 'workout log', 'tracker', 'sets', 'reps', 'weight']
    ],
    [
      'title' => 'Exercise History & Completed Workouts Log',
      'url' => 'exercise-done.php',
      'category' => 'tool',
      'cat_name' => 'History Log',
      'icon' => 'fa-history',
      'desc' => 'View all your previously logged workout sessions, historical training data, and fitness consistency benchmarks.',
      'keywords' => ['exercise done', 'history', 'completed exercises', 'log history', 'past workouts']
    ],

    // Resources & Library
    [
      'title' => 'Free Fitness & Bodybuilding Ebooks Library',
      'url' => 'Ebooks.php',
      'category' => 'ebook',
      'cat_name' => 'Ebooks Library',
      'icon' => 'fa-book-open',
      'desc' => 'Download free illustrated training PDF books including Strength Training Anatomy, nutrition manuals, and workout guides.',
      'keywords' => ['ebooks', 'ebook', 'books', 'pdf', 'strength training anatomy', 'download', 'free books', 'library']
    ],
    [
      'title' => 'Member Stories & Fitness Transformations',
      'url' => 'Stories.php',
      'category' => 'anatomy',
      'cat_name' => 'Community',
      'icon' => 'fa-users',
      'desc' => 'Inspiring real-life transformation stories from Lean\'N\'Green community members achieving fitness goals on a plant-based diet.',
      'keywords' => ['stories', 'transformation', 'member stories', 'community', 'inspiration', 'before after']
    ]
  ];

  // Perform search matching
  $results = [];
  if (!empty($query)) {
    $q_lower = strtolower($query);
    $q_tokens = explode(' ', $q_lower);

    // 1. Search Static Guides
    foreach ($site_index as $item) {
      $score = 0;
      $title_lower = strtolower($item['title']);
      $desc_lower = strtolower($item['desc']);

      // Exact phrase match in title
      if (strpos($title_lower, $q_lower) !== false) {
        $score += 20;
      }
      // Exact phrase match in description
      if (strpos($desc_lower, $q_lower) !== false) {
        $score += 10;
      }

      // Keyword token matches
      foreach ($item['keywords'] as $kw) {
        if (strpos($kw, $q_lower) !== false || strpos($q_lower, $kw) !== false) {
          $score += 15;
        }
      }

      // Token matches
      foreach ($q_tokens as $token) {
        if (strlen($token) >= 2) {
          if (strpos($title_lower, $token) !== false) $score += 8;
          if (strpos($desc_lower, $token) !== false) $score += 4;
          foreach ($item['keywords'] as $kw) {
            if (strpos($kw, $token) !== false) $score += 6;
          }
        }
      }

      if ($score > 0) {
        $item['score'] = $score;
        $results[] = $item;
      }
    }

    // 2. Search Database `plant_protein` table if available
    if (isset($conn) && $conn) {
      $searchTerm = '%' . $conn->real_escape_string($query) . '%';
      $sql = "SELECT * FROM plant_protein WHERE name LIKE ? OR type LIKE ? OR notes LIKE ? LIMIT 5";
      $stmt = $conn->prepare($sql);
      if ($stmt) {
        $stmt->bind_param('sss', $searchTerm, $searchTerm, $searchTerm);
        $stmt->execute();
        $db_res = $stmt->get_result();
        while ($row = $db_res->fetch_assoc()) {
          $results[] = [
            'title' => $row['name'] . ' (' . $row['protein_per_100g'] . 'g Protein / 100g)',
            'url' => 'Plant-Protein.php',
            'category' => 'nutrition',
            'cat_name' => 'Food Item',
            'icon' => 'fa-leaf',
            'desc' => 'Type: ' . $row['type'] . ' &bull; Calories: ' . $row['calories_per_100g'] . ' kcal/100g. ' . $row['notes'],
            'score' => 25
          ];
        }
        $stmt->close();
      }
    }

    // Sort by score descending
    usort($results, function($a, $b) {
      return $b['score'] <=> $a['score'];
    });
  }

  $totalResults = count($results);

  // Helper to highlight match query words
  function highlightMatches($text, $query) {
    if (empty($query)) return htmlspecialchars($text);
    $words = explode(' ', preg_quote($query, '/'));
    $pattern = '/(' . implode('|', array_filter($words)) . ')/i';
    return preg_replace($pattern, '<span class="highlight-term">$1</span>', htmlspecialchars($text));
  }
  ?>

  <!-- Header Banner -->
  <section class="search-hero">
    <div class="container">
      <div class="row" style="display:flex; align-items:center; flex-wrap:wrap;">
        <div class="col-md-8 col-sm-8 col-xs-12">
          <?php if (!empty($query)): ?>
            <h1 class="search-hero-title">
              <i class="fa fa-search text-emerald"></i> Search Results
            </h1>
            <p class="search-hero-subtitle">
              Showing <?php echo $totalResults; ?> results matching "<strong><?php echo $clean_query; ?></strong>"
            </p>
          <?php else: ?>
            <h1 class="search-hero-title">
              <i class="fa fa-search text-emerald"></i> Search Guides &amp; Tools
            </h1>
            <p class="search-hero-subtitle">
              Type a workout, nutrition, anatomy, or calculator keyword to explore our entire fitness index.
            </p>
          <?php endif; ?>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12 text-right">
          <ol class="search-breadcrumb">
            <li><a href="index.php" style="color:#34d399;"><i class="fa fa-home"></i> Home</a></li>
            <li class="active" style="color:#e2e8f0;">Search</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <!-- Main Search Content -->
  <section class="search-page-section">
    <div class="container">
      <div class="row">
        <!-- Left Column: Search Form & Results (col-md-8) -->
        <div class="col-md-8">
          
          <!-- Search Box Widget -->
          <div class="search-box-widget">
            <form action="search.php" method="GET">
              <div class="search-box-input-wrapper">
                <i class="fa fa-search"></i>
                <input type="text" name="q" class="search-box-input" placeholder="Search workouts, plant protein, anatomy, BMI..." value="<?php echo $clean_query; ?>" required autofocus>
              </div>
              <button type="submit" class="search-box-btn">
                <i class="fa fa-arrow-right"></i> Search
              </button>
            </form>
          </div>

          <?php if (!empty($query)): ?>
            <!-- Category Filter Pills -->
            <div class="search-filter-pills">
              <a href="#" class="filter-pill active" onclick="filterResults('all', this); return false;">All (<?php echo $totalResults; ?>)</a>
              <a href="#" class="filter-pill" onclick="filterResults('workout', this); return false;">Workouts</a>
              <a href="#" class="filter-pill" onclick="filterResults('nutrition', this); return false;">Nutrition</a>
              <a href="#" class="filter-pill" onclick="filterResults('anatomy', this); return false;">Anatomy</a>
              <a href="#" class="filter-pill" onclick="filterResults('tool', this); return false;">Tools</a>
              <a href="#" class="filter-pill" onclick="filterResults('ebook', this); return false;">Ebooks</a>
            </div>

            <!-- Results List -->
            <?php if ($totalResults > 0): ?>
              <div class="search-results-list">
                <?php foreach ($results as $item): ?>
                  <div class="search-result-card" data-category="<?php echo $item['category']; ?>">
                    <div class="result-card-top">
                      <span class="result-cat-badge cat-<?php echo $item['category']; ?>">
                        <i class="fa <?php echo $item['icon']; ?>"></i> <?php echo $item['cat_name']; ?>
                      </span>
                    </div>
                    <h3 class="result-card-title">
                      <a href="<?php echo $item['url']; ?>">
                        <?php echo highlightMatches($item['title'], $query); ?>
                      </a>
                    </h3>
                    <p class="result-card-desc">
                      <?php echo highlightMatches($item['desc'], $query); ?>
                    </p>
                    <a href="<?php echo $item['url']; ?>" class="result-card-btn">
                      Open Resource &rarr;
                    </a>
                  </div>
                <?php endforeach; ?>
              </div>
            <?php else: ?>
              <!-- 0 Results State -->
              <div class="search-empty-box">
                <i class="fa fa-search search-empty-icon"></i>
                <h3 class="search-empty-title">No direct matches found for "<?php echo $clean_query; ?>"</h3>
                <p class="search-empty-desc">
                  We couldn't find a direct guide matching your search term. Try checking for typos or explore our most popular fitness topics below:
                </p>
                <div class="popular-tags">
                  <a href="search.php?q=Plant+Protein" class="pop-tag">#PlantProtein</a>
                  <a href="search.php?q=Chest+Workout" class="pop-tag">#ChestWorkout</a>
                  <a href="search.php?q=BMI+Calculator" class="pop-tag">#BMICalculator</a>
                  <a href="search.php?q=Free+Ebooks" class="pop-tag">#FreeEbooks</a>
                  <a href="search.php?q=Vegan+Diet" class="pop-tag">#VeganDiet</a>
                  <a href="search.php?q=Biceps" class="pop-tag">#Biceps</a>
                  <a href="search.php?q=HIIT+Cardio" class="pop-tag">#Cardio</a>
                </div>
              </div>
            <?php endif; ?>

          <?php else: ?>
            <!-- Initial Empty Search State -->
            <div class="search-empty-box">
              <i class="fa fa-compass search-empty-icon"></i>
              <h3 class="search-empty-title">Explore Lean'N'Green Fitness Index</h3>
              <p class="search-empty-desc">
                Find exactly what you need to build muscle and optimize health. Pick a trending topic or use the search bar above:
              </p>
              <div class="popular-tags">
                <a href="search.php?q=Plant+Protein" class="pop-tag">#PlantProtein</a>
                <a href="search.php?q=Chest+Workout" class="pop-tag">#ChestWorkout</a>
                <a href="search.php?q=BMI+Calculator" class="pop-tag">#BMICalculator</a>
                <a href="search.php?q=Free+Ebooks" class="pop-tag">#FreeEbooks</a>
                <a href="search.php?q=Vegan+Diet" class="pop-tag">#VeganDiet</a>
                <a href="search.php?q=Biceps" class="pop-tag">#Biceps</a>
                <a href="search.php?q=Muscle+Anatomy" class="pop-tag">#MuscleAnatomy</a>
                <a href="search.php?q=HIIT+Cardio" class="pop-tag">#Cardio</a>
              </div>
            </div>
          <?php endif; ?>

        </div>

        <!-- Right Column: Sidebar (col-md-4) -->
        <?php include('sidebar.php'); ?>
      </div>
    </div>
  </section>

  <script>
  function filterResults(category, btn) {
    document.querySelectorAll('.filter-pill').forEach(function(el) {
      el.classList.remove('active');
    });
    btn.classList.add('active');

    var cards = document.querySelectorAll('.search-result-card');
    cards.forEach(function(card) {
      if (category === 'all' || card.getAttribute('data-category') === category) {
        card.style.display = 'block';
      } else {
        card.style.display = 'none';
      }
    });
  }
  </script>

  <?php include('footer.php'); ?>
