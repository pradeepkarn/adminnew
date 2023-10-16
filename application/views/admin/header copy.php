<?php // echo "hi";echo $this->session->sess_user_users_permissions['Groups'];  die(); 
?>
<!DOCTYPE html>
<html <?php echo ($ln == 'ar') ? 'lang="ar" dir="rtl"' : 'lang="en"'; ?>>

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?php echo $this->lang->line('PROJECT_NAME'); ?></title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?php echo base_url('assets/vendors/simple-line-icons/css/simple-line-icons.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/vendors/flag-icon-css/css/flag-icon.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/vendors/css/vendor.bundle.base.css'); ?>">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="<?php echo base_url('assets/vendors/font-awesome/css/font-awesome.min.css'); ?>" />
  <link rel="stylesheet" href="<?php echo base_url('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/vendors/jvectormap/jquery-jvectormap.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/vendors/daterangepicker/daterangepicker.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/vendors/chartist/chartist.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/style_w3.css'); ?>">
  <link href="<?php echo base_url('assets/vendors/dropify/dropify.min.css'); ?>" rel="stylesheet" />

  <link rel="stylesheet" href="<?php echo base_url('assets/vendors/jquery-toast-plugin/jquery.toast.min.css'); ?>">


  <?php if ($this->router->fetch_method() == "permission") { ?>
    <link rel="stylesheet" href="<?php echo base_url('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') ?>">
  <?php } ?>
  <?php if ($this->router->fetch_method() == "addpermission" || $this->router->fetch_method() == "editpermission") { ?>
    <link rel="stylesheet" href="<?php echo base_url('assets/vendors/ion-rangeslider/css/ion.rangeSlider.css'); ?>">
  <?php } ?>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="<?php echo base_url('assets/css/demo_1/style.css'); ?>">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.png');
                                  ?>" />
  <script src="<?php echo base_url('assets/vendors/js/vendor.bundle.base.js'); ?>"></script>
  <style>
    .navbar .navbar-brand-wrapper .navbar-brand img {
      height: auto
    }
  </style>
</head>

<body class="<?php echo ($ln == 'ar') ? 'rtl' : ''; ?> <?php if ($menu != 'dashboard') {
                                                          echo 'sidebar-icon-only';
                                                        } ?>">
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center" style="background:#fff;">
        <a class="navbar-brand brand-logo" href="<?php echo base_url('dashboard'); ?>">
          <img src="<?php echo base_url('assets/images/favicon.png');
                    ?>" alt="logo" class="logo-dark" style="width:48%" />
          <img src="<?php echo base_url('assets/images/favicon.png');
                    ?>" alt="logo-light" class="logo-light">
        </a>
        <a class="navbar-brand brand-logo-mini" href="<?php echo base_url('dashboard'); ?>"><img src="<?php echo base_url('assets/images/logo.png');
                                                                                                      ?>" alt="logo" style="width:48%" /></a>
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center">
        <h5 class="mb-0 font-weight-medium d-none d-lg-flex"><?php echo $this->lang->line('WELCOME'); ?> </h5>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown language-dropdown d-none d-sm-flex align-items-center">

            <?php if ($ln == 'en') { ?>

              <a class="nav-link d-flex align-items-center dropdown-toggle" id="LanguageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <div class="d-inline-flex">
                  <i class="flag-icon flag-icon-us"></i>
                </div>
                <span class="profile-text font-weight-normal">English</span>
              </a>
            <?php } else { ?>

              <a class="nav-link d-flex align-items-center dropdown-toggle" id="LanguageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <div class="d-inline-flex">
                  <i class="flag-icon flag-icon-sa"></i>
                </div>
                <span class="profile-text font-weight-normal">عربي</span>
              </a>

            <?php } ?>


            <div class="dropdown-menu dropdown-menu-left navbar-dropdown py-2" aria-labelledby="LanguageDropdown">
              <a href="<?php echo base_url('switchlanguage/en'); ?>" class="dropdown-item">
                <i class="flag-icon flag-icon-us"></i> English </a>
              <a href="<?php echo base_url('switchlanguage/ar'); ?>" class="dropdown-item">
                <i class="flag-icon flag-icon-sa"></i> عربي</a>

            </div>
          </li>
          <li class="nav-item dropdown d-none d-xl-inline-flex user-dropdown">
            <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <img class="img-xs rounded-circle ml-2" src="<?php echo base_url('assets/images/faces/profile.png'); ?>" alt="Profile image"> <span class="font-weight-normal"> <?php echo $this->session->userdata('sess_user_name'); ?> </span></a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
              <div class="dropdown-header text-center">
                <img class="img-md rounded-circle" src="<?php echo base_url('assets/images/faces/profile.png'); ?>" alt="Profile image">
                <p class="mb-1 mt-3"><?php echo $this->session->userdata('sess_user_name'); ?></p>
                <p class="font-weight-light text-muted mb-0"><?php echo $this->session->userdata('sess_user_email'); ?></p>
              </div>
              <a href="<?php echo base_url('logout'); ?>" class="dropdown-item"><i class="dropdown-item-icon icon-power text-primary"></i><?php echo $this->lang->line('sign_out'); ?></a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">

      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item navbar-brand-mini-wrapper" style="background:#fff;">
            <a class="nav-link navbar-brand brand-logo-mini" href="<?php echo base_url('dashboard'); ?>"><img src="<?php echo base_url('assets/images/logo.png');
                                                                                                                    ?>" alt="logo" style="max-width:40px;" /></a>
          </li>
          <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
              <div class="profile-image">
                <img class="img-xs rounded-circle" src="<?php echo base_url('assets/images/faces/profile.png'); ?>" alt="profile image">
                <div class="dot-indicator bg-success"></div>
              </div>
              <div class="text-wrapper">
                <p class="profile-name"><?php echo $this->session->userdata('sess_user_name'); ?></p>
              </div>

            </a>
          </li>

          <li class="nav-item <?php if (!empty($menu) && $menu == 'dashboard') {
                                echo 'active';
                              } ?>">
            <a class="nav-link" href="<?php echo base_url('dashboard'); ?>">
              <span class="menu-title"><?php echo $this->lang->line('DASHBOARD'); ?></span>
              <i class="icon-screen-desktop menu-icon"></i>
            </a>
          </li>

          <li class="nav-item  <?php if (!empty($menu) && $menu == 'tenants') {
                                  echo 'active';
                                } ?>">
            <a class="nav-link" href="<?php echo base_url('tenants'); ?>">
              <span class="menu-title"><?php echo $this->lang->line('TENANTS'); ?></span>
              <i class="icon-key menu-icon"></i>
            </a>
          </li>

          <li class="nav-item  <?php if (!empty($menu) && $menu == 'owners') {
                                  echo 'active';
                                } ?>">
            <a class="nav-link" href="<?php echo base_url('owners'); ?>">
              <span class="menu-title"><?php echo $this->lang->line('OWNERS'); ?></span>
              <i class="icon-people menu-icon"></i>
            </a>
          </li>

          <li class="nav-item  <?php if (!empty($menu) && $menu == 'properties') {
                                  echo 'active';
                                } ?>">
            <a class="nav-link" href="<?php echo base_url('properties'); ?>">
              <span class="menu-title"><?php echo $this->lang->line('PROPERTIES_UNITS'); ?></span>
              <i class="icon-flag menu-icon"></i>
            </a>
          </li>

          <li class="nav-item  <?php if (!empty($menu) && $menu == 'contracts') {
                                  echo 'active';
                                } ?>">
            <a class="nav-link" href="<?php echo base_url('contracts'); ?>">
              <span class="menu-title"><?php echo $this->lang->line('CONTRACTS'); ?></span>
              <i class="icon-bell menu-icon"></i>
            </a>
          </li>


          <li class="nav-item  <?php if (!empty($menu) && $menu == 'reports') {
                                  echo 'active';
                                } ?>">
            <a class="nav-link" href="<?php echo base_url('reports'); ?>">
              <span class="menu-title"><?php echo $this->lang->line('REPORTS'); ?></span>
              <i class="icon-key menu-icon"></i>
            </a>
          </li>




          <li class="nav-item  <?php if (!empty($menu) && $menu == 'advertisement') {
                                  echo 'active';
                                } ?>">
            <a class="nav-link" href="<?php echo base_url('advertisement'); ?>">
              <span class="menu-title"><?php echo $this->lang->line('ADVERTISEMENT'); ?></span>
              <i class="icon-screen-desktop menu-icon"></i>
            </a>
          </li>



        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">