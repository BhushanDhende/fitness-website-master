<?php
$pageTitle = "Lean'N'Green : Exercise Log & History";
include('header.php');
include_once('db.php');

$user_id = $_SESSION['id'] ?? null;
$user_exercises = [];
$total_calories = 0;
$total_fat_loss = 0;

if ($user_id) {
    if (isset($pdo) && $pdo) {
        $stmt = $pdo->prepare("SELECT * FROM user_exercises WHERE user_id = ? ORDER BY date_performed DESC, id DESC");
        $stmt->execute([$user_id]);
        $user_exercises = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } elseif (isset($conn) && $conn) {
        $stmt = $conn->prepare("SELECT * FROM user_exercises WHERE user_id = ? ORDER BY date_performed DESC, id DESC");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $res = $stmt->get_result();
        while ($r = $res->fetch_assoc()) {
            $user_exercises[] = $r;
        }
        $stmt->close();
    }

    foreach ($user_exercises as $ex) {
        $total_calories += floatval($ex['calories_burned'] ?? 0);
        $total_fat_loss += floatval($ex['fat_loss_grams'] ?? 0);
    }
}
?>

<!-- Header Banner -->
<section id="single-page-header4" style="background:linear-gradient(135deg, #0f172a 0%, #1e293b 100%) !important; padding:50px 0 !important; border-bottom:1px solid rgba(255,255,255,0.08); float:none !important; clear:both !important; display:block !important; width:100% !important;">
  <div class="container">
    <div class="row" style="display:flex; align-items:center; flex-wrap:wrap;">
      <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="single-page-header-left">
          <span class="hero-badge" style="margin-bottom:8px; display:inline-block; background:rgba(16,185,129,0.15); color:#34d399; padding:4px 12px; border-radius:16px; font-size:12px; font-weight:700;">
            <i class="fa fa-chart-line fa-calendar-check"></i> PROGRESS TRACKER
          </span>
          <h1 style="color:#fff; font-family:'Outfit',sans-serif; font-size:32px; font-weight:800; margin:4px 0 0 0;">
            My Exercise Log
          </h1>
        </div>
      </div>
      <div class="col-md-6 col-sm-6 col-xs-12 text-right">
        <ol class="breadcrumb" style="background:rgba(255,255,255,0.06); border-radius:10px; display:inline-block; padding:10px 18px; margin:10px 0 0 0;">
          <li><a href="index.php" style="color:#34d399;"><i class="fa fa-home"></i> Home</a></li>
          <li style="color:#94a3b8;">Profile</li>
          <li class="active" style="color:#e2e8f0;">Exercise Log</li>
        </ol>
      </div>
    </div>
  </div>
</section>

<?php if (!$user_id): ?>
<!-- Unauthenticated Login Prompt -->
<section style="padding: 95px 0 110px 0; background: #f8fafc; min-height: 520px; clear: both; display: block; width: 100%;">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3 text-center">
        <div style="background: #ffffff; border-radius: 20px; border: 1px solid #e2e8f0; padding: 55px 40px; box-shadow: 0 10px 30px rgba(15,23,42,0.06); margin-top: 15px;">
          <div style="width: 76px; height: 76px; background: linear-gradient(135deg, #ecfdf5, #d1fae5); border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 20px; border: 2px solid #a7f3d0;">
            <i class="fa fa-lock" style="font-size: 32px; color: #059669;"></i>
          </div>
          <h2 style="font-family: 'Outfit', sans-serif; font-size: 26px; font-weight: 800; color: #0f172a; margin-top: 0; margin-bottom: 12px;">
            Sign In to View Exercise Log
          </h2>
          <p style="color: #64748b; font-size: 15px; line-height: 1.6; margin-bottom: 28px;">
            You need to be logged into your Lean'N'Green account to track workout records, check logged sets, and calculate calories burned.
          </p>
          <div style="display: flex; gap: 12px; justify-content: center; flex-wrap: wrap;">
            <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#login-form"
              style="background: linear-gradient(135deg, #10b981, #059669); border: none; padding: 12px 28px; border-radius: 12px; font-weight: 700; font-size: 15px; box-shadow: 0 6px 18px rgba(16,185,129,0.35); transition: all 0.2s;">
              <i class="fa fa-sign-in" style="margin-right: 6px;"></i> Sign In / Register
            </button>
            <a href="index.php" class="btn btn-default btn-lg"
              style="background: #f1f5f9; border: 1px solid #cbd5e1; padding: 12px 24px; border-radius: 12px; font-weight: 600; font-size: 15px; color: #475569;">
              <i class="fa fa-home" style="margin-right: 6px;"></i> Back to Home
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php else: ?>

<!-- Authenticated Exercise History View -->
<section style="padding: 50px 0 80px 0; background: #f8fafc;">
  <div class="container">

    <!-- Overview Stat Cards -->
    <div class="row" style="margin-bottom: 30px;">
      <div class="col-md-4 col-sm-4" style="margin-bottom: 15px;">
        <div style="background: #ffffff; border-radius: 16px; border: 1px solid #e2e8f0; padding: 22px 24px; display: flex; align-items: center; gap: 18px; box-shadow: 0 4px 16px rgba(15,23,42,0.04);">
          <div style="width: 54px; height: 54px; border-radius: 14px; background: #ecfdf5; display: flex; align-items: center; justify-content: center; border: 1px solid #a7f3d0;">
            <i class="fa fa-dumbbell" style="font-size: 22px; color: #059669;"></i>
          </div>
          <div>
            <div style="font-size: 26px; font-weight: 800; color: #0f172a; font-family: 'Outfit', sans-serif; line-height: 1;">
              <?= count($user_exercises) ?>
            </div>
            <div style="color: #64748b; font-size: 13.5px; font-weight: 600; margin-top: 4px;">Logged Exercises</div>
          </div>
        </div>
      </div>

      <div class="col-md-4 col-sm-4" style="margin-bottom: 15px;">
        <div style="background: #ffffff; border-radius: 16px; border: 1px solid #e2e8f0; padding: 22px 24px; display: flex; align-items: center; gap: 18px; box-shadow: 0 4px 16px rgba(15,23,42,0.04);">
          <div style="width: 54px; height: 54px; border-radius: 14px; background: #fff7ed; display: flex; align-items: center; justify-content: center; border: 1px solid #fed7aa;">
            <i class="fa fa-fire" style="font-size: 22px; color: #ea580c;"></i>
          </div>
          <div>
            <div style="font-size: 26px; font-weight: 800; color: #ea580c; font-family: 'Outfit', sans-serif; line-height: 1;">
              <?= number_format($total_calories, 1) ?> <span style="font-size: 15px; font-weight: 600;">cal</span>
            </div>
            <div style="color: #64748b; font-size: 13.5px; font-weight: 600; margin-top: 4px;">Total Calories Burned</div>
          </div>
        </div>
      </div>

      <div class="col-md-4 col-sm-4" style="margin-bottom: 15px;">
        <div style="background: #ffffff; border-radius: 16px; border: 1px solid #e2e8f0; padding: 22px 24px; display: flex; align-items: center; gap: 18px; box-shadow: 0 4px 16px rgba(15,23,42,0.04);">
          <div style="width: 54px; height: 54px; border-radius: 14px; background: #eff6ff; display: flex; align-items: center; justify-content: center; border: 1px solid #bfdbfe;">
            <i class="fa fa-heartbeat" style="font-size: 22px; color: #2563eb;"></i>
          </div>
          <div>
            <div style="font-size: 26px; font-weight: 800; color: #2563eb; font-family: 'Outfit', sans-serif; line-height: 1;">
              <?= number_format($total_fat_loss, 1) ?> <span style="font-size: 15px; font-weight: 600;">g</span>
            </div>
            <div style="color: #64748b; font-size: 13.5px; font-weight: 600; margin-top: 4px;">Est. Fat Burned</div>
          </div>
        </div>
      </div>
    </div>

    <!-- Main Table Card -->
    <div style="background: #ffffff; border-radius: 16px; border: 1px solid #e2e8f0; padding: 28px; box-shadow: 0 4px 20px rgba(15,23,42,0.04);">
      <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; margin-bottom: 24px; border-bottom: 2px solid #f1f5f9; padding-bottom: 16px;">
        <div>
          <h3 style="font-family: 'Outfit', sans-serif; font-size: 22px; font-weight: 700; color: #0f172a; margin: 0;">
            Workout History Log
          </h3>
          <p style="color: #64748b; font-size: 14px; margin: 4px 0 0 0;">Review your sets, weights lifted, and energy burned over time</p>
        </div>
        <div>
          <a href="Chest.php" class="btn btn-success" style="background: linear-gradient(135deg, #10b981, #059669); border: none; padding: 8px 18px; border-radius: 8px; font-weight: 700; font-size: 13.5px; box-shadow: 0 4px 12px rgba(16,185,129,0.3);">
            <i class="fa fa-plus" style="margin-right: 6px;"></i> Log New Exercise
          </a>
        </div>
      </div>

      <?php if (empty($user_exercises)): ?>
        <div style="text-align: center; padding: 50px 20px; color: #64748b;">
          <div style="width: 70px; height: 70px; border-radius: 50%; background: #f1f5f9; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 16px;">
            <i class="fa fa-dumbbell" style="font-size: 28px; color: #94a3b8;"></i>
          </div>
          <h4 style="font-family: 'Outfit', sans-serif; font-size: 20px; font-weight: 700; color: #1e293b; margin: 0 0 8px 0;">
            No Logged Exercises Yet
          </h4>
          <p style="font-size: 14.5px; max-width: 480px; margin: 0 auto 20px auto; color: #64748b;">
            Start logging your sets from our exercise guides (Chest, Arms, Legs, Back, etc.) and your training logs will show up here with calorie tracking.
          </p>
          <a href="Chest.php" class="btn btn-primary" style="background: #10b981; border: none; padding: 10px 22px; border-radius: 10px; font-weight: 600;">
            Browse Workout Guides
          </a>
        </div>
      <?php else: ?>
        <div class="table-responsive">
          <table class="table table-hover" style="margin-bottom: 0;">
            <thead>
              <tr style="background: #f8fafc; color: #475569; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px;">
                <th style="font-family: 'Outfit', sans-serif; font-weight: 700; border-bottom: 2px solid #e2e8f0; padding: 12px 16px;">Date</th>
                <th style="font-family: 'Outfit', sans-serif; font-weight: 700; border-bottom: 2px solid #e2e8f0; padding: 12px 16px;">Exercise Name</th>
                <th style="font-family: 'Outfit', sans-serif; font-weight: 700; border-bottom: 2px solid #e2e8f0; padding: 12px 16px; text-align: center;">Sets</th>
                <th style="font-family: 'Outfit', sans-serif; font-weight: 700; border-bottom: 2px solid #e2e8f0; padding: 12px 16px; text-align: center;">Reps / Duration</th>
                <th style="font-family: 'Outfit', sans-serif; font-weight: 700; border-bottom: 2px solid #e2e8f0; padding: 12px 16px; text-align: center;">Weight</th>
                <th style="font-family: 'Outfit', sans-serif; font-weight: 700; border-bottom: 2px solid #e2e8f0; padding: 12px 16px; text-align: right;">Calories Burned</th>
                <th style="font-family: 'Outfit', sans-serif; font-weight: 700; border-bottom: 2px solid #e2e8f0; padding: 12px 16px; text-align: right;">Est. Fat Loss</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($user_exercises as $ex): ?>
                <tr style="border-bottom: 1px solid #f1f5f9; font-size: 14px;">
                  <td style="padding: 14px 16px; color: #64748b; font-weight: 600;">
                    <span style="background: #f1f5f9; padding: 4px 10px; border-radius: 6px; font-size: 12.5px;">
                      <i class="fa fa-calendar-alt fa-calendar" style="margin-right: 5px; color: #10b981;"></i>
                      <?= htmlspecialchars($ex['date_performed'] ?? date('Y-m-d')) ?>
                    </span>
                  </td>
                  <td style="padding: 14px 16px; font-weight: 700; color: #0f172a;">
                    <?= htmlspecialchars($ex['name']) ?>
                  </td>
                  <td style="padding: 14px 16px; text-align: center; color: #334155; font-weight: 600;">
                    <?= htmlspecialchars($ex['sets']) ?>
                  </td>
                  <td style="padding: 14px 16px; text-align: center; color: #334155;">
                    <?= htmlspecialchars($ex['reps']) ?>
                    <?php if (!empty($ex['duration_minutes'])): ?>
                      <span style="color: #94a3b8; font-size: 12px;">(<?= $ex['duration_minutes'] ?>m)</span>
                    <?php endif; ?>
                  </td>
                  <td style="padding: 14px 16px; text-align: center; color: #334155; font-weight: 600;">
                    <?= floatval($ex['weight_kg']) > 0 ? htmlspecialchars($ex['weight_kg']) . ' kg' : '<span style="color:#94a3b8;">Bodyweight</span>' ?>
                  </td>
                  <td style="padding: 14px 16px; text-align: right; color: #059669; font-weight: 700;">
                    <?= number_format(floatval($ex['calories_burned']), 1) ?> cal
                  </td>
                  <td style="padding: 14px 16px; text-align: right; color: #2563eb; font-weight: 600;">
                    <?= number_format(floatval($ex['fat_loss_grams']), 1) ?> g
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<?php endif; ?>

<?php include('footer.php'); ?>