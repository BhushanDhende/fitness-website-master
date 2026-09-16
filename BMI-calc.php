<?php
$pageTitle = "Lean'N'Green : BMI Calculator";
include('header.php');
?>

  <!-- Start single page header -->
  <section id="single-page-header">
    <div class="overlay">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="single-page-header-left">
              <h2>BMI Calculator</h2>
              <p>
              <blockquote>"BMI quickly estimates body fat based on height and weight to help assess whether you're underweight, healthy, overweight, or obese."</blockquote>
              </p>
            </div>
          </div>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="single-page-header-right">
              <ol class="breadcrumb">
                <li><a href="index.php">Home</a></li>
                <li class="active">BMI Calculator</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- BMI Calculation Script -->
  <script>
    function calculateBmi() {
      var weight = parseFloat(document.bmiForm.weight.value);
      var height = parseFloat(document.bmiForm.height.value);
      if (weight > 0 && height > 0) {
        var heightInM = height / 100;
        var finalBmi = weight / (heightInM * heightInM);
        document.bmiForm.bmi.value = finalBmi.toFixed(1);
        if (finalBmi < 18.5) {
          document.bmiForm.meaning.value = "Underweight (< 18.5)";
        } else if (finalBmi <= 24.9) {
          document.bmiForm.meaning.value = "Healthy / Normal (18.5 - 24.9)";
        } else if (finalBmi <= 29.9) {
          document.bmiForm.meaning.value = "Overweight (25.0 - 29.9)";
        } else {
          document.bmiForm.meaning.value = "Obese (30.0 or higher)";
        }
      } else {
        alert("Please enter valid positive values for weight (kg) and height (cm).");
      }
    }
  </script>

  <section id="feature" style="padding: 50px 0 30px 0; background: #f8fafc;">
    <div class="container">
      <div class="row">
        <div class="col-md-10 col-md-offset-1 col-sm-12">
          
          <!-- Introduction Card -->
          <div style="background: #ffffff; border-radius: 14px; border: 1px solid #e2e8f0; padding: 26px 30px; margin-bottom: 30px; box-shadow: 0 4px 16px rgba(15,23,42,0.04);">
            <h3 style="font-family: 'Outfit', sans-serif; font-size: 22px; font-weight: 700; color: #0f172a; margin-top: 0; margin-bottom: 12px;">
              <i class="fa fa-info-circle text-emerald" style="margin-right: 8px;"></i> What is Body Mass Index?
            </h3>
            <p style="color: #475569; font-size: 15px; line-height: 1.7; margin: 0; text-align: justify;">
              BMI (Body Mass Index) is an internationally recognized estimate of body fatness based on height and weight for adults. A healthy BMI score typically falls between 18.5 and 24.9. A score below 18.5 indicates that you may be underweight, while a value from 25.0 to 29.9 denotes overweight status. Use this tool alongside body composition metrics and guidance from healthcare professionals to optimize your health journey.
            </p>
          </div>

          <!-- Calculator Card -->
          <div style="background: #ffffff; border-radius: 16px; border: 1px solid #e2e8f0; padding: 35px 30px; box-shadow: 0 6px 20px rgba(15,23,42,0.05); max-width: 600px; margin: 0 auto 30px auto;">
            <div style="text-align: center; margin-bottom: 25px;">
              <div style="width: 60px; height: 60px; background: #ecfdf5; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 12px; border: 1.5px solid #a7f3d0;">
                <i class="fa fa-calculator" style="font-size: 26px; color: #059669;"></i>
              </div>
              <h2 style="font-family: 'Outfit', sans-serif; font-size: 26px; font-weight: 800; color: #0f172a; margin: 0;">
                BMI Calculator
              </h2>
              <p style="color: #64748b; font-size: 14px; margin-top: 6px;">Enter your current metrics below</p>
            </div>

            <form name="bmiForm" onsubmit="event.preventDefault(); calculateBmi();">
              <div class="form-group" style="margin-bottom: 16px;">
                <label style="font-weight: 600; font-size: 13.5px; color: #334155; margin-bottom: 6px; display: block;">
                  Your Weight (kg):
                </label>
                <input type="number" step="0.1" name="weight" placeholder="e.g. 70" class="form-control" style="height: 46px; border-radius: 8px; border: 1.5px solid #cbd5e1; font-size: 15px;" required>
              </div>

              <div class="form-group" style="margin-bottom: 20px;">
                <label style="font-weight: 600; font-size: 13.5px; color: #334155; margin-bottom: 6px; display: block;">
                  Your Height (cm):
                </label>
                <input type="number" step="0.1" name="height" placeholder="e.g. 175" class="form-control" style="height: 46px; border-radius: 8px; border: 1.5px solid #cbd5e1; font-size: 15px;" required>
              </div>

              <div style="display: flex; gap: 10px; margin-bottom: 25px;">
                <button type="button" onClick="calculateBmi()" class="comment-btn" style="flex: 1; height: 46px; border-radius: 8px; font-weight: 700; font-size: 14.5px;">
                  <i class="fa fa-calculator" style="margin-right: 6px;"></i> Calculate BMI
                </button>
                <button type="reset" class="btn btn-default" style="height: 46px; padding: 0 20px; border-radius: 8px; font-weight: 600; border: 1.5px solid #cbd5e1;">
                  Reset
                </button>
              </div>

              <div style="background: #f8fafc; border-radius: 10px; padding: 18px; border: 1px solid #e2e8f0;">
                <div class="form-group" style="margin-bottom: 12px;">
                  <label style="font-weight: 600; font-size: 13px; color: #64748b; margin-bottom: 4px; display: block;">Your Calculated BMI:</label>
                  <input type="text" name="bmi" readonly class="form-control" style="height: 42px; font-weight: 700; font-size: 16px; color: #059669; background: #ffffff; border-radius: 6px;" placeholder="Result will appear here">
                </div>
                <div class="form-group" style="margin-bottom: 0;">
                  <label style="font-weight: 600; font-size: 13px; color: #64748b; margin-bottom: 4px; display: block;">Classification:</label>
                  <input type="text" name="meaning" readonly class="form-control" style="height: 42px; font-weight: 600; font-size: 14px; color: #0f172a; background: #ffffff; border-radius: 6px;" placeholder="Category summary">
                </div>
              </div>
            </form>
          </div>

        </div>
      </div>
    </div>
  </section>

  <section style="padding: 20px 0 60px 0; background: #f8fafc;">
    <div class="container">
      <div class="row">
        <div class="col-md-10 col-md-offset-1 col-sm-12">
          <div style="background: #ffffff; border-radius: 16px; padding: 28px; box-shadow: 0 4px 18px rgba(15, 23, 42, 0.05); border: 1px solid #e2e8f0;">
            <?php include('comment.php'); ?>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php include('footer.php'); ?>