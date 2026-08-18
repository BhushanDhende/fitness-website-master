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
    $delete_sql = "DELETE FROM comments WHERE id = $delete_id";
    mysqli_query($conn, $delete_sql);
    echo "<script>alert('Comment deleted successfully');window.location.href='Comments.php';</script>";
}
?>

<div class="container mt-5 d-flex justify-content-center">
    <div class="w-100" style="max-width: 1200px; padding-top: 60px;">
        <h2 class="text-center">Comments List</h2>
        <!-- Search Form -->
        <form method="get" class="mb-3 d-flex justify-content-center">
            <div class="input-group" style="max-width: 300px;">
                <input type="number" name="search_comment_id" class="form-control" placeholder="Search by Comment ID" value="<?php echo isset($_GET['search_comment_id']) ? htmlspecialchars($_GET['search_comment_id']) : ''; ?>">
                <button class="btn btn-primary" type="submit">Search</button>
                <a href="Comments.php" class="btn btn-secondary">Reset</a>
            </div>
        </form>
        <div class="table-responsive" style="overflow-y: auto;">
            <table class="table table-bordered mb-0">
                <thead class="table-light" style="position: sticky; top: 0; z-index: 1;">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Comment</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $where = "";
                if (isset($_GET['search_comment_id']) && $_GET['search_comment_id'] !== "") {
                    $search_comment_id = intval($_GET['search_comment_id']);
                    $where = "WHERE id = $search_comment_id";
                }
                $result = mysqli_query($conn, "SELECT id, name, email, comment FROM comments $where ORDER BY id DESC");
                while($row = mysqli_fetch_assoc($result)){
                    echo "<tr>";
                    echo "<td>".$row['id']."</td>";
                    echo "<td>".htmlspecialchars($row['name'])."</td>";
                    echo "<td>".htmlspecialchars($row['email'])."</td>";
                    echo "<td>".htmlspecialchars($row['comment'])."</td>";
                    echo "<td>
                        <a href='?delete_id=".$row['id']."' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure you want to delete this comment?');\">Delete</a>
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