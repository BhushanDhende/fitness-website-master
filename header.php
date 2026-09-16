<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$siteTitle = isset($pageTitle) ? $pageTitle : "Lean'N'Green : Plant-Powered Fitness & Anatomy Training";
$siteDescription = isset($pageDescription) ? $pageDescription : "Science-based workout routines, interactive human muscle anatomy guides, high-protein vegan nutrition plans, and free bodybuilding ebooks.";
$siteKeywords = isset($pageKeywords) ? $pageKeywords : "fitness, muscle anatomy, bodybuilding, workout routines, vegan diet plan, plant protein, exercise database, BMI calculator";
$canonicalUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$ogImage = isset($pageOgImage) ? $pageOgImage : "assets/images/og-share-card.jpg";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo htmlspecialchars($siteTitle); ?></title>
  <meta name="description" content="<?php echo htmlspecialchars($siteDescription); ?>">
  <meta name="keywords" content="<?php echo htmlspecialchars($siteKeywords); ?>">
  <link rel="canonical" href="<?php echo htmlspecialchars($canonicalUrl); ?>">
  
  <!-- Open Graph / Facebook -->
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="Lean'N'Green">
  <meta property="og:title" content="<?php echo htmlspecialchars($siteTitle); ?>">
  <meta property="og:description" content="<?php echo htmlspecialchars($siteDescription); ?>">
  <meta property="og:image" content="<?php echo htmlspecialchars($ogImage); ?>">
  <meta property="og:url" content="<?php echo htmlspecialchars($canonicalUrl); ?>">

  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?php echo htmlspecialchars($siteTitle); ?>">
  <meta name="twitter:description" content="<?php echo htmlspecialchars($siteDescription); ?>">
  <meta name="twitter:image" content="<?php echo htmlspecialchars($ogImage); ?>">
  
  <!-- Modern Favicon Set -->
  <link rel="icon" type="image/svg+xml" href="assets/images/favicon.svg">
  <link rel="alternate icon" type="image/x-icon" href="assets/images/favicon.ico">
  <link rel="apple-touch-icon" href="assets/images/favicon.ico">
  
  <!-- Analytics Container (GA4) -->
  <?php if (!empty(getenv('GA_TRACKING_ID'))): ?>
  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=<?= htmlspecialchars(getenv('GA_TRACKING_ID')) ?>"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', '<?= htmlspecialchars(getenv('GA_TRACKING_ID')) ?>');
  </script>
  <?php endif; ?>
  
  <!-- CSS Bundles -->
  <link href="assets/css/font-awesome.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
  
  <!-- Page Specific Stylesheets -->
  <?php if (!empty($extraCss)): ?>
    <?php foreach ((array)$extraCss as $cssFile): ?>
  <link href="<?php echo htmlspecialchars($cssFile); ?>" rel="stylesheet">
    <?php endforeach; ?>
  <?php endif; ?>
  
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
