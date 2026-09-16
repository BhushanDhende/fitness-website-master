<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'heder.php';
require_once '../../db.php';

// Handle delete action
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $delete_sql = "DELETE FROM exercises WHERE id = $delete_id";
    mysqli_query($conn, $delete_sql);
    echo "<script>alert('Exercise deleted successfully');window.location.href='addExercises.php';</script>";
}

// Handle add action
if(isset($_POST['submit'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $muscle_group = mysqli_real_escape_string($conn, $_POST['muscle_group']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $avg_calories_burned_per_min = floatval($_POST['avg_calories_burned_per_min']);

    if($name != "" && $muscle_group != ""){
        $sql = "INSERT INTO exercises (name, muscle_group, description, avg_calories_burned_per_min)
                        VALUES ('$name', '$muscle_group', '$description', $avg_calories_burned_per_min)";
        if(mysqli_query($conn, $sql)){
            echo "<script>alert('Exercise added successfully');window.location.href='addExercises.php';</script>";
        } else {
            echo "<script>alert('Error adding exercise');</script>";
        }
    }
}
?> 
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh; padding-top: 60px;">
    <section id="upload_container" class="w-100" style="max-width: 700px;">
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <h2 class="text-center mb-4">Add Exercise</h2>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="name" class="form-label">Exercise Name</label>
                    <input type="text" name="name" id="name" placeholder="Exercise Name" required class="form-control">
                </div>
                <div class="col-md-6">
                    <label for="muscle_group" class="form-label">Muscle Group</label>
                    <select name="muscle_group" id="muscle_group" required class="form-control">
                        <option value="">Select Muscle Group</option>
                        <option value="Back">Back</option>
                        <option value="Shoulders">Shoulders</option>
                        <option value="Chest">Chest</option>
                        <option value="Arms">Arms</option>
                        <option value="Abs">Abs</option>
                        <option value="Legs">Legs</option>
                        <option value="Buttocks">Buttocks</option>
                        <option value="Cardio">Cardio</option>
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label for="avg_calories_burned_per_min" class="form-label">Avg Calories Burned Per Min</label>
                <input type="number" step="0.01" name="avg_calories_burned_per_min" id="avg_calories_burned_per_min" class="form-control" min="0">
            </div>
            <div class="text-center">
                <button type="submit" name="submit" class="btn btn-primary">Add Exercise</button>
            </div>
        </form>
    </section>
</div>

<div class="container mt-5">
    <h2>Exercise List</h2>
    <div class="table-responsive" style="overflow-y: auto;">
        <table class="table table-bordered mb-0">
            <thead class="table-light" style="position: sticky; top: 0; z-index: 1;">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Muscle Group</th>
                    <th>Description</th>
                    <th>Avg Calories Burned/Min</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $result = mysqli_query($conn, "SELECT * FROM exercises ORDER BY id DESC");
            while($row = mysqli_fetch_assoc($result)){
                echo "<tr>";
                echo "<td>".$row['id']."</td>";
                echo "<td>".htmlspecialchars($row['name'])."</td>";
                echo "<td>".htmlspecialchars($row['muscle_group'])."</td>";
                echo "<td>".htmlspecialchars($row['description'])."</td>";
                echo "<td>".$row['avg_calories_burned_per_min']."</td>";
                echo "<td>
                    <a href='?delete_id=".$row['id']."' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure you want to delete this exercise?');\">Delete</a>
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