<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include('heder.php'); 
?>
<link rel="stylesheet" href="admin-carousel.css" />

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
        alt="Fitness Training" 
        class="d-block carousel-img"
      >
      <div class="carousel-caption">
        <h3>WELCOME TO ADMIN PANEL</h3>
        <p>Manage workouts, users, comments, and site data.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img 
        src="https://images.everydayhealth.com/images/healthy-living/fitness/everything-you-need-know-about-fitness-1440x810.jpg?sfvrsn=2fee0a3b_5" 
        alt="Health and Fitness" 
        class="d-block carousel-img"
      >
      <div class="carousel-caption">
        <h3>WELCOME TO ADMIN PANEL</h3>
        <p>Manage workouts, users, comments, and site data.</p>
      </div> 
    </div>
    <div class="carousel-item">
      <img 
        src="https://cdn.shopify.com/s/files/1/0291/3743/6771/files/Importance-of-physical-fitness-2.png?v=1721987667" 
        alt="Physical Conditioning" 
        class="d-block carousel-img"
      >
      <div class="carousel-caption">
        <h3>WELCOME TO ADMIN PANEL</h3>
        <p>Manage workouts, users, comments, and site data.</p>
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