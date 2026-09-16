<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'heder.php';
require_once '../../db.php';

// Handle delete action
if (isset($_GET['delete_id'])) {
  $delete_id = intval($_GET['delete_id']);
  $delete_sql = "DELETE FROM vegan_diet_plan WHERE id = $delete_id";
  mysqli_query($conn, $delete_sql);
  echo "<script>alert('Vegan diet plan deleted successfully');window.location.href='addVeganDietPlan.php';</script>";
}

// Handle add action
if(isset($_POST['submit'])){
  $day_of_week = mysqli_real_escape_string($conn, $_POST['day_of_week']);
  $meal_time = mysqli_real_escape_string($conn, $_POST['meal_time']);
  $meal_name = mysqli_real_escape_string($conn, $_POST['meal_name']);
  $description = mysqli_real_escape_string($conn, $_POST['description']);
  $calories = floatval($_POST['calories']);
  $protein = floatval($_POST['protein']);
  $fat = floatval($_POST['fat']);
  $carbs = floatval($_POST['carbs']);
  $source_link = mysqli_real_escape_string($conn, $_POST['source_link']);

  if($day_of_week != "" && $meal_time != "" && $meal_name != ""){
    $sql = "INSERT INTO vegan_diet_plan (day_of_week, meal_time, meal_name, description, calories, protein, fat, carbs, source_link)
            VALUES ('$day_of_week', '$meal_time', '$meal_name', '$description', $calories, $protein, $fat, $carbs, '$source_link')";
    if(mysqli_query($conn, $sql)){
      echo "<script>alert('Vegan diet plan added successfully');window.location.href='addVeganDietPlan.php';</script>";
    } else {
      echo "<script>alert('Error adding vegan diet plan');</script>";
    }
  }
}
?> 
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh; padding-top: 60px;">
  <section id="upload_container" class="w-100" style="max-width: 700px;">
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
      <h2 class="text-center mb-4">Add Vegan Diet Plan</h2>
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
          <label for="meal_time" class="form-label">Meal Time</label>
          <select name="meal_time" id="meal_time" required class="form-control">
            <option value="">Select Meal Time</option>
            <option value="Breakfast">Breakfast</option>
            <option value="Lunch">Lunch</option>
            <option value="Dinner">Dinner</option>
            <option value="Snack">Snack</option>
          </select>
        </div>
      </div>

      <div class="mb-3">
        <label for="meal_name" class="form-label">Meal Name</label>
        <input type="text" name="meal_name" id="meal_name" placeholder="Meal Name" required class="form-control">
      </div>

      <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea name="description" id="description" placeholder="Description" class="form-control"></textarea>
      </div>

      <div class="row mb-3">
        <div class="col-md-3 col-6">
          <label for="calories" class="form-label">Calories</label>
          <input type="number" step="0.01" name="calories" id="calories" required class="form-control">
        </div>
        <div class="col-md-3 col-6">
          <label for="protein" class="form-label">Protein (g)</label>
          <input type="number" step="0.01" name="protein" id="protein" required class="form-control">
        </div>
        <div class="col-md-3 col-6">
          <label for="fat" class="form-label">Fat (g)</label>
          <input type="number" step="0.01" name="fat" id="fat" required class="form-control">
        </div>
        <div class="col-md-3 col-6">
          <label for="carbs" class="form-label">Carbs (g)</label>
          <input type="number" step="0.01" name="carbs" id="carbs" required class="form-control">
        </div>
      </div>

      <div class="mb-3">
        <label for="source_link" class="form-label">Source Link</label>
        <input type="url" name="source_link" id="source_link" class="form-control">
      </div>

      <div class="text-center">
        <button type="submit" name="submit" class="btn btn-primary">Add Vegan Diet Plan</button>
      </div>
    </form>
  </section>
</div>

<div class="container mt-5">
  <h2>Vegan Diet Plan List</h2>
  <div class="table-responsive" style=" overflow-y: auto;">
    <table class="table table-bordered mb-0">
      <thead class="table-light" style="position: sticky; top: 0; z-index: 1;">
        <tr>
          <th>ID</th>
          <th>Day</th>
          <th>Meal Time</th>
          <th>Meal Name</th>
          <th>Description</th>
          <th>Calories</th>
          <th>Protein</th>
          <th>Fat</th>
          <th>Carbs</th>
          <th>Source Link</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      <?php
      $result = mysqli_query($conn, "SELECT * FROM vegan_diet_plan ORDER BY id DESC");
      while($row = mysqli_fetch_assoc($result)){
        echo "<tr>";
        echo "<td>".$row['id']."</td>";
        echo "<td>".htmlspecialchars($row['day_of_week'])."</td>";
        echo "<td>".htmlspecialchars($row['meal_time'])."</td>";
        echo "<td>".htmlspecialchars($row['meal_name'])."</td>";
        echo "<td>".htmlspecialchars($row['description'])."</td>";
        echo "<td>".$row['calories']."</td>";
        echo "<td>".$row['protein']."</td>";
        echo "<td>".$row['fat']."</td>";
        echo "<td>".$row['carbs']."</td>";
        echo "<td>";
        if (!empty($row['source_link'])) {
          echo "<a href='".htmlspecialchars($row['source_link'])."' target='_blank'>Link</a>";
        }
        echo "</td>";
        echo "<td>
          <a href='?delete_id=".$row['id']."' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure you want to delete this vegan diet plan?');\">Delete</a>
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