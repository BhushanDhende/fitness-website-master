<?php
$pageTitle = "Lean'N'Green : Free Bodybuilding Ebooks & PDF Guides";
include('header.php');
?>


  <!-- Start single page header -->
  <section id="single-page-header8" style="background:linear-gradient(135deg, #0f172a 0%, #1e293b 100%); padding:60px 0; border-bottom:1px solid rgba(255,255,255,0.08);">
    <div class="container">
      <div class="row" style="display:flex; align-items:center; flex-wrap:wrap;">
        <div class="col-md-7 col-sm-7 col-xs-12">
          <div class="single-page-header-left">
            <span class="hero-badge" style="margin-bottom:10px;"><i class="fa fa-book-open"></i> Knowledge Base</span>
            <h1 style="color:#fff; font-family:'Outfit',sans-serif; font-size:36px; font-weight:800; margin:6px 0 12px 0;">
              Free Fitness &amp; Bodybuilding Ebooks
            </h1>
            <p style="color:#94a3b8; font-size:15px; margin:0;">
              "A Book is a gift you can open again and again. Reading a good training book is taking a journey toward your peak self."
            </p>
          </div>
        </div>
        <div class="col-md-5 col-sm-5 col-xs-12 text-right">
          <ol class="breadcrumb" style="background:rgba(255,255,255,0.06); border-radius:10px; display:inline-block; padding:10px 18px; margin:15px 0 0 0;">
            <li><a href="index.php" style="color:#34d399;"><i class="fa fa-home"></i> Home</a></li>
            <li class="active" style="color:#e2e8f0;">Ebooks</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <!-- End single page header -->

  <section style="padding:60px 0; background:#f8fafc;">
    <div class="container">
      <div class="row">
        <!-- Main Content (8 cols) -->
        <div class="col-md-8 col-sm-12">
          <div class="section-title-area" style="margin-bottom:35px;">
            <h2 style="font-family:'Outfit',sans-serif; font-size:28px; font-weight:800; color:#0f172a; margin-top:0;">
              Download Bodybuilding Guides &amp; Manuals
            </h2>
            <p style="color:#64748b; font-size:15px;">
              All ebooks are provided in high quality, fully optimized PDF format for instant reading on phone, tablet, or desktop.
            </p>
          </div>

          <div class="row">
            <?php
            $ebooks = [
              [
                'title' => 'Strength Training Anatomy',
                'author' => 'Frederic Delavier',
                'img' => 'assets/images/Strength-Training-Anatomy.jpg',
                'file' => 'assets/Ebooks/Strength-Training-Anatomy-1.pdf',
                'size' => '~5.5 MB'
              ],
              [
                'title' => 'Arnold Training: Chest',
                'author' => 'Arnold Schwarzenegger',
                'img' => 'assets/images/arnold-training-chest.jpg',
                'file' => 'assets/Ebooks/arnold-training-chest.pdf',
                'size' => '~2.2 MB'
              ],
              [
                'title' => 'Arnold Training: Delts & Arms',
                'author' => 'Arnold Schwarzenegger',
                'img' => 'assets/images/arnold-training-delts-arm.jpg',
                'file' => 'assets/Ebooks/arnold-training-delts-arms.pdf',
                'size' => '~3.5 MB'
              ],
              [
                'title' => 'Arnold Training: Legs, Back & Abs',
                'author' => 'Arnold Schwarzenegger',
                'img' => 'assets/images/arnold-training-back-legs-abs.jpg',
                'file' => 'assets/Ebooks/arnold-training-legs-back-abs.pdf',
                'size' => '~4.2 MB'
              ],
              [
                'title' => 'Men\'s Health: Total Body Muscle Plan',
                'author' => 'Men\'s Health Editors',
                'img' => 'assets/images/Mens-Health-Total-Body-Muscle-Plan.jpg',
                'file' => 'assets/Ebooks/Mens-Health-Total-Body-Muscle-Plan.pdf',
                'size' => '~1.6 MB'
              ],
              [
                'title' => 'A Guide to Flexible Dieting',
                'author' => 'Lyle McDonald',
                'img' => 'assets/images/Lyle-McDonald-A-Guide-to-Flexible-Dieting.jpg',
                'file' => 'assets/Ebooks/Lyle-McDonald-A-Guide-to-Flexible-Dieting.pdf',
                'size' => '~0.7 MB'
              ],
              [
                'title' => 'Brink\'s Bodybuilding Revealed',
                'author' => 'Will Brink',
                'img' => 'assets/images/Brinks-Bodybuilding-Revealed.jpg',
                'file' => 'assets/Ebooks/Brinks-Bodybuilding-Revealed.pdf',
                'size' => '~7.4 MB'
              ],
              [
                'title' => 'Maximize Your Metabolism',
                'author' => 'Christopher Guerriero',
                'img' => 'assets/images/Christopher-Gerriero-Maximize-Your-Metabolism.jpg',
                'file' => 'assets/Ebooks/Christopher-Gerriero-Maximize-Your-Metabolism.pdf',
                'size' => '~2.6 MB'
              ],
              [
                'title' => 'Natural Cures "They" Don\'t Want You To Know',
                'author' => 'Kevin Trudeau',
                'img' => 'assets/images/Kevin-Trudeau-Natural-Cures-Jan-2006-ebook.jpg',
                'file' => 'assets/Ebooks/Kevin-Trudeau-Natural-Cures-Jan-2006-ebook.pdf',
                'size' => '~2.8 MB'
              ],
              [
                'title' => 'The Fat Burning Bible',
                'author' => 'Mackie Shilstone',
                'img' => 'assets/images/Mackie-Shilstone-The-Fat-Burning-Bible.jpg',
                'file' => 'assets/Ebooks/Mackie-Shilstone-The-Fat-Burning-Bible.pdf',
                'size' => '~4.1 MB'
              ]
            ];

            foreach ($ebooks as $b): ?>
              <div class="col-md-6 col-sm-6" style="margin-bottom:28px;">
                <div class="ebook-preview-card" style="height:100%; display:flex; flex-direction:column; justify-content:space-between;">
                  <div>
                    <div class="ebook-cover-wrapper" style="height:210px;">
                      <img src="<?php echo htmlspecialchars($b['img']); ?>" alt="<?php echo htmlspecialchars($b['title']); ?>" style="object-fit:cover; height:100%; width:100%;">
                      <span class="badge-free">FREE PDF</span>
                    </div>
                    <div class="ebook-card-info" style="padding:16px;">
                      <span style="font-size:11px; color:#10b981; font-weight:700; text-transform:uppercase; letter-spacing:0.5px;"><?php echo htmlspecialchars($b['author']); ?></span>
                      <h4 style="font-size:16px; font-weight:700; margin:4px 0 8px 0; color:#0f172a;"><?php echo htmlspecialchars($b['title']); ?></h4>
                    </div>
                  </div>
                  <div class="ebook-card-footer" style="padding:12px 16px; background:#fafafa; border-top:1px solid #f1f5f9;">
                    <span class="filesize-tag"><i class="fa fa-file-pdf" style="color:#ef4444;"></i> <?php echo $b['size']; ?></span>
                    <a href="<?php echo htmlspecialchars($b['file']); ?>" download class="btn-download-sm">
                      <i class="fa fa-download"></i> Download
                    </a>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>

          <div style="background:#ffffff; border-radius:16px; padding:24px; box-shadow:0 6px 18px rgba(0,0,0,0.04); margin-top:20px;">
            <?php include('comment.php'); ?>
          </div>
        </div>
        <!-- Sidebar (4 cols) -->
        <?php include('sidebar.php'); ?>
      </div>
    </div>
  </section>

  <!-- Start subscribe us & footer -->
  <?php include('footer.php'); ?>