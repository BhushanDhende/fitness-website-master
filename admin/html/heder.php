<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Panel - Lean'N'Green</title>
  
  <link rel="stylesheet" href="styles.min.css" />
  <link rel="stylesheet" href="addp.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
  <div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="position:fixed; width:100vw; z-index:1050; top:0; left:0; box-shadow:0 2px 10px rgba(0,0,0,0.05);">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.php" style="font-weight:700; color:#10b981;">Admin Panel</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown" style="margin-left: 20px; margin-right: 20px;">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="chartsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Charts
              </a>
              <ul class="dropdown-menu" aria-labelledby="chartsDropdown">
                <li><a class="dropdown-item" href="addPlantProteins.php">Add Plant Proteins</a></li>
                <li><a class="dropdown-item" href="addVeganDietPlan.php">Add Vegan Diet Plan</a></li>
                <li><a class="dropdown-item" href="addWorkoutRoutine.php">Add Workout Routine</a></li>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="exercisesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Exercises
              </a>
              <ul class="dropdown-menu" aria-labelledby="exercisesDropdown">
                <li><a class="dropdown-item" href="addExercises.php">Add Exercises</a></li>
                <li><a class="dropdown-item" href="UserExercises.php">User Exercises</a></li>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="authDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Authentication
              </a>
              <ul class="dropdown-menu" aria-labelledby="authDropdown">
                <li><a class="dropdown-item" href="allUsers.php">Users</a></li>
                <li><a class="dropdown-item" href="Comments.php">Comments</a></li>
                <li><a class="dropdown-item" href="Subscribers.php">Subscribers</a></li>
              </ul>
            </li>
          </ul>
          <?php if(isset($_SESSION['auth'])): ?>
            <span class="me-3" style="font-weight:600;">Welcome, <?= htmlspecialchars($_SESSION['uname']); ?></span>
            <a href="logout.php" class="btn btn-outline-danger btn-sm">Logout</a>
          <?php endif; ?>
        </div>
      </div>
    </nav>
  </div>

  <?php if (isset($_SESSION['message'])) { ?>
    <div style="margin-top:70px;" class="alert alert-warning alert-dismissible fade show container" role="alert">
      <strong>Hey!</strong> <?= htmlspecialchars($_SESSION['message']); ?>.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php unset($_SESSION['message']); ?>
  <?php } ?>
