<!-- Start sidebar widget -->
<div class="col-md-4 col-sm-12 col-xs-12">
  <aside class="fitness-side-bar">
    

    <!-- 2. Fitness Categories -->
    <div class="sidebar-widget-card">
      <h4 class="widget-card-title"><i class="fa fa-th-large text-emerald"></i> Fitness Categories</h4>
      <ul class="sidebar-catg-list">
        <li>
          <a href="Muscles.php">
            <span><i class="fa fa-cubes text-emerald"></i> Muscle Anatomy</span>
            <span class="badge-cat">12 Zones</span>
          </a>
        </li>
        <li>
          <a href="Plant-Protein.php">
            <span><i class="fa fa-leaf text-emerald"></i> Plant Protein Chart</span>
            <span class="badge-cat">50+ Foods</span>
          </a>
        </li>
        <li>
          <a href="Vegan-Diet-Plan.php">
            <span><i class="fa fa-apple-alt text-emerald"></i> Vegan Meal Plans</span>
            <span class="badge-cat">7-Day</span>
          </a>
        </li>
        <li>
          <a href="Workout-Routine.php">
            <span><i class="fa fa-calendar-check text-emerald"></i> Hypertrophy Routines</span>
            <span class="badge-cat">Daily</span>
          </a>
        </li>
        <li>
          <a href="cardio.php">
            <span><i class="fa fa-heartbeat text-emerald"></i> Cardio &amp; Stamina</span>
            <span class="badge-cat">HIIT</span>
          </a>
        </li>
        <li>
          <a href="Ebooks.php">
            <span><i class="fa fa-book-open text-emerald"></i> Free Ebooks Library</span>
            <span class="badge-cat">10+ PDFs</span>
          </a>
        </li>
      </ul>
    </div>

    <!-- 3. Interactive Quick BMI Calculator Widget -->
    <div class="sidebar-widget-card sidebar-bmi-card">
      <div class="bmi-pill-tag"><i class="fa fa-calculator"></i> Quick Health Tool</div>
      <h4 class="widget-card-title" style="margin-top:10px; margin-bottom:6px;">Instant BMI Check</h4>
      <p style="font-size:13px; color:#64748b; margin-bottom:14px; line-height:1.4;">
        Check your Body Mass Index directly in this sidebar:
      </p>
      <div class="mini-bmi-form">
        <div class="row" style="margin:0 -5px 10px -5px;">
          <div class="col-xs-6" style="padding:0 5px;">
            <label style="font-size:12px; font-weight:600; color:#475569; margin-bottom:4px; display:block;">Weight (kg)</label>
            <input type="number" id="sb-weight" placeholder="e.g. 70" min="20" max="250" class="form-control" style="height:40px; border-radius:8px; font-size:13.5px;">
          </div>
          <div class="col-xs-6" style="padding:0 5px;">
            <label style="font-size:12px; font-weight:600; color:#475569; margin-bottom:4px; display:block;">Height (cm)</label>
            <input type="number" id="sb-height" placeholder="e.g. 175" min="80" max="250" class="form-control" style="height:40px; border-radius:8px; font-size:13.5px;">
          </div>
        </div>
        <button type="button" id="sb-calc-btn" class="btn-sidebar-bmi" onclick="calcSidebarBMI()">
          Calculate BMI
        </button>
        <div id="sb-bmi-result" style="display:none; margin-top:10px; padding:10px 14px; border-radius:8px; font-size:13px; text-align:center;"></div>
        <div style="text-align:center; margin-top:12px;">
          <a href="BMI-calc.php" style="color:#059669; font-size:12.5px; font-weight:700; text-decoration:none;">
            Full Calculator &amp; Calories &rarr;
          </a>
        </div>
      </div>
    </div>

    <!-- 4. Featured Free E-Book Download -->
    <div class="sidebar-widget-card sidebar-ebook-card">
      <span class="badge-free-pdf">FREE PDF</span>
      <div style="display:flex; gap:14px; align-items:center;">
        <img src="assets/images/Strength-Training-Anatomy.jpg" alt="Strength Training Anatomy" style="width:72px; height:94px; object-fit:cover; border-radius:8px; box-shadow:0 4px 10px rgba(0,0,0,0.15); flex-shrink:0;">
        <div>
          <h5 style="font-family:'Outfit',sans-serif; font-weight:700; font-size:15px; color:#0f172a; margin:0 0 4px 0; line-height:1.3;">
            Strength Training Anatomy
          </h5>
          <span style="font-size:12px; color:#64748b; display:block; margin-bottom:8px;">
            <i class="fa fa-file-pdf text-emerald"></i> ~5.5 MB &bull; Illustrated
          </span>
          <a href="assets/Ebooks/Strength-Training-Anatomy-1.pdf" download class="btn-sidebar-download">
            <i class="fa fa-download"></i> Download
          </a>
        </div>
      </div>
    </div>

    <!-- 5. Trending Fitness Topics -->
    <div class="sidebar-widget-card">
      <h4 class="widget-card-title"><i class="fa fa-fire text-emerald"></i> Trending Topics</h4>
      <div class="fitness-tags-container">
        <a href="Plant-Protein.php" class="fitness-tag-chip">#PlantProtein</a>
        <a href="Muscles.php" class="fitness-tag-chip">#Hypertrophy</a>
        <a href="Chest.php" class="fitness-tag-chip">#ChestDay</a>
        <a href="Vegan-Diet-Plan.php" class="fitness-tag-chip">#VeganGains</a>
        <a href="Arms.php" class="fitness-tag-chip">#Biceps</a>
        <a href="Legs.php" class="fitness-tag-chip">#SquatDepth</a>
        <a href="cardio.php" class="fitness-tag-chip">#HIITCardio</a>
        <a href="Ebooks.php" class="fitness-tag-chip">#FreeEbooks</a>
        <a href="Back.php" class="fitness-tag-chip">#VTaper</a>
        <a href="Abdomen.php" class="fitness-tag-chip">#CoreStrength</a>
      </div>
    </div>

    <!-- 6. Daily Fitness Motivation -->
    <div class="sidebar-widget-card sidebar-quote-box">
      <i class="fa fa-quote-left quote-mark"></i>
      <p class="quote-body">
        "Discipline is doing what needs to be done, even when you don't feel like doing it."
      </p>
      <span class="quote-sign">&mdash; Lean'N'Green Philosophy</span>
    </div>

  </aside>
</div>

<script>
function calcSidebarBMI() {
  var w = parseFloat(document.getElementById('sb-weight').value);
  var h = parseFloat(document.getElementById('sb-height').value);
  var res = document.getElementById('sb-bmi-result');
  if (!w || !h || w <= 0 || h <= 0) {
    res.style.display = 'block';
    res.style.background = '#fef3c7';
    res.style.color = '#92400e';
    res.innerHTML = '<i class="fa fa-exclamation-triangle"></i> Please enter valid weight & height.';
    return;
  }
  var hm = h / 100;
  var bmi = (w / (hm * hm)).toFixed(1);
  var status = '';
  var bg = '';
  var color = '';
  if (bmi < 18.5) {
    status = 'Underweight';
    bg = '#e0f2fe';
    color = '#0369a1';
  } else if (bmi < 25) {
    status = 'Normal Weight';
    bg = '#d1fae5';
    color = '#065f46';
  } else if (bmi < 30) {
    status = 'Overweight';
    bg = '#fef3c7';
    color = '#92400e';
  } else {
    status = 'Obese';
    bg = '#fee2e2';
    color = '#991b1b';
  }
  res.style.display = 'block';
  res.style.background = bg;
  res.style.color = color;
  res.innerHTML = 'BMI: <strong>' + bmi + '</strong> &bull; ' + status;
}
</script>