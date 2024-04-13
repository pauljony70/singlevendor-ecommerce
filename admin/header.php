<?php

header('Cache-Control: no cache');
?>
<!--
Author: Jony Paul
Author URL: https://github.com/pauljony70
-->
<!DOCTYPE HTML>
<html>

<head>
  <title>Dashboard, Admin panel</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="keywords" content="Dashboard,Admin panel, blueappsoftware" />
  <!-- App favicon -->
  <link rel="shortcut icon" href="<?= BASEURL . 'assets/images/favicon_io/favicon.ico' ?>">

  <!-- Plugins css -->
  <link href="assets/libs/flatpickr/flatpickr.min.css" rel="stylesheet" type="text/css" />
  <link href="assets/libs/selectize/css/selectize.bootstrap3.css" rel="stylesheet" type="text/css" />
  <link href="assets/libs/mohithg-switchery/switchery.min.css" rel="stylesheet" type="text/css" />
  <link href="assets/libs/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />
  <link href="assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
  <link href="assets/libs/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
  <link href="assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" type="text/css" />
  <link href="assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
  <link href="assets/libs/clockpicker/bootstrap-clockpicker.min.css" rel="stylesheet" type="text/css" />
  <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
  <link href="assets/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css" />
  <link href="assets/libs/dropify/css/dropify.min.css" rel="stylesheet" type="text/css" />
  <link href="assets/libs/busyload/app.min.css" rel="stylesheet" type="text/css" />
  <link href="assets/libs/auto-complete/jquery-ui.css" rel="stylesheet" type="text/css" />
  <link href="assets/libs/ladda/ladda-themeless.min.css" rel="stylesheet" type="text/css" />
  <!-- <link href="<?= BASEURL; ?>admin/assets/css/jquery.multiselect.css" rel="stylesheet" /> -->

  <!-- third party css -->
  <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
  <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
  <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
  <link href="assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css" rel="stylesheet" type="text/css" />
  <!-- third party css end -->

  <!-- App css -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
  <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

  <link href="assets/css/bootstrap-dark.min.css" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" disabled />
  <link href="assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="app-dark-stylesheet" disabled />

  <!-- icons -->
  <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Custom CSS -->
  <!-- <link href="css/style.css" rel='stylesheet' type='text/css' /> -->

  <link rel="stylesheet" href="css/export.css" type="text/css" media="all" />

  <style media="screen">
    .ui-widget-content {
      z-index: 99999;
    }

    .form-control:disabled,
    .form-control[readonly] {
      background-color: #f3f3f3;
    }

    .pro-user-name {
      color: #fff;
    }

    .zoomable-img {
      transition: all .2s linear;
    }

    .zoomable-img:hover {
      transform: scale(4);
    }

    .table {
      color: #000 !important;
    }

    .top-bar {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      height: 24px;
      background-color: #FF6600;
      color: #fff;
      box-sizing: border-box;
      z-index: 1001;
    }

    .new-logo-box {
      height: 70px;
      width: 100%;
      float: left;
      transition: all .1s ease-out;
    }

    .new-logo-box .logo {
      line-height: 70px;
    }

    @media (max-width: 576px) {
      .support-mail {
        margin-top: 0.25rem;
      }
    }

    #loading-animation {
      position: fixed;
      top: 0px;
      left: 0px;
      background: rgba(0, 0, 0, 0.21);
      color: rgb(255, 255, 255);
      display: flex;
      align-items: center;
      justify-content: center;
      width: 100%;
      height: 100%;
      z-index: 9999
    }

    /* Pagination */
    .pagination li a,
    .pagination li span {
      padding: 7px 15px;
    }

    .pagination li {
      padding: 5px 0px;
      border: 1px solid #ced4da;
      border-radius: .2rem;
      cursor: pointer;
    }

    /* .pagination li a {
      color: #6c757d;
    } */

    .pagination li.active,
    .pagination li:not(.disabled):hover {
      color: #fff !important;
      background-color: #1d2128;
      border-color: #171b21;
    }

    .pagination li:hover a {
      color: #fff !important;
    }

    .pagination li:has(.disabled) {
      cursor: not-allowed;
    }

    .pagination li:has(.disabled):hover {
      color: #6c757d !important;
      background-color: #fff;
      border-color: #ced4da;
    }

    li {
      list-style-type: none;
    }
  </style>
  <style type="text/css" media="print">
    @media print {
      @page {
        margin-top: 0;
        margin-bottom: 0;
      }

      body {
        padding-top: 72px;
        padding-bottom: 72px;
      }
    }

    .dontprint {
      display: none;
    }
  </style>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.0.16/jspdf.plugin.autotable.js"></script>
  <script src="assets/js/vendor.min.js"></script>
  <script src="js/common.js"></script>
</head>

<body data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": false}, "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": true}'>
  <!-- <div id="loading-animation">
    <div class="busy-load-container-item" style="background: none; display: flex; justify-content: center; align-items: center; flex-direction: row-reverse;">
      <div class="spinner-pump busy-load-spinner-css busy-load-spinner" style="max-height: 50px; max-width: 50px; min-height: 20px; min-width: 20px;">
        <div class="double-bounce1" style="background-color: rgb(255, 255, 255); margin-right: 0.9rem;"></div>
        <div class="double-bounce2" style="background-color: rgb(255, 255, 255); margin-right: 0.9rem;"></div>
      </div>
    </div>
  </div> -->
  <div id="wrapper">
    <div class="navbar-custom">
      <div class="container-fluid">
        <ul class="list-unstyled topnav-menu float-right mb-0">

          <li class="dropdown notification-list topbar-dropdown">
            <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
              <span class="pro-user-name ml-1">
                <?= $_SESSION['seller_name']; ?> <i class="mdi mdi-chevron-down"></i>
              </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
              <!-- item-->
              <div class="dropdown-header noti-title">
                <h6 class="text-overflow m-0">Welcome !</h6>
              </div>

              <!-- item-->
              <!-- <a href="profile.php" class="dropdown-item notify-item">
                <i class="fe-user"></i>
                <span>Profile</span>
              </a> -->

              <div class="dropdown-divider"></div>

              <!-- item-->
              <a class="dropdown-item notify-item" href="logout.php"><i class="fe-log-out"></i>
                Logout
              </a>

            </div>
          </li>

        </ul>

        <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
          <li>
            <button class="button-menu-mobile waves-effect">
              <i class="fe-menu"></i>
            </button>
          </li>

          <li>
            <!-- Mobile menu toggle (Horizontal Layout)-->
            <a class="navbar-toggle nav-link" data-toggle="collapse" data-target="#topnav-menu-content">
              <div class="lines">
                <span>
                  <div class="logo-box">
                    <a href="#" class="logo logo-light">
                      <span class="logo-sm">
                        <img src="assets/images/logo.png" alt="" height="40">
                      </span>
                      <span class="logo-lg">
                        <img src="assets/images/logo.png" alt="" height="40">
                      </span>
                    </a>
                  </div>
                </span>
                <span></span>
                <span></span>
              </div>
            </a>
            <!-- End mobile menu toggle-->
          </li>
          <!-- z -->
        </ul>
        <div class="clearfix"></div>
      </div>
    </div>

    <!-- Sidebar -->
    <div class="left-side-menu">
      <div class="h-100" data-simplebar>
        <div class="user-box text-center">
          <img src="" alt="user-img" title="Mat Helme" class="rounded-circle avatar-md">
          <div class="dropdown">
            <a href="javascript: void(0);" class="text-dark dropdown-toggle h5 mt-2 mb-1 d-block" data-toggle="dropdown">Admin</a>
            <div class="dropdown-menu user-pro-dropdown">

              <a href="javascript:void(0);" class="dropdown-item notify-item">
                <i class="fe-user mr-1"></i>
                <span>My Account</span>
              </a>
              <a href="javascript:void(0);" class="dropdown-item notify-item">
                <i class="fe-settings mr-1"></i>
                <span>Settings</span>
              </a>
              <a href="javascript:void(0);" class="dropdown-item notify-item">
                <i class="fe-lock mr-1"></i>
                <span>Lock Screen</span>
              </a>
              <a href="javascript:void(0);" class="dropdown-item notify-item">
                <i class="fe-log-out mr-1"></i>
                <span>Logout</span>
              </a>

            </div>
          </div>
          <p class="text-muted">Admin Head</p>
        </div>
        <div id="sidebar-menu">
          <ul id="side-menu">
            <li class="menu-title">Navigation</li>

            <?php if ($_SESSION['roll']  == "admin") { ?>

              <li>
                <a href="dashboard.php">
                  <i class="fa fa-dashboard"></i>
                  <span>Dashboard</span>
                </a>
              </li>

              <li>
                <a href="category.php">
                  <i class="fa-solid fa-bars-staggered"></i>
                  <span>Category</span>
                </a>
              </li>
              <li>
                <a href="brand.php">
                  <i class="fa-solid fa-list"></i>
                  <span>Brand</span>
                </a>
              </li>

              <li>
                <a href="homepage-banner-website.php">
                  <i class="fa-solid fa-earth-americas"></i>
                  <span>Home Page - Website</span>
                </a>
              </li>

              <li>
                <a href="#produdct" data-toggle="collapse">
                  <i class="fa-solid fa-cube"></i>
                  <span> Product </span>
                  <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="produdct">
                  <ul class="nav-second-level">
                    <li>
                      <a href="add_product.php">Add Product</a>
                    </li>
                    <li>
                      <a href="manage-conf-attributes.php">Manage Attributes</a>
                    </li>
                    <li>
                      <a href="manage_product_filter.php">Manage Product</a>
                    </li>
                    <li>
                      <a href="custom-navigations.php">Custom Navigations</a>
                    </li>
                  </ul>
                </div>
              </li>

              <li>
                <a href="orders.php">
                  <i class="fa-solid fa-truck-fast"></i>
                  <span>Order List</span>
                </a>
              </li>

              <!-- <li>
                <a href="return_productlist.php">
                  <i class="fa fa-dashboard"></i>
                  <span>Return Request</span>
                </a>
              </li> -->

              <li>
                <a href="account.php">
                  <i class="fa-solid fa-file-invoice"></i>
                  <span>Sale Account</span>
                </a>
              </li>

              <li>
                <a href="account.php">
                  <i class="fa-solid fa-rocket"></i>
                  <span>Campaign</span>
                </a>
              </li>

              <!-- <li>
                <a href="spinners.php">
                  <i class="fa-solid fa-arrows-spin"></i>
                  <span>Spinners</span>
                </a>
              </li> -->

              <!-- <li>
                <a href="pincodelist.php">
                  <i class="fa fa-dashboard"></i> <span>Shipping Pincodes</span>
                </a>
              </li> -->
              <li style="display:none;">
                <a href="#">
                  <i class="fa fa-laptop"></i>
                  <span>Pincode / Delivery Time</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="pincodelist.php"><i class="fa fa-angle-right"></i>Pincodes</a></li>
                  <li><a href="deliverytime.php"><i class="fa fa-angle-right"></i>Delivery Time</a></li>

                </ul>
              </li>

              <li>
                <a href="store_setting.php">
                  <i class="fa-solid fa-earth-asia"></i>
                  <span>Custom Pages</span>
                </a>
              </li>

              <li>
                <a href="store_setting.php">
                  <i class="fa-solid fa-gear"></i>
                  <span>Store Setting</span>
                </a>
              </li>

              <li>
                <a href="userlist.php">
                  <i class="fa-solid fa-user"></i>
                  <span>App User</span>
                </a>
              </li>
              <!-- <li>
                <a href="notifyme.php">
                  <i class="fa fa-dashboard"></i> <span>Notify Me</span>
                </a>
              </li> -->

              <!-- <li>
                <a href="review.php">
                  <i class="fa fa-dashboard"></i> <span>Review</span>
                </a>
              </li> -->

              <li>
                <a href="support.php">
                  <i class="fa-solid fa-headphones-simple"></i>
                  <span>Support</span>
                </a>
              </li>
            <?php } else { ?>

              <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="sidebar-menu" style="overflow: auto;">
                  <li>
                    <a href="orders.php">
                      <i class="fa fa-dashboard"></i> <span>Order List</span>
                    </a>
                  </li>
                  <li>
                    <a href="return_productlist.php">
                      <i class="fa fa-dashboard"></i> <span>Return Request</span>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-laptop"></i>
                      <span>Products</span>
                      <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                      <li><a href="add_product.php"><i class="fa fa-angle-right"></i> Add Product</a></li>
                      <li><a href="manage_product.php"><i class="fa fa-angle-right"></i> Manage Product</a></li>
                      <li><a href="discountproducts.php"><i class="fa fa-angle-right"></i> Discount Product</a></li>
                      <li><a href="latestproducts.php"><i class="fa fa-angle-right"></i> Latest Product</a></li>
                      <li><a href="popularproducts.php"><i class="fa fa-angle-right"></i>Popular Product</a></li>
                      <li><a href="homepagecategory.php"><i class="fa fa-angle-right"></i>HomePage Category</a></li>

                    </ul>
                  </li>
                </ul>
              </div>
            <?php } ?>
            <!-- /.navbar-collapse -->
          </ul>
        </div>
      </div>
    </div>
    <!-- End Sidebar -->


    <!-- //header-ends -->
    <div class="loading" style="display:none;">Loading&#8230;</div>
    <input type="hidden" name="code_ajax" id="code_ajax" value="<?= $_SESSION['_token']; ?>">
    <input type="hidden" name="base_url" id="base_url" value="<?= BASEURL ?>">
    <input type="hidden" name="media_url" id="media_url" value="<?= MEDIA_URL ?>">
    <link href="css/xdialog.min.css" rel="stylesheet" />
    <script type="text/javascript" src="js/xdialog.min.js"></script>