<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'heder.php';
require_once '../../db.php';

// Handle delete action
if (isset($_GET['delete_id'])) {
  $delete_id = intval($_GET['delete_id']);
  $delete_sql = "DELETE FROM workout_routine WHERE id = $delete_id";
  mysqli_query($conn, $delete_sql);
  echo "<script>alert('Workout routine deleted successfully');window.location.href='addWorkoutRoutine.php';</script>";
}

// Handle add action
if(isset($_POST['submit'])){
  $day_of_week = mysqli_real_escape_string($conn, $_POST['day_of_week']);
  $workout_name = mysqli_real_escape_string($conn, $_POST['workout_name']);
  $muscle_group = mysqli_real_escape_string($conn, $_POST['muscle_group']);
  $exercise_name = mysqli_real_escape_string($conn, $_POST['exercise_name']);
  $sets = intval($_POST['sets']);
  $reps = intval($_POST['reps']);
  $rest_seconds = intval($_POST['rest_seconds']);
  $duration_minutes = intval($_POST['duration_minutes']);
  $equipment_needed = mysqli_real_escape_string($conn, $_POST['equipment_needed']);
  $is_cardio = isset($_POST['is_cardio']) ? 1 : 0;
  $notes = mysqli_real_escape_string($conn, $_POST['notes']);

  if($day_of_week != "" && $workout_name != "" && $exercise_name != ""){
    $sql = "INSERT INTO workout_routine (day_of_week, workout_name, muscle_group, exercise_name, sets, reps, rest_seconds, duration_minutes, equipment_needed, is_cardio, notes)
            VALUES ('$day_of_week', '$workout_name', '$muscle_group', '$exercise_name', $sets, $reps, $rest_seconds, $duration_minutes, '$equipment_needed', $is_cardio, '$notes')";
    if(mysqli_query($conn, $sql)){
      echo "<script>alert('Workout routine added successfully');window.location.href='addWorkoutRoutine.php';</script>";
    } else {
      echo "<script>alert('Error adding workout routine');</script>";
    }
  }
}
?> 
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh; padding-top: 60px;">
  <section id="upload_container" class="w-100" style="max-width: 700px;">
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
      <h2 class="text-center mb-4">Add Workout Routine</h2>
      <div class="row mb-3">
        <div class="col-md-6">
          <label for="day_of_week" class="form-label">Day of Week</label>
          <select name="day_of_week" id="day_of_week" required class="form-control">
            <option value="">Select Day</option>
            <option value="Monday">Monday</option>
            <option value="Tuesday">Tuesday</option>
            <option value="Wednesday">Wednesday</option>
            <option value="Thursday">Thursday</option>
            <option value="Friday">Friday</option>
            <option value="Saturday">Saturday</option>
            <option value="Sunday">Sunday</option>
          </select>
        </div>
        <div class="col-md-6">
          <label for="workout_name" class="form-label">Workout Name</label>
          <input type="text" name="workout_name" id="workout_name" placeholder="Workout Name" required class="form-control">
        </div>
      </div>
      <div class="row mb-3">
        <div class="col-md-6">
          <label for="muscle_group" class="form-label">Muscle Group</label>
          <input type="text" name="muscle_group" id="muscle_group" placeholder="Workout Group" class="form-control">
        </div>
        <div class="col-md-6">
          <label for="exercise_name" class="form-label">Exercise Name</label>
          <input type="text" name="exercise_name" id="exercise_name" placeholder="Exercise Name" required class="form-control">
        </div>
      </div>
      <div class="row mb-3">
        <div class="col-md-3 col-6">
          <label for="sets" class="form-label">Sets</label>
          <input type="number" name="sets" id="sets" class="form-control" min="1" required>
        </div>
        <div class="col-md-3 col-6">
          <label for="reps" class="form-label">Reps</label>
          <input type="number" name="reps" id="reps" class="form-control" min="1" required>
        </div>
        <div class="col-md-3 col-6">
          <label for="rest_seconds" class="form-label">Rest (sec)</label>
          <input type="number" name="rest_seconds" id="rest_seconds" class="form-control" min="0">
        </div>
        <div class="col-md-3 col-6">
          <label for="duration_minutes" class="form-label">Duration (min)</label>
          <input type="number" name="duration_minutes" id="duration_minutes" class="form-control" min="0">
        </div>
      </div>
      <div class="mb-3">
        <label for="equipment_needed" class="form-label">Equipment Needed</label>
        <input type="text" name="equipment_needed" id="equipment_needed" class="form-control">
      </div>
      <div class="mb-3 form-check">
        <input type="checkbox" name="is_cardio" id="is_cardio" class="form-check-input">
        <label for="is_cardio" class="form-check-label">Is Cardio?</label>
      </div>
      <div class="mb-3">
        <label for="notes" class="form-label">Notes</label>
        <textarea name="notes" id="notes" class="form-control"></textarea>
      </div>
      <div class="text-center">
        <button type="submit" name="submit" class="btn btn-primary">Add Workout Routine</button>
      </div>
    </form>
  </section>
</div>

<div class="container mt-5">
  <h2>Workout Routine List</h2>
  <div class="table-responsive" style="overflow-y: auto;">
    <table class="table table-bordered mb-0">
      <thead class="table-light" style="position: sticky; top: 0; z-index: 1;">
        <tr>
          <th>ID</th>
          <th>Day</th>
          <th>Workout Name</th>
          <th>Workout Group</th>
          <th>Exercise Name</th>
          <th>Sets</th>
          <th>Reps</th>
          <th>Rest (s)</th>
          <th>Duration (min)</th>
          <th>Equipment Needed</th>
          <th>Is Cardio</th>
          <th>Notes</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      <?php
      $result = mysqli_query($conn, "SELECT * FROM workout_routine ORDER BY id DESC");
      while($row = mysqli_fetch_assoc($result)){
        echo "<tr>";
        echo "<td>".$row['id']."</td>";
        echo "<td>".htmlspecialchars($row['day_of_week'])."</td>";
        echo "<td>".htmlspecialchars($row['workout_name'])."</td>";
        echo "<td>".htmlspecialchars($row['muscle_group'])."</td>";
        echo "<td>".htmlspecialchars($row['exercise_name'])."</td>";
        echo "<td>".$row['sets']."</td>";
        echo "<td>".$row['reps']."</td>";
        echo "<td>".$row['rest_seconds']."</td>";
        echo "<td>".$row['duration_minutes']."</td>";
        echo "<td>".htmlspecialchars($row['equipment_needed'])."</td>";
        echo "<td>".($row['is_cardio'] ? 'Yes' : 'No')."</td>";
        echo "<td>".htmlspecialchars($row['notes'])."</td>";
        echo "<td>
          <a href='?delete_id=".$row['id']."' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure you want to delete this workout routine?');\">Delete</a>
        </td>";
        echo "</tr>";
      }
      ?>
      </tbody>
    </table>
  </div>
</div>
</div>
</body>
</html>