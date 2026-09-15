<?php
$pageTitle = "Lean'N'Green : Log Exercise";
include('header.php');
include_once('db.php');

$user_id = $_SESSION['id'] ?? null;
$exercise_id = isset($_GET['exercise_id']) ? intval($_GET['exercise_id']) : 0;
$muscle_group = isset($_GET['muscle_group']) ? htmlspecialchars($_GET['muscle_group']) : 'Workout';
$log_msg = '';

$exercise = null;
if ($exercise_id > 0 && isset($pdo) && $pdo) {
    $stmt = $pdo->prepare("SELECT * FROM exercises WHERE id = ?");
    $stmt->execute([$exercise_id]);
    $exercise = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($user_id && $exercise && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $duration = isset($_POST['duration']) ? intval($_POST['duration']) : 0;
    $sets = isset($_POST['sets']) ? intval($_POST['sets']) : 0;
    $reps = isset($_POST['reps']) ? intval($_POST['reps']) : 0;
    $weight = isset($_POST['weight']) && $_POST['weight'] !== '' ? floatval($_POST['weight']) : null;

    if ($duration <= 0 || $sets <= 0 || $reps <= 0) {
        $log_msg = '<div class="alert alert-warning" style="border-radius:10px;"><i class="fa fa-exclamation-triangle"></i> Please enter valid positive values for duration, sets, and reps.</div>';
    } else {
        $cal_per_min = floatval($exercise['avg_calories_burned_per_min'] ?? 7.5);
        $calories_burned = $duration * $cal_per_min;
        $fat_loss = $calories_burned / 9;

        $insert_query = "INSERT INTO user_exercises (user_id, exercise_id, name, duration_minutes, sets, reps, weight_kg, date_performed, calories_burned, fat_loss_grams)
                         VALUES (?, ?, ?, ?, ?, ?, ?, CURDATE(), ?, ?)";
        $stmt = $pdo->prepare($insert_query);
        if ($stmt->execute([$user_id, $exercise_id, $exercise['name'], $duration, $sets, $reps, $weight, $calories_burned, $fat_loss])) {
            $log_msg = '<div class="alert alert-success" style="border-radius:10px;"><i class="fa fa-check-circle"></i> Exercise logged successfully! <strong>' . number_format($calories_burned, 1) . ' calories burned</strong> (' . number_format($fat_loss, 1) . 'g fat loss). <a href="exercise-done.php" class="alert-link" style="text-decoration:underline; font-weight:700;">View Exercise Log &rarr;</a></div>';
        } else {
            $log_msg = '<div class="alert alert-danger" style="border-radius:10px;"><i class="fa fa-exclamation-circle"></i> Error logging exercise. Please try again.</div>';
        }
    }
}
?>

<!-- Header Banner -->
<section id="single-page-header4" style="background:linear-gradient(135deg, #0f172a 0%, #1e293b 100%); padding:50px 0; border-bottom:1px solid rgba(255,255,255,0.08);">
  <div class="container">
    <div class="row" style="display:flex; align-items:center; flex-wrap:wrap;">
      <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="single-page-header-left">
          <span class="hero-badge" style="margin-bottom:8px; display:inline-block; background:rgba(16,185,129,0.15); color:#34d399; padding:4px 12px; border-radius:16px; font-size:12px; font-weight:700;">
            <i class="fa fa-plus-circle"></i> WORKOUT TRACKER
          </span>
          <h1 style="color:#fff; font-family:'Outfit',sans-serif; font-size:32px; font-weight:800; margin:4px 0 0 0;">
            Log Exercise Set
          </h1>
        </div>
      </div>
      <div class="col-md-6 col-sm-6 col-xs-12 text-right">
        <ol class="breadcrumb" style="background:rgba(255,255,255,0.06); border-radius:10px; display:inline-block; padding:10px 18px; margin:10px 0 0 0;">
          <li><a href="index.php" style="color:#34d399;"><i class="fa fa-home"></i> Home</a></li>
          <li style="color:#94a3b8;">Workouts</li>
          <li class="active" style="color:#e2e8f0;">Log Exercise</li>
        </ol>
      </div>
    </div>
  </div>
</section>

<?php if (!$user_id): ?>
<!-- Unauthenticated Login Prompt -->
<section style="padding: 70px 0 90px 0; background: #f8fafc; min-height: 500px;">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3 text-center">
        <div style="background: #ffffff; border-radius: 20px; border: 1px solid #e2e8f0; padding: 45px 35px; box-shadow: 0 10px 30px rgba(15,23,42,0.06);">
          <div style="width: 76px; height: 76px; background: linear-gradient(135deg, #ecfdf5, #d1fae5); border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 20px; border: 2px solid #a7f3d0;">
            <i class="fa fa-user-lock" style="font-size: 32px; color: #059669;"></i>
          </div>
          <h2 style="font-family: 'Outfit', sans-serif; font-size: 26px; font-weight: 800; color: #0f172a; margin-top: 0; margin-bottom: 12px;">
            Sign In to Log Exercises
          </h2>
          <p style="color: #64748b; font-size: 15px; line-height: 1.6; margin-bottom: 28px;">
            To log your workout sets, reps, and track your calories burned over time, please sign in or create a Lean'N'Green athlete account.
          </p>
          <div style="display: flex; gap: 12px; justify-content: center; flex-wrap: wrap;">
            <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#login-form"
              style="background: linear-gradient(135deg, #10b981, #059669); border: none; padding: 12px 28px; border-radius: 12px; font-weight: 700; font-size: 15px; box-shadow: 0 6px 18px rgba(16,185,129,0.35); transition: all 0.2s;">
              <i class="fa fa-sign-in" style="margin-right: 6px;"></i> Sign In / Register
            </button>
            <a href="Chest.php" class="btn btn-default btn-lg"
              style="background: #f1f5f9; border: 1px solid #cbd5e1; padding: 12px 24px; border-radius: 12px; font-weight: 600; font-size: 15px; color: #475569;">
              <i class="fa fa-dumbbell" style="margin-right: 6px;"></i> View Workouts
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php elseif (!$exercise): ?>
<section style="padding: 70px 0; background: #f8fafc;">
  <div class="container text-center">
    <div style="background: #ffffff; border-radius: 16px; border: 1px solid #e2e8f0; padding: 40px; max-width: 540px; margin: 0 auto;">
      <i class="fa fa-info-circle" style="font-size: 36px; color: #94a3b8; margin-bottom: 12px;"></i>
      <h3 style="font-family: 'Outfit', sans-serif; font-weight: 700; color: #0f172a;">Exercise Not Found</h3>
      <p style="color: #64748b; margin-bottom: 20px;">Please select an exercise from our workout guides to log.</p>
      <a href="Chest.php" class="btn btn-success" style="background: #10b981; border: none; padding: 10px 24px; border-radius: 8px;">Explore Exercises</a>
    </div>
  </div>
</section>

<?php else: ?>

<!-- Authenticated Logging Form -->
<section style="padding: 50px 0 80px 0; background: #f8fafc;">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div style="background: #ffffff; border-radius: 18px; border: 1px solid #e2e8f0; padding: 32px; box-shadow: 0 4px 20px rgba(15,23,42,0.06);">
          
          <div style="border-bottom: 2px solid #f1f5f9; padding-bottom: 18px; margin-bottom: 22px;">
            <span style="background: #ecfdf5; color: #065f46; font-size: 12px; font-weight: 700; padding: 3px 10px; border-radius: 12px; text-transform: uppercase;">
              <?= htmlspecialchars($exercise['muscle_group'] ?? $muscle_group) ?>
            </span>
            <h2 style="font-family: 'Outfit', sans-serif; font-size: 24px; font-weight: 800; color: #0f172a; margin: 8px 0 4px 0;">
              <?= htmlspecialchars($exercise['name']) ?>
            </h2>
            <p style="color: #64748b; font-size: 14px; margin: 0;">
              Burn rate: <strong style="color: #059669;"><?= htmlspecialchars($exercise['avg_calories_burned_per_min']) ?> cal/min</strong>
            </p>
          </div>

          <?php if (!empty($log_msg)) echo $log_msg; ?>

          <form action="" method="POST">
            <div class="form-group" style="margin-bottom: 18px;">
              <label for="duration" style="font-size: 13.5px; font-weight: 600; color: #334155; margin-bottom: 6px; display: block;">
                Workout Duration (minutes) <span style="color: #ef4444;">*</span>
              </label>
              <div class="input-group" style="width: 100%;">
                <span class="input-group-addon" style="background: #f8fafc; border-color: #cbd5e1; color: #64748b; border-radius: 10px 0 0 10px;"><i class="fa fa-clock"></i></span>
                <input type="number" name="duration" id="duration" class="form-control" placeholder="e.g. 15" min="1" max="180" required style="height: 44px; border-radius: 0 10px 10px 0; border-color: #cbd5e1;">
              </div>
            </div>

            <div class="row">
              <div class="col-xs-6">
                <div class="form-group" style="margin-bottom: 18px;">
                  <label for="sets" style="font-size: 13.5px; font-weight: 600; color: #334155; margin-bottom: 6px; display: block;">
                    Sets <span style="color: #ef4444;">*</span>
                  </label>
                  <input type="number" name="sets" id="sets" class="form-control" placeholder="e.g. 3" min="1" max="50" required style="height: 44px; border-radius: 10px; border-color: #cbd5e1;">
                </div>
              </div>
              <div class="col-xs-6">
                <div class="form-group" style="margin-bottom: 18px;">
                  <label for="reps" style="font-size: 13.5px; font-weight: 600; color: #334155; margin-bottom: 6px; display: block;">
                    Reps / Set <span style="color: #ef4444;">*</span>
                  </label>
                  <input type="number" name="reps" id="reps" class="form-control" placeholder="e.g. 12" min="1" max="100" required style="height: 44px; border-radius: 10px; border-color: #cbd5e1;">
                </div>
              </div>
            </div>

            <div class="form-group" style="margin-bottom: 24px;">
              <label for="weight" style="font-size: 13.5px; font-weight: 600; color: #334155; margin-bottom: 6px; display: block;">
                Weight in kg <span style="color: #94a3b8; font-weight: normal;">(Optional - leave blank for bodyweight)</span>
              </label>
              <div class="input-group" style="width: 100%;">
                <span class="input-group-addon" style="background: #f8fafc; border-color: #cbd5e1; color: #64748b; border-radius: 10px 0 0 10px;"><i class="fa fa-weight-hanging fa-dumbbell"></i></span>
                <input type="number" step="0.5" name="weight" id="weight" class="form-control" placeholder="e.g. 25.0" style="height: 44px; border-radius: 0 10px 10px 0; border-color: #cbd5e1;">
              </div>
            </div>

            <div style="display: flex; gap: 10px;">
              <button type="submit" class="btn btn-success" style="flex: 1; height: 48px; background: linear-gradient(135deg, #10b981, #059669); border: none; border-radius: 10px; font-weight: 700; font-size: 15px; box-shadow: 0 4px 14px rgba(16,185,129,0.35);">
                <i class="fa fa-check" style="margin-right: 6px;"></i> Save &amp; Log Exercise
              </button>
              <a href="exercise-done.php" class="btn btn-default" style="height: 48px; line-height: 34px; background: #f8fafc; border: 1px solid #cbd5e1; border-radius: 10px; font-weight: 600; color: #475569; padding: 0 18px;">
                History
              </a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<?php endif; ?>

<?php include('footer.php'); ?>