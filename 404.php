<?php
http_response_code(404);
$pageTitle = "Lean'N'Green : 404 - Page Not Found";
$pageDescription = "The page you are looking for does not exist or has been moved. Explore our interactive workout routines, muscle anatomy guides, or BMI calculator.";
include('header.php');
?>

  <!-- Start single page header -->
  <section id="single-page-header">
    <div class="overlay">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="single-page-header-left">
              <h2>404 Error</h2>
              <p>
              <blockquote>"The only bad workout is the one that didn't happen."</blockquote>
              </p>
            </div>
          </div>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="single-page-header-right">
              <ol class="breadcrumb">
                <li><a href="index.php">Home</a></li>
                <li class="active">404 Not Found</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End single page header -->

  <section style="padding: 70px 0 80px 0; background: #f8fafc;">
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 text-center">
          
          <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 20px; padding: 45px 30px; box-shadow: 0 10px 35px rgba(15, 23, 42, 0.05);">
            
            <div style="width: 90px; height: 90px; border-radius: 50%; background: #ecfdf5; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 20px;">
              <i class="fa fa-compass" style="font-size: 42px; color: #059669;"></i>
            </div>

            <h1 style="font-family: 'Outfit', sans-serif; font-size: 56px; font-weight: 800; color: #0f172a; margin: 0 0 10px 0; letter-spacing: -1px;">
              404
            </h1>

            <h2 style="font-family: 'Outfit', sans-serif; font-size: 24px; font-weight: 700; color: #334155; margin: 0 0 14px 0;">
              Oops! We Couldn't Find That Rep
            </h2>

            <p style="color: #64748b; font-size: 15px; max-width: 520px; margin: 0 auto 28px auto; line-height: 1.6;">
              The page you are looking for might have been moved, renamed, or is temporarily unavailable. Let's get you back on track to crush your fitness goals.
            </p>

            <!-- Quick Search Bar -->
            <div style="max-width: 440px; margin: 0 auto 30px auto;">
              <form action="search.php" method="get" style="display: flex; gap: 8px;">
                <input type="text" name="query" placeholder="Search exercises, nutrition, anatomy..." required class="form-control" style="height: 44px; border-radius: 25px; padding-left: 20px; font-size: 14px; border: 1.5px solid #e2e8f0;">
                <button type="submit" class="btn btn-success" style="border-radius: 25px; padding: 0 24px; font-weight: 700; background: #10b981; border-color: #10b981;">
                  <i class="fa fa-search"></i>
                </button>
              </form>
            </div>

            <!-- Helpful Navigation Shortcuts -->
            <div style="border-top: 1px solid #f1f5f9; padding-top: 25px;">
              <p style="font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; color: #94a3b8; margin-bottom: 14px;">
                Explore Popular Destinations:
              </p>
              <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 10px;">
                <a href="index.php" class="btn btn-default" style="border-radius: 20px; font-size: 13px; font-weight: 600; padding: 8px 18px; border-color: #e2e8f0;">
                  <i class="fa fa-home" style="color:#10b981; margin-right:5px;"></i> Home
                </a>
                <a href="Anatomy-and-Exercises.php" class="btn btn-default" style="border-radius: 20px; font-size: 13px; font-weight: 600; padding: 8px 18px; border-color: #e2e8f0;">
                  <i class="fa fa-crosshairs" style="color:#10b981; margin-right:5px;"></i> Muscle Anatomy
                </a>
                <a href="Workout-Routine.php" class="btn btn-default" style="border-radius: 20px; font-size: 13px; font-weight: 600; padding: 8px 18px; border-color: #e2e8f0;">
                  <i class="fa fa-calendar-check" style="color:#10b981; margin-right:5px;"></i> 7-Day Workout Split
                </a>
                <a href="Vegan-Diet-Plan.php" class="btn btn-default" style="border-radius: 20px; font-size: 13px; font-weight: 600; padding: 8px 18px; border-color: #e2e8f0;">
                  <i class="fa fa-leaf" style="color:#10b981; margin-right:5px;"></i> Vegan Diet Plan
                </a>
                <a href="BMI-calc.php" class="btn btn-default" style="border-radius: 20px; font-size: 13px; font-weight: 600; padding: 8px 18px; border-color: #e2e8f0;">
                  <i class="fa fa-calculator" style="color:#10b981; margin-right:5px;"></i> BMI Calculator
                </a>
              </div>
            </div>

          </div>

        </div>
      </div>
    </div>
  </section>

<?php include('footer.php'); ?>
