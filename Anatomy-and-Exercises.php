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
              <h2>Anatomy &amp; Exercises</h2>
              <p>
              <blockquote>"PEOPLE eat meat and think will become STRONG as an OX, forgetting that the OX eats GRASS."</blockquote>
              </p>
            </div>
          </div>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="single-page-header-right">
              <ol class="breadcrumb">
                <li><a href="index.php">Home</a></li>
                <li><a href="Muscles.php">Workout</a></li>
                <li class="active">Anatomy and Exercises</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End single page header -->

  <!-- Interactive Anatomy Explorer Section -->
  <section id="anatomy-showcase" style="padding: 50px 0 30px 0; background: #f8fafc;">
    <div class="container">
      
      <div class="anatomy-explorer-card">
        
        <!-- Section Title & Description inside card -->
        <div style="text-align: center; margin-bottom: 25px;">
          <span style="background: #ecfdf5; color: #059669; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; padding: 5px 16px; border-radius: 20px; display: inline-block; margin-bottom: 10px; border: 1px solid #a7f3d0;">
            <i class="fa fa-crosshairs" style="margin-right: 6px;"></i> Interactive Muscle Map
          </span>
          <h2 style="font-family: 'Outfit', sans-serif; font-size: 28px; font-weight: 800; color: #0f172a; margin: 0 0 8px 0;">
            Target Your Training by Muscle Anatomy
          </h2>
          <p style="color: #64748b; font-size: 14.5px; max-width: 620px; margin: 0 auto;">
            Click any muscle pointer on the model below to immediately jump to dedicated exercises, target mechanics, and form guides.
          </p>
        </div>

        <!-- View Controls (Front / Back Body) -->
        <div class="anatomy-controls">
          <button type="button" id="tab-front" class="anatomy-tab-btn active" onclick="switchAnatomyView('front')">
            <i class="fa fa-user"></i> Front Muscles (Anterior)
          </button>
          <button type="button" id="tab-back" class="anatomy-tab-btn" onclick="switchAnatomyView('back')">
            <i class="fa fa-shield-alt fa-shield"></i> Back Muscles (Posterior)
          </button>
        </div>

        <!-- Interactive Stage -->
        <div class="anatomy-stage">

          <!-- FRONT ANATOMY VIEW -->
          <div id="view-front" class="anatomy-view active">
            <img src="assets/images/muscle-anatomy-front.jpg" alt="Human Muscular Anatomy Front View" class="anatomy-stage-img">

            <!-- Pointer: Shoulders (Viewer Right) -->
            <a href="Shoulder.php" class="muscle-pointer pointer-right" style="top: 22%; left: 59%;" title="Click to view Shoulder Exercises">
              <span class="muscle-pin"></span>
              <span class="muscle-line"></span>
              <span class="muscle-badge-btn">
                <i class="fa fa-dumbbell" style="color:#10b981;"></i>
                Shoulders
                <span class="muscle-sub">Deltoids</span>
              </span>
            </a>

            <!-- Pointer: Chest (Viewer Left) -->
            <a href="Chest.php" class="muscle-pointer pointer-left" style="top: 25.5%; right: 54%;" title="Click to view Chest Exercises">
              <span class="muscle-pin"></span>
              <span class="muscle-line"></span>
              <span class="muscle-badge-btn">
                <i class="fa fa-fire" style="color:#10b981;"></i>
                Chest
                <span class="muscle-sub">Pectorals</span>
              </span>
            </a>

            <!-- Pointer: Arms (Viewer Right) -->
            <a href="Arms.php" class="muscle-pointer pointer-right" style="top: 38%; left: 61%;" title="Click to view Arms Exercises">
              <span class="muscle-pin"></span>
              <span class="muscle-line"></span>
              <span class="muscle-badge-btn">
                <i class="fa fa-bolt" style="color:#10b981;"></i>
                Arms
                <span class="muscle-sub">Biceps &amp; Triceps</span>
              </span>
            </a>

            <!-- Pointer: Abdomen (Viewer Left) -->
            <a href="Abdomen.php" class="muscle-pointer pointer-left" style="top: 36.5%; right: 49%;" title="Click to view Abdominal Exercises">
              <span class="muscle-pin"></span>
              <span class="muscle-line"></span>
              <span class="muscle-badge-btn">
                <i class="fa fa-compress" style="color:#10b981;"></i>
                Abdominal
                <span class="muscle-sub">Core &amp; Abs</span>
              </span>
            </a>

            <!-- Pointer: Legs / Quads (Viewer Right) -->
            <a href="Legs.php" class="muscle-pointer pointer-right" style="top: 67%; left: 55%;" title="Click to view Legs Exercises">
              <span class="muscle-pin"></span>
              <span class="muscle-line"></span>
              <span class="muscle-badge-btn">
                <i class="fa fa-running" style="color:#10b981;"></i>
                Legs
                <span class="muscle-sub">Quadriceps</span>
              </span>
            </a>

            <!-- Bottom Left Quick Indicator for Back -->
            <div style="position: absolute; bottom: 16px; left: 16px; background: rgba(15,23,42,0.85); backdrop-filter: blur(6px); padding: 8px 14px; border-radius: 10px; border: 1px solid rgba(255,255,255,0.1); font-size: 12px; color: #cbd5e1;">
              <i class="fa fa-info-circle text-emerald"></i> Want Back or Glutes? <a href="javascript:void(0)" onclick="switchAnatomyView('back')" style="color:#34d399; font-weight:700; text-decoration:underline;">Switch to Posterior View</a>
            </div>
          </div>

          <!-- BACK ANATOMY VIEW -->
          <div id="view-back" class="anatomy-view">
            <img src="assets/images/muscle-anatomy-back.jpg" alt="Human Muscular Anatomy Back View" class="anatomy-stage-img">

            <!-- Pointer: Upper Back & Traps (Viewer Left) -->
            <a href="Back.php" class="muscle-pointer pointer-left" style="top: 24%; right: 49%;" title="Click to view Back Exercises">
              <span class="muscle-pin"></span>
              <span class="muscle-line"></span>
              <span class="muscle-badge-btn">
                <i class="fa fa-shield-alt fa-shield" style="color:#10b981;"></i>
                Upper Back
                <span class="muscle-sub">Trapezius</span>
              </span>
            </a>

            <!-- Pointer: Lats & Wings (Viewer Left) -->
            <a href="Back.php" class="muscle-pointer pointer-left" style="top: 41%; right: 54%;" title="Click to view Latissimus Exercises">
              <span class="muscle-pin"></span>
              <span class="muscle-line"></span>
              <span class="muscle-badge-btn">
                <i class="fa fa-layer-group fa-bars" style="color:#10b981;"></i>
                Lats
                <span class="muscle-sub">Latissimus Dorsi</span>
              </span>
            </a>

            <!-- Pointer: Arms & Rear Delts (Viewer Right) -->
            <a href="Arms.php" class="muscle-pointer pointer-right" style="top: 36%; left: 66%;" title="Click to view Arms Exercises">
              <span class="muscle-pin"></span>
              <span class="muscle-line"></span>
              <span class="muscle-badge-btn">
                <i class="fa fa-bolt" style="color:#10b981;"></i>
                Triceps &amp; Arms
                <span class="muscle-sub">Rear Delts</span>
              </span>
            </a>

            <!-- Pointer: Glutes & Buttocks (Viewer Right) -->
            <a href="Buttocks.php" class="muscle-pointer pointer-right" style="top: 64%; left: 53%;" title="Click to view Glutes Exercises">
              <span class="muscle-pin"></span>
              <span class="muscle-line"></span>
              <span class="muscle-badge-btn">
                <i class="fa fa-arrows-alt fa-crosshairs" style="color:#10b981;"></i>
                Buttocks
                <span class="muscle-sub">Glutes</span>
              </span>
            </a>

            <!-- Pointer: Hamstrings & Legs (Viewer Right) -->
            <a href="Legs.php" class="muscle-pointer pointer-right" style="top: 86%; left: 56%;" title="Click to view Hamstrings Exercises">
              <span class="muscle-pin"></span>
              <span class="muscle-line"></span>
              <span class="muscle-badge-btn">
                <i class="fa fa-running" style="color:#10b981;"></i>
                Hamstrings &amp; Calves
                <span class="muscle-sub">Lower Body</span>
              </span>
            </a>

            <!-- Bottom Left Quick Indicator for Front -->
            <div style="position: absolute; bottom: 16px; left: 16px; background: rgba(15,23,42,0.85); backdrop-filter: blur(6px); padding: 8px 14px; border-radius: 10px; border: 1px solid rgba(255,255,255,0.1); font-size: 12px; color: #cbd5e1;">
              <i class="fa fa-info-circle text-emerald"></i> Want Chest or Abs? <a href="javascript:void(0)" onclick="switchAnatomyView('front')" style="color:#34d399; font-weight:700; text-decoration:underline;">Switch to Anterior View</a>
            </div>
          </div>

        </div>

      </div>

    </div>
  </section>

  <!-- Complete Muscle Category Direct Grid -->
  <section class="muscle-grid-section" style="background: #f8fafc; padding-top: 0;">
    <div class="container">
      <div style="text-align: center; margin-bottom: 15px;">
        <span style="font-size: 12px; font-weight: 700; text-transform: uppercase; color: #10b981; letter-spacing: 0.5px;">All Muscle Groups</span>
        <h3 style="font-family: 'Outfit', sans-serif; font-size: 24px; font-weight: 800; color: #0f172a; margin: 4px 0 8px 0;">
          Select a Muscle to Explore Workouts
        </h3>
        <p style="color: #64748b; font-size: 14.5px; margin: 0 auto;">Browse all structured workout routines and exercises categorized by anatomical focus.</p>
      </div>

      <div class="muscle-cards-grid">
        <!-- Chest -->
        <a href="Chest.php" class="muscle-card-btn">
          <div class="muscle-card-left">
            <div class="muscle-card-icon"><i class="fa fa-fire"></i></div>
            <div>
              <h4 class="muscle-card-title">Chest</h4>
              <p class="muscle-card-sub">Pectorals &amp; Incline</p>
            </div>
          </div>
          <i class="fa fa-arrow-right muscle-card-arrow"></i>
        </a>

        <!-- Shoulders -->
        <a href="Shoulder.php" class="muscle-card-btn">
          <div class="muscle-card-left">
            <div class="muscle-card-icon"><i class="fa fa-dumbbell"></i></div>
            <div>
              <h4 class="muscle-card-title">Shoulders</h4>
              <p class="muscle-card-sub">Anterior, Lateral &amp; Rear Delts</p>
            </div>
          </div>
          <i class="fa fa-arrow-right muscle-card-arrow"></i>
        </a>

        <!-- Arms -->
        <a href="Arms.php" class="muscle-card-btn">
          <div class="muscle-card-left">
            <div class="muscle-card-icon"><i class="fa fa-bolt"></i></div>
            <div>
              <h4 class="muscle-card-title">Arms</h4>
              <p class="muscle-card-sub">Biceps, Triceps &amp; Forearms</p>
            </div>
          </div>
          <i class="fa fa-arrow-right muscle-card-arrow"></i>
        </a>

        <!-- Back -->
        <a href="Back.php" class="muscle-card-btn">
          <div class="muscle-card-left">
            <div class="muscle-card-icon"><i class="fa fa-shield-alt fa-shield"></i></div>
            <div>
              <h4 class="muscle-card-title">Back</h4>
              <p class="muscle-card-sub">Lats, Traps &amp; Rhomboids</p>
            </div>
          </div>
          <i class="fa fa-arrow-right muscle-card-arrow"></i>
        </a>

        <!-- Abdominal -->
        <a href="Abdomen.php" class="muscle-card-btn">
          <div class="muscle-card-left">
            <div class="muscle-card-icon"><i class="fa fa-compress"></i></div>
            <div>
              <h4 class="muscle-card-title">Abdominal</h4>
              <p class="muscle-card-sub">Upper &amp; Lower Abs, Obliques</p>
            </div>
          </div>
          <i class="fa fa-arrow-right muscle-card-arrow"></i>
        </a>

        <!-- Buttocks -->
        <a href="Buttocks.php" class="muscle-card-btn">
          <div class="muscle-card-left">
            <div class="muscle-card-icon"><i class="fa fa-crosshairs"></i></div>
            <div>
              <h4 class="muscle-card-title">Buttocks</h4>
              <p class="muscle-card-sub">Gluteus Maximus &amp; Medius</p>
            </div>
          </div>
          <i class="fa fa-arrow-right muscle-card-arrow"></i>
        </a>

        <!-- Legs -->
        <a href="Legs.php" class="muscle-card-btn">
          <div class="muscle-card-left">
            <div class="muscle-card-icon"><i class="fa fa-running"></i></div>
            <div>
              <h4 class="muscle-card-title">Legs</h4>
              <p class="muscle-card-sub">Quads, Hamstrings &amp; Calves</p>
            </div>
          </div>
          <i class="fa fa-arrow-right muscle-card-arrow"></i>
        </a>

        <!-- Cardio -->
        <a href="cardio.php" class="muscle-card-btn">
          <div class="muscle-card-left">
            <div class="muscle-card-icon"><i class="fa fa-heartbeat"></i></div>
            <div>
              <h4 class="muscle-card-title">Cardio</h4>
              <p class="muscle-card-sub">HIIT, Stamina &amp; Conditioning</p>
            </div>
          </div>
          <i class="fa fa-arrow-right muscle-card-arrow"></i>
        </a>
      </div>
    </div>
  </section>

  <!-- Interactive Switcher Script -->
  <script>
    function switchAnatomyView(viewName) {
      var views = document.querySelectorAll('.anatomy-view');
      var tabs = document.querySelectorAll('.anatomy-tab-btn');
      
      views.forEach(function(v) {
        v.classList.remove('active');
      });
      tabs.forEach(function(t) {
        t.classList.remove('active');
      });

      var activeView = document.getElementById('view-' + viewName);
      var activeTab = document.getElementById('tab-' + viewName);
      
      if (activeView) activeView.classList.add('active');
      if (activeTab) activeTab.classList.add('active');
    }
  </script>

<?php include ('footer.php'); ?>