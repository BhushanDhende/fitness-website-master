<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'heder.php';
require_once '../../db.php';

// Handle delete action
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $delete_sql = "DELETE FROM newsletter_subscribers WHERE id = $delete_id";
    mysqli_query($conn, $delete_sql);
    echo "<script>alert('Subscriber deleted successfully');window.location.href='Subscribers.php';</script>";
}
?>

<div class="container mt-5 d-flex justify-content-center">
    <div class="w-100" style="max-width: 1200px; padding-top: 60px;">
        <h2 class="text-center">Newsletter Subscribers List</h2>
        <!-- Search Form -->
        <form method="get" class="mb-3 d-flex justify-content-center">
            <div class="input-group" style="max-width: 300px;">
                <input type="number" name="search_subscriber_id" class="form-control" placeholder="Search by Subscriber ID" value="<?php echo isset($_GET['search_subscriber_id']) ? htmlspecialchars($_GET['search_subscriber_id']) : ''; ?>">
                <button class="btn btn-primary" type="submit">Search</button>
                <a href="Subscribers.php" class="btn btn-secondary">Reset</a>
            </div>
        </form>
        <div class="table-responsive" style="overflow-y: auto;">
            <table class="table table-bordered mb-0">
                <thead class="table-light" style="position: sticky; top: 0; z-index: 1;">
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $where = "";
                if (isset($_GET['search_subscriber_id']) && $_GET['search_subscriber_id'] !== "") {
                    $search_subscriber_id = intval($_GET['search_subscriber_id']);
                    $where = "WHERE id = $search_subscriber_id";
                }
                $result = mysqli_query($conn, "SELECT id, email FROM newsletter_subscribers $where ORDER BY id DESC");
                while($row = mysqli_fetch_assoc($result)){
                    echo "<tr>";
                    echo "<td>".$row['id']."</td>";
                    echo "<td>".htmlspecialchars($row['email'])."</td>";
                    echo "<td>
                        <a href='?delete_id=".$row['id']."' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure you want to delete this subscriber?');\">Delete</a>
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