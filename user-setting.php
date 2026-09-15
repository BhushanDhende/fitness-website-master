<?php
$pageTitle = "Lean'N'Green : Account Settings";
include('header.php');
include_once('db.php');

$user_id = $_SESSION['id'] ?? null;
$fullname = $username = $email = '';
$profile_msg = '';
$password_msg = '';

if ($user_id && isset($conn) && $conn) {
    // Handle Profile Update
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
        $new_fullname = trim($_POST['fullname'] ?? '');
        $new_username = trim($_POST['username'] ?? '');
        $new_email = trim($_POST['email'] ?? '');

        if ($new_fullname && $new_username && $new_email) {
            $stmt = $conn->prepare("UPDATE users SET name = ?, username = ?, email = ? WHERE id = ?");
            if ($stmt) {
                $stmt->bind_param("sssi", $new_fullname, $new_username, $new_email, $user_id);
                if ($stmt->execute()) {
                    $_SESSION['username'] = $new_username;
                    $profile_msg = '<div class="alert alert-success" style="border-radius:10px;"><i class="fa fa-check-circle"></i> Profile updated successfully!</div>';
                } else {
                    $profile_msg = '<div class="alert alert-danger" style="border-radius:10px;"><i class="fa fa-exclamation-circle"></i> Error updating profile.</div>';
                }
                $stmt->close();
            }
        } else {
            $profile_msg = '<div class="alert alert-warning" style="border-radius:10px;"><i class="fa fa-exclamation-triangle"></i> All fields are required.</div>';
        }
    }

    // Handle Password Change
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_password'])) {
        $old_password = $_POST['old_password'] ?? '';
        $new_password = $_POST['new_password'] ?? '';
        $re_password = $_POST['re_password'] ?? '';

        if ($old_password && $new_password && $re_password) {
            if ($new_password !== $re_password) {
                $password_msg = '<div class="alert alert-warning" style="border-radius:10px;"><i class="fa fa-exclamation-triangle"></i> New passwords do not match.</div>';
            } elseif (strlen($new_password) < 4) {
                $password_msg = '<div class="alert alert-warning" style="border-radius:10px;"><i class="fa fa-exclamation-triangle"></i> New password must be at least 4 characters.</div>';
            } else {
                $stmt = $conn->prepare("SELECT password FROM users WHERE id = ?");
                if ($stmt) {
                    $stmt->bind_param("i", $user_id);
                    $stmt->execute();
                    $stmt->bind_result($db_password_hash);
                    if ($stmt->fetch()) {
                        $stmt->close();
                        if (password_verify($old_password, $db_password_hash)) {
                            $new_hash = password_hash($new_password, PASSWORD_DEFAULT);
                            $update_stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
                            if ($update_stmt) {
                                $update_stmt->bind_param("si", $new_hash, $user_id);
                                if ($update_stmt->execute()) {
                                    $password_msg = '<div class="alert alert-success" style="border-radius:10px;"><i class="fa fa-check-circle"></i> Password changed successfully!</div>';
                                } else {
                                    $password_msg = '<div class="alert alert-danger" style="border-radius:10px;"><i class="fa fa-exclamation-circle"></i> Error updating password.</div>';
                                }
                                $update_stmt->close();
                            }
                        } else {
                            $password_msg = '<div class="alert alert-danger" style="border-radius:10px;"><i class="fa fa-times-circle"></i> Current password is incorrect.</div>';
                        }
                    } else {
                        $stmt->close();
                        $password_msg = '<div class="alert alert-danger" style="border-radius:10px;">User record not found.</div>';
                    }
                }
            }
        } else {
            $password_msg = '<div class="alert alert-warning" style="border-radius:10px;"><i class="fa fa-exclamation-triangle"></i> All password fields are required.</div>';
        }
    }

    // Fetch latest user data
    $stmt = $conn->prepare("SELECT name, username, email FROM users WHERE id = ?");
    if ($stmt) {
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->bind_result($fullname, $username, $email);
        $stmt->fetch();
        $stmt->close();
    }
}
?>

<!-- Header Banner -->
<section id="single-page-header4" style="background:linear-gradient(135deg, #0f172a 0%, #1e293b 100%) !important; padding:50px 0 !important; border-bottom:1px solid rgba(255,255,255,0.08); float:none !important; clear:both !important; display:block !important; width:100% !important;">
  <div class="container">
    <div class="row" style="display:flex; align-items:center; flex-wrap:wrap;">
      <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="single-page-header-left">
          <span class="hero-badge" style="margin-bottom:8px; display:inline-block; background:rgba(16,185,129,0.15); color:#34d399; padding:4px 12px; border-radius:16px; font-size:12px; font-weight:700;">
            <i class="fa fa-cog"></i> USER DASHBOARD
          </span>
          <h1 style="color:#fff; font-family:'Outfit',sans-serif; font-size:32px; font-weight:800; margin:4px 0 0 0;">
            Account Settings
          </h1>
        </div>
      </div>
      <div class="col-md-6 col-sm-6 col-xs-12 text-right">
        <ol class="breadcrumb" style="background:rgba(255,255,255,0.06); border-radius:10px; display:inline-block; padding:10px 18px; margin:10px 0 0 0;">
          <li><a href="index.php" style="color:#34d399;"><i class="fa fa-home"></i> Home</a></li>
          <li style="color:#94a3b8;">Profile</li>
          <li class="active" style="color:#e2e8f0;">Settings</li>
        </ol>
      </div>
    </div>
  </div>
</section>

<?php if (!$user_id): ?>
<!-- Unauthenticated Login Prompt -->
<section style="padding: 95px 0 110px 0; background: #f8fafc; min-height: 520px; clear: both; display: block; width: 100%;">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3 text-center">
        <div style="background: #ffffff; border-radius: 20px; border: 1px solid #e2e8f0; padding: 55px 40px; box-shadow: 0 10px 30px rgba(15,23,42,0.06); margin-top: 15px;">
          <div style="width: 76px; height: 76px; background: linear-gradient(135deg, #ecfdf5, #d1fae5); border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 20px; border: 2px solid #a7f3d0;">
            <i class="fa fa-user-lock" style="font-size: 32px; color: #059669;"></i>
          </div>
          <h2 style="font-family: 'Outfit', sans-serif; font-size: 26px; font-weight: 800; color: #0f172a; margin-top: 0; margin-bottom: 12px;">
            Account Sign In Required
          </h2>
          <p style="color: #64748b; font-size: 15px; line-height: 1.6; margin-bottom: 28px;">
            Please log in or register a free Lean'N'Green account to manage your profile, edit your personal details, and change your password.
          </p>
          <div style="display: flex; gap: 12px; justify-content: center; flex-wrap: wrap;">
            <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#login-form"
              style="background: linear-gradient(135deg, #10b981, #059669); border: none; padding: 12px 28px; border-radius: 12px; font-weight: 700; font-size: 15px; box-shadow: 0 6px 18px rgba(16,185,129,0.35); transition: all 0.2s;">
              <i class="fa fa-sign-in" style="margin-right: 6px;"></i> Sign In / Create Account
            </button>
            <a href="index.php" class="btn btn-default btn-lg"
              style="background: #f1f5f9; border: 1px solid #cbd5e1; padding: 12px 24px; border-radius: 12px; font-weight: 600; font-size: 15px; color: #475569;">
              <i class="fa fa-home" style="margin-right: 6px;"></i> Back to Home
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php else: ?>

<!-- Authenticated Settings Panel -->
<section style="padding: 50px 0 80px 0; background: #f8fafc;">
  <div class="container">
    
    <!-- User Profile Hero Banner -->
    <div style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); border-radius: 18px; padding: 26px 30px; margin-bottom: 35px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 20px; box-shadow: 0 10px 25px rgba(0,0,0,0.12);">
      <div style="display: flex; align-items: center; gap: 20px;">
        <div style="width: 68px; height: 68px; border-radius: 50%; background: linear-gradient(135deg, #10b981, #059669); color: #fff; font-size: 26px; font-weight: 800; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 14px rgba(16,185,129,0.4); border: 2px solid rgba(255,255,255,0.2);">
          <?= strtoupper(substr($fullname ?: $username ?: 'U', 0, 1)) ?>
        </div>
        <div>
          <h2 style="color: #fff; font-family: 'Outfit', sans-serif; font-size: 24px; font-weight: 800; margin: 0 0 6px 0;">
            <?= htmlspecialchars($fullname ?: $username) ?>
          </h2>
          <div style="display: flex; gap: 14px; flex-wrap: wrap; font-size: 13.5px; color: #94a3b8;">
            <span><i class="fa fa-user" style="color: #10b981; margin-right: 5px;"></i> @<?= htmlspecialchars($username) ?></span>
            <span><i class="fa fa-envelope" style="color: #10b981; margin-right: 5px;"></i> <?= htmlspecialchars($email) ?></span>
            <span style="background: rgba(16,185,129,0.15); color: #34d399; padding: 2px 10px; border-radius: 12px; font-size: 12px; font-weight: 700;">Verified Athlete</span>
          </div>
        </div>
      </div>
      <div>
        <a href="exercise-done.php" class="btn btn-default" style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.18); color: #fff; padding: 10px 20px; border-radius: 10px; font-weight: 600; font-size: 13.5px; transition: all 0.2s;">
          <i class="fa fa-calendar-check" style="color: #10b981; margin-right: 6px;"></i> My Exercise Log
        </a>
      </div>
    </div>

    <div class="row">
      <!-- Edit Profile Card -->
      <div class="col-md-6 col-sm-12" style="margin-bottom: 30px;">
        <div style="background: #ffffff; border-radius: 16px; border: 1px solid #e2e8f0; padding: 30px; box-shadow: 0 4px 20px rgba(15,23,42,0.04); height: 100%;">
          <div style="border-bottom: 2px solid #f1f5f9; padding-bottom: 16px; margin-bottom: 24px;">
            <h3 style="font-family: 'Outfit', sans-serif; font-size: 20px; font-weight: 700; color: #0f172a; margin: 0; display: flex; align-items: center; gap: 8px;">
              <i class="fa fa-user-edit" style="color: #10b981;"></i> Profile Information
            </h3>
            <p style="color: #64748b; font-size: 13.5px; margin: 4px 0 0 0;">Update your public athlete profile and email address</p>
          </div>

          <?php if (!empty($profile_msg)) echo $profile_msg; ?>

          <form method="post" action="">
            <div class="form-group" style="margin-bottom: 18px;">
              <label for="fullname" style="font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px; display: block;">Full Name</label>
              <div class="input-group" style="width: 100%;">
                <span class="input-group-addon" style="background: #f8fafc; border-color: #cbd5e1; color: #64748b; border-radius: 10px 0 0 10px;"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control" id="fullname" name="fullname" value="<?php echo htmlspecialchars($fullname); ?>" required style="height: 44px; border-radius: 0 10px 10px 0; border-color: #cbd5e1;">
              </div>
            </div>

            <div class="form-group" style="margin-bottom: 18px;">
              <label for="username" style="font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px; display: block;">Username</label>
              <div class="input-group" style="width: 100%;">
                <span class="input-group-addon" style="background: #f8fafc; border-color: #cbd5e1; color: #64748b; border-radius: 10px 0 0 10px;"><i class="fa fa-at"></i></span>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" required style="height: 44px; border-radius: 0 10px 10px 0; border-color: #cbd5e1;">
              </div>
            </div>

            <div class="form-group" style="margin-bottom: 24px;">
              <label for="email" style="font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px; display: block;">Email Address</label>
              <div class="input-group" style="width: 100%;">
                <span class="input-group-addon" style="background: #f8fafc; border-color: #cbd5e1; color: #64748b; border-radius: 10px 0 0 10px;"><i class="fa fa-envelope"></i></span>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required style="height: 44px; border-radius: 0 10px 10px 0; border-color: #cbd5e1;">
              </div>
            </div>

            <button type="submit" name="update_profile" class="btn btn-success btn-block"
              style="height: 46px; background: linear-gradient(135deg, #10b981, #059669); border: none; border-radius: 10px; font-weight: 700; font-size: 14.5px; box-shadow: 0 4px 14px rgba(16,185,129,0.3); transition: all 0.2s;">
              <i class="fa fa-save" style="margin-right: 6px;"></i> Save Profile Changes
            </button>
          </form>
        </div>
      </div>

      <!-- Change Password Card -->
      <div class="col-md-6 col-sm-12" style="margin-bottom: 30px;">
        <div style="background: #ffffff; border-radius: 16px; border: 1px solid #e2e8f0; padding: 30px; box-shadow: 0 4px 20px rgba(15,23,42,0.04); height: 100%;">
          <div style="border-bottom: 2px solid #f1f5f9; padding-bottom: 16px; margin-bottom: 24px;">
            <h3 style="font-family: 'Outfit', sans-serif; font-size: 20px; font-weight: 700; color: #0f172a; margin: 0; display: flex; align-items: center; gap: 8px;">
              <i class="fa fa-shield-alt fa-lock" style="color: #f59e0b;"></i> Security &amp; Password
            </h3>
            <p style="color: #64748b; font-size: 13.5px; margin: 4px 0 0 0;">Ensure your account remains safe with a strong password</p>
          </div>

          <?php if (!empty($password_msg)) echo $password_msg; ?>

          <form method="post" action="">
            <div class="form-group" style="margin-bottom: 18px;">
              <label for="old_password" style="font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px; display: block;">Current Password</label>
              <div class="input-group" style="width: 100%;">
                <span class="input-group-addon" style="background: #f8fafc; border-color: #cbd5e1; color: #64748b; border-radius: 10px 0 0 10px;"><i class="fa fa-key"></i></span>
                <input type="password" class="form-control" id="old_password" name="old_password" placeholder="Enter current password" required style="height: 44px; border-radius: 0 10px 10px 0; border-color: #cbd5e1;">
              </div>
            </div>

            <div class="form-group" style="margin-bottom: 18px;">
              <label for="new_password" style="font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px; display: block;">New Password</label>
              <div class="input-group" style="width: 100%;">
                <span class="input-group-addon" style="background: #f8fafc; border-color: #cbd5e1; color: #64748b; border-radius: 10px 0 0 10px;"><i class="fa fa-lock"></i></span>
                <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Create new password" required style="height: 44px; border-radius: 0 10px 10px 0; border-color: #cbd5e1;">
              </div>
            </div>

            <div class="form-group" style="margin-bottom: 24px;">
              <label for="re_password" style="font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px; display: block;">Confirm New Password</label>
              <div class="input-group" style="width: 100%;">
                <span class="input-group-addon" style="background: #f8fafc; border-color: #cbd5e1; color: #64748b; border-radius: 10px 0 0 10px;"><i class="fa fa-check-circle"></i></span>
                <input type="password" class="form-control" id="re_password" name="re_password" placeholder="Re-type new password" required style="height: 44px; border-radius: 0 10px 10px 0; border-color: #cbd5e1;">
              </div>
            </div>

            <button type="submit" name="change_password" class="btn btn-warning btn-block"
              style="height: 46px; background: linear-gradient(135deg, #f59e0b, #d97706); color: #fff; border: none; border-radius: 10px; font-weight: 700; font-size: 14.5px; box-shadow: 0 4px 14px rgba(245,158,11,0.3); transition: all 0.2s;">
              <i class="fa fa-sync-alt fa-refresh" style="margin-right: 6px;"></i> Update Password
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<?php endif; ?>

<?php include('footer.php'); ?>