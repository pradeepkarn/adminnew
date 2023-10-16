<?php $rtl = ($ln == 'ar') ? '.rtl' : null;
define('rtl', $rtl);
$sess = (object)($this->session->userdata);
// echo $sess->ag_id;
// echo $sess->ag_can_create;
// echo $sess->ag_can_read;
// echo $sess->ag_can_delete;
// echo $sess->ag_can_update;
// echo $sess->ag_view_stats;
?>
<!DOCTYPE html>
<html <?php echo ($ln == 'ar') ? 'lang="ar" dir="rtl"' : 'lang="en"'; ?>>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/logo.png">

    <!-- Previuos files -->
    <title><?php echo $this->lang->line('PROJECT_NAME'); ?></title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?php echo base_url('assets/vendors/simple-line-icons/css/simple-line-icons.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/vendors/flag-icon-css/css/flag-icon.min.css'); ?>">
    <link rel="stylesheet" href="<?php //echo base_url('assets/vendors/css/vendor.bundle.base.css'); 
                                    ?>">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="<?php //echo base_url('assets/vendors/font-awesome/css/font-awesome.min.css'); 
                                    ?>" />
    <link rel="stylesheet" href="<?php //echo base_url('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css'); 
                                    ?>">
    <link rel="stylesheet" href="<?php // echo base_url('assets/vendors/jvectormap/jquery-jvectormap.css'); 
                                    ?>">
    <link rel="stylesheet" href="<?php //echo base_url('assets/vendors/daterangepicker/daterangepicker.css'); 
                                    ?>">
    <link rel="stylesheet" href="<?php //echo base_url('assets/vendors/chartist/chartist.min.css'); 
                                    ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style_w3.css'); ?>">
    <link href="<?php //echo base_url('assets/vendors/dropify/dropify.min.css'); 
                ?>" rel="stylesheet" />

    <link rel="stylesheet" href="<?php //echo base_url('assets/vendors/jquery-toast-plugin/jquery.toast.min.css'); 
                                    ?>">


    <?php if ($this->router->fetch_method() == "permission") { ?>
        <link rel="stylesheet" href="<?php //echo base_url('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') 
                                        ?>">
    <?php } ?>
    <?php if ($this->router->fetch_method() == "addpermission" || $this->router->fetch_method() == "editpermission") { ?>
        <link rel="stylesheet" href="<?php // echo base_url('assets/vendors/ion-rangeslider/css/ion.rangeSlider.css'); 
                                        ?>">
    <?php } ?>
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script> -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="<?php // echo base_url('assets/css/demo_1/style.css'); 
                                    ?>">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.png');
                                    ?>" />
    <script src="<?php //echo base_url('assets/vendors/js/vendor.bundle.base.js'); 
                    ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <script src="<?php echo base_url('assets/static/assets/libs/jquery/dist/jquery.min.js'); ?>"></script>
    <!-- New files CSS -->
    <?php echo ($ln == 'ar') ? '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.rtl.min.css" integrity="sha384-PRrgQVJ8NNHGieOA1grGdCTIt4h21CzJs6SnWH4YMQ6G5F5+IEzOHz67L4SQaF0o" crossorigin="anonymous">' : '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">'; ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">

    <link href="<?php echo base_url("assets/static/dist/css/style{$rtl}.css"); ?>" rel="stylesheet">
    <link href="<?php //echo base_url('assets/static/assets/extra-libs/c3/c3.min.css'); 
                ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/static/assets/libs/chartist/dist/chartist.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/static/assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css'); ?>" rel="stylesheet" />
    <link href="<?php //echo base_url('assets/static/dist/css/style.min.css" rel="stylesheet'); 
                ?>">
    <script src="<?php //echo base_url('assets/static/assets/libs/chartist/dist/chartist.min.js'); 
                    ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <style>
        .navbar .navbar-brand-wrapper .navbar-brand img {
            height: auto
        }
    </style>

</head>


<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin6">
            <nav class="navbar top-navbar navbar-expand-md">
                <div class="navbar-header" data-logobg="skin6">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <div class="navbar-brand">
                        <!-- Logo icon -->
                        <a href="<?php echo base_url('dashboard'); ?>">
                            <b class="logo-icon">
                                <!-- Dark Logo icon -->
                                <img src="<?php echo base_url('assets/images/logo.png'); ?>" alt="homepage" style="width: 20%;  padding-top: 10px;" class="dark-logo" />
                                <!-- Light Logo icon -->
                                <img src="<?php echo base_url('assets/images/logo.png'); ?>" alt="homepage" style="width: 20%;  padding-top: 10px;" class="light-logo" />
                            </b>
                            <!--End Logo icon -->
                            <!-- Logo text -->
                            <!-- <span class="logo-text">
                                dark Logo text -->
                            <!-- <img src="assets/images/logo-text.png" alt="homepage" class="dark-logo" />
                                 Light Logo text
                                <img src="assets/images/logo-light-text.png" class="light-logo" alt="homepage" />
                            </span> -->
                        </a>
                    </div>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav ml-3 pl-1">
                        <!-- Notification -->

                        <li class="nav-item dropdown d-none d-md-block ms-3">
                            <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

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
                            </a>
                            <div class="dropdown-menu dropdown user-dd animated flipInY">
                                <a href="<?php echo base_url('switchlanguage/en'); ?>" class="dropdown-item">
                                    <i class="flag-icon flag-icon-us"></i> English </a>
                                <a href="<?php echo base_url('switchlanguage/ar'); ?>" class="dropdown-item">
                                    <i class="flag-icon flag-icon-sa"></i> عربي</a>
                            </div>
                        </li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav ms-auto">
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        <!-- <li class="nav-item d-none d-md-block">
                            <a class="nav-link" href="javascript:void(0)">
                                <form>
                                    <div class="customize-input">
                                        <input name="search" class="form-control custom-shadow custom-radius border-0 bg-white" type="search" placeholder="Search" aria-label="Search">
                                        <i class="form-control-icon" data-feather="search"></i>
                                        <input type="hidden" name="page" value="<?php //echo $menu; 
                                                                                ?>">
                                    </div>
                                </form>
                            </a>
                        </li> -->
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="<?php echo base_url('assets/images/faces/profile.png'); ?>" alt="user" class="rounded-circle" width="40">
                                <span class="ml-2 d-none d-lg-inline-block">
                                    <span class="text-dark"><?php echo $this->session->userdata('sess_user_name'); ?></span> <i data-feather="chevron-down" class="svg-icon"></i></span>

                            </a>
                            <div class="dropdown-menu dropdown-menu-<?php echo $rtl ? 'left' : 'right'; ?> user-dd animated flipInY">
                                <a class="dropdown-item" href="javascript:void(0)"><i data-feather="user" class="svg-icon mr-2 ml-1"></i>
                                    <?php echo $this->session->userdata('sess_user_name'); ?>
                                </a>
                                <!-- <a class="dropdown-item" href="javascript:void(0)"><i data-feather="credit-card" class="svg-icon mr-2 ml-1"></i>
                                    My Balance</a> -->
                                <a class="dropdown-item" href="javascript:void(0)"><i data-feather="mail" class="svg-icon mr-2 ml-1"></i>
                                    <?php echo $this->session->userdata('sess_user_email'); ?>
                                </a>
                                <div class="dropdown-divider"></div>
                                <!-- <a class="dropdown-item" href="javascript:void(0)"><i data-feather="settings" class="svg-icon mr-2 ml-1"></i>
                                    Account Setting</a> -->
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?php echo base_url('logout'); ?>"><i data-feather="power" class="svg-icon mr-2 ml-1"></i>
                                    Logout</a>
                                <!-- <div class="dropdown-divider"></div>
                                <div class="pl-4 p-3"><a href="javascript:void(0)" class="btn btn-sm btn-info">View
                                        Profile</a></div> -->
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">

                        <?php if ($sess->ag_view_stats == 1) : ?>
                            <li class="sidebar-item selected"> <a class="sidebar-link sidebar-link" href="<?php echo base_url('dashboard'); ?>" aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span class="hide-menu"><?php echo $this->lang->line('DASHBOARD'); ?></span></a></li>
                        <?php endif; ?>


                        <?php if ($sess->ag_can_read == 1 || $sess->ad_offer == 1) : ?>
                        <?php endif; ?>
                        <?php if ($sess->ag_can_read == 1) : ?>
                            <li class="list-divider"></li>
                            <li class="sidebar-item  <?php if (!empty($menu) && $menu == 'tenants') {
                                                            echo 'active';
                                                        } ?>">
                                <a class="sidebar-link" href="<?php echo base_url('tenants'); ?>">
                                    <!-- <i class="icon-key menu-icon"></i> -->
                                    <i data-feather="users" class="feather-icon"></i>
                                    <span class="menu-title"><?php echo $this->lang->line('TENANTS'); ?></span>
                                </a>
                            </li>

                            <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="<?php echo base_url('owners'); ?>" aria-expanded="false"><i data-feather="user" class="feather-icon"></i><span class="hide-menu"><?php echo $this->lang->line('OWNERS'); ?></span></a></li>
                            <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="<?php echo base_url('properties'); ?>" aria-expanded="false"><i data-feather="command" class="feather-icon"></i><span class="hide-menu"><?php echo $this->lang->line('PROPERTIES_UNITS'); ?></span></a></li>



                            <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="<?php echo base_url('contracts'); ?>" aria-expanded="false"><i data-feather="file-text" class="feather-icon"></i><span class="hide-menu"><?php echo $this->lang->line('CONTRACTS'); ?></span></a></li>
                            <!-- <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="<?php echo base_url('reports/pending-installments'); ?>" aria-expanded="false"><i data-feather="file-text" class="feather-icon"></i><span class="hide-menu"><?php echo $this->lang->line('REPORTS'); ?></span></a></li>
 -->




                            <li class="sidebar-item dropdown">
                                <a class="sidebar-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i data-feather="file-text" class="feather-icon"></i><span class="hide-menu"><?php echo $this->lang->line('REPORTS'); ?></span>
                                </a>
                                <div class="dropdown-menu dropdown">
                                    <a class="dropdown-item" href="<?php echo base_url('reports/pending-installments'); ?>">
                                        <?php echo $this->lang->line('PENDING_INSTALLMENTS'); ?>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="<?php echo base_url('reports/expiring-contracts'); ?>">
                                        <?php echo $this->lang->line('EXPIRING_CONTRACTS'); ?>
                                    </a>

                                </div>
                            </li>





                            <!-- <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="<?php echo base_url('reports/expiring-contracts'); ?>" aria-expanded="false"><i data-feather="file-text" class="feather-icon"></i><span class="hide-menu"><?php echo $this->lang->line('EXPIRING_CONTRACTS'); ?></span></a></li> -->

                        <?php endif; ?>
                        <?php if ($sess->ad_offer == 1) : ?>
                            <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="<?php echo base_url('realstate-offer-list'); ?>" aria-expanded="false"><i data-feather="file-text" class="feather-icon"></i><span class="hide-menu"><?php echo $this->lang->line('REAL_ESTATE_OFFERS_LIST'); ?></span></a></li>
                        <?php endif; ?>
                        <?php if ($sess->ag_can_create == 1 && $sess->ag_can_update == 1 && $sess->ag_can_read == 1 && $sess->ag_can_delete == 1 && $sess->ag_view_stats == 1) : ?>
                            <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="<?php echo base_url('users'); ?>" aria-expanded="false"><i data-feather="file-text" class="feather-icon"></i><span class="hide-menu"><?php echo $this->lang->line('ADMINS'); ?></span></a></li>
                        <?php endif; ?>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->