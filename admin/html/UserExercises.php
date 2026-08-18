<html lang="en">  


<head>
    
     <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
  </head>
<body>
<?php session_start();?>

<?php
include 'heder.php';
require_once '../../db.php';

// Handle delete action
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $delete_sql = "DELETE FROM user_exercises WHERE id = $delete_id";
    mysqli_query($conn, $delete_sql);
    echo "<script>alert('User exercise deleted successfully');window.location.href='UserExercises.php';</script>";
}
?>

<div class="container mt-5 d-flex justify-content-center">
    <div class="w-100" style="max-width: 1200px; padding-top: 60px;">
        <h2 class="text-center">User Exercise List</h2>
        <!-- Search Form -->
        <form method="get" class="mb-3 d-flex justify-content-center">
            <div class="input-group" style="max-width: 300px;">
                <input type="number" name="search_user_id" class="form-control" placeholder="Search by User ID" value="<?php echo isset($_GET['search_user_id']) ? htmlspecialchars($_GET['search_user_id']) : ''; ?>">
                <button class="btn btn-primary" type="submit">Search</button>
                <a href="UserExercises.php" class="btn btn-secondary">Reset</a>
            </div>
        </form>
        <div class="table-responsive" style="overflow-y: auto;">
            <table class="table table-bordered mb-0">
                <thead class="table-light" style="position: sticky; top: 0; z-index: 1;">
                    <tr>
                        <th>ID</th>
                        <th>User ID</th>
                        <th>Exercise ID</th>
                        <th>Name</th>
                        <th>Duration (minutes)</th>
                        <th>Sets</th>
                        <th>Reps</th>
                        <th>Weight (kg)</th>
                        <th>Date Performed</th>
                        <th>Calories Burned</th>
                        <th>Fat Loss (grams)</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $where = "";
                if (isset($_GET['search_user_id']) && $_GET['search_user_id'] !== "") {
                    $search_user_id = intval($_GET['search_user_id']);
                    $where = "WHERE user_id = $search_user_id";
                }
                $result = mysqli_query($conn, "SELECT * FROM user_exercises $where ORDER BY id DESC");
                while($row = mysqli_fetch_assoc($result)){
                    echo "<tr>";
                    echo "<td>".$row['id']."</td>";
                    echo "<td>".$row['user_id']."</td>";
                    echo "<td>".$row['exercise_id']."</td>";
                    echo "<td>".htmlspecialchars($row['name'])."</td>";
                    echo "<td>".$row['duration_minutes']."</td>";
                    echo "<td>".$row['sets']."</td>";
                    echo "<td>".$row['reps']."</td>";
                    echo "<td>".$row['weight_kg']."</td>";
                    echo "<td>".$row['date_performed']."</td>";
                    echo "<td>".$row['calories_burned']."</td>";
                    echo "<td>".$row['fat_loss_grams']."</td>";
                    echo "<td>
                        <a href='?delete_id=".$row['id']."' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure you want to delete this user exercise?');\">Delete</a>
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