<?php
$pageTitle = "Lean'N'Green : Full Week Workout Routine";
$extraCss = 'assets/css/components/workout-routine.css';
include('header.php');
include_once('db.php');

// Fetch full week workout routine grouped and ordered by day
$sql = "SELECT id, day_of_week, workout_name, muscle_group, exercise_name, sets, reps, rest_seconds, duration_minutes, equipment_needed, is_cardio, notes 
        FROM workout_routine 
        ORDER BY FIELD(day_of_week, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'), id ASC";

$result = $conn->query($sql);
$daysOrder = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
$routinesByDay = [];
foreach ($daysOrder as $d) {
    $routinesByDay[$d] = [
        'workout_name' => '',
        'exercises' => [],
        'total_duration' => 0,
        'muscle_groups' => []
    ];
}

$totalExercises = 0;
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $day = $row['day_of_week'];
        if (isset($routinesByDay[$day])) {
            if (empty($routinesByDay[$day]['workout_name'])) {
                $routinesByDay[$day]['workout_name'] = $row['workout_name'];
            }
            $routinesByDay[$day]['exercises'][] = $row;
            $routinesByDay[$day]['total_duration'] += intval($row['duration_minutes']);
            if (!in_array($row['muscle_group'], $routinesByDay[$day]['muscle_groups'])) {
                $routinesByDay[$day]['muscle_groups'][] = $row['muscle_group'];
            }
            $totalExercises++;
        }
    }
}
?>

  <!-- Start single page header -->
  <section id="single-page-header">
    <div class="overlay">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="single-page-header-left">
              <h2>Weekly Workout Routine</h2>
              <p>
              <blockquote>"Fitness is not about being better than someone else... It's about being better than you used to be."</blockquote>
              </p>
            </div>
          </div>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="single-page-header-right">
              <ol class="breadcrumb">
                <li><a href="index.php">Home</a></li>
                <li><a href="Workout-Routine.php">Plans</a></li>
                <li class="active">Workout Routine</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End single page header -->

  <section class="routine-container">
    <div class="container">

      <!-- Week Summary & Filter Header Card -->
      <div class="routine-header-card">
        <span style="background: #ecfdf5; color: #059669; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; padding: 5px 16px; border-radius: 20px; display: inline-block; margin-bottom: 12px; border: 1px solid #a7f3d0;">
          <i class="fa fa-calendar-check" style="margin-right: 6px;"></i> Complete 7-Day Split
        </span>
        <h2 style="font-family: 'Outfit', sans-serif; font-size: 28px; font-weight: 800; color: #0f172a; margin: 0 0 10px 0;">
          Full Week Structured Training Program
        </h2>
        <p style="color: #64748b; font-size: 15px; max-width: 680px; margin: 0 auto;">
          An expertly periodized 7-day routine engineered to maximize muscle hypertrophy, functional strength, cardiovascular endurance, and systemic recovery.
        </p>

        <!-- Day Filter Navigation -->
        <div class="routine-filter-nav">
          <button type="button" class="routine-filter-btn active" onclick="filterRoutineDay('all', this)">
            <i class="fa fa-layer-group"></i> All Week (<?= $totalExercises ?> Exercises)
          </button>
          <?php foreach ($daysOrder as $day): ?>
            <?php 
              $dayExCount = count($routinesByDay[$day]['exercises']);
              if ($dayExCount === 0) continue;
            ?>
            <button type="button" class="routine-filter-btn" onclick="filterRoutineDay('<?= strtolower($day) ?>', this)">
              <?= $day ?> (<?= $dayExCount ?>)
            </button>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- Days Routine Cards -->
      <div id="routine-days-wrapper">
        <?php foreach ($daysOrder as $day): ?>
          <?php 
            $dayData = $routinesByDay[$day];
            if (empty($dayData['exercises'])) continue;
            $dayId = 'routine-day-' . strtolower($day);
          ?>
          <div class="routine-day-card" id="<?= $dayId ?>" data-day="<?= strtolower($day) ?>">
            <!-- Day Card Header -->
            <div class="routine-day-header">
              <div class="routine-day-title-group">
                <span class="routine-day-badge"><?= htmlspecialchars($day) ?></span>
                <h3 class="routine-workout-name"><?= htmlspecialchars($dayData['workout_name']) ?></h3>
              </div>
              <div class="routine-day-meta">
                <span><i class="fa fa-dumbbell" style="color:#10b981;"></i> <?= count($dayData['exercises']) ?> Exercises</span>
                <span><i class="fa fa-clock" style="color:#10b981;"></i> ~<?= $dayData['total_duration'] ?> min</span>
                <span><i class="fa fa-bullseye" style="color:#10b981;"></i> Focus: <?= htmlspecialchars(implode(', ', $dayData['muscle_groups'])) ?></span>
              </div>
            </div>

            <!-- Exercises Table -->
            <div class="routine-table-wrapper">
              <table class="routine-table">
                <thead>
                  <tr>
                    <th style="width: 50px;">#</th>
                    <th>Exercise &amp; Focus</th>
                    <th>Muscle Target</th>
                    <th>Sets &amp; Reps</th>
                    <th>Rest</th>
                    <th>Duration</th>
                    <th>Equipment</th>
                    <th style="text-align: center;">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $idx = 1; foreach ($dayData['exercises'] as $ex): ?>
                    <tr>
                      <td style="font-weight: 700; color: #94a3b8;"><?= $idx++ ?></td>
                      <td>
                        <div class="routine-exercise-name"><?= htmlspecialchars($ex['exercise_name']) ?></div>
                        <?php if (!empty($ex['notes'])): ?>
                          <div class="routine-exercise-notes"><i class="fa fa-info-circle" style="color:#10b981;"></i> <?= htmlspecialchars($ex['notes']) ?></div>
                        <?php endif; ?>
                      </td>
                      <td>
                        <span class="muscle-badge <?= $ex['is_cardio'] ? 'badge-cardio' : '' ?>">
                          <i class="fa <?= $ex['is_cardio'] ? 'fa-heartbeat' : 'fa-check-circle' ?>"></i>
                          <?= htmlspecialchars($ex['muscle_group']) ?>
                        </span>
                      </td>
                      <td>
                        <span class="stat-pill"><?= htmlspecialchars($ex['sets']) ?> sets &times; <?= htmlspecialchars($ex['reps']) ?> reps</span>
                      </td>
                      <td><i class="fa fa-stopwatch" style="color:#64748b; margin-right:4px;"></i> <?= htmlspecialchars($ex['rest_seconds']) ?>s</td>
                      <td><i class="fa fa-hourglass-half" style="color:#64748b; margin-right:4px;"></i> <?= htmlspecialchars($ex['duration_minutes']) ?>m</td>
                      <td style="color: #475569; font-size: 13px;"><?= htmlspecialchars($ex['equipment_needed'] ?: 'None / Bodyweight') ?></td>
                      <td style="text-align: center;">
                        <?php if (isset($_SESSION['id'])): ?>
                          <a href="log_exercise.php?exercise_id=<?= urlencode($ex['id']) ?>&muscle_group=<?= urlencode($ex['muscle_group']) ?>"
                             class="btn btn-success btn-xs" style="background:#10b981; border:none; font-weight:600; padding:6px 12px; border-radius:6px;" title="Log this exercise">
                            <i class="fa fa-plus"></i> Log
                          </a>
                        <?php else: ?>
                          <button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#login-form"
                                  style="font-weight:600; padding:6px 12px; border-radius:6px;" title="Sign in to log this exercise">
                            <i class="fa fa-lock"></i> Log
                          </button>
                        <?php endif; ?>
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
    function filterRoutineDay(selectedDay, btn) {
      // Toggle button active state
      var buttons = document.querySelectorAll('.routine-filter-btn');
      buttons.forEach(function(b) {
        b.classList.remove('active');
      });
      if (btn) btn.classList.add('active');

      // Filter day cards
      var cards = document.querySelectorAll('.routine-day-card');
      cards.forEach(function(card) {
        if (selectedDay === 'all' || card.getAttribute('data-day') === selectedDay) {
          card.style.display = 'block';
        } else {
          card.style.display = 'none';
        }
      });
    }
  </script>

  <?php include('footer.php'); ?>