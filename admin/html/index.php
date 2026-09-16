
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin panel</title>
  
  <link rel="stylesheet" href="styles.min.css" />
  <link rel="stylesheet" href="admin-carousel.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>
<?php session_start(); 

include('heder.php'); ?>


<?php if (isset($_SESSION['message'])) { ?>
    <div style="margin-left:280px;" class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong class="mt-5" >Hey!</strong><?= $_SESSION['message'];  ?>.
      <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php
      unset($_SESSION['message']);
  }
  ?>

<div id="demo" class="carousel slide" data-bs-ride="carousel" style="width:100vw; height:100vh; position:relative; left:50%; transform:translateX(-50%);">

  <!-- Indicators/dots -->
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
    <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
    <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
  </div>
  
  <!-- The slideshow/carousel -->
  <div class="carousel-inner" style="width:100vw; height:100vh;">
    <div class="carousel-item active">
      <img 
        src="https://images.squarespace-cdn.com/content/v1/58f40e9ed2b85703bbfca8ee/1693158638376-JU77BW761WHL13QMLAO8/image-asset.jpeg" 
        alt="Los Angeles" 
        class="d-block carousel-img"
      >
      <div class="carousel-caption">
        <h3>WELCOME TO ADMIN PANEL</h3>
        <p>Thank you, For visiting!</p>
      </div>
    </div>
    <div class="carousel-item">
      <img 
        src="https://images.everydayhealth.com/images/healthy-living/fitness/everything-you-need-know-about-fitness-1440x810.jpg?sfvrsn=2fee0a3b_5" 
        alt="Chicago" 
        class="d-block carousel-img"
      >
      <div class="carousel-caption">
        <h3>WELCOME TO ADMIN PANEL</h3>
        <p>Thank you, For visiting!</p>
      </div> 
    </div>
    <div class="carousel-item">
      <img 
        src="https://cdn.shopify.com/s/files/1/0291/3743/6771/files/Importance-of-physical-fitness-2.png?v=1721987667" 
        alt="New York" 
        class="d-block carousel-img"
      >
      <div class="carousel-caption">
        <h3>WELCOME TO ADMIN PANEL</h3>
        <p>Thank you, For visiting!</p>
      </div>  
    </div>
  </div>
  
  <!-- Left and right controls/icons -->
  <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
</div>


</body>

</html>