<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'heder.php';
require_once '../../db.php';

// Handle delete action
if (isset($_GET['delete_id'])) {
  $delete_id = intval($_GET['delete_id']);
  $delete_sql = "DELETE FROM plant_protein WHERE id = $delete_id";
  mysqli_query($conn, $delete_sql);
  echo "<script>alert('Plant protein deleted successfully');window.location.href='addPlantProteins.php';</script>";
}

// Handle add action
if(isset($_POST['submit'])){
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $type = mysqli_real_escape_string($conn, $_POST['type']);
  $protein_per_100g = floatval($_POST['protein_per_100g']);
  $calories_per_100g = floatval($_POST['calories_per_100g']);
  $source_category = mysqli_real_escape_string($conn, $_POST['source_category']);
  $is_complete_protein = isset($_POST['is_complete_protein']) ? 1 : 0;
  $notes = mysqli_real_escape_string($conn, $_POST['notes']);

  if($name != "" && $type != ""){
    $sql = "INSERT INTO plant_protein (name, type, protein_per_100g, calories_per_100g, source_category, is_complete_protein, notes)
            VALUES ('$name', '$type', $protein_per_100g, $calories_per_100g, '$source_category', $is_complete_protein, '$notes')";
    if(mysqli_query($conn, $sql)){
      echo "<script>alert('Plant protein added successfully');window.location.href='addPlantProteins.php';</script>";
    } else {
      echo "<script>alert('Error adding plant protein');</script>";
    }
  }
}
?> 
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh; padding-top: 60px;">
  <section id="upload_container" class="w-100" style="max-width: 700px;">
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
      <h2 class="text-center mb-4">Add Plant Protein</h2>
      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" name="name" id="name" placeholder="Name" required class="form-control">
      </div>
      <div class="mb-3">
        <label for="type" class="form-label">Type</label>
        <input type="text" name="type" id="type" placeholder="Type" required class="form-control">
      </div>
      <div class="row mb-3">
        <div class="col-md-6">
          <label for="protein_per_100g" class="form-label">Protein per 100g (g)</label>
          <input type="number" step="0.01" name="protein_per_100g" id="protein_per_100g" required class="form-control">
        </div>
        <div class="col-md-6">
          <label for="calories_per_100g" class="form-label">Calories per 100g</label>
          <input type="number" step="0.01" name="calories_per_100g" id="calories_per_100g" required class="form-control">
        </div>
      </div>
      <div class="mb-3">
        <label for="source_category" class="form-label">Source Category</label>
        <input type="text" name="source_category" id="source_category" placeholder="Source Category" class="form-control">
      </div>
      <div class="mb-3 form-check">
        <input type="checkbox" name="is_complete_protein" id="is_complete_protein" class="form-check-input">
        <label for="is_complete_protein" class="form-check-label">Is Complete Protein?</label>
      </div>
      <div class="mb-3">
        <label for="notes" class="form-label">Notes</label>
        <textarea name="notes" id="notes" placeholder="Notes" class="form-control"></textarea>
      </div>
      <div class="text-center">
        <button type="submit" name="submit" class="btn btn-primary">Add Plant Protein</button>
      </div>
    </form>
  </section>
</div>

<div class="container mt-5">
  <h2>Plant Protein List</h2>
  <div class="table-responsive" style=" overflow-y: auto;">
    <table class="table table-bordered mb-0">
      <thead class="table-light" style="position: sticky; top: 0; z-index: 1;">
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Type</th>
          <th>Protein/100g</th>
          <th>Calories/100g</th>
          <th>Source Category</th>
          <th>Complete Protein</th>
          <th>Notes</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      <?php
      $result = mysqli_query($conn, "SELECT * FROM plant_protein ORDER BY id DESC");
      while($row = mysqli_fetch_assoc($result)){
        echo "<tr>";
        echo "<td>".$row['id']."</td>";
        echo "<td>".htmlspecialchars($row['name'])."</td>";
        echo "<td>".htmlspecialchars($row['type'])."</td>";
        echo "<td>".$row['protein_per_100g']."</td>";
        echo "<td>".$row['calories_per_100g']."</td>";
        echo "<td>".htmlspecialchars($row['source_category'])."</td>";
        echo "<td>".($row['is_complete_protein'] ? 'Yes' : 'No')."</td>";
        echo "<td>".htmlspecialchars($row['notes'])."</td>";
        echo "<td>
          <a href='?delete_id=".$row['id']."' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure you want to delete this plant protein?');\">Delete</a>
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