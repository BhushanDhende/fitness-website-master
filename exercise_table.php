<?php
// Reusable Exercise Table Component
include_once('db.php');

$targetMuscle = isset($muscleGroup) ? $muscleGroup : 'Chest';
$exercises = [];

if (isset($pdo) && $pdo) {
    $stmt = $pdo->prepare("SELECT * FROM exercises WHERE muscle_group = ? ORDER BY name");
    $stmt->execute([$targetMuscle]);
    $exercises = $stmt->fetchAll(PDO::FETCH_ASSOC);
} elseif (isset($conn) && $conn) {
    $stmt = $conn->prepare("SELECT * FROM exercises WHERE muscle_group = ? ORDER BY name");
    $stmt->bind_param("s", $targetMuscle);
    $stmt->execute();
    $res = $stmt->get_result();
    while ($r = $res->fetch_assoc()) {
        $exercises[] = $r;
    }
    $stmt->close();
}
?>

<section class="workout-content-section" style="padding: 40px 0 60px 0; background: #f8fafc;">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div style="background:#ffffff; border-radius:14px; border:1px solid #e2e8f0; padding:28px; box-shadow:0 4px 16px rgba(15,23,42,0.04);">
          <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px; margin-bottom:20px; border-bottom:2px solid #f1f5f9; padding-bottom:14px;">
            <h2 style="font-family:'Outfit',sans-serif; font-size:24px; font-weight:700; color:#0f172a; margin:0;">
              <i class="fa fa-dumbbell" style="color:#10b981; margin-right:8px;"></i> <?= htmlspecialchars($targetMuscle) ?> Exercises
            </h2>
            <span style="background:#ecfdf5; color:#065f46; font-size:12px; font-weight:700; padding:4px 12px; border-radius:20px; border:1px solid #a7f3d0;">
              <?= count($exercises) ?> Exercises
            </span>
          </div>

          <?php if (!empty($exercises)): ?>
            <div class="table-responsive">
              <table class="table table-bordered table-striped" style="margin-bottom:0;">
                <thead style="background:#f1f5f9; color:#0f172a;">
                  <tr>
                    <th style="font-family:'Outfit',sans-serif; font-weight:700;">Exercise Name</th>
                    <th style="font-family:'Outfit',sans-serif; font-weight:700;">Description</th>
                    <th style="font-family:'Outfit',sans-serif; font-weight:700;">Calories Burned</th>
                    <th style="font-family:'Outfit',sans-serif; font-weight:700; text-align:center;">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($exercises as $exercise): ?>
                    <tr>
                      <td style="font-weight:600; color:#0f172a;"><?= htmlspecialchars($exercise['name']) ?></td>
                      <td style="color:#475569;"><?= htmlspecialchars($exercise['description']) ?></td>
                      <td style="color:#059669; font-weight:600;"><?= htmlspecialchars($exercise['avg_calories_burned_per_min']) ?> cal/min</td>
                      <td style="text-align:center;">
                        <?php if (isset($_SESSION['id'])): ?>
                          <a href="log_exercise.php?exercise_id=<?= urlencode($exercise['id']) ?>&muscle_group=<?= urlencode($targetMuscle) ?>"
                             class="btn btn-success btn-sm" style="background:#10b981; border:none; font-weight:600; padding:6px 14px; border-radius:6px;">
                            <i class="fa fa-plus"></i> Log this exercise
                          </a>
                        <?php else: ?>
                          <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#login-form"
                                  style="font-weight:600; padding:6px 14px; border-radius:6px;" title="Sign in to log this exercise">
                            <i class="fa fa-lock"></i> Log this exercise
                          </button>
                        <?php endif; ?>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          <?php else: ?>
            <div style="text-align:center; padding:40px 20px; color:#64748b;">
              <i class="fa fa-info-circle" style="font-size:32px; color:#94a3b8; margin-bottom:10px;"></i>
              <p style="margin:0; font-size:15px;">No specific exercises found for <?= htmlspecialchars($targetMuscle) ?> yet.</p>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>
