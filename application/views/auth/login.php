<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>WBS | Login</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?= base_url(); ?>assets/img/favicon2.png" rel="icon">
  <link href="<?= base_url(); ?>assets/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?= base_url(); ?>assets/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url(); ?>assets/assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="<?= base_url(); ?>assets/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?= base_url(); ?>assets/assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="<?= base_url(); ?>assets/assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="<?= base_url(); ?>assets/assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?= base_url(); ?>assets/assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: iPortfolio - v1.5.1
  * Template URL: https://bootstrapmade.com/iportfolio-bootstrap-portfolio-websites-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Mobile nav toggle button ======= -->
  <!-- <button type="button" class="mobile-nav-toggle d-xl-none"><i class="icofont-navigation-menu"></i></button> -->

  <!-- ======= Header ======= -->


  <!-- ======= Hero Section ======= -->


  <main id="main">

    <!-- ======= About Section ======= -->


    <!-- ======= Facts Section ======= -->


    <!-- ======= Skills Section ======= -->


    <!-- ======= Resume Section ======= -->


    <!-- ======= Portfolio Section ======= -->


    <!-- ======= Services Section ======= -->


    <!-- ======= Testimonials Section ======= -->


    <!-- ======= Contact Section ======= -->
    <section class="contact">
      <div class="container">

        <div class="section-title">
          <h2>Login WBS</h2>
          <h5>RS Jiwa Prof. HB. Saanin Padang</h5>
        </div>

        <div class="row" data-aos="fade-in">

          <?= $this->session->flashdata('message'); ?>

          <div class="col-lg-6 mt-5 mt-lg-0 d-flex align-items-stretch">
            <div class="php-email-form">
              <form action="<?php base_url('auth'); ?>" method="post">
                <div class="form-group col-md-12">
                  <label for="username">Username</label>
                  <input type="text" name="username" id="username" class="form-control" id="name" value="<?= set_value('username'); ?>" />
                  <?= form_error('username', '<small><span class="text-danger">', '</span></small>'); ?>
                </div>
                <div class="form-group col-md-12">
                  <label for="name">Password</label>
                  <input type="password" class="form-control" name="password" id="password" />
                  <?= form_error('password', '<small><span class="text-danger">', '</span></small>'); ?>
                </div>
                <br>
                <div class="text-center"><button type="submit" class="btn btn-primary btn-block">Masuk</button></div>
              </form>
            </div>

          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->


  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="<?= base_url(); ?>assets/assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?= base_url(); ?>assets/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url(); ?>assets/assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="<?= base_url(); ?>assets/assets/vendor/php-email-form/validate.js"></script>
  <script src="<?= base_url(); ?>assets/assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="<?= base_url(); ?>assets/assets/vendor/counterup/counterup.min.js"></script>
  <script src="<?= base_url(); ?>assets/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="<?= base_url(); ?>assets/assets/vendor/venobox/venobox.min.js"></script>
  <script src="<?= base_url(); ?>assets/assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="<?= base_url(); ?>assets/assets/vendor/typed.js/typed.min.js"></script>
  <script src="<?= base_url(); ?>assets/assets/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="<?= base_url(); ?>assets/assets/js/main.js"></script>

</body>

</html>