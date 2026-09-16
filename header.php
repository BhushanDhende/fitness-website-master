<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$siteTitle = isset($pageTitle) ? $pageTitle : "Lean'N'Green : Fitness & Nutrition";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo htmlspecialchars($siteTitle); ?></title>
  
  <!-- Favicon -->
  <link rel="shortcut icon" type="image/icon" href="assets/images/favicon.ico" />
  
  <!-- CSS Bundles -->
  <link href="assets/css/font-awesome.css" rel="stylesheet">
  <link href="assets/css/bootstrap.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="assets/css/slick.css" />
  <link rel="stylesheet" href="assets/css/jquery.fancybox.css" type="text/css" media="screen" />
  <link rel="stylesheet" type="text/css" href="assets/css/animate.css" />
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-progressbar-3.3.4.css" />
  
  <!-- Theme Color -->
  <link id="switcher" href="assets/css/theme-color/default-theme.css" rel="stylesheet">
  
  <!-- Main Stylesheet -->
  <link href="style.css?v=2.2" rel="stylesheet">
  
  <!-- Modular Component Stylesheets -->
  <link href="assets/css/components/header.css?v=2.2" rel="stylesheet">
  <link href="assets/css/components/footer.css?v=2.2" rel="stylesheet">
  <link href="assets/css/components/comments.css?v=2.2" rel="stylesheet">
  <link href="assets/css/components/sidebar.css?v=2.2" rel="stylesheet">
  
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700" rel="stylesheet" type="text/css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

  <!-- HTML5 shim and Respond.js for IE8 support -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>

  <!-- Preloader -->
  <div id="preloader">
    <div id="status">&nbsp;</div>
  </div>

  <!-- Scroll To Top Button -->
  <a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>

  <!-- Navigation Bar -->
  <?php include('nav.php'); ?>
